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
    <?php include 'nav-bar.php'; ?>
    <!-- End Navbar -->

    <!-- Main content -->
    <main>
        <body class="bg-light">

        <div class="container mt-5">

            <div class="row">
                <div class="col-md-4 order-md-2 mb-4" style="background-color: lightcoral">
                    <h4 class="d-flex justify-content-between align-items-center mb-3">
                        <span class="text-muted">Minu pakkumine</span>
                        <span class="badge badge-secondary badge-pill"></span>
                    </h4>
                    <form class="card p-2 mb-5">
                        <div class="mb-3">
                            <label for="summa" class="form-label">Summa</label>
                            <input type="text" class="form-control" id="summa">
                        </div>
                        <div class="mb-3">
                            <label for="kaibemaks" class="form-label">Käibemaks</label>
                            <select class="form-select" id="kaibemaks" aria-label="Default select example">

                                <option value="hinna-sees">Hinna Sees</option>
                                <option value="option-2">Option 2</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="kirjeldus" class="form-label">Pakkumise kirjeldus</label>
                            <textarea name="advert_description" class="form-control" id="kirjeldus" rows="4"></textarea>
                        </div>
                        <button type="submit" class="btn btn-primary mt-4">Saada pakkumine</button>
                    </form>

                </div>

                <div class="col-md-8 order-md-1" style="background-color: lightblue">
                    <h4 class="mb-3">Kuulutuse nimetus</h4>
                    <div class="card p-2">
                        <table class="table table-borderless">
                            <colgroup>
                                <col style="width: 50%">
                                <col style="width: 50%">
                            </colgroup>
                            <tbody>
                            <tr class="table-row">
                                <td>Hanke lõpp:</td>
                                <td></td>
                            </tr>
                            <tr class="table-row">
                                <td>Maakond:</td>
                                <td>Row 2, Column 2</td>
                            </tr>
                            <tr class="table-row">
                                <td>Linn:</td>
                                <td>Row 3, Column 2</td>
                            </tr>
                            <tr class="table-row">
                                <td>Tööde algus:</td>
                                <td>Row 4, Column 2</td>
                            </tr>
                            <tr class="table-row">
                                <td>Tööde lõpp:</td>
                                <td>Row 5, Column 2</td>
                            </tr>
                            </tbody>
                        </table>

                    </div>
                    <label for="description" class="form-label">Töö sisu :</label>
                    <div id="description">выводим с базы данных</div>


                    <label for="failid" class="form-label">Pildid, video ja failid</label>
                    <div id="failid">всякие файлы </div>

                    <div class="card p-2">
                        <h4>Küsimused hanke korraldajale</h4>
                        <hr>
                    </div>
                    </div>


            </div>



    </main>
    <!-- End Main content -->

    <hr>

    <!-- Contact -->
    <?php include 'contact.php'; ?>
    <!-- End Contact -->

</div>

<hr>

<!-- Footer -->
<footer class="text-center py-4">
    <div class="container px-5 mb-2">Autor: Maria-Julia Jarv </div>
</footer>
<!-- End Footer -->

<!-- Leaflet JS -->
<?php include 'script-links.php'; ?>
</body>
</html>