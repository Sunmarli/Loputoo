<?php
require_once('conf.php');
global $yhendus;
session_start();

if (!isset($_SESSION['user_id'])) {
    // Redirect the user to the login page if not logged in
    header("Location: login.php");
    exit();
}
$user_id = $_SESSION['user_id'];

// Fetch advertisements associated with the user ID
$sql = "SELECT advert_id, advert_title, advert_description, created_at FROM advert_table WHERE user_id = ?";
$stmt = $yhendus->prepare($sql);
if ($stmt) {
    $stmt->bind_param("i", $user_id);
    $stmt->execute();

    $advertisements = array();
    $result = $stmt->get_result();
    // Check if there are any advertisements
    if ($result->num_rows > 0) {
        // Output the list of advertisements
        while ($row = $result->fetch_assoc()) {
            $advert = new stdClass();
            $advert->advert_id = $row['advert_id']; // Assign advert_id from the fetched row
            $advert->user_id = $user_id;
            $advert->advert_title = htmlspecialchars($row['advert_title']); // Assign advert_title from the fetched row
            $advert->description = htmlspecialchars($row['advert_description']); // Assign advert_description from the fetched row
            $advert->created_at = $row['created_at']; // Assign created_at from the fetched row
            array_push($advertisements, $advert);
        }
    } else {
        // Display a message if no advertisements are found
        echo "No advertisements found.";
    }
    $stmt->close(); // Close the statement after fetching the result set
} else {
    // Handle database error
    echo "Error: " . $yhendus->error;
}

// Close the database connection
$yhendus->close();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0">
    <title>Website</title>
    <?php include 'head-links.php'; ?>
</head>
<body>

<div class="container-fluid px-0">
    <!-- Navbar -->
    <?php include 'nav-bar.php'; ?>
    <!-- End Navbar -->

    <!-- Main content -->
    <main>
        <div class="container">
            <div class="row">
                <div class="col-md-9">
                    <div class="table-responsive">
                        <table class="table table-striped">
                            <thead>
                            <tr>
                                <th class="text-left" scope="col">Kuulutus</th>
                                <th class="text-left" scope="col">Lisatud</th>
                            </tr>
                            </thead>
                            <tbody>
                            <?php foreach($advertisements as $advert): ?>
                                <tr>
                                    <td>
                                        <div class="row mr-2">
                                            <div class="col-md-8">
                                                <h4 style="word-wrap: break-word;">
                                                    <?=$advert->advert_title ?>
                                                </h4>
                                                <p style="word-wrap: break-word;">
                                                    <?=$advert->description ?>
                                                </p>
                                            </div>
                                        </div>
                                    </td>
                                    <td class="text-left"><?= date("d.m.Y", strtotime($advert->created_at)) ?>

                                        <div class="d-flex justify-content-center align-items-center mt-3"> <!-- Center the button vertically -->
                                            <a class="btn custom-button" href="arvert_edit.php">Muuda</a>
                                        </div></td>
                                </tr>
                            <?php endforeach; ?>
                            </tbody>
                        </table>
                    </div>
                </div>
                <div class="col-md-3 mt-5">
                    <div class="d-flex justify-content-center align-items-center h-100"> <!-- Center the button vertically -->
                        <a class="btn custom-button" href="arvert_edit.php">Muuda</a>
                    </div>
                </div>
            </div>
        </div>
    </main>

    <!-- Bootstrap JS and dependencies (jQuery and Popper.js) -->
<!--    --><?php //include 'footer-links.php'; ?>
</div>
</body>
</html>
