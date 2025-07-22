<?php
require 'db.php';
if (isset($_POST['title'], $_POST['start'])) {
    $title = $_POST['title'];
    $start = $_POST['start'];
    $end = isset($_POST['end']) ? $_POST['end'] : null;
    $stmt = $conn->prepare("INSERT INTO events (title, start, end) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $title, $start, $end);
    $stmt->execute();
    $stmt->close();
    echo 'success';
} else {
    echo 'error';
}
$conn->close(); 