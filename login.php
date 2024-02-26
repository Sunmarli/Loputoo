<!-- <?php
//require_once ("conf.php");
//global $yhendus;
//session_start();
//if (isset($_SESSION['tuvastamine'])) {
//    header('Location: registreerimine.php');
//    exit();
//}
////kontrollime kas väljad on täidetud
//if (!empty($_POST['login']) && !empty($_POST['pass'])) {
//    //eemaldame kasutaja sisestusest kahtlase pahna
//    $login = htmlspecialchars(trim($_POST['login']));
//    $pass = htmlspecialchars(trim($_POST['pass']));
//    //SIIA UUS KONTROLL
//    $sool = 'taiestisuvalinetekst';
//    $kryp = crypt($pass, $sool);
//    //kontrollime kas andmebaasis on selline kasutaja ja parool
//    $kask = $yhendus-> prepare("SELECT kasutaja FROM kasutajad WHERE kasutaja=? AND parool=?");
//    $kask->bind_param("ss", $login, $kryp);
//    $kask->bind_result($kasutaja);
//    $kask->execute();
//    //kui on, siis loome sessiooni ja suuname
//    if ($kask->fetch()) {
//        $_SESSION['tuvastamine'] = 'misiganes';
//        $_SESSION['kasutaja'] = $kasutaja;
//        header('Location: registreerimine.php');
//        exit();
//    } else {
//        echo "kasutaja $login või parool $kryp on vale";
//    }
//}
//?>-->


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <title> Login</title>

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
                Login Page
            </a>

        </div>
    </nav>
</div>
<div id="forms">

        <h1>Login</h1>
        <form action="" method="post" >
            <dl>
                <dt>Login:</dt>
                <dd><input type="text" name="login">admin<br></dd>
                <dt>Password:</dt>
                <dd><input type="password" name="pass">admin<br></dd>
                <dt><input type="submit" name="sisestusnupp" value="Logi sisse" /></dt>  </dl>
        </form>

</div>
    <!-- Footer -->
    <footer class="text-start">
        <div class="container px-3 mb-2">

        </div>

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