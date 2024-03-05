<?php
session_start();


if (isset($_SESSION['username'])) {
    // Log the user out
    session_unset();
    session_destroy();


    header("Location: ../index.php");
    exit();
} else {

    header("Location: ../index.php");
    exit();
}
?>