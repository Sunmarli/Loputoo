<?php
//ob_start();
//session_start();
//if (!isset($_SESSION['tuvastamine'])) {
//    header('Location: login.php');
//    exit();
//}
//// Check if the logout button is clicked
//if (isset($_POST['logout'])) {
//    // Destroy the session
//    session_destroy();
//    // Redirect the user to the login page
//    header('Location: login.php');
//    exit();
//}
// require_once("conf.php");
//    if(isSet($_REQUEST["sisestusnupp"])){
//        if(preg_match('#[0-9]#',$_REQUEST['perekonnanimi'])
//            ||preg_match('#[0-9]#',$_REQUEST['eesnimi'])
//            || empty ($_REQUEST['perekonnanimi'])
//            || empty ($_REQUEST['eesnimi']))
//        {
//            echo
//            "<script>
//            alert('Valesti sisestatud ees või perekonnanimi');
//            location.href='registreerimine.php'
//            </script>";
//            //" 'Valesti sisestatud ees või perekonnanimi'";
//        }else {
//            ob_start();
//            global $yhendus;
//            $kask = $yhendus->prepare(
//                "INSERT INTO jalgrattaeksam(eesnimi, perekonnanimi) VALUES (?, ?)");
//            $kask->bind_param("ss", $_REQUEST["eesnimi"], $_REQUEST["perekonnanimi"]);
//            $kask->execute();
//            $yhendus->close();
//            header("Location: $_SERVER[PHP_SELF]?lisatudeesnimi=$_REQUEST[eesnimi]");
//            header("Location: Teooriaeksam.php");
//            ob_end_flush();
//            exit();
//        }
//    }
//ob_end_flush();
//?>
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
        <a class="navbar-brand" href="/">
            Esileht
        </a>
    </div>
<!--        <div class="user-info">-->
<!--            --><?php //=$_SESSION['kasutaja']?><!-- on logitud-->
<!--            <form action="" method="post">-->
<!--                <input type="submit" name="logout" value="Logi välja" class="logout-button">-->
<!--            </form>-->
<!--        </div>-->
    </nav>
<body>
<div id="firma_form">
    <section>
        <div class="mask d-flex align-items-center h-100 gradient-custom-3">
            <div class="container h-100">
                <div class="row d-flex justify-content-center align-items-center h-100">
                    <div class="col-12 col-md-9 col-lg-7 col-xl-6 mt-5 mb-5">
                        <div class="card" style="border-radius: 15px;">
                            <div class="card-body p-5">
                                <h2 class="text-uppercase text-center mb-5">Loo konto</h2>

                                <form>
                                    <div class="text mb-2" style="font-size: 11px">Teie nimi ja perekonnanimi on nähtav ainult Tuleohutusteenused.ee'le </div>

                                    <div class="form-floating mb-4">
                                        <input type="text" id="eesnimi" class="form-control form-control-lg" placeholder=" " />
                                        <label for="eesnimi">Eesnimi</label>
                                    </div>
                                    <div class="form-floating mb-4">
                                        <input type="text" id="perenimi" class="form-control form-control-lg" placeholder=" " />
                                        <label for="perenimi">Perekonnanimi</label>
                                    </div>


                                    <div class="form-floating mb-4">
                                        <input type="text" id="firmaNimi" class="form-control form-control-lg" placeholder=" " />
                                        <label for="firmaNimi">Ettevõtte nimi</label>
                                    </div>
                                    <div class="form-floating mb-4">
                                        <input type="text" id="regkood" class="form-control form-control-lg" placeholder=" " />
                                        <label for="regkood">Registreerimiskood</label>
                                    </div>

                                    <div class="form-floating mb-4">
                                        <input type="text" id="aadress" class="form-control form-control-lg" placeholder=" " />
                                        <label for="aadress">Aadress</label>
                                    </div>
                                    <div class="form-floating mb-4">
                                        <input type="email" id="email" class="form-control form-control-lg" placeholder=" " />
                                        <label for="email">Email</label>
                                    </div>
                                    <div class="text-xs mb-2" style="font-size: 11px" >Vähemalt 8 sümbolit. </div>
                                    <div class="form-floating mb-4">
                                        <input type="password" id="parool" class="form-control form-control-lg" placeholder=" " />
                                        <label for="parool">Parool</label>
                                    </div>
                                    <div class="form-floating mb-4">
                                        <input type="password" required="required" id="password_confirmation"  class="form-control form-control-lg" placeholder=" " />
                                        <label for="parool">Korrake parooli</label>
                                    </div>
<!--                                    <div class="form-check d-flex justify-content-center mb-5">-->
<!--                                        <input class="form-check-input me-2" type="checkbox" value="" id="form2Example3cg" />-->
<!--                                        <label class="form-check-label" for="form2Example3g">-->
<!--                                            I agree all statements in <a href="#!" class="text-body"><u>Terms of service</u></a>-->
<!--                                        </label>-->
<!--                                    </div>-->
                                    <div class="d-flex justify-content-center ">
                                        <button type="button"
                                                class="btn btn-success btn-block btn-lg gradient-custom-4 text-body col-12">Registreerun</button>
                                    </div>

                                    <p class="text-center text-muted mt-5 mb-0">Olete juba registreerunud? <a href="#!"
                                                                                                            class="fw-bold text-body"><u>Login here</u></a></p>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
</div>
<?php
//if(isSet($_REQUEST["lisatudeesnimi"])){
//    echo "Lisati $_REQUEST[lisatudeesnimi]";
//    echo "<script>
//            alert('Uus inimene lisatud');
//            location.href='registreerimine.php'
//            </script>";
//}
//?><!--Footer -->
<footer class="text-center py-4">
    <div class="container px-5 mb-2">Maria-Julia Jarv </div>
</footer>
<!-- End Footer -->

<!-- Leaflet JS -->
<script src="https://unpkg.com/leaflet@1.9.3/dist/leaflet.js"></script>

<!-- Bootstrap JS -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>

<!-- Custom JS -->
<script src="js/scripts.js"></script>
</body>
</html>