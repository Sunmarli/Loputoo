<?php
require_once('conf.php');
global $yhendus;
session_start();

if (!isset($_SESSION['user_id'])) {
    header("Location: login.php");
    exit();
}
$user_id = $_SESSION['user_id'];

// Prepare SQL statement with JOIN operation
// Fetch data from offers_table based on the user_id in session
$sql = "SELECT advert_table.advert_id, advert_table.advert_title, offers_table.offer_description, offers_table.price, cu.company_name
        FROM advert_table
        INNER JOIN offers_table ON advert_table.advert_id = offers_table.advert_id
        INNER JOIN company_users cu ON offers_table.company_id = cu.company_id
        WHERE offers_table.user_id = ?";
$stmt = $yhendus->prepare($sql);
$stmt->bind_param("i", $_SESSION['user_id']); // Assuming you have the user_id in session
$stmt->execute();
$stmt->bind_result($advert_id, $advert_title, $offer_description, $price, $company_name);

// Fetch the data into an array of objects
$sonumid= array();
while ($stmt->fetch()) {
    $sonum = new stdClass();
    $sonum->user_id= $user_id;
    $sonum->advert_id = $advert_id;
//    $advert->offer_id = $offer_id;
    $sonum->offer_description = $offer_description;
    $sonum->advert_title = $advert_title;
    $sonum->price = $price;
    $sonum->company_name = htmlspecialchars($company_name);
    $sonumid[] = $sonum;
}

$stmt->close();
//if (isset($_POST["delete"])) {
//    delete_sonum($_POST["advert_id"]);
//    header("Location: " . $_SERVER['PHP_SELF']);
//    exit();
//}

$yhendus->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <title>Website</title>
    <?php include 'head-links.php'; ?>
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">

</head>
<body>
<div class="container-fluid px-0">
    <!-- Navbar -->
    <?php include 'nav-bar.php'?>
    <!-- End Navbar -->

    <!-- Main content -->
    <main>
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-md-10 mb-5">
                    <h2 class="mt-5">Sõnumid sulle</h2>
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th class="text-left col-2" scope="col">Kuulutus</th>
                                <th class="text-left col-5" scope="col">Sõnum</th> <!-- Adjusted column width to col-4 -->
                                <th class="text-right" scope="col">Hind</th>
                                <th class="text-right" scope="col">Firma</th>
                                <th></th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach($sonumid as $sonum): ?>
                                <tr>
                                    <td class="text-left ">

                                        <div style="max-height: 3em; overflow: hidden;">
                                            <?=$sonum->advert_title ?>
                                        </div>

                                    </td>
                                    <td class="text-left ">

                                            <div style="max-height: 3em; overflow: hidden;">
                                                <?=$sonum->offer_description ?>
                                            </div>

                                    </td>
                                    <td class="text-right ">
                                        <?=$sonum->price?>
                                    </td>
                                    <td class="text-right">
                                        <?=$sonum->company_name?>
                                    </td>
                                    <td>
                                        <div class="d-flex justify-content-center align-items-center ">
                                            <a class="btn custom-button" href="firma_data.php?advert_id=<?= $sonum->advert_id ?>"">Vaata</a>
<!--                                            <form id="deleteForm--><?php //= $sonum->offer_id ?><!--" method="post" action="--><?php //echo $_SERVER['PHP_SELF']; ?><!--" class="ml-3">-->
<!--                                                <input type="hidden" name="advert_id" value="--><?php //= $sonum->advert_id ?><!--">-->
<!--                                                <i class="material-icons delete-icon" data-form-id="deleteForm--><?php //= $sonum->advert_id ?><!--" style="cursor: pointer;">delete</i>-->
<!--                                            </form>-->

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
