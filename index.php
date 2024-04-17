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

</head>
<body>

    <!-- Navbar -->
    <?php include 'nav-bar-outside-partial.php'; ?>

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
                    <h3 class="fw-bold">Populaarseimaid hanked</h3>
                    <p class="lead text-muted mb-2 "></p>
                </div>
                <?php include 'partial/main_table.php'; ?>
        </section>

    </main>

        <!-- End Main content -->

        <hr>
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

</body>
</html>