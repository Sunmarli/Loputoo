<?php
require_once('conf.php');
global $yhendus;
//shows what has been sent from the form
echo "<pre>";
print_r($_POST);
echo "</pre>";
require_once('conf.php');
global $yhendus;
session_start();

// Check if company_id is 0, if so, set it to null
$company_id = $_POST["company_id"] === '0' ? null : $_POST["company_id"];
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["submit-reply"])) {
    // Check if all required fields are set and not empty
    if (!empty($_POST["advert_id"]) && !empty($_POST["reply_text"])) {
        // Get data from the form
        $advert_id = $_POST["advert_id"];
        $comment_text = $_POST["reply_text"];
        $parent_comment_id = $_POST["parent_comment_id"];
        $user_id = $_POST["user_id"];
        $company_id = $_POST["company_id"] === '0' ? null : $_POST["company_id"];

        // Prepare and execute the SQL statement to insert the reply
        $sql = "INSERT INTO comments (advert_id, user_id, company_id, comment_text, parent_comment_id, created_at) 
            VALUES (?, ?, ?, ?, ?, NOW())";
        $stmt = $yhendus->prepare($sql);
        $stmt->bind_param("iiiss", $advert_id, $user_id, $company_id, $comment_text, $parent_comment_id);
        // Execute the SQL query
        $success = $stmt->execute();

        if ($success) {
            // Reply submitted successfully
            echo "Reply submitted successfully!";
            echo '<script>window.location.href = "../advert_detailed.php?advert_id=' . $advert_id . '";</script>';
            exit;
        } else {
            // Error while submitting reply
            echo "Error submitting reply. Please try again later.";
        }
    } else {
        // Required fields are empty or not set
        echo "All fields are required.";
    }
} else {
    // Redirect if accessed directly
    echo "Redirect if accessed directly.";
    echo '<script>window.location.href = "../index.php/";</script>';
    exit;
}

?>

