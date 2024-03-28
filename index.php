<?php
require_once ('conf.php');
global $yhendus;
session_start();
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
<?php echo  'User---'.$_SESSION['username'];?>
<?php echo  'Company----'.$_SESSION['company_name'];?>
<div class="container-fluid px-0">
    <!-- Navbar -->
        <link rel="stylesheet" href="css/styles.css">
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width,initial-scale=1.0">
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
                                    <a class="nav-link navbar-dark-color me-lg-3" href="ad_user_form.php">Lisa kuulutus</a>
                                </li>
                                <li class="nav-item">
                                    <a class="nav-link me-lg-3" href="register_choose.php">Registreeri</a>
                                </li>
                                <?php
                                if (isset($_SESSION['tuvastamine'])) {
                                    if ($_SESSION['tuvastamine'] === 'user') {
                                        // User is logged in
                                        echo '<li class="nav-item dropdown">';
                                        echo '<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">';
                                        echo  ' Tere, '. $_SESSION['username'];
                                        echo '</a>';
                                        echo '<div class="dropdown-menu" aria-labelledby="navbarDropdown">';
                                        echo '<a class="dropdown-item" href="#">Profile</a>';
                                        echo '<a class="dropdown-item" href="partial/user_advert_list.php">Minu kuulutused</a>';
                                        echo '<a class="dropdown-item" href="partial/logout.php">Log out</a>';
                                        // Add more dropdown items as needed
                                        echo '</div>';
                                        echo '</li>';
                                    } elseif ($_SESSION['tuvastamine'] === 'company') {
                                        // Company is logged in
                                        echo '<li class="nav-item dropdown">';
                                        echo '<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">';
                                        echo  ' Tere, '. $_SESSION['company_name'];
                                        echo '</a>';
                                        echo '<div class="dropdown-menu" aria-labelledby="navbarDropdown">';
                                        echo '<a class="dropdown-item" href="#">Profile</a>';
                                        echo '<a class="dropdown-item" href="company_offers.php">Minu pakkumised</a>';
                                        echo '<a class="dropdown-item" href="partial/logout.php">Log out</a>';
                                        // Add more dropdown items as needed
                                        echo '</div>';
                                        echo '</li>';
                                    }
                                } else {
                                    // No user logged in
                                    echo '<li class="nav-item">';
                                    echo '<div class="container_for_button">';
                                    echo '<a class="nav-link" href="login.php" id="loginLink">Logi sisse</a>';
                                    echo '<div id="registrationOption" style="display: none;">';
                                    echo '<a class="nav-link" href="register_choose.php">Register</a>';
                                    echo '</div>';
                                    echo '</div>';
                                    echo '</li>';
                                }
                                ?>

                        </div>
                    </div>
                </div>
            </nav>
    <!-- End Navbar -->

    <!-- Header -->
    <header class=" position-relative header-height">
        <img class="img-fluid  header-image" src="images/header.jpg" alt="Hero Image">
        <div class="position-absolute top-0 start-0 end-0 bottom-0 gradient-overlay"></div>
        <div class="container position-absolute top-50 start-50 translate-middle custom-left-margin">
            <div class="row align-items-center">
                <div class="col-lg-8 col-xl-6 col-xxl-6">
                    <div class="my-2 text-center text-black">

                        <p class="lead mb-6">

                        <ul class="text-start">
                            <p class="text-shadow">Tuleohutusteenused on teenus , tellijate, klientide ja tellimuste kokku viimiseks ning väljakutsete ja ülesannete avaldamiseks. Siit leiate nii ühe tuleohutusspetsialisti kui ka terviklik lahendus firmade poolt.</p>

                            <p>Kui otsite tuleohutusteenust avaldage kuulutus meie portaalis TASUTA.</p>
                        </ul>

                        <div class="d-grid gap-3 d-sm-flex justify-content-center">
                            <a class="btn btn-outline-primary custom-button btn-lg text-uppercase" href="ad_user_form.php"">
                                Lisa kuulutus

                            </a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>
    <!-- End Header -->
    <!-- Main content -->

    <main>
        <section id="main content" class="text-center py-5">
            <div class="container py-2">
                <div class="row justify-content-center">
                    <h2 class="fw-bold">Populaarseimaid hanked</h2>
                    <p class="lead text-muted mb-5 "></p>
                </div>
                <?php include 'partial/main_table.php'; ?>
        </section>

    </main>

        <!-- End Main content -->

        <hr>

        <!-- Testimonials -->

        <!-- End Testimonials -->
    <!-- Contact -->
    <?php include 'partial/contact.php'; ?>
    <!-- End Contact -->

</div>
    <!--End  Navbar -->
<hr>

<!-- Footer -->
<footer class="text-center py-4">
    <div class="container px-5 mb-2">Autor: Maria-Julia Jarv </div>
</footer>
<!-- End Footer -->

<!-- Scripts -->
<?php include 'partial/script-links.php'; ?>

</body>
</html>