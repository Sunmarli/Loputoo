<?php
require_once('conf.php');
global $yhendus;
session_start();
if (!isset($_SESSION['user_id'])) {
    // Redirect the user to the login page if not logged in
    header("Location: login.php");
    exit();
}
if (isset($_GET['advert_id'])) {
    $advert_id = $_GET['advert_id'];}

$user_id = $_SESSION['user_id'];

$stmt = $yhendus->prepare("SELECT advert_id, user_id, advert_description, advert_title, region, city, work_start_date, work_end_date, created_at FROM advert_table WHERE advert_id = ?");
$stmt->bind_param("i", $advert_id);
$stmt->bind_result($advert_id, $user_id, $advert_description, $advert_title, $region, $city, $work_start_date, $work_end_date, $created_at);
$stmt->execute();
$stmt->fetch();
$stmt->close();

function advert_edit($advert_id, $advert_title, $advert_description, $region, $city, $work_start_date, $work_end_date){
    global $yhendus;
    $stmt = $yhendus->prepare("UPDATE advert_table SET advert_title=?, advert_description=?, region=?, city=?, work_start_date=?, work_end_date=? WHERE advert_id=?");
    $stmt->bind_param("ssssssi", $advert_title, $advert_description, $region, $city, $work_start_date, $work_end_date, $advert_id);
    $stmt->execute();
}
function delete_advert($advert_id){
    global $yhendus;
    $stmt=$yhendus->prepare("DELETE FROM advert_table WHERE advert_id=?");
    $stmt->bind_param("i", $advert_idid);
    $stmt->execute();

    $stmt_files = $yhendus->prepare("DELETE FROM advert_files WHERE advert_id = ?");
    $stmt_files->bind_param("i", $advert_id);
    $stmt_files->execute();
}

if (isset($_POST["save"])) {
    advert_edit($_POST["advert_id"], $_POST["advert_title"], $_POST["advert_description"], $_POST["region"], $_POST["city"], $_POST["work_start_date"], $_POST["work_end_date"]);
    // Redirect to prevent form resubmission
    header("Location: ".$_SERVER['PHP_SELF']);
    exit();
}
if (isset($_POST["delete"])) {
    delete_advert($_POST["advert_id"]);
    // Redirect to prevent form resubmission
    header("Location: ".$_SERVER['PHP_SELF']);
    exit();
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <title>Advertisement Edit</title>
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
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
        <div class="col-md-6">
            <h1 class="p-5">Muuda kuulutus</h1>
            <form method="post" action="">
                <div class="form-group">
                    <label for="advert_title">Title:</label>
                    <input class="form-control" type="text" id="advert_title" name="advert_title" value="<?=$advert_title ?>">
                </div>
                <div class="form-group">
                    <label for="advert_description">Description:</label>
                    <textarea class="form-control" id="advert_description" name="advert_description"><?=$advert_description ?></textarea>
                </div>
                <div class="form-group">
                    <label for="region">Region:</label>
                    <input class="form-control" type="text" id="region" name="region" value="<?=$region ?>">
                </div>
                <div class="form-group">
                    <label for="city">City:</label>
                    <input class="form-control" type="text" id="city" name="city" value="<?=$city ?>">
                </div>
                <div class="form-group">
                    <label for="work_start_date">Start Date:</label>
                    <input class="form-control" type="date" id="work_start_date" name="work_start_date" value="<?=$work_start_date ?>">
                </div>
                <div class="form-group">
                    <label for="work_end_date">End Date:</label>
                    <input class="form-control" type="date" id="work_end_date" name="work_end_date" value="<?=$work_end_date ?>">
                </div>
                <input type="hidden" name="advert_id" value="<?=$advert_id ?>">
                <input type="submit" name="save" class="btn btn-primary" value="Save">
                <a href="user_advert_list.php" class="btn btn-secondary">Cancel</a>
            </form>
        </div>
    </div>
</div>


<!-- Bootstrap JS -->
<script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.5.4/dist/umd/popper.min.js"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

</body>
</html>

