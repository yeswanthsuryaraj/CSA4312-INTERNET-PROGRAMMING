<?php
declare(strict_types=1);
session_start();

define('APP_NAME', 'Glow & Go Beauty Studio');
define('BASE_URL', 'http://localhost/beauty_parlour_booking'); // Change for your setup
define('DB_HOST', 'localhost');
define('DB_NAME', 'beauty_parlour');
define('DB_USER', 'root');
define('DB_PASS', '');

// Optional Stripe Checkout integration. Add your secret key to enable online deposits.
define('STRIPE_SECRET_KEY', '');

// Connect to MySQL using PDO.
try {
    $pdo = new PDO(
        'mysql:host=' . DB_HOST . ';dbname=' . DB_NAME . ';charset=utf8mb4',
        DB_USER,
        DB_PASS,
        [PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION, PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC]
    );
} catch (PDOException $e) {
    http_response_code(500);
    exit('Database connection failed. Import database.sql and check config.php.');
}
