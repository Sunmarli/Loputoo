<?php
global $yhendus;
// Check Token
$token = $_GET["token"] ?? null;
if (!$token) {
    die("Token not found");
}

$token_hash = hash("sha256", $token);

// Database Connection
require __DIR__ .  "/../../conf.php";

// Fetch User Details
$sql = "SELECT * FROM users WHERE reset_token_hash=?";
$stmt = $yhendus->prepare($sql);
$stmt->bind_param("s", $token_hash);
$stmt->execute();
$result_user = $stmt->get_result();
$user = $result_user->fetch_assoc();

if (empty($user)) {
    // If not found in users table, check company_users table
    $sql_company = "SELECT * FROM company_users WHERE reset_token_hash=?";
    $stmt_company = $yhendus->prepare($sql_company);
    $stmt_company->bind_param("s", $token_hash);
    $stmt_company->execute();
    $result_company = $stmt_company->get_result();
    $company_user = $result_company->fetch_assoc();

    if (empty($company_user)) {
        die("Token not found");
    } else {
        // Set user type as company user
        $user_type = "company";
    }
} else {
    // Set user type as individual user
    $user_type = "individual";
}

// Check Token Expiry based on user type
if ($user_type === "individual" && strtotime($user['reset_token_expires_at']) <= time()) {
    die("Token has expired");
} elseif ($user_type === "company" && strtotime($company_user['reset_token_expires_at']) <= time()) {
    die("Token has expired");
}

echo "Token is valid and has not expired";

// Password Validation
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
if (!empty($passwordError) || !empty($confirmError)) {
    // If there are errors, include them directly in the form
    include 'reset-password.php'; // Include the form file
    exit(); // Terminate the script execution
}

$password_hash = password_hash($_POST["password"], PASSWORD_DEFAULT);

// Update Password based on User Type
if ($user_type === "individual") {
    $sql_update = "UPDATE users
                   SET password_hash = ?,
                       reset_token_hash = NULL,
                       reset_token_expires_at = NULL
                   WHERE user_id = ?";
} elseif ($user_type === "company") {
    $sql_update = "UPDATE company_users
                   SET password_hash = ?,
                       reset_token_hash = NULL,
                       reset_token_expires_at = NULL
                   WHERE company_id = ?";
}

$stmt_update = $yhendus->prepare($sql_update);

// Check if the user is individual or company and bind parameters accordingly
if ($user_type === "individual") {
    $stmt_update->bind_param("ss", $password_hash, $user["user_id"]);
} elseif ($user_type === "company") {
    $stmt_update->bind_param("ss", $password_hash, $company_user["company_id"]);
}

$stmt_update->execute();



echo '<script>alert("Password updated. You can now login");</script>';
echo '<script>window.location.href = "../../login.php";</script>';
?>
