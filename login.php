<?php
require_once('conf.php');

session_start();
if (isset($_SESSION['tuvastamine'])) {
    header('Location: index.php');
    exit();
}

global $yhendus;
if (!empty($_POST['password'])) {
    $pass = htmlspecialchars(trim($_POST['password']));
    $login = "";

    // Check if the input matches a username
    if (!empty($_POST['username'])) {
        $login = htmlspecialchars(trim($_POST['username']));
        $query = $yhendus->prepare("SELECT user_id, username, password FROM users WHERE username = ?");
        $query->bind_result($dbUserId, $dbUsername, $hashedPassword);
    }

    $query->bind_param("s", $login);
    $query->execute();

    if ($query->fetch() && password_verify($pass, $hashedPassword)) {
        $_SESSION['tuvastamine'] = 'user';
        $_SESSION['username'] = $dbUsername;
        $_SESSION['user_id'] = $dbUserId;
        $query->close();

        header('Location: index.php');
        exit();
    } else {
        // If not found in users table, check in company_users table
        $query->close();
        $query = $yhendus->prepare("SELECT company_id, company_name, password FROM company_users WHERE company_name = ?");
        $query->bind_param("s", $login);
        $query->bind_result($dbCompanyId, $dbCompanyName, $hashedPassword);
        $query->execute();

        if ($query->fetch() && password_verify($pass, $hashedPassword)) {
            $_SESSION['tuvastamine'] = 'company';
            $_SESSION['company_name'] = $dbCompanyName;
            $_SESSION['company_id'] = $dbCompanyId;
            $query->close();

            header('Location: index.php');
            exit();
        } else {
            $errorMessage = "Username or password is incorrect";
        }
    }
}

?>

<!doctype html>
<html lang="et">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <title>Registreerimine</title>
    <?php include 'partial/head-links.php'; ?>

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
                                                <div><p>või </p><a href="register_choose.php">Registreeri</a></div>
                                                <div><p>Unustasid parooli?</p><a href="partial/password-recover.php">Reset password</a></div>
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
