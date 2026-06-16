<?php
session_start(); require_once 'db.php';
$msg = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $booking_id = (int)$_POST['booking_id'];
    $stmt = $conn->prepare(
        "UPDATE bookings SET status='Checked-In'
         WHERE booking_id=? AND status='Booked'");
    $stmt->execute([$booking_id]);
    $msg = ($stmt->rowCount() > 0) ? "Checked-in!" : "Invalid Booking ID.";
}
?>