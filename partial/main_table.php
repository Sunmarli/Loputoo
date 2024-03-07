
<?php
require ('conf.php');
global $yhendus;


$stmt = $yhendus->prepare("SELECT advert_id, advert_title, region, city, work_start_date, created_at FROM advert_table");

$stmt->bind_result($advert_id, $advert_title, $region, $city, $work_start_date, $created_at);
$stmt->execute();
$hoidla = array();
while ($stmt->fetch()) {
    $advert = new stdClass();
    $advert->advert_id = $advert_id;
    $advert->advert_title = htmlspecialchars($advert_title);
    $advert->region = htmlspecialchars($region);
    $advert->city = htmlspecialchars($city);;
    $advert->work_start_date = $work_start_date;
    array_push($hoidla, $advert);
}
return $hoidla;
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

<!--                    table start-->
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
                            <?php foreach($advertisements as $advert): ?>
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

                                                <h4 style="word-wrap: break-word;"><a class="border-link" href=""><?=$advert->advert_title ?></a></h4>
                                                <div class="table-files">
                                                    <span><img src="https://www.hange.ee/img/table-imgs.svg" alt="image">1 foto</span>
                                                </div>
                                                <p>
                                                    <span class="light">Asukoht:</span> <?=$advert->region ?><?=$advert->city ?><br>

                                                    <span class="light">Hanke korraldaja:</span> <?=$advert->user_id ?>
                                                </p>
                                                <div class="table-info-mobile">
                                                    <span class="light">Pakkumisi:</span><strong>35</strong><br>
                                                </div>
                                            </div>
                                        </div>
                                    </td>
                                    <td><?=$advert->created_at ?></td>
                                    <td>Avatud</td>
                                    <td class="bold relative">35</td>
                                </tr>
                            <?php endforeach; ?>
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
</section>
