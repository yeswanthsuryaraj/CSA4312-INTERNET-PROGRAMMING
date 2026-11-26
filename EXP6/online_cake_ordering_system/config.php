<?php
session_start();
$host='localhost'; $db='cake_ordering'; $user='root'; $pass='';
try {
 $pdo=new PDO("mysql:host=$host;dbname=$db;charset=utf8mb4",$user,$pass,[
  PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION,
  PDO::ATTR_DEFAULT_FETCH_MODE=>PDO::FETCH_ASSOC
 ]);
} catch(PDOException $e) { exit('Database connection failed. Import database.sql and check config.php.'); }
function h($v){ return htmlspecialchars((string)$v,ENT_QUOTES,'UTF-8'); }
function require_login(){ if(empty($_SESSION['user_id'])){header('Location: login.php');exit;} }
function require_admin(){ require_login(); if(empty($_SESSION['is_admin'])) exit('Admin access only'); }
function money($n){ return '₹'.number_format((float)$n,2); }
?>