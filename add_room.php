<?php
session_start(); require_once 'db.php';
$msg = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $type  = trim($_POST['room_type']);
    $price = (float)$_POST['price'];
    $stmt  = $conn->prepare(
        "INSERT INTO rooms (type, price, status) VALUES (?, ?, 'Available')");
    $stmt->execute([$type, $price]);
    $msg = "Room Added!";
}
?>