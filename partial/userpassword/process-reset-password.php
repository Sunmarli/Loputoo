<?php
global $yhendus;

$token = $_GET["token"] ?? null; // Use null coalescing operator to handle undefined index
if (!$token) {
    die("Token not found");
}

$token_hash = hash("sha256", $token);

require __DIR__ .  "/../../conf.php";

$sql = "SELECT * FROM users WHERE reset_token_hash=?";
$stmt = $yhendus->prepare($sql);
$stmt->bind_param("s", $token_hash);
$stmt->execute();
$result = $stmt->get_result();

$user = $result->fetch_assoc();

if (empty($user)) {
    die("Token not found");
}

if (strtotime($user['reset_token_expires_at']) <= time()) {
    die("Token has expired");
}

echo "Token is valid and has not expired";


// Initialize error messages
$passwordError = $confirmError = "";

// Validate password
if (strlen($_POST["password"]) < 5) {
    $passwordError = "Password must be at least 5 characters";
}

// Validate password confirmation
if ($_POST["password"] !== $_POST["password_confirmation"]) {
    $confirmError = "Passwords must match";
}

// Check if there are any errors
if (isset($passwordError) || isset($confirmError)) {
    // If there are errors, include them directly in the form
    include 'reset-password.php'; // Include the form file
    exit(); // Terminate the script execution
}
$password_hash = password_hash($_POST["password"], PASSWORD_DEFAULT);

$sql = "UPDATE users
        SET password_hash = ?,
            reset_token_hash = NULL,
            reset_token_expires_at = NULL
        WHERE user_id = ?";

$stmt = $yhendus->prepare($sql);

$stmt->bind_param("ss", $password_hash, $user["user_id"]);

$stmt->execute();

echo "Password updated. You can now login.";
?>
