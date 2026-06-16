<?php
session_start(); require_once 'db.php';
$msg = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name  = strtoupper(trim($_POST['name']));
    $phone = trim($_POST['phone']);
    $proof = (int)$_POST['id_proof'];
    $stmt = $conn->prepare(
        "INSERT INTO guests (name, phone, id_proof) VALUES (?, ?, ?)");
    $stmt->execute([$name, $phone, $proof]);
    $msg = "Guest Registered! ID: " . $conn->lastInsertId();
}
?>