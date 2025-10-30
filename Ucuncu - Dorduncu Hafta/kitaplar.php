<?php
require __DIR__ . '/auth.php';
require_role('admin');
require __DIR__ . '/db.php';

$stmt = $pdo->query("SELECT * FROM kitaplar ORDER BY id DESC");
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
?>
<!doctype html>
<html lang="tr">
<head>
<meta charset="utf-8"><title>Kitaplar</title>
<style>
  body{font-family:system-ui;margin:24px}
  table{border-collapse:collapse;width:100%}
  th,td{border:1px solid #e5e7eb;padding:8px}
  .top{display:flex;justify-content:space-between;align-items:center;margin-bottom:12px}
  a.btn{background:#111827;color:#fff;padding:8px 10px;border-radius:8px;text-decoration:none}
</style>
</head>
<body>
  <div class="top">
    <h1>Kitaplar</h1>
    <div>
      <a class="btn" href="kitap_ekle.php">+ Kitap Ekle</a>
      <a class="btn" href="admin.php">⟵ Admin</a>
    </div>
  </div>
  <table>
    <thead><tr>
      <th>ID</th><th>Ad</th><th>Yazar</th><th>ISBN</th><th>Adet</th><th>İşlemler</th>
    </tr></thead>
    <tbody>
    <?php foreach($rows as $r): ?>
      <tr>
        <td><?= $r['id'] ?></td>
        <td><?= htmlspecialchars($r['ad']) ?></td>
        <td><?= htmlspecialchars($r['yazar']) ?></td>
        <td><?= htmlspecialchars($r['isbn']) ?></td>
        <td><?= (int)$r['adet'] ?></td>
        <td>
          <a href="kitap_duzenle.php?id=<?= $r['id'] ?>">Düzenle</a> |
          <a href="kitap_sil.php?id=<?= $r['id'] ?>" onclick="return confirm('Silinsin mi?')">Sil</a>
        </td>
      </tr>
    <?php endforeach; ?>
    </tbody>
  </table>
</body>
</html>
