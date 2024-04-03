<?php

global $yhendus;
require __DIR__ .  "/../../conf.php";
// Check if email is provided and valid
if (!isset($_POST["email"]) || !filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
    echo "Invalid email address.";
    exit;
}
$email = $_POST["email"];

// Check if token already exists
$sql_check = "SELECT reset_token_hash FROM users WHERE email = ?";
$stmt_check = $yhendus->prepare($sql_check);
$stmt_check->bind_param("s", $email);
$stmt_check->execute();
$stmt_check->store_result();
$count=0;
if ($stmt_check->num_rows > 0) {
    // Token already exists, attempt to generate a new one
    $max_attempts = 10; // Set a maximum number of attempts
    $attempt = 0;
    do {
        $token = bin2hex(random_bytes(16));
        $token_hash = hash("sha256", $token);
        $expiry = date("Y-m-d H:i:s", time() + 60 * 30);

        // Check if the token already exists
        $sql_token_exists = "SELECT COUNT(*) FROM users WHERE reset_token_hash = ?";
        $stmt_token_exists = $yhendus->prepare($sql_token_exists);
        $stmt_token_exists->bind_param("s", $token_hash);
        $stmt_token_exists->execute();
        $stmt_token_exists->bind_result($count);
        $stmt_token_exists->fetch();
        $stmt_token_exists->close();

        $attempt++;

    } while ($attempt < $max_attempts && $count > 0);

    if ($count == 0) {
        // Update database with new token
        $sql_update = "UPDATE users
                       SET reset_token_hash = ?,
                           reset_token_expires_at = ? 
                       WHERE email = ?";
        $stmt_update = $yhendus->prepare($sql_update);
        $stmt_update->bind_param("sss", $token_hash, $expiry, $email);
        $stmt_update->execute();
        $stmt_update->close();

        echo "User found and updated successfully.";

        // Email sending logic here
        $mail = require __DIR__ . "/mailier.php";
        $mail->setFrom("noreply@example.com", "Kapibara");
        $mail->addAddress($email);
        $mail->Subject = "Password reset";
        $mail->Body = <<<END
            We recieved a password reset request. The lnk to reset your password is below. Here is your password reset link; <a href="http://localhost:63342/Loputoo/partial/userpassword/reset-password.php?token=$token">here</a> 
            to reset your password.
        END;
        try {
            $mail->send();
            echo "Link has been sent, check your mail";
        } catch (Exception $e) {
            echo "Email can not be sent, error: {$mail->ErrorInfo}";
        }
    } else {
        echo "Failed to generate a unique token within the maximum attempts limit.";
    }
} else {
    echo "User not found.";
}

$stmt_check->close();
$yhendus->close();








