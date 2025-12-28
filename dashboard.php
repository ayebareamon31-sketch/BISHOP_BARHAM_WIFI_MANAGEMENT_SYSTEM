<?php
session_start();
if (!isset($_SESSION["user"])) {
    header("Location: index.php");
    exit;
}
?>
<!DOCTYPE html>
<html>
<head>
<link rel="stylesheet" href="style.css">
</head>
<body>

<header>BISHOP BARHAM WIFI MANAGEMENT SYSTEM</header>

<nav>
<a href="dashboard.php">Dashboard</a>
<a href="charts.php">Analytics</a>
<a href="logout.php">Logout</a>
</nav>

<div class="container">
<h2>Admin Dashboard</h2>
<p>Welcome, <b><?= $_SESSION["user"]["fullname"] ?></b></p>

<ul>
<li>User Management</li>
<li>Device Registration</li>
<li>Bandwidth Monitoring</li>
<li>Usage Reports</li>
</ul>
</div>

<footer>&copy; Bishop Barham University</footer>
</body>
</html>
