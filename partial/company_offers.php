<?php
require_once('conf.php');
global $yhendus;
session_start();

if (!isset($_SESSION['company_id'])) {
    header("Location: login.php");
    exit();
}
$company_id = $_SESSION['company_id'];

// Prepare SQL statement with JOIN operation
$sql = "SELECT a.advert_id, a.advert_title,o.offer_id, o.offer_description, o.price
        FROM advert_table a
        INNER JOIN offers_table o ON a.advert_id = o.advert_id
        WHERE o.company_id = ?";
$stmt = $yhendus->prepare($sql);
$stmt->bind_param("i", $_SESSION['company_id']);
$stmt->execute();
$stmt->bind_result($advert_id, $advert_title, $offer_id, $offer_description, $price);

// Fetch the data into an array of objects
$advertisements = array();
while ($stmt->fetch()) {
    $advert = new stdClass();
    $advert->advert_id = $advert_id;
    $advert->offer_id = $offer_id;
    $advert->offer_description = $offer_description;
    $advert->advert_title = $advert_title;
    $advert->price = $price;
    $advertisements[] = $advert;
}

$stmt->close();
if (isset($_POST["delete"])) {
    delete_offer($_POST["offer_id"]);
    header("Location: " . $_SERVER['PHP_SELF']);
    exit();
}

function delete_offer($offer_id)
{
    global $yhendus;

    // Now delete the row from advert_table
    $stmt = $yhendus->prepare("DELETE FROM offers_table WHERE offer_id = ?");
    $stmt->bind_param("i", $offer_id);
    $stmt->execute();
    $stmt->close();
}

$yhendus->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <title>Website</title>
<!--  <?php //include 'head-links.php'; ?>  -->

    <!-- Custom CSS -->
    <link rel="stylesheet" href="../css/styles.css">
</head>
<body>
<div class="container-fluid px-0">
    <!-- Navbar -->
    <?php include 'nav-bar.php'?>
    <!-- End Navbar -->

    <!-- Main content -->
    <main>
        <div class="container ">

            <div class="row justify-content-center">
                <div class="col-md-10 mb-5">
                    <h2 class="mt-5">Minu pakkumised</h2>
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th class="text-left" scope="col">Kuulutus</th>
                                <th class="text-left" scope="col">Pakkumise kirjeldus</th>
                                <th class="text-left" scope="col">Hind</th>
                                <th class="text-left" scope="col"></th>

                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach($advertisements as $advert): ?>
                                <tr>
                                    <td>
                                        <div class="row ">
                                            <h5 style="width: 200px; word-wrap: break-word;">
                                                <?=$advert->advert_title ?>
                                            </h5>
                                            </div>

                                    <td ><div class="d-flex justify-content-center align-items-center" style="width: 500px;word-wrap: break-word;">

                                            <p class="truncated-text">
                                                <?= substr($advert->offer_description, 0, 100) ?>
                                            </p>
                                    </td>
                                    <td>
                                            </p>
                                            <?=$advert->price ?></p>
                                    </td>
                                    <td>
<!--                                        <form method="post" action="--><?php //echo $_SERVER['PHP_SELF']; ?><!--" class="ml-3">-->
<!--                                            <input type="hidden" name="offer_id" value="--><?php //= $advert->offer_id ?><!--">-->
<!--                                            <button type="submit" name="delete" class="btn btn-danger ">Kustuta</button>-->
<!--                                        </form>-->
                                        </div>
                                    </td>


                                </tr>
                            <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
    </main>



    <script src="../js/scripts.js"></script>
</div>
</body>

<?php include 'contact.php'; ?>
<!--Footer -->
<?php include 'footer.php'; ?>


</html>
