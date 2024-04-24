<?php
require_once('conf.php');
global $yhendus;
session_start();

if (!empty($_POST['password'])) {
    $pass = htmlspecialchars(trim($_POST['password']));
    $login = htmlspecialchars(trim($_POST['username']));

    // Check if the input matches a username or email
    if (!empty($_POST['username'])) {
        $login = htmlspecialchars(trim($_POST['username']));
        $userQuery = $yhendus->prepare("SELECT user_id, username, password FROM users WHERE username = ? OR email = ?");
        $userQuery->bind_param("ss", $login, $login);
        $userQuery->execute();
        $userQuery->bind_result($user_id, $username, $hashedPassword);

        if ($userQuery->fetch() && password_verify($pass, $hashedPassword)) {
            $_SESSION['tuvastamine'] = 'user';
            $_SESSION['username'] = $username;
            $_SESSION['user_id'] = $user_id;
            $userQuery->close();

            header('Location: index.php');
            exit();
        } else {
            // Debugging: Output values to check what you're getting
            var_dump($login, $pass, $user_id, $username, $hashedPassword);
            echo "User query failed!";
        }

        $userQuery->close();
    }

    // If not found in users table, check in company_users table
    $companyQuery = $yhendus->prepare("SELECT company_id, company_name, password_hash FROM company_users WHERE company_name = ? OR email = ?");
    $companyQuery->bind_param("ss", $login, $login);
    $companyQuery->execute();
    $companyQuery->bind_result($company_id, $company_name, $hashedPassword);

    if ($companyQuery->fetch() && password_verify($pass, $hashedPassword)) {
        $_SESSION['tuvastamine'] = 'company';
        $_SESSION['company_name'] = $company_name;
        $_SESSION['company_id'] = $company_id;
        $companyQuery->close();

        header('Location: index.php');
        exit();
    } else {
        // Debugging: Output values to check what you're getting
        var_dump($login, $pass, $company_id, $company_name, $hashedPassword);
        echo "Company query failed!";
        $errorMessage = "Username or password is incorrect";
    }

    $companyQuery->close();
} else {
    $errorMessage = "Please enter both username and password";
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
                        <div class="card shadow-lg" style="border-radius: 15px;">
                            <div class="card-body p-5  ">

                                <div id="forms" class="text-center">
                                    <h1>Login</h1>

                                    <form action="login.php" method="POST">
                                        <div class="row">
                                            <div class="col-12 ">
                                                <dl>
                                                    <dt>Username or Copmany name:</dt>
                                                    <dd><input type="text" name="username" autocomplete="username">
                                                        <br></dd>

                                                    <dt>Password:</dt>
                                                    <dd><input type="password" name="password" autocomplete="current-password">
                                                        <br></dd>
                                                    <dt>
                                                    <button type="submit" name="submit" value="Logi sisse"
                                                            class="btn custom-button2 text-body col-6 mt-2">Logi sisse</button></dt>
                                                    <?php
                                                    if (isset($errorMessage)) {
                                                        echo "<p class='error-message '>$errorMessage</p>";
                                                    }
                                                    ?>
                                                </dl>
                                                <div><p>või </p><a href="register_choose.php">Registreeri</a></div>
                                                <div><p>Unustasid parooli?</p><a href="partial/userpassword/forgot-password.php">Vaheta parool</a></div>
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



<!--<!-- Leaflet JS -->-->
<!--<script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js"></script>-->
<!---->
<!--<!-- Bootstrap JS -->-->
<!--<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>-->
<!---->
<!--<!-- Custom JS -->-->
<!--<script src="js/scripts.js"></script>-->
</body>
</html>
