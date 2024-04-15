<?php
require_once('conf.php');
global $yhendus;
//shows what has been sent from the form
echo "<pre>";
print_r($_POST);
echo "</pre>";
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit"])) {
    // Check if all required fields are set
    if (isset($_POST["advert_id"], $_POST["comment_text"])) {
        // Get data from the form
        $advert_id = $_POST["advert_id"];
        $comment_text = $_POST["comment_text"];


        date_default_timezone_set('Europe/Tallinn');
        $currentDateTime = date("d-m-Y H:i:s");

        session_start(); // Start the session

        // Check if user_id is set in session
        if (isset($_SESSION['user_id'])) {
            $user_id = $_SESSION['user_id'];
            $company_id = null;
        } elseif (isset($_SESSION['company_id'])) { // Check if company_id is set in session
            $company_id = $_SESSION['company_id'];
            $user_id = null;
        } else {
            // If neither user_id nor company_id is set, handle the error or redirect
            echo "Error: User or company not logged in.";
            exit;
        }

        // Prepare and execute the SQL statement to insert the comment
        $sql = "INSERT INTO comments (advert_id, user_id, company_id, comment_text, parent_comment_id, created_at) 
            VALUES (?, ?, ?, ?, ?, ?)";
        $stmt = $yhendus->prepare($sql);
        $stmt->bind_param("iiisss", $advert_id, $user_id, $company_id, $comment_text, $parent_comment_id, $currentDateTime);
        // Execute the SQL query
        $success = $stmt->execute();

        if ($success) {
            // Comment submitted successfully
            echo "Comment submitted successfully!";
            header('Location: advert_detailed.php?advert_id=' . $advert_id);
            exit; // Make sure to exit after redirection
        } else {
            // Error while submitting comment
            echo "Error submitting comment. Please try again later.";
        }
    } else {
        // Required fields not set
        echo "All fields are required.";
    }


} else {
    // Redirect if accessed directly
    echo "this is fucked up !";// Change index.php to the appropriate page
    exit;
}
?>
