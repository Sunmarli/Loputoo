<?php
require_once ('conf.php');
global $yhendus;

?>
<!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
<link rel="stylesheet" href="../css/styles.css">
<div class="container-fluid px-0">
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark  shadow">
        <div class="container-fluid">
            <a class="navbar-brand" href="/index.php">
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
                            <a class="nav-link navbar-dark-color me-lg-3" href="page_of_commits.php">Lisa kuulutus</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link me-lg-3" href="register_choose.php">Registreeri</a>
                        </li>
                        <?php
                        if (isset($_SESSION['username'])) {
                            // User is logged in, show "Logi välja" button
                            echo '<li class="nav-item">';
                            echo '<div class="container_for_button text-white mt-2" style="font-family: Montserrat, sans-serif">';

                            echo $_SESSION['username'] . ' on logitud';
                            echo '<form action="logout.php" method="post">';
                            echo '<a href="logout.php" class="btn btn-outline-info text-white mt-2">Logi välja</a>';
                            echo '</form>';
                            echo '</div>';
                            echo '</li>';
                        } else {

                            echo '<li class="nav-item">';
                            echo '<div class="container_for_button">';
                            echo '<a class="nav-link" href="../login.php" id="loginLink">Logi sisse</a>';
                            echo '<div id="registrationOption" style="display: none;">';
                            echo '<a class="nav-link" href="../register_choose.php">Register</a>';
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