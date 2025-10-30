<?php
require __DIR__ . '/auth.php'; require_role('admin');
require __DIR__ . '/db.php';

$id = (int)($_GET['id'] ?? 0);
$stmt = $pdo->prepare("SELECT * FROM uyeler WHERE id=?");
$stmt->execute([$id]);
$u = $stmt->fetch(PDO::FETCH_ASSOC);
if (!$u) die("Üye bulunamadı.");

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $adsoyad = trim($_POST['adsoyad'] ?? '');
  $email   = trim($_POST['email'] ?? '');
  $telefon = trim($_POST['telefon'] ?? '');
  $durum   = $_POST['durum'] ?? 'aktif';

  if ($adsoyad==='' || $email==='') {
    $err = "Ad Soyad ve E-posta zorunlu.";
  } else {
    $up = $pdo->prepare("UPDATE uyeler SET adsoyad=?, email=?, telefon=?, durum=? WHERE id=?");
    try {
      $up->execute([$adsoyad,$email,$telefon,$durum,$id]);
      header('Location: uyeler.php'); exit;
    } catch(PDOException $e) {
      $err = "Hata: " . $e->getMessage();
    }
  }
}
?>
<!doctype html>
<html lang="tr">
<head><meta charset="utf-8"><title>Üye Düzenle</title></head>
<body style="font-family:system-ui;margin:24px">
  <h1>Üye Düzenle</h1>
  <?php if(!empty($err)) echo "<p style='color:#b91c1c'>$err</p>"; ?>
  <form method="post">
    <p>Ad Soyad: <input name="adsoyad" value="<?= htmlspecialchars($u['adsoyad']) ?>" required></p>
    <p>E-posta: <input type="email" name="email" value="<?= htmlspecialchars($u['email']) ?>" required></p>
    <p>Telefon: <input name="telefon" value="<?= htmlspecialchars($u['telefon']) ?>"></p>
    <p>Durum:
      <select name="durum">
        <?php foreach(['aktif','pasif','engelli'] as $d): ?>
          <option value="<?= $d ?>" <?= $d===$u['durum']?'selected':'' ?>><?= $d ?></option>
        <?php endforeach; ?>
      </select>
    </p>
    <p>
      <button type="submit">Güncelle</button>
      <a href="uyeler.php">Geri</a>
    </p>
  </form>
</body>
</html>
