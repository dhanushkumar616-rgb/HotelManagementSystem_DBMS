<?php
session_start(); require_once 'db.php';
$msg = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $guest_id  = (int)$_POST['guest_id'];
    $room_id   = (int)$_POST['room_id'];
    $check_in  = $_POST['check_in'];
    $check_out = $_POST['check_out'];
    $stmt = $conn->prepare(
        "INSERT INTO bookings (guest_id, room_id, check_in, check_out, status)
         VALUES (?, ?, ?, ?, 'Booked')");
    $stmt->execute([$guest_id, $room_id, $check_in, $check_out]);
    $conn->prepare(
        "UPDATE rooms SET status='Occupied' WHERE room_id=?")
        ->execute([$room_id]);
    $msg = "Booking Successful!";
}
?>