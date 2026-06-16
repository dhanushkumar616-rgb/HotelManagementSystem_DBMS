<?php 
session_start(); require_once 'db.php';
$msg = '';
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $username = trim($_POST['username']);
    $password = trim($_POST['password']);
    $stmt = $conn->prepare(
        "SELECT * FROM admins WHERE username=? AND password=?");
    $stmt->execute([$username, md5($password)]);
    $admin = $stmt->fetch(PDO::FETCH_ASSOC);
    if ($admin) {
        $_SESSION['admin'] = $admin['admin_id'];
        header("Location: admin_dashboard.php");
        exit;
    } else {
        $msg = "Invalid credentials.";
    }
}
?>