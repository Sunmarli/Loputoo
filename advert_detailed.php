<?php
require_once ('conf.php');
global $yhendus;
session_start();
$company_id = $_GET['company_id'];


// Check if advert_id is provided in the URL
if (isset($_GET['advert_id'])) {
$advert_id = $_GET['advert_id'];}
$stmt = $yhendus->prepare("SELECT advert_id,user_id, advert_title, region, city, work_start_date, created_at FROM advert_table");
$stmt->bind_result($advert_id, $user_id, $advert_title, $region, $city, $work_start_date, $created_at);
$stmt->execute();

$advertisements = array();

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

$stmt->close();

// Prepare and execute a query to fetch details based on advert_id
$stmt = $yhendus->prepare("SELECT user_id, advert_title, advert_description, region, city, work_start_date,work_end_date, created_at FROM advert_table WHERE advert_id = ?");
$stmt->bind_param("i", $advert_id);
$stmt->execute();
$stmt->bind_result($user_id, $advert_title,$advert_description, $region, $city, $work_start_date,$work_end_date,  $created_at);

if ($stmt->fetch()) {
    $advert = new stdClass();

    $advert->user_id = $user_id;
    $advert->advert_title = htmlspecialchars($advert_title);
    $advert->advert_description=htmlspecialchars($advert_description);
    $advert->region = htmlspecialchars($region);
    $advert->city = htmlspecialchars($city);
    $advert->work_start_date = $work_start_date;
    $advert->created_at = $created_at;

} else {

    echo "Advertisement not found.";
}

// Close the statement
$stmt->close();

?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <title> Website</title>

    <?php include 'partial/head-links.php'; ?>
</head>
<body>

<div class="container-fluid px-0">
    <!-- Navbar -->
    <?php include 'partial/nav-bar-outside-partial.php'; ?>
    <!-- End Navbar -->

    <!-- Main content -->
    <main>
        <body class="bg-light">
        <?php echo  'company id---'.$_SESSION['company_id'];?>
        <?php echo  'Company name----'.$_SESSION['company_name'];?>
        <div class="container mt-5">
            <div class="row rounded p-3" style="background-color: #edeff1" >

                <div class="col-md-8 order-md-1" >
                    <h3 class="mb-4 mt-4"><?=$advert_title ?></h3>
                    <div class="card p-2">
                        <table class="table table-borderless">
                            <colgroup>
                                <col style="width: 50%">
                                <col style="width: 50%">
                            </colgroup>
                            <tbody>
                            <tr class="table-row">
                                <td>Hanke lõpp:</td>
                                <td><?=$work_start_date ?></td>
                            </tr>
                            <tr class="table-row">
                                <td>Maakond:</td>
                                <td><?=$region ?></td>
                            </tr>
                            <tr class="table-row">
                                <td>Linn:</td>
                                <td><?=$city ?></td>
                            </tr>
                            <tr class="table-row">
                                <td>Tööde algus:</td>
                                <td><?=$work_start_date?></td>
                            </tr>
                            <tr class="table-row">
                                <td>Tööde lõpp:</td>
                                <td><?=$work_end_date ?></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="row ml-2 mr-2">
                        <label for="description" class="form-label mt-4">Töö sisu :</label>
                        <div id="description"><?=$advert_description ?></div>
                       <label for="failid" class="form-label mt-4">Pildid, videod ja failid</label>
                        <div id="failid"><?php include 'partial/display-files-of-img.php'; ?> </div>

                        <div class="card p-2 mt-5">
                            <h4>Küsimused hanke korraldajale</h4>
                            <hr>
                        </div>
                    </div>


                </div>
                <div class="col-md-4 order-md-2 mb-4">
                    <?php if(isset($_SESSION['company_id'])): ?>
                        <h4 class="d-flex justify-content-between align-items-center mb-3 mt-5">
                            <span class="text">Minu pakkumine</span>
                            <span class="badge badge-secondary badge-pill"></span>
                        </h4>
                        <form class="card p-2 mb-5">

                            <div class="mb-3">
                                <label for="summa" class="form-label">Summa</label>
                                <input type="text" class="form-control" id="summa">
                            </div>
                            <!--                        <div class="mb-3">-->
                            <!--                            <label for="kaibemaks" class="form-label">Käibemaks</label>-->
                            <!--                            <select class="form-select" id="kaibemaks" aria-label="Default select example">-->
                            <!---->
                            <!--                                <option value="hinna-sees">Hinna Sees</option>-->
                            <!--                                <option value="option-2">Option 2</option>-->
                            <!--                            </select>-->
                            <!--                        </div>-->
                            <div class="mb-3">
                                <label for="kirjeldus" class="form-label">Pakkumise kirjeldus</label>
                                <textarea name="advert_description" class="form-control" id="kirjeldus" rows="4"></textarea>
                            </div>
                            <button type="submit" class="btn custom-button2 mt-4">Saada pakkumine</button>
                        </form>
                    <?php endif; ?>
                </div>
            </div>
        </div>
    </main>
    <!-- End Main content -->

    <hr>

    <!-- Contact -->
    <?php include 'partial/contact.php'; ?>
    <!-- End Contact -->

</div>

<hr>

<!-- Footer -->
<footer class="text-center py-4">
    <div class="container px-5 mb-2">Autor: Maria-Julia Jarv </div>
</footer>
<!-- End Footer -->

<!-- Leaflet JS -->
<?php include 'partial/script-links.php'; ?>
</body>
</html>