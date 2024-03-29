<?php
require_once('conf.php');

global $yhendus;

// Pagination parameters
$results_per_page = 10;
if (!isset($_GET['page'])) {
    $page = 1;
} else {
    $page = $_GET['page'];
}
$start_from = ($page - 1) * $results_per_page;

// Fetch data with pagination and sorting
$stmt = $yhendus->prepare("SELECT advert_id, user_id, advert_title, region, city, work_start_date, created_at FROM advert_table ORDER BY created_at DESC LIMIT ?, ?");
$stmt->bind_param("ii", $start_from, $results_per_page);
$stmt->execute();
$stmt->bind_result($advert_id, $user_id, $advert_title, $region, $city, $work_start_date, $created_at);

$advertisements = array(); // Initialize an array to store advertisements

// Fetch data from the database and store it in the $advertisements array
while ($stmt->fetch()) {
    $advert = new stdClass();
    $advert->advert_id = $advert_id;
    $advert->user_id = $user_id;
    $advert->advert_title = htmlspecialchars($advert_title);
    $advert->region = htmlspecialchars($region);
    $advert->city = htmlspecialchars($city);
    $advert->work_start_date = $work_start_date;
    $advert->created_at = $created_at; // Add created_at to the advertisement object
    array_push($advertisements, $advert);
}

$stmt->close(); // Close the prepared statement

// Count total number of records
$stmt = $yhendus->prepare("SELECT COUNT(*) AS total FROM advert_table");
$stmt->execute();
$stmt->bind_result($total_records);
$stmt->fetch();
$stmt->close();

// Calculate total number of pages
$total_pages = ceil($total_records / $results_per_page);

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <title> Website</title>

    <!-- Montserrat Font -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- Material Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet">

    <!-- Leaflet CSS -->
    <link href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css" rel="stylesheet">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/styles.css">
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
                            <th class="first text-left" scope="col">Kuulutus</th>
                            <th scope="col">Lisatud</th>
                            <th scope="col">Some more column</th>
                            <th scope="col">Pakkumisi näiteks?</th>
                        </tr>
                        </thead>
                        <tbody>
                        <?php foreach($advertisements as $advert): ?>
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
                                            <h4 style="word-wrap: break-word;"> <a class="border-link" href="advert_detailed.php?advert_id=<?= $advert->advert_id ?>">
                                                    <?=$advert->advert_title ?>
                                                </a>
                                            </h4>
                                            <div class="table-files">
                                                <span>Kasutaja ID: <?=$advert->user_id ?></span>
                                            </div>
                                            <p>
                                                <span class="light">Asukoht:</span> <?=$advert->region ?>, <?=$advert->city ?><br>
                                                <!-- Hanke korraldaja: This seems to be missing -->
                                            </p>
                                            <div class="table-info-mobile">
                                                <span class="light">Pakkumisi:</span><strong>35</strong><br>
                                            </div>
                                        </div>
                                    </div>
                                </td>
                                <td><?= date("d.m.Y", strtotime($advert->created_at)) ?></td>

                                <td>Aktiivne näiteks?</td>
                                <td class="bold relative">35</td>
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
                                <a class="page-link" href="?page=<?= $i ?>"><?= $i ?></a>
                            </li>
                        <?php endfor; ?>
                    </ul>
                </div>
            </div>
        </div>
    </div>
</section>

</body>
</html>

