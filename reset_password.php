<?php
require "db.php";

if (!isset($_GET["token"])) {
    die("Invalid request");
}

$t = $_GET["token"];

$q = $conn->prepare(
    "SELECT user_id FROM password_resets
     WHERE reset_token=? AND expires_at > NOW()"
);
$q->bind_param("s", $t);
$q->execute();
$r = $q->get_result();

if (!$row = $r->fetch_assoc()) {
    die("Token expired or invalid");
}

if ($_SERVER["REQUEST_METHOD"] === "POST") {
    $p = password_hash($_POST["password"], PASSWORD_DEFAULT);

    $stmt = $conn->prepare("UPDATE users SET password=? WHERE id=?");
    $stmt->bind_param("si", $p, $row["user_id"]);
    $stmt->execute();

    $conn->query("DELETE FROM password_resets WHERE user_id=".$row["user_id"]);

    echo "Password reset successful. <a href='index.php'>Login</a>";
    exit;
}
?>
<form method="POST">
<input type="password" name="password" placeholder="New Password" required>
<button>Reset Password</button>
</form>
