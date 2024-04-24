<?php

global $yhendus;
require __DIR__ .  "/../../conf.php";

// Check if email is provided and valid
if (!isset($_POST["email"]) || !filter_var($_POST["email"], FILTER_VALIDATE_EMAIL)) {
    echo "Invalid email address.";
    exit;
}

$email = $_POST["email"];

// Prepare query for users table
$sql_check_users = "SELECT reset_token_hash FROM users WHERE email = ?";
$stmt_check_users = $yhendus->prepare($sql_check_users);
$stmt_check_users->bind_param("s", $email);

// Execute query for users table
$stmt_check_users->execute();

// Store results
$userResult = $stmt_check_users->get_result();

// Fetch results from the first query
$userFound = $userResult->num_rows > 0;

// Close prepared statement
$stmt_check_users->close();

// Close result set
$userResult->close();

// Prepare query for company_users table
$sql_check_company = "SELECT reset_token_hash FROM company_users WHERE email = ?";
$stmt_check_company = $yhendus->prepare($sql_check_company);
$stmt_check_company->bind_param("s", $email);

// Execute query for company_users table
$stmt_check_company->execute();

// Store results
$companyResult = $stmt_check_company->get_result();

// Fetch results from the second query
$companyFound = $companyResult->num_rows > 0;

// Close prepared statement
$stmt_check_company->close();

// Close result set
$companyResult->close();

if ($userFound || $companyFound) {
    // User found in at least one table, proceed with token generation logic
    $max_attempts = 10;
    $attempt = 0;
    $count = 0; // Initialize count variable

    // Generate a unique token
    do {
        $token = bin2hex(random_bytes(16));
        $token_hash = hash("sha256", $token);
        $expiry = date("Y-m-d H:i:s", time() + 60 * 30);

        // Check if the token already exists in any of the tables
        $sql_token_exists = "SELECT (SELECT COUNT(*) FROM users WHERE reset_token_hash = ?) + (SELECT COUNT(*) FROM company_users WHERE reset_token_hash = ?) AS total_count";
        $stmt_token_exists = $yhendus->prepare($sql_token_exists);
        $stmt_token_exists->bind_param("ss", $token_hash, $token_hash);
        $stmt_token_exists->execute();
        $stmt_token_exists->bind_result($total_count);
        $stmt_token_exists->fetch();
        $stmt_token_exists->close();
        $attempt++;

    } while ($attempt < $max_attempts && $total_count > 0);

    if ($count == 0) {
        // Update users table
        $sql_update_users = "UPDATE users SET reset_token_hash = ?, reset_token_expires_at = ? WHERE email = ?";
        $stmt_update_users = $yhendus->prepare($sql_update_users);
        $stmt_update_users->bind_param("sss", $token_hash, $expiry, $email);
        $stmt_update_users->execute();
        $stmt_update_users->close();

        // Update company_users table
        $sql_update_company = "UPDATE company_users SET reset_token_hash = ?, reset_token_expires_at = ? WHERE email = ?";
        $stmt_update_company = $yhendus->prepare($sql_update_company);
        $stmt_update_company->bind_param("sss", $token_hash, $expiry, $email);
        $stmt_update_company->execute();
        $stmt_update_company->close();

        // Email sending logic here
        $mail = require __DIR__ . "/mailier.php";
        $mail->setFrom("noreply@example.com", "Tuleohutusteenused");
        $mail->addAddress($email);
        $mail->Subject = "Password reset";
        $mail->Body = <<<END
            We received a password reset request. The link to reset your password is below. Click 
            <a href="https://maria-juliajarv22.thkit.ee/Loputoo/partial/userpassword/reset-password.php?token=$token">here</a> 
            to reset your password.
        END;
        try {
            $mail->send();
            echo '<script>alert("Link has been sent, check your email");</script>';
            echo '<script>window.location.href = "../../index.php";</script>';

        } catch (Exception $e) {
            echo "Email could not be sent, error: {$mail->ErrorInfo}";
        }
    } else {
        echo "Failed to generate a unique token within the maximum attempts limit.";
    }
} else {
    echo "User not found.";
}

$yhendus->close();
