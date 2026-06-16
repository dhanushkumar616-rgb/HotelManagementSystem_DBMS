<?php
session_start(); require_once 'db.php';
if (!isset($_SESSION['admin'])) {
    header("Location: admin_login.php"); exit;
}
if (isset($_GET['delete'])) {
    $id = (int)$_GET['delete'];
    $conn->prepare("DELETE FROM guests WHERE guest_id=?",)
        ->execute([$id]);
}
$guests = $conn->query("SELECT * FROM guests")
    ->fetchAll(PDO::FETCH_ASSOC);
?>