<?php
$host = 'localhost';
$db = 'user_db';    // Name of your database
$user = 'root';     // Your MySQL username
$pass = '';         // Your MySQL password

try {
    $pdo = new PDO("mysql:host=$host;dbname=$db", $user, $pass);
    $pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch (PDOException $e) {
    die("Could not connect to the database $db :" . $e->getMessage());
}
?>

