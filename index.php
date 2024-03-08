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

    <!-- Montserrat Font -->
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <!-- Material Icons -->
    <link href="https://fonts.googleapis.com/icon?family=Material+Icons+Outlined" rel="stylesheet">

    <!-- Leaflet CSS -->
    <link href="https://unpkg.com/leaflet@1.9.3/dist/leaflet.css" rel="stylesheet">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css" rel="stylesheet">

    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/styles.css">
</head>
<body>
<div class="container-fluid px-0">
    <!-- Navbar -->
    <?php include 'partial/nav-bar.php'; ?>
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
        <section id="contact" class="text-center py-2">
            <div class="container py-2">
                <div class="row justify-content-center">
                    <h2 class="fw-bold">Contact</h2>
                    <p class="lead text-muted mb-5">
                        Some text if needed
                    </p>
                </div>
            </div>
            <div class="container mb-2">
                <div class="row justify-content-left"> <!-- Corrected class name -->
                    <div class="col-xl-3 col-lg-3 mb-2"> <!-- Adjusted column widths -->
                        <div class="mb-2">
                            <h6 class="text-uppercase mb-2">VeebileheNimi</h6>
                            <p class="lead mb-0">Tallinn, Estonia</p>
                            <p class="lead mb-0">blabla@gmail.com</p>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-3 mb-2"> <!-- Adjusted column widths -->
                        <div class="mb-2">
                            <h6 class="text-uppercase mb-2">Üldine</h6>
                            <p class="lead mb-0">Registreeru</p>
                            <p class="lead mb-0">Unustasid parooli?</p>
                            <p class="lead mb-0">KKK</p>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-3 mb-2"> <!-- Adjusted column widths -->
                        <div class="mb-2">
                            <h6 class="text-uppercase mb-2">Hanked</h6>
                            <p class="lead mb-0">Lisage hange</p>
                            <p class="lead mb-0">Kõik aktiivsed hanked</p>
                        </div>
                    </div>
                    <div class="col-xl-3 col-lg-3 mb-2"> <!-- Adjusted column widths -->
                        <div class="mb-2">
                            <h6 class="text-uppercase mb-2">Teenused</h6>
                            <p class="lead mb-0">Reklaam</p>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    <!-- End Contact -->

</div>

<hr>

<!-- Footer -->
<footer class="text-center py-4">
    <div class="container px-5 mb-2">Autor: Maria-Julia Jarv </div>
</footer>
<!-- End Footer -->

<!-- Leaflet JS -->
<script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js"></script>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>

<!-- Custom JS -->
<script src="js/scripts.js"></script>
</body>
</html>