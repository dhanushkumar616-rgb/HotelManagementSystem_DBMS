<?php
// db.php — Database connection file
$host   = 'localhost';
$dbname = 'hotel_db';
$user   = 'root';
$pass   = ''; // XAMPP default password is empty
try {
    $conn = new PDO(
        "mysql:host=$host;dbname=$dbname;charset=utf8",
        $user, $pass
    );
    $conn->setAttribute(
        PDO::ATTR_ERRMODE,
        PDO::ERRMODE_EXCEPTION
    );
} catch (PDOException $e) {
    die('<h3 style="color:red;">Database Connection Failed!</h3>'
        . '<p>' . $e->getMessage() . '</p>');
}
?>