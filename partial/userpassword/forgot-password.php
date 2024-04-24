<!doctype html>
<html lang="et">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <title>Vaheta parool</title>
    <?php include '../head-links.php'; ?>

    <!-- Custom CSS -->
   <link rel="stylesheet" href="../../css/styles.css">
</head>
<!-- Navbar -->
<meta charset="utf-8">
<meta name="viewport" content="width=device-width,initial-scale=1.0">
<body class="container-fluid px-0">
    <!-- Navbar -->
    <nav class="navbar navbar-expand-lg navbar-dark  shadow">
        <div class="container-fluid">
            <a class="navbar-brand" href="../../index.php">
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
                            <a class="nav-link navbar-dark-color me-lg-3" href="ad_user_form.php">Logi sisse</a>
                        </li>


                </div>
            </div>
        </div>
    </nav>
    <!-- End Navbar -->

    <section>
        <div class="mask d-flex align-items-center h-100 gradient-custom-3">
            <div class="container h-100">
                <div class="row d-flex justify-content-center align-items-center h-100">
                    <div class="col-12 col-md-9 col-lg-7 col-xl-6 mt-5 custom-margin">
                        <div class="card" style="border-radius: 15px;">
                            <div class="card-body p-5  ">

                                <div id="forms" class="text-center">
                                    <h1>Vaheta parool</h1>
                                    <div class="row">
                                        <div class="col-12 mt-3">
                                            <dl>
                                                <form method="post" action="send-password-reset.php" >
                                                    <dt><label for="email">Teie e-mail:</label></dt>
                                                    <dd><input name="email" type="email" id="email" class="col-9"></dd>
                                                    <dt><button
                                                                class="btn custom-button2  col-6 mt-2 font-weight-medium text-white">Saada link</button></dt>
                                                </form>
                                            </dl>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>
     <?php include '../script-links.php'; ?>
</body>
<?php include '../footer.php'; ?>




