<?php
require_once ('conf.php');

session_start();
if (isset($_SESSION['tuvastamine'])) {
    header('Location: index.php');
    exit();
}


global $yhendus;
if (!empty($_POST['username']) && !empty($_POST['password'])) {
    $login = htmlspecialchars(trim($_POST['username']));
    $pass = htmlspecialchars(trim($_POST['password']));

    // Prepare and execute the database query
    $kask = $yhendus->prepare("SELECT user_id,username, password FROM users WHERE username = ?");
    $kask->bind_param("s", $login);
    $kask->bind_result($dbUserId, $dbUsername, $hashedPassword);
    $kask->execute();

    if ($kask->fetch() && password_verify($pass, $hashedPassword)) {
        $_SESSION['tuvastamine'] = 'misiganes';
        $_SESSION['username'] = $dbUsername;
        $_SESSION['user_id'] = $dbUserId;

        $kask->close();

        header('Location: index.php');
    } else {
        $errorMessage = "Username $login or password is incorrect";
    }
}
?>
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
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/styles.css">
</head>
<!-- Navbar -->
<nav class="navbar navbar-expand-lg navbar-dark  shadow">
    <div class="container-fluid">
        <a class="navbar-brand" href="index.php">
            Esileht
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

<div id="form">
    <section>
        <div class="mask d-flex align-items-center h-100 gradient-custom-3">
            <div class="container h-100">
                <div class="row d-flex justify-content-center align-items-center h-100">
                    <div class="col-12 col-md-9 col-lg-7 col-xl-6 mt-5 custom-margin">
                        <div class="card" style="border-radius: 15px;">
                            <div class="card-body p-5  ">

                                <div id="forms" class="text-center">
                                    <h1>Login</h1>

                                    <form action="login.php" method="POST"">
                                        <div class="row">
                                            <div class="col-12">
                                                <dl>
                                                    <dt>Username:</dt>
                                                    <dd><input type="text" name="username"><br></dd>
                                                    <dt>Password:</dt>
                                                    <dd><input type="password" name="password"><br></dd>
                                                    <dt><input type="submit" name="sisestusnupp" value="Logi sisse" /></dt>
                                                    <?php
                                                    if (isset($errorMessage)) {
                                                        echo "<p class='error-message '>$errorMessage</p>";
                                                    }
                                                    ?>
                                                </dl>
<!--посмотри как сделать reset пароля-->
                                                <div><p>või </p><a href="register_choose.php">Registreeri</a></div>
                                                <div><p>Unustasid parooli?</p><a href="password-recover.php">Reset password</a></div>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>

<!--Footer -->
<?php include 'partial/footer.php'; ?>


<!-- End Footer -->
<!--eraisik vorm-->
<!--end eraisik vorm-->
<?php
//if(isSet($_REQUEST["lisatudeesnimi"])){
//    echo "Lisati $_REQUEST[lisatudeesnimi]";
//    echo "<script>
//            alert('Uus inimene lisatud');
//            location.href='registreerimine.php'
//            </script>";
//}
//?>


<!-- Leaflet JS -->
<script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js"></script>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>

<!-- Custom JS -->
<script src="js/scripts.js"></script>
</body>
</html>
