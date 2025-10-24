<?php
require __DIR__ . '/auth.php';
require_role('member');
$user = $_SESSION['user'];
?>
<!doctype html>
<html lang="tr">
<head>
  <meta charset="utf-8">
  <title>Üye Alanı</title>
  <style>
    body {font-family: system-ui, -apple-system, Arial; background:#f9fafb; color:#111827; margin:0; padding:40px;}
    .wrap {max-width:900px; margin:0 auto;}
    .top {display:flex; align-items:center; justify-content:space-between; margin-bottom:24px;}
    .card {background:#fff; border:1px solid #e5e7eb; border-radius:16px; padding:20px; box-shadow:0 6px 24px rgba(0,0,0,.06);}
    a.btn {background:#111827; color:#fff; padding:10px 14px; border-radius:10px; text-decoration:none;}
    .hi {font-size:18px;}
  </style>
</head>
<body>
  <div class="wrap">
    <div class="top">
      <div class="hi">Hoş geldin, <b><?= htmlspecialchars($user['username']) ?></b> (Üye)</div>
      <a class="btn" href="logout.php">Çıkış</a>
    </div>
    <div class="card">
      <h2>Üyelere Özel Sayfa</h2>
      <p>Burayı sadece <b>üye</b> rolü görebilir.</p>
    </div>
  </div>
</body>
</html>
