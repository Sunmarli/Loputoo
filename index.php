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
    <nav class="navbar navbar-expand-lg navbar-dark  shadow">
        <div class="container-fluid">
            <a class="navbar-brand" href="/">
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
            <div class="container px-3">
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-auto me-4 my-3 my-lg-0">

                        <li class="nav-item">
                            <a class="nav-link navbar-dark-color me-lg-3" href="ad_user_form.php">Lisa kuulutus</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link me-lg-3" href="register_choose.php">Registreeri</a>
                        </li>
                        <?php
                        if (isset($_SESSION['username'])) {
                            // User is logged in, show "Logi välja" button
                            // User is logged in, show dropdown menu and username
                            echo '<li class="nav-item dropdown">';
                            echo '<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">';
                            echo  ' Tere, '. $_SESSION['username'] . ', ';
                            echo ' User ID: ' . $_SESSION['user_id'];
                            echo '</a>';
                            echo '<div class="dropdown-menu" aria-labelledby="navbarDropdown">';
                            echo '<a class="dropdown-item" href="#">Profile</a>';
                            echo '<a class="dropdown-item" href="#">Messages</a>';
                            echo '<a class="dropdown-item" href="partial/logout.php">Log out</a>';
                            // Add more dropdown items as needed
                            echo '</div>';
                            echo '</li>';
                        } else {

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

                    </ul>
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
            </div>

            <div class="container">
                <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <p>Here will be Table of kuulutused</p>
                            <table class="table table-striped">
                                <thead>
                                <tr>
                                    <th class="first text-left" scope="col">Kuulutus</th>
                                    <th scope="col">Lisatud</th>
                                    <th scope="col">Olek</th>
                                    <th scope="col">Pakkumisi</th>
                                </tr>
                                </thead>
                                <tbody>
                                <tr class="">
                                    <td class="first paddingmob0 bordermob0">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <div class="table-img">
                                                    <picture>
                                                        <img src="images/sided-view-hand-filling-document.jpg" height="100" alt="">
                                                    </picture>
                                                </div>
                                            </div>
                                            <div class="col-md-9 text-left">

                                                <h4 style="word-wrap: break-word;"><a class="border-link" href="">Eramaja Lorem Ipsum</a></h4>
                                                <div class="table-files">
                                                    <span><img src="https://www.hange.ee/img/table-imgs.svg" alt="image">1 foto</span>
                                                </div>
                                                <p>
                                                    <span class="light">Asukoht:</span> Harjumaa, Tallinn.<br>
                                                    <span class="light">Hanke etapp:</span> Pakkumiste tegemine kuni 08.03.2024<br>
                                                    <span class="light">Hanke korraldaja:</span> ettevõtte
                                                </p>
                                                <div class="table-info-mobile">
                                                    <span class="light">Pakkumisi:</span><strong>35</strong><br>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td>23.02.2024</td>
                                    <td>Avatud</td>
                                    <td class="bold relative">35</td>
                                </tr>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
        </section>

    </main>

        <!-- End Main content -->

        <hr>

        <!-- Testimonials -->
        <!--
        <section id="testimonials" class="text-center py-5">
          <div class="container py-5">
            <div class="row justify-content-center">
              <h2 class="fw-bold">Testimonials</h2>
              <p class="lead text-muted mb-5">Check what clients have said about my work</p>
            </div>
          </div>
          <div class="container mb-5">
            <div class="row">
              <div class="col-lg-4 mx-auto mb-5">
                <div class="text-center fs-4 fst-italic mb-4 px-2">
                  Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut
                  quis elit ut tellus tempus pharetra.
                </div>
                <div class="d-flex align-items-center justify-content-center testimonial">
                  <img class="rounded-circle me-3" src="images/user1.png" alt="User 1">
                  <div class="fw-bold">
                    Amy Jones
                    <span class="text-primary mx-1">/</span>
                    CEO, Company 1
                  </div>
                </div>
              </div>
              <div class="col-lg-4 mx-auto mb-5">
                <div class="text-center fs-4 fst-italic mb-4 px-2">
                  Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut
                  quis elit ut tellus tempus pharetra.
                </div>
                <div class="d-flex align-items-center justify-content-center testimonial">
                  <img class="rounded-circle me-3" src="images/user2.png" alt="User 2">
                  <div class="fw-bold">
                    James Smith
                    <span class="text-primary mx-1">/</span>
                    CEO, Company 2
                  </div>
                </div>
              </div>
              <div class="col-lg-4 mx-auto mb-5">
                <div class="text-center fs-4 fst-italic mb-4 px-2">
                  Lorem ipsum dolor sit amet, consectetur adipiscing elit. Ut
                  quis elit ut tellus tempus pharetra.
                </div>
                <div class="d-flex align-items-center justify-content-center testimonial">
                  <img class="rounded-circle me-3" src="images/user3.png" alt="User 3">
                  <div class="fw-bold">
                    Mary Richards
                    <span class="text-primary mx-1">/</span>
                    CEO, Company 3
                  </div>
                </div>
              </div>
            </div>
          </div>
        </section> -->
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