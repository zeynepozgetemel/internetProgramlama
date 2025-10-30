<?php
require __DIR__ . '/auth.php'; require_role('admin');
require __DIR__ . '/db.php';

$stmt = $pdo->query("SELECT * FROM uyeler ORDER BY id DESC");
$rows = $stmt->fetchAll(PDO::FETCH_ASSOC);
$durumRenk = ['aktif'=>'#16a34a','pasif'=>'#f59e0b','engelli'=>'#dc2626'];
?>
<!doctype html>
<html lang="tr">
<head>
<meta charset="utf-8"><title>Üyeler</title>
<style>
  body{font-family:system-ui;margin:24px}
  table{border-collapse:collapse;width:100%}
  th,td{border:1px solid #e5e7eb;padding:8px}
  .top{display:flex;justify-content:space-between;align-items:center;margin-bottom:12px}
  a.btn{background:#111827;color:#fff;padding:8px 10px;border-radius:8px;text-decoration:none}
  .badge{padding:4px 8px;border-radius:999px;color:#fff;font-size:12px}
  form.inline{display:inline}
  select{padding:2px 6px}
</style>
</head>
<body>
  <div class="top">
    <h1>Üyeler</h1>
    <div>
      <a class="btn" href="uye_ekle.php">+ Üye Ekle</a>
      <a class="btn" href="admin.php">⟵ Admin</a>
    </div>
  </div>
  <table>
    <thead><tr>
      <th>ID</th><th>Ad Soyad</th><th>E-posta</th><th>Telefon</th><th>Durum</th><th>İşlemler</th>
    </tr></thead>
    <tbody>
    <?php foreach($rows as $r): ?>
      <tr>
        <td><?= $r['id'] ?></td>
        <td><?= htmlspecialchars($r['adsoyad']) ?></td>
        <td><?= htmlspecialchars($r['email']) ?></td>
        <td><?= htmlspecialchars($r['telefon']) ?></td>
        <td>
          <span class="badge" style="background:<?= $durumRenk[$r['durum']] ?? '#6b7280' ?>">
            <?= $r['durum'] ?>
          </span>
          <!-- Hızlı durum değiştir -->
          <form class="inline" method="post" action="uye_durum.php" style="margin-left:6px">
            <input type="hidden" name="id" value="<?= $r['id'] ?>">
            <select name="durum" onchange="this.form.submit()">
              <?php foreach(['aktif','pasif','engelli'] as $d): ?>
                <option value="<?= $d ?>" <?= $d===$r['durum']?'selected':'' ?>><?= $d ?></option>
              <?php endforeach; ?>
            </select>
          </form>
        </td>
        <td>
          <a href="uye_duzenle.php?id=<?= $r['id'] ?>">Düzenle</a> |
          <a href="uye_sil.php?id=<?= $r['id'] ?>" onclick="return confirm('Üye silinsin mi?')">Sil</a>
        </td>
      </tr>
    <?php endforeach; ?>
    </tbody>
  </table>
</body>
</html>
