<?php
session_start(); require_once 'db.php';
$msg = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $booking_id   = (int)$_POST['booking_id'];
    $payment_mode = trim($_POST['payment_mode']);
    $bk = $conn->prepare(
        "SELECT b.*, r.price FROM bookings b
         JOIN rooms r ON b.room_id = r.room_id
         WHERE b.booking_id = ?");
    $bk->execute([$booking_id]);
    $booking = $bk->fetch(PDO::FETCH_ASSOC);
    if ($booking) {
        $nights = (strtotime($booking['check_out'])
                 - strtotime($booking['check_in'])) / 86400;
        $nights = max(1, $nights);
        $total  = $nights * $booking['price'];
        $conn->prepare(
            "INSERT INTO payments (booking_id, amount, payment_mode)
             VALUES (?, ?, ?)")
            ->execute([$booking_id, $total, $payment_mode]);
        $msg = "Total Bill = ₹" . $total;
    }
}
?>