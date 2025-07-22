<?php
require 'db.php';
$result = $conn->query("SELECT id, title, start, end FROM events");
$events = [];
while ($row = $result->fetch_assoc()) {
    $events[] = $row;
}
header('Content-Type: application/json');
echo json_encode($events);
$conn->close(); 