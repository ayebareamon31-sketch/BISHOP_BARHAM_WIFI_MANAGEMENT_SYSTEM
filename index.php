<?php
session_start();
require "db.php";

$error = "";

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $u = $_POST["username"];
    $p = $_POST["password"];

    $stmt = $conn->prepare("SELECT * FROM users WHERE username=? AND status='active'");
    $stmt->bind_param("s", $u);
    $stmt->execute();
    $res = $stmt->get_result();

    if ($user = $res->fetch_assoc()) {
        if (password_verify($p, $user["password"])) {
            $_SESSION["user"] = $user;
            header("Location: dashboard.php");
            exit;
        }
    }
    $error = "Invalid username or password";
}
?>
<!DOCTYPE html>
<html>
<head>
<title>BISHOP BARHAM WIFI MANAGEMENT SYSTEM</title>
<link rel="stylesheet" href="style.css">
</head>
<body>

<header>BISHOP BARHAM WIFI MANAGEMENT SYSTEM</header>

<div class="container">
<h2>System Login</h2>

<form method="POST">
<input name="username" placeholder="Username" required>
<input type="password" name="password" placeholder="Password" required>
<button>Login</button>
</form>

<p style="color:red"><?= $error ?></p>
<p><a href="forgot_password.php">Forgot Password?</a></p>
</div>

<footer>&copy; Bishop Barham University</footer>
</body>
</html>
