<?php
require "db.php";
$msg = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $u = $_POST["username"];

    $q = $conn->prepare("SELECT id FROM users WHERE username=?");
    $q->bind_param("s", $u);
    $q->execute();
    $r = $q->get_result();

    if ($user = $r->fetch_assoc()) {
        $token = bin2hex(random_bytes(32));
        $exp = date("Y-m-d H:i:s", strtotime("+30 minutes"));

        $conn->query("DELETE FROM password_resets WHERE user_id=".$user["id"]);

        $stmt = $conn->prepare(
            "INSERT INTO password_resets (user_id, reset_token, expires_at)
             VALUES (?, ?, ?)"
        );
        $stmt->bind_param("iss", $user["id"], $token, $exp);
        $stmt->execute();

        $msg = "Reset link:<br>
        <a href='reset_password.php?token=$token'>Reset Password</a>";
    } else {
        $msg = "User not found";
    }
}
?>
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="style.css">
</head>
<body>

<header>Password Recovery</header>

<div class="container">
<h2>Forgot Password</h2>
<form method="POST">
<input name="username" placeholder="Username" required>
<button>Generate Reset Link</button>
</form>
<p><?= $msg ?></p>
</div>

</body>
</html>
