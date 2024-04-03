<?php
global $yhendus;

$token = $_GET["token"];
$token_hash = hash("sha256", $token);

require __DIR__ .  "/../../conf.php";

$sql = "SELECT * FROM users WHERE reset_token_hash=?";
$stmt = $yhendus->prepare($sql);
$stmt->bind_param("s", $token_hash);
$stmt->execute();
$result = $stmt->get_result();

$user = $result->fetch_assoc();

if (empty($user)) {
    die("Token not found");
}

else if (strtotime($user['reset_token_expires_at']) <= time()) {
    die("Token has expired");
}
else {echo "Token is valid and has not expired";

}
var_dump($_GET);
var_dump($token);
?>
<!doctype html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <title>Vaheta parool</title>
    <?php include '../head-links.php'; ?>

    <!-- Custom CSS -->
    <link rel="stylesheet" href="/css/styles.css">
</head>
<body>
<div class="container-fluid px-0">
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark  shadow">
        <div class="container-fluid">
            <a class="navbar-brand" href="index.php">
                Esileht
            </a>
            <button
                    type="button"
                    class="navbar-toggler"
                    data-bs-toggle="collapse"
                    data-bs-target="#navbarSupportedContent"
                    aria-controls="navbarSupportedContent"
                    aria-expanded="false"
                    aria-label="Toggle navigation"
            >
                <span class="navbar-toggler-icon"></span>
            </button>
            <div class="container-fluid px-0">
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-auto me-4 my-3 my-lg-0 ">

                        <li class="nav-item">
                            <a class="nav-link navbar-dark-color me-lg-3" href="ad_user_form.php">Logi sisse</a>
                        </li>


                </div>
            </div>
        </div>
    </nav>
    <!-- End Navbar -->

    <section>
        <div class="mask d-flex align-items-center h-100 gradient-custom-3">
            <div class="container h-100">
                <div class="row d-flex justify-content-center align-items-center h-100">
                    <div class="col-12 col-md-9 col-lg-7 col-xl-6 mt-5 custom-margin">
                        <div class="card" style="border-radius: 15px;">
                            <div class="card-body p-5  ">

                                <div id="forms" class="text-center">
                                    <h1>Loo uus parool</h1>
                                    <dl>
                                        <!-- Your HTML form code here -->
                                        <form method="post" action="process-reset-password.php?token=<?= htmlspecialchars($token) ?>">

                                            <dt><input type="hidden" name="token" value="<?= htmlspecialchars($token) ?>"></dt>

                                            <label for="password">Uus parool</label>
                                            <dd><input type="password" id="password" name="password"></dd>

                                            <?php if (isset($passwordError)) { ?>
                                                <p class="error-message"><?= $passwordError ?></p>
                                            <?php } ?>
                                            <dt></dt><label for="password_confirmation">Korrata parooli</label></dt>
                                            <dd><input type="password" id="password_confirmation" name="password_confirmation"></dd>
                                            <?php
                                            if (isset($confirmError)) {
                                                echo "<p class='error-message '>$confirmError</p>";
                                            }
                                            ?>

                                            <button type="submit" name="sisestusnupp" value="salvesta" class="btn custom-button2 col-6 mt-2 font-weight-medium text-white">Salvesta</button>
                                        </form>
                                        <!-- Your remaining HTML code here -->


                                    </dl>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</body>
