<?php
session_start();
$host = 'localhost';
$db   = 'flight_reservation';
$user = 'root';
$pass = '';
try {
    $pdo = new PDO("mysql:host=$host;dbname=$db;charset=utf8mb4", $user, $pass, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC
    ]);
} catch (PDOException $e) {
    exit('Database connection failed. Import database.sql and check config.php.');
}
function h($value) { return htmlspecialchars((string)$value, ENT_QUOTES, 'UTF-8'); }
function require_login() {
    if (empty($_SESSION['user_id'])) { header('Location: login.php'); exit; }
}
function is_admin() { return !empty($_SESSION['is_admin']); }
?>