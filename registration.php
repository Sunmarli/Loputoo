<?php
//ob_start();
//session_start();
//if (!isset($_SESSION['tuvastamine'])) {
//    header('Location: login.php');
//    exit();
//}
//// Check if the logout button is clicked
//if (isset($_POST['logout'])) {
//    // Destroy the session
//    session_destroy();
//    // Redirect the user to the login page
//    header('Location: login.php');
//    exit();
//}
// require_once("conf.php");
//    if(isSet($_REQUEST["sisestusnupp"])){
//        if(preg_match('#[0-9]#',$_REQUEST['perekonnanimi'])
//            ||preg_match('#[0-9]#',$_REQUEST['eesnimi'])
//            || empty ($_REQUEST['perekonnanimi'])
//            || empty ($_REQUEST['eesnimi']))
//        {
//            echo
//            "<script>
//            alert('Valesti sisestatud ees või perekonnanimi');
//            location.href='registreerimine.php'
//            </script>";
//            //" 'Valesti sisestatud ees või perekonnanimi'";
//        }else {
//            ob_start();
//            global $yhendus;
//            $kask = $yhendus->prepare(
//                "INSERT INTO jalgrattaeksam(eesnimi, perekonnanimi) VALUES (?, ?)");
//            $kask->bind_param("ss", $_REQUEST["eesnimi"], $_REQUEST["perekonnanimi"]);
//            $kask->execute();
//            $yhendus->close();
//            header("Location: $_SERVER[PHP_SELF]?lisatudeesnimi=$_REQUEST[eesnimi]");
//            header("Location: Teooriaeksam.php");
//            ob_end_flush();
//            exit();
//        }
//    }
//ob_end_flush();
//?>
<!doctype html>
<html lang="et">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <title>Registreerimine</title>

    <!-- Montserrat Font -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- Material Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet">

    <!-- Leaflet CSS -->
    <link href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css" rel="stylesheet">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
<div class="container-fluid px-0">
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-light shadow">
        <div class="container-fluid">
            <a class="navbar-brand">

            <span class="material-icons-outlined">
                cottage
                </span>
                Home
            </a>
        </div>
<!--        <div class="user-info">-->
<!--            --><?php //=$_SESSION['kasutaja']?><!-- on logitud-->
<!--            <form action="" method="post">-->
<!--                <input type="submit" name="logout" value="Logi välja" class="logout-button">-->
<!--            </form>-->
<!--        </div>-->
    </nav>
<body>
<div id="forms">
<h1>Registreerimine</h1>

<form action="?" >
    <dl>
        <dt>Eesnimi:</dt>
        <dd><input type="text" name="eesnimi" required /></dd>
        <dt>Perekonnanimi:</dt>
        <dd><input type="text" name="perekonnanimi" required /></dd>
        <dt><input type="submit" name="sisestusnupp" value="sisesta" /></dt>  </dl>
</form>
</div>
<?php
//if(isSet($_REQUEST["lisatudeesnimi"])){
//    echo "Lisati $_REQUEST[lisatudeesnimi]";
//    echo "<script>
//            alert('Uus inimene lisatud');
//            location.href='registreerimine.php'
//            </script>";
//}
//?><!--Footer -->
<footer class="text-center py-4">
    <div class="container px-5 mb-2">Maria-Julia Jarv </div>
</footer>
<!-- End Footer -->

<!-- Leaflet JS -->
<script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js"></script>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>

<!-- Custom JS -->
<script src="js/scripts.js"></script>
</body>
</html>