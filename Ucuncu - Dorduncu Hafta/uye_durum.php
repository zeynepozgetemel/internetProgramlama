<?php
require __DIR__ . '/auth.php'; require_role('admin');
require __DIR__ . '/db.php';

$id = (int)($_POST['id'] ?? 0);
$durum = $_POST['durum'] ?? 'aktif';
if (!in_array($durum, ['aktif','pasif','engelli'], true)) $durum = 'aktif';

$up = $pdo->prepare("UPDATE uyeler SET durum=? WHERE id=?");
$up->execute([$durum,$id]);
header('Location: uyeler.php'); exit;
