<?php
require "db.php";

$q = $conn->query(
    "SELECT u.role, SUM(s.data_used) AS total
     FROM sessions s
     JOIN users u ON s.user_id=u.id
     GROUP BY u.role"
);

$data = [];
while ($row = $q->fetch_assoc()) {
    $data[] = $row;
}

echo json_encode($data);
