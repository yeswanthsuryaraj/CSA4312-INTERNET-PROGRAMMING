<?php
declare(strict_types=1);
session_start();
define('APP_URL','http://localhost/stylehub_ecommerce');
define('DB_HOST','localhost'); define('DB_NAME','stylehub'); define('DB_USER','root'); define('DB_PASS','');
try{$pdo=new PDO('mysql:host='.DB_HOST.';dbname='.DB_NAME.';charset=utf8mb4',DB_USER,DB_PASS,[PDO::ATTR_ERRMODE=>PDO::ERRMODE_EXCEPTION,PDO::ATTR_DEFAULT_FETCH_MODE=>PDO::FETCH_ASSOC]);}
catch(PDOException $e){http_response_code(500);exit('Database connection failed. Import database.sql and check config.php.');}
