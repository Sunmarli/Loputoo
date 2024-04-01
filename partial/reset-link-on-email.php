<?php
require_once ('conf.php');
global $yhendus;
session_start();

ini_set('SMTP', 'localhost');
ini_set('smtp_port', 25);


$receiver = "mjum473@gmail.com";
$subject = "Email Test via PHP using Localhost";
$body = "Hi, there...This is a test email send from Localhost.";
$sender = "From:mjum473@gmail.com";

if (mail($receiver, $subject, $body, $sender)) {
    echo "Email sent successfully to $receiver";
} else {
    echo "Sorry, failed while sending mail!";
}


// Function to retrieve user by email from the database
function getUserByEmail($email, $yhendus) {
    $sql = "SELECT * FROM users WHERE email = ?";
    $stmt = $yhendus->prepare($sql);
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    return $result->fetch_assoc();
}

// Function to store reset token in the database
function storeToken($userId, $email, $token, $yhendus) {
    $sql = "INSERT INTO password_reset_tokens (user_id, email, token) VALUES (?, ?, ?)";
    $stmt = $yhendus->prepare($sql);
    $stmt->bind_param("iss", $userId, $email, $token);
    $stmt->execute();
}

// Function to update password in the database
function updatePassword($userId, $newPassword, $yhendus) {
    $sql = "UPDATE users SET password = ? WHERE user_id = ?";
    $stmt = $yhendus->prepare($sql);
    $stmt->bind_param("si", $newPassword, $userId);
    $stmt->execute();
}

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["email"])) {

    $email = filter_var($_POST["email"], FILTER_SANITIZE_EMAIL);

    // Generate a unique token
    $token = bin2hex(random_bytes(32));

    // Fetch user from the database based on email
    $user = getUserByEmail($email, $yhendus);

    if ($user) {
        // Store the token and email in the database
        storeToken($user['user_id'], $email, $token, $yhendus);

        $resetLink = "https://example.com/password-recover.php?token=$token";

        $subject = "Password Reset";
        $message = "To reset your password, click on the following link: $resetLink";
        $headers = "From: your@example.com";

        // Send the email
        if (mail($email, $subject, $message, $headers)) {
            echo "Password reset link has been sent to your email address.";
        } else {
            echo "Failed to send password reset link. Please try again later.";
        }
    } else {

        echo "User with email $email does not exist.";
    }
}
?>
