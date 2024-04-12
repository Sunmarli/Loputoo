<?php
require_once('conf.php');
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}

// Check if advert_id is provided in the URL
if (isset($_GET['advert_id'])) {
    $advert_id = $_GET['advert_id'];
} else {
    echo 'No advert id provided';
    exit();
}

// Prepare SQL statement to fetch data based on advert_id
$sql = "SELECT advert_table.advert_id, advert_table.advert_title, offers_table.offer_description, offers_table.offer_id, offers_table.price, cu.company_name, cu.email, cu.telephone, cu.registration_code
        FROM advert_table
        INNER JOIN offers_table ON advert_table.advert_id = offers_table.advert_id
        INNER JOIN company_users cu ON offers_table.company_id = cu.company_id
        WHERE advert_table.advert_id = ?";
$stmt = $yhendus->prepare($sql);
$stmt->bind_param("i", $advert_id);
$stmt->execute();
$stmt->bind_result($advert_id, $advert_title, $offer_description, $offer_id, $price, $company_name, $email, $telephone, $registration_code);
$stmt->fetch();
$stmt->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Website</title>
    <?php include 'head-links.php'; ?>
</head>
<body>

<div class="container-fluid px-0">
    <!-- Navbar -->
    <?php include 'nav-bar.php'; ?>
    <!-- End Navbar -->

    <!-- Main content -->
    <main class="bg-light">
        <div class="container mt-5">
            <div class="row justify-content-center">
                <div class="col-md-8 order-md-1">
                    <div class="row rounded p-3" style="background-color: #edeff1">
                        <h3 class="mb-4 mt-4">
                            <?= $advert_title ?>
                        </h3>
                        <h4>Kuulutuse ID: <?= $advert_id ?></h4>
                        <div class="card p-2 mb-5">
                            <table class="table table-borderless">
                                <tbody>
                                <tr class="table-row">
                                    <td>Firma:</td>
                                    <td><?= $company_name ?></td>
                                </tr>
                                <tr class="table-row">
                                    <td>Pakkumine:</td>
                                    <td><?= $offer_description ?></td>
                                </tr>
                                <tr class="table-row">
                                    <td>Hind:</td>
                                    <td><?= $price ?></td>
                                </tr>

                                <tr class="table-row">
                                    <td>Firma email:</td>
                                    <td><?= $email ?></td>
                                </tr>
                                <tr class="table-row">
                                    <td>Registrikood:</td>
                                    <td><?= $registration_code ?></td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                        <a class="btn custom-button2" href="user-msgbox.php">Tagasi</a>
                    </div>
                </div>
            </div>
        </div>
    </main>
    <!-- End Main content -->

    <!-- Contact -->
    <?php include 'contact.php'; ?>
    <!-- End Contact -->

</div>

<hr>

<!-- Footer -->
<footer class="text-center py-4">
    <div class="container px-5 mb-2">Autor: Maria-Julia Jarv</div>
</footer>
<!-- End Footer -->

<!-- Leaflet JS -->
<?php include 'script-links.php'; ?>
</body>
</html>
