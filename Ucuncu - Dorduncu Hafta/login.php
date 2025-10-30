<?php require __DIR__ . '/db.php'; ?>
<!doctype html>
<html lang="tr">
<head>
  <meta charset="utf-8">
  <title>Giriş</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <style>
    body {font-family: system-ui, Arial; background:#f6f7fb; display:flex; align-items:center; justify-content:center; min-height:100vh; margin:0;}
    .card {background:#fff; padding:28px; border-radius:16px; box-shadow:0 10px 30px rgba(0,0,0,.08); width:360px;}
    h1 {font-size:22px; margin:0 0 16px;}
    label {display:block; font-size:14px; margin:12px 0 6px;}
    input {width:100%; padding:10px 12px; border:1px solid #e3e6ee; border-radius:10px; font-size:14px;}
    button {margin-top:16px; width:100%; padding:12px; border:0; border-radius:12px; background:#4f46e5; color:#fff; font-weight:600; cursor:pointer;}
    .msg {margin-top:12px; font-size:14px; color:#b91c1c;}
  </style>
</head>
<body>
  <div class="card">
    <h1>Giriş Yap</h1>
    <form method="post" action="process_login.php">
      <label for="kulad">Kullanıcı adı</label>
      <input id="kulad" name="kulad" type="text" required autofocus>
      <label for="sifre">Şifre</label>
      <input id="sifre" name="sifre" type="password" required>
      <button type="submit">Giriş</button>
      <?php if (!empty($_SESSION['flash'])): ?>
        <div class="msg"><?= htmlspecialchars($_SESSION['flash']); unset($_SESSION['flash']); ?></div>
      <?php endif; ?>
    </form>
  </div>
</body>
</html>
