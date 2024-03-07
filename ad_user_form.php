<?php
require_once('conf.php');
global $yhendus;
session_start();
$user_id= $_SESSION['user_id'];
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

    if (isset($_FILES["filename"]) && $_FILES["filename"]["error"] == 0) {
        // File upload handling...
        $target_dir = dirname(__FILE__) . "/user_files/"; // Corrected folder path
        $filename = uniqid() . '_' . basename($_FILES["filename"]["name"]);
        $upload_path = $target_dir . $filename;

        if (move_uploaded_file($_FILES["filename"]["tmp_name"], $upload_path)) {
            // Insert data into the database without specifying the filename column
            $sql = "INSERT INTO advert_table (user_id, advert_title, advert_description, region, city, work_start_date, work_end_date, filename)
                    VALUES (?, ?, ?, ?, ?, ?, ?, ?)";
            $stmt = $yhendus->prepare($sql);
            if ($stmt) {
                $stmt->bind_param("isssssss", $user_id, $advert_title, $advert_description, $region, $city, $work_start_date, $work_end_date, $filename);
                if ($stmt->execute()) {
                    echo "The file $filename has been uploaded and the information has been stored in the database.";
                } else {
                    echo "Sorry, there was an error storing information in the database: " . $stmt->error;
                }
                $stmt->close();
            } else {
                echo "Sorry, there was an error preparing the SQL statement: " . $yhendus->error;
            }
        } else {
            echo "Sorry, there was an error uploading your file.";
        }
    } else {
        // Insert data into the database without the filename column
        $sql = "INSERT INTO advert_table (user_id, advert_title, advert_description, region, city, work_start_date, work_end_date)
                VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $yhendus->prepare($sql);
        if ($stmt) {
            $stmt->bind_param("issssss", $user_id, $advert_title, $advert_description, $region, $city, $work_start_date, $work_end_date);
            if ($stmt->execute()) {
                echo "The information has been stored in the database.";
            } else {
                echo "Sorry, there was an error storing information in the database: " . $stmt->error;
            }
            $stmt->close();
        } else {
            echo "Sorry, there was an error preparing the SQL statement: " . $yhendus->error;
        }
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
</head>
<body>
<!-- Navbar -->
<?php include 'partial/nav-bar.php'; ?>
<!-- End Navbar -->
<div class="container-fluid px-0">
    <div class="container mt-5">
        <div class="row justify-content-center">
            <div class="col-md-8 ">
                <div class="shadow p-3 mb-5 bg-white rounded p-5">
                    <h2> täidab kasutaja. This form will go to database and later to be shown on main page table. Need to be connect to database</h2>
                    <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="post" enctype="multipart/form-data">
                        <div class="form-group">
                            <label for="advert_title" class="mt-2" >Kuulutuse pealkiri</label>
                            <input type="text" name="advert_title" class="form-control" id="advert_title" maxlength="80">
                        </div>
                        <div class="form-group">
                            <label for="advert_description" class="mt-2">Töö sisu</label>
                            <textarea name="advert_description" class="form-control" id="advert_description" rows="4"></textarea>
                        </div>
                        <div><label for="region" class="mt-2">Maakond:</label>
                            <input type="text" name="region" class="form-control" id="region"></div>
                        <div><label for="city" class="mt-2">Linn/Asula/Küla:</label>
                            <input type="text" name="city" class="form-control" id="city"></div>
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
                                    <input type="file" name="filename" class="form-control-file mt-3" id="filename">
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
    <?php include 'partial/concat.php'; ?>
    <!-- End Contact -->
</div>
<!-- Custom JS -->
<script src="js/scripts.js"></script>
</body>
</html>

