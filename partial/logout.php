<?php
session_start();
if (isset($_SESSION['username'])) {
    // Log the user out
    session_unset();
    session_destroy();
} elseif (isset($_SESSION['company_name'])) {
    // Log the company out
    session_unset();
    session_destroy();
}

// Redirect to index.php after logout
header("Location: ../index.php");
exit();
?>
