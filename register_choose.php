<?php

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

    </nav>
<body>
<div id="form">
    <section>
        <div class="mask d-flex align-items-center h-100 gradient-custom-3">
            <div class="container h-100">
                <div class="row d-flex justify-content-center align-items-center h-100">
                    <div class="col-12 col-md-9 col-lg-7 col-xl-6 mt-5 custom-margin">
                        <div class="card" style="border-radius: 15px;">
                            <div class="card-body p-5">
                                <h2 class="text-uppercase text-center ">Loo konto</h2>
                                <form>
                                    <p class="text-center text-muted mt-3 mb-5">Olete juba registreerunud? <a href="login.php"
                                                                                                              class="fw-bold text-body"><u>Sisenen</u></a></p>

                                    <div class="d-flex justify-content-center mb-3">
                                        <button type="button"
                                                class="btn btn-success btn-block btn-lg gradient-custom-4 text-body col-12"
                                                onclick="Eraisik();"
                                                style="border: none;">Eraisik(füüsiline isik)</button>
                                    </div>
                                    <div class="d-flex justify-content-center">
                                        <button type="button"
                                                class="btn btn-success btn-block btn-lg gradient-custom-4 text-body col-12"
                                                onclick="ForCompanyRegistration();"
                                                style="border: none;">Ettevõtte(juriidiline isik)</button>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<!--firma form-->
<?php include 'partial/registration_firma.php'; ?>
<!--end firma form-->
<?php include 'partial/registration.php'; ?>
<!--end eraisik form-->
<!--Footer -->
<?php include 'partial/footer.php'; ?>


<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
<script src="js/scripts.js"></script>

</body>
</html>