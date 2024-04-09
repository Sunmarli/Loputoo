<?php
require_once('conf.php');

global $yhendus;

// Pagination parameters
$results_per_page = 8;
if (!isset($_GET['page'])) {
    $page = 1;
} else {
    $page = $_GET['page'];
}
$start_from = ($page - 1) * $results_per_page;

// Fetch data with pagination and sorting
$stmt = $yhendus->prepare("SELECT a.advert_id, a.user_id, a.advert_title, a.region, a.city, a.work_start_date, a.created_at, u.username 
                           FROM advert_table a 
                           JOIN users u ON a.user_id = u.user_id 
                           ORDER BY a.created_at DESC 
                           LIMIT ?, ?");
$stmt->bind_param("ii", $start_from, $results_per_page);
$stmt->execute();
$stmt->bind_result($advert_id, $user_id, $advert_title, $region, $city, $work_start_date, $created_at, $username);

$advertisements = array();

// Fetch data from the database and store it in the $advertisements array
while ($stmt->fetch()) {
    $advert = new stdClass();
    $advert->advert_id = $advert_id;
    $advert->user_id = $user_id;
    $advert->username = $username;
    $advert->advert_title = htmlspecialchars($advert_title);
    $advert->region = htmlspecialchars($region);
    $advert->city = htmlspecialchars($city);
    $advert->work_start_date = $work_start_date;
    $advert->created_at = $created_at;
    array_push($advertisements, $advert);
}


$stmt->close();
//Pagination
// Count total number of records
$stmt = $yhendus->prepare("SELECT COUNT(*) AS total FROM advert_table");
$stmt->execute();
$stmt->bind_result($total_records);
$stmt->fetch();
$stmt->close();

// Calculate total number of pages
$total_pages = ceil($total_records / $results_per_page);

// Function to count offers for a specific advert
function countOffersForAdvert($advert_id, $yhendus)
{
    // Prepare SQL statement to count offers for the specified advert_id
    $stmt = $yhendus->prepare("SELECT COUNT(*) FROM offers_table WHERE advert_id = ?");
    $stmt->bind_param("i", $advert_id);
    $stmt->execute();
    $stmt->bind_result($offer_count);
    $stmt->fetch();
    $stmt->close();

    // Return the count of offers for the advert
    return $offer_count;
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <title> Website</title>
    <?php include 'head-links.php'; ?>
    <!-- Custom CSS -->
    <link rel="stylesheet" href="/css/styles.css">
</head>
<body>
<section id="main content" class="text-center py-5">
    <!-- Main table -->
    <div class="container">
        <div class="row">
            <div class="col-md-12">
                <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                        <tr>
                            <th class="first text-left black-heading" scope="col">Kuulutus</th>
                            <th scope="col" class="black-heading">Lisatud</th>

                            <th scope="col" class="black-heading">Pakkumisi </th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach($advertisements as $advert): ?>
                            <?php
                            // Count the number of offers for the current advertisement
                            $offer_count = countOffersForAdvert($advert->advert_id, $yhendus);
                            ?>
                            <tr class="">
                                <td class="first paddingmob0 bordermob0">
                                    <div class="row">
                                        <div class="col-lg-3">
                                            <div class="table-img">
                                                <picture>
                                                    <img src="images/sided-view-hand-filling-document.jpg" style="height: 120px; width: 120px; object-fit: cover;" alt="">
                                                </picture>
                                            </div>
                                        </div>
                                        <div class="col-lg-9 text-left">
                                            <h4 style="word-wrap: break-word;">
                                                <a class="border-link black-link" href="advert_detailed.php?advert_id=<?= $advert->advert_id ?>">
                                                    <?=$advert->advert_title ?>
                                                </a>
                                            </h4>
                                            <div class="table-files">
                                                <span>Kasutaja : <?=$advert->username ?></span>
                                            </div>
                                            <p>
                                                <span class="light">Asukoht:</span> <?=$advert->region ?>, <?=$advert->city ?><br>
                                                <!-- Hanke korraldaja: This seems to be missing -->
                                            </p>
                                            <div class="table-info-mobile">
                                                <span class="light">Pakkumisi:</span> <?= $offer_count ?><strong> </strong><br>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td><?= date("d.m.Y", strtotime($advert->created_at)) ?></td>


                                <td class="bold relative"><?= $offer_count ?></td>
                            </tr>
                        <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
        <!--Pagination-->
        <div class="container">
            <div class="row">
                <div class="col-md-12">
                    <ul class="pagination justify-content-center">
                        <?php for ($i = 1; $i <= $total_pages; $i++) : ?>
                            <li class="page-item <?php if ($i == $page) echo 'active'; ?>">
                                <a class="page-link black-link" href="?page=<?= $i ?>"><?= $i ?></a>
                            </li>
                        <?php endfor; ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>
<!-- jQuery script -->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

<!-- Your custom JavaScript/jQuery code -->
<script>
    $(document).ready(function(){
        <?php if ($page == 2): ?>
        // Scroll to the top of the table after page load if it's the second page
        $('html, body').animate({
            scrollTop: $(".table").offset().top
        }, 500);
        <?php endif; ?>
    });
</script>

</body>
</html>
