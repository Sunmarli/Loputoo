
<?php
require_once ('conf.php');
global $yhendus;
session_start();

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Process the form data
    $title = $_POST["title"];
    $comment = $_POST["comment"];

    // You can perform further processing, validation, or database operations here

    // For example, you could redirect the user to another page after processing the form
    header("Location: success.php");
    exit;
}
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


    <!-- Custom CSS -->
    <link rel="stylesheet" href="css/styles.css">
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
            <div class="container px-3">
                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav ms-auto me-4 my-3 my-lg-0">
                        <?php
                        if (isset($_SESSION['username'])) {
                            // User is logged in, show "Logi välja" button
                            // User is logged in, show dropdown menu and username
                            echo '<li class="nav-item dropdown">';
                            echo '<a class="nav-link dropdown-toggle" href="#" id="navbarDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">';
                            echo  ' Tere, '. $_SESSION['username'];
                            echo '</a>';
                            echo '<div class="dropdown-menu" aria-labelledby="navbarDropdown">';
                            echo '<a class="dropdown-item" href="#">Profile</a>';
                            echo '<a class="dropdown-item" href="#">Messages</a>';
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
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8 ">
                <div class="shadow p-3 mb-5 bg-white rounded p-5">
                    <h2> täidab kasutaja</h2>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post">
                        <div class="form-group">
                            <label for="title" class="mt-2" >Kuulutuse pealkiri</label>
                            <input type="text" name="title" class="form-control" id="title" maxlength="80">
                        </div>
                        <div class="form-group">
                            <label for="comment" class="mt-2">Töö sisu</label>
                            <textarea name="comment" class="form-control" id="comment" rows="4"></textarea>
                        </div>
                        <div><label for="title" class="mt-2">Maakond:</label>
                            <input type="text" name="title" class="form-control" id="title"></div>
                        <div><label for="title" class="mt-2">Linn/Asula/Küla:</label>
                            <input type="text" name="title" class="form-control" id="title"></div>
                        <div class="form-group">
                            <label for="start_date" class="mt-2">Tööde algus</label>
                            <input type="date" name="start_date" class="form-control" id="start_date">
                        </div>
                        <div class="form-group">
                            <label for="end_date" class="mt-2">Tööde lõpp</label>
                            <input type="date" name="end_date" class="form-control" id="end_date">
                        </div>
                        <div class="form-group">
                            <label for="files" class="mt-2">Pildid, video ja failid</label>
                            <div class="row">
                                <div class="col">
                                    <input type="file" name="files[]" class="form-control-file mt-3" id="files" multiple>
                                </div>
                            </div>
                        </div>
                        <button type="submit" class="btn custom-button mt-4">Lisa kuulutus</button>
                    </form>
                </div>
            </div>
        </div>
    </div>

        <!-- Contact -->
        <section id="contact" class="text-center py-2 mt-5" style="background-color: lightgray">
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
    </main>
</div>


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
