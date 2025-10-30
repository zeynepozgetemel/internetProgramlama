<?php
// MAMP varsayılanları (gerekiyorsa port 8889):
$DB_HOST = '127.0.0.1';
$DB_PORT = 8889;            // XAMPP ise 3306
$DB_NAME = 'kullanicilar';  // <— Senin veritabanının adı (ör. loginpro ise loginpro yaz)
$DB_USER = 'root';
$DB_PASS = 'root';          // XAMPP ise genelde '' (boş)

$DSN = "mysql:host=$DB_HOST;port=$DB_PORT;dbname=$DB_NAME;charset=utf8mb4";

try {
  $pdo = new PDO($DSN, $DB_USER, $DB_PASS, [
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION
  ]);
} catch (PDOException $e) {
  die("DB bağlantı hatası: " . $e->getMessage());
}

if (session_status() === PHP_SESSION_NONE) session_start();
