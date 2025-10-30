<?php
// admin.php
require __DIR__ . '/auth.php';
require_role('admin'); // sadece admin girsin
$u = $_SESSION['user']; // ['kulad','rol',...]
?>
<!doctype html>
<html lang="tr">
<head>
  <meta charset="utf-8">
  <title>Admin Panel</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <style>
    :root{
      --bg:#0f172a; --card:#111827; --muted:#94a3b8; --bord:#1f2937; --btn:#111827;
      --link:#93c5fd; --text:#e2e8f0; --accent:#22c55e; --danger:#ef4444;
    }
    *{box-sizing:border-box}
    body{margin:0; font-family:system-ui,-apple-system,Segoe UI,Roboto,Arial;
         background:var(--bg); color:var(--text)}
    .wrap{max-width:1080px; margin:32px auto; padding:0 16px}
    .top{display:flex; gap:16px; align-items:center; justify-content:space-between; margin-bottom:24px}
    .hi{font-size:18px}
    .actions a{display:inline-block; text-decoration:none; background:var(--danger); color:#fff; padding:10px 14px; border-radius:10px}
    .grid{display:grid; grid-template-columns:repeat(auto-fill,minmax(260px,1fr)); gap:16px}
    .card{background:var(--card); border:1px solid var(--bord); border-radius:14px; padding:18px}
    .card h2{margin:0 0 8px; font-size:18px}
    .card p{margin:0 0 12px; color:var(--muted); font-size:14px; line-height:1.4}
    .links a{display:inline-block; text-decoration:none; padding:10px 12px; border-radius:10px; background:#1f2937; color:#fff; margin-right:8px}
    .foot{margin-top:28px; color:var(--muted); font-size:12px}
    a.inline{color:var(--link)}
  </style>
</head>
<body>
  <div class="wrap">
    <div class="top">
      <div class="hi">Hoş geldin, <b><?= htmlspecialchars($u['kulad']) ?></b> — <span style="color:var(--accent)">Admin</span></div>
      <div class="actions">
        <a href="logout.php">Çıkış</a>
      </div>
    </div>

    <div class="grid">
      <div class="card">
        <h2>📚 Kitaplar</h2>
        <p>Kitap ekle, düzenle, sil; stok adetlerini yönet.</p>
        <div class="links">
          <a href="kitaplar.php">Listeyi Aç</a>
          <a href="kitap_ekle.php">Yeni Kitap</a>
        </div>
      </div>

      <div class="card">
        <h2>👥 Üyeler</h2>
        <p>Üye ekle/sil/güncelle; durum: <i>aktif • pasif • engelli</i>.</p>
        <div class="links">
          <a href="uyeler.php">Listeyi Aç</a>
          <a href="uye_ekle.php">Yeni Üye</a>
        </div>
      </div>

      <div class="card">
        <h2>⚙️ Sistem</h2>
        <p>Bu alanı loglar, raporlar veya yedekleme işlemleri için kullanabilirsin.</p>
        <div class="links">
          <a href="admin.php">Yenile</a>
          <a class="inline" href="login.php">Giriş sayfası</a>
        </div>
      </div>
    </div>

    <div class="foot">
      <p>Not: Bu panel sayfalarına yalnızca <b>admin</b> rolü erişebilir. Yetkisiz girişler <code>require_role('admin')</code> ile engellenir.</p>
    </div>
  </div>
</body>
</html>
