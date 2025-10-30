<?php
require __DIR__ . '/auth.php'; require_role('admin');
require __DIR__ . '/db.php';

$id = (int)($_GET['id'] ?? 0);
$del = $pdo->prepare("DELETE FROM kitaplar WHERE id=?");
$del->execute([$id]);
header('Location: kitaplar.php'); exit;
