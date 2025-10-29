<?php 

// Database connection settings
$host = 'localhost';
$db   = 'blog_db';
$user = 'tee';
$pass = '001100tee';
$charset = 'utf8mb4';

$dsn = "mysql:host=$host;dbname=$db;charset=utf8mb4";

try {
    $pdo = new PDO($dsn, $user, $pass, [
        PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
        PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
    ]);
} catch (PDOException $e) {
    // Friendly error on local dev
    echo "DB connection failed: " . htmlspecialchars($e->getMessage());
    exit;
}

?>