<?php
require_once __DIR__ . '/db.php';

function require_login() {
  if (empty($_SESSION['user'])) {
    $_SESSION['flash'] = 'Lütfen giriş yapın.';
    header('Location: login.php'); exit;
  }
}

function require_role($role) {
  require_login();
  if (($_SESSION['user']['rol'] ?? null) !== $role) {
    // Yanlış rol: kendi sayfasına döndür
    if ($_SESSION['user']['rol'] === 'admin') header('Location: admin.php');
    else header('Location: uye.php');
    exit;
  }
}
