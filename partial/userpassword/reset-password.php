<?php
global $yhendus;

$token = $_GET["token"];
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
?>
<!DOCTYPE html>
<html>
<head>
    <title>Uus parool</title>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/water.css@2/out/water.css">
</head>
<body>

<h1>Loo Uus parool</h1>

<form method="post" action="process-reset-password.php">

    <input type="hidden" name="token" value="<?= htmlspecialchars($token) ?>">

    <label for="password">New password</label>
    <input type="password" id="password" name="password">

    <label for="password_confirmation">Repeat password</label>
    <input type="password" id="password_confirmation"
           name="password_confirmation">

    <button>Send</button>
</form>

</body>
</html>