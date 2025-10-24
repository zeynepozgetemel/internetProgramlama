<?php
require __DIR__ . '/db.php';

$kulad = trim($_POST['kulad'] ?? '');
$sifre = $_POST['sifre'] ?? '';

if ($kulad === '' || $sifre === '') {
  $_SESSION['flash'] = 'Kullanıcı adı ve şifre zorunlu.';
  header('Location: login.php'); exit;
}

// DİKKAT: tablo = kullanicilar, alanlar = kulad, sifre, rol
$stmt = $pdo->prepare("SELECT id, kulad, sifre, rol FROM kullanicilar WHERE kulad = ?");
$stmt->execute([$kulad]);
$user = $stmt->fetch(PDO::FETCH_ASSOC);

if (!$user || !password_verify($sifre, $user['sifre'])) {
  $_SESSION['flash'] = 'Geçersiz kullanıcı adı veya şifre.';
  header('Location: login.php'); exit;
}

// Session
$_SESSION['user'] = [
  'id'   => $user['id'],
  'kulad'=> $user['kulad'],
  'rol'  => $user['rol'],
];

// Role göre yönlendir (senin SQL’inde roller 'admin' ve 'uye')
if ($user['rol'] === 'admin') {
  header('Location: admin.php');
} else {
  header('Location: uye.php');
}
exit;
