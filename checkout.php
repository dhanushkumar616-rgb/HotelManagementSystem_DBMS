<?php
session_start(); require_once 'db.php';
$msg = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $booking_id = (int)$_POST['booking_id'];
    $bk = $conn->prepare(
        "SELECT * FROM bookings WHERE booking_id=?");
    $bk->execute([$booking_id]);
    $booking = $bk->fetch(PDO::FETCH_ASSOC);
    if ($booking && $booking['status'] === 'Checked-In') {
        $conn->prepare(
            "UPDATE bookings SET status='Completed'
             WHERE booking_id=?")->execute([$booking_id]);
        $conn->prepare(
            "UPDATE rooms SET status='Available'
             WHERE room_id=?")->execute([$booking['room_id']]);
        $msg = "Checked-out successfully!";
    } else {
        $msg = "Booking not found or already completed.";
    }
}
?>