<?php
require_once('conf.php');
global $yhendus;
session_start();

if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id'];

}
// Check if the connection to the database is successful
if ($yhendus->connect_error) {
    die("Connection failed: " . $yhendus->connect_error);
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $advert_title = $_POST['advert_title'];
    $advert_description = $_POST['advert_description'];
    $region = $_POST['region'];
    $city = $_POST['city'];
    $work_start_date = $_POST['work_start_date'];
    $work_end_date = $_POST['work_end_date'];

    // Insert data into the database without the filename column
    date_default_timezone_set('Europe/Tallinn');
    $currentDateTime = date("Y-m-d H:i:s");
    $sql = "INSERT INTO advert_table (user_id, advert_title, advert_description, region, city, work_start_date, work_end_date, created_at)
            VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $yhendus->prepare($sql);
    if ($stmt) {
        $stmt->bind_param("isssssss", $user_id, $advert_title, $advert_description, $region, $city, $work_start_date, $work_end_date, $currentDateTime);
        if ($stmt->execute()) {
            // Get the last inserted advert_id
            $last_insert_id = $stmt->insert_id;

            // Upload and insert files into advert_files table
            if (!empty($_FILES['filename']['name'])) {
                $file_count = count($_FILES['filename']['name']);
                for ($i = 0; $i < $file_count; $i++) {
                    $filename = uniqid() . '_' . basename($_FILES["filename"]["name"][$i]);
                    $upload_path = dirname(__FILE__) . "/user_files/" . $filename;
                    if (move_uploaded_file($_FILES["filename"]["tmp_name"][$i], $upload_path)) {
                        $sql = "INSERT INTO advert_files (advert_id, filename, file_path, created_at)
                                VALUES (?, ?, ?, ?)";
                        $stmt = $yhendus->prepare($sql);
                        if ($stmt) {
                            $stmt->bind_param("isss", $last_insert_id, $filename, $upload_path, $currentDateTime);
                            if ($stmt->execute()) {
                                echo "The file $filename has been uploaded and the information has been stored in the database.";
                            } else {
                                echo "Sorry, there was an error storing file information in the database: " . $stmt->error;
                            }

                        } else {
                            echo "Sorry, there was an error preparing the SQL statement: " . $yhendus->error;
                        }
                    } else {
                        echo "Sorry, there was an error uploading your file.";
                    }
                }
            } else {
                echo "No files were uploaded.";
            }

            echo "The information has been stored in the database.";
        } else {
            echo "Sorry, there was an error storing information in the database: " . $stmt->error;
        }
        $stmt->close();
    } else {
        echo "Sorry, there was an error preparing the SQL statement: " . $yhendus->error;
    }
}

$yhendus->close();
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <title> Website</title>
    <link rel="stylesheet" href="css/styles.css">
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:wght@100;200;300;400;500;600;700;800;900&display=swap" rel="stylesheet">

    <?php include 'partial/head-links.php'; ?>
</head>
<body>


<div class="container-fluid px-0">
    <!-- Navbar -->
    <?php include 'nav-bar-outside-partial.php'; ?>
    <!-- End Navbar -->
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8 ">
                <div class="shadow p-3 mb-5 bg-white rounded p-5">
                    <h2> Lisa kuulutus</h2>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">
                        <?php
                        // Check if user is logged in as "user"
                        if (isset($_SESSION['tuvastamine']) && $_SESSION['tuvastamine'] === 'user') {
                            ?>
                            <div class="form-group">
                                <label for="advert_title" class="mt-2">Kuulutuse pealkiri</label>
                                <input type="text" name="advert_title" class="form-control" id="advert_title" maxlength="80">
                            </div>
                            <div class="form-group">
                                <label for="advert_description" class="mt-2">Töö sisu</label>
                                <textarea name="advert_description" class="form-control" id="advert_description" rows="4"></textarea>
                            </div>
                            <div class="form-group">
                                <label for="region" class="mt-2">Maakond:</label>
                                <input type="text" name="region" class="form-control" id="region">
                            </div>
                            <div class="form-group">
                                <label for="city" class="mt-2">Linn/Asula/Küla:</label>
                                <input type="text" name="city" class="form-control" id="city">
                            </div>
                            <div class="form-group">
                                <label for="work_start_date" class="mt-2">Töö algus</label>
                                <input type="date" name="work_start_date" class="form-control" id="work_start_date">
                            </div>
                            <div class="form-group">
                                <label for="work_end_date" class="mt-2">Töö lõpp</label>
                                <input type="date" name="work_end_date" class="form-control" id="work_end_date">
                            </div>
                            <div class="form-group">
                                <label for="filename" class="mt-2">Pildid, video ja failid</label>
                                <div class="row">
                                    <div class="col">
                                        <input type="file" name="filename[]" class="form-control-file mt-3" id="filename" multiple>
                                    </div>
                                </div>
                            </div>
                            <button type="submit" class="btn custom-button mt-4">Lisa kuulutus</button>
                            <?php
                        } else if (isset($_SESSION['tuvastamine']) && $_SESSION['tuvastamine'] === 'company') {
                            // Display message if user is logged in as "company"
                            echo '<p style="color: red;">Teil puudub õigus kuulutusi lisada.<br> Kuulutusi saab lisada ainult registreerunud eraklient.<br></p>';


                        } else {
                            // Display message if no user is logged in
                            echo '<p style="color: red;">Teil puudub õigus kuulutusi lisada.<br> Kuulutusi saab lisada ainult registreeritud eraklient.<br><a class="black-link" href="login.php">Logi sisse.</a> </p>';
                        }
                        ?>
                    </form>


                </div>
        </div>
    </div>
    <!-- Contact -->
    <?php include 'partial/contact.php'; ?>
    <!-- End Contact -->
</div>
<!-- Bootstrap JS and dependencies (jQuery and Popper.js) -->
<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.16.0/umd/popper.min.js"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/5.0.2/js/bootstrap.min.js"></script>
<!-- Custom JS -->
<script src="js/scripts.js"></script>
</body>
</html>


