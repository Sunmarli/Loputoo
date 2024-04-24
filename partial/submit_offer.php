<?php
require_once ('conf.php');
global $yhendus;

// Check if the company_id is set in the session
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit"])) {
    // Retrieve company_id from form submission
    $company_id = $_POST['company_id'];

    // Fetch user_id from adverts table based on advert_id
    $stmt_user_id = $yhendus->prepare("SELECT user_id FROM advert_table WHERE advert_id = ?");
    $stmt_user_id->bind_param("i", $_POST['advert_id']);
    $stmt_user_id->execute();
    $stmt_user_id->bind_result($user_id);
    $stmt_user_id->fetch();
    $stmt_user_id->close();

    // Prepare an SQL statement to insert data into the database
    $stmt = $yhendus->prepare("INSERT INTO offers_table (company_id, user_id, advert_id, offer_description, price) VALUES (?, ?, ?, ?, ?)");
    $stmt->bind_param("iiisd", $company_id, $user_id, $_POST['advert_id'], $_POST['offer_description'], $_POST['summa']);

    // Execute the statement
    $stmt->execute();

    echo '<script>alert("Pakkumine on saadetud");</script>';
    echo ' <script>
            window.location.href = "/Loputoo/partial/company_offers.php";
            </script>';
    exit();


} else {
    // Redirect to an error page or handle the error
    echo 'error';
    header("Location: /../../index.php");
    exit();
}

?>