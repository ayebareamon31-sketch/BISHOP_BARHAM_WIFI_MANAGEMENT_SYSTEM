<?php
$DB_HOST = getenv("DB_HOST");
$DB_USER = getenv("DB_USER");
$DB_PASS = getenv("DB_PASS");
$DB_NAME = getenv("DB_NAME");

if (!$DB_HOST || !$DB_USER || !$DB_NAME) {
    die("Database configuration missing.");
}

$conn = new mysqli($DB_HOST, $DB_USER, $DB_PASS, $DB_NAME);

if ($conn->connect_error) {
    die("Database connection failed.");
}
?>



