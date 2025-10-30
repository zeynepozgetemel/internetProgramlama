<?php
require __DIR__ . '/auth.php'; require_role('admin');
require __DIR__ . '/db.php';

$id = (int)($_GET['id'] ?? 0);
$stmt = $pdo->prepare("SELECT * FROM kitaplar WHERE id=?");
$stmt->execute([$id]);
$k = $stmt->fetch(PDO::FETCH_ASSOC);
if (!$k) { die("Kitap bulunamadı."); }

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $ad    = trim($_POST['ad'] ?? '');
  $yazar = trim($_POST['yazar'] ?? '');
  $isbn  = trim($_POST['isbn'] ?? '');
  $adet  = (int)($_POST['adet'] ?? 1);

  if ($ad === '' || $yazar === '' || $adet < 1) {
    $err = "Ad, yazar ve adet zorunlu (adet ≥ 1).";
  } else {
    $up = $pdo->prepare("UPDATE kitaplar SET ad=?, yazar=?, isbn=?, adet=? WHERE id=?");
    $up->execute([$ad,$yazar,$isbn,$adet,$id]);
    header('Location: kitaplar.php'); exit;
  }
}
?>
<!doctype html>
<html lang="tr">
<head><meta charset="utf-8"><title>Kitap Düzenle</title></head>
<body style="font-family:system-ui;margin:24px">
  <h1>Kitap Düzenle</h1>
  <?php if(!empty($err)) echo "<p style='color:#b91c1c'>$err</p>"; ?>
  <form method="post">
    <p>Ad: <input name="ad" value="<?= htmlspecialchars($k['ad']) ?>" required></p>
    <p>Yazar: <input name="yazar" value="<?= htmlspecialchars($k['yazar']) ?>" required></p>
    <p>ISBN: <input name="isbn" value="<?= htmlspecialchars($k['isbn']) ?>"></p>
    <p>Adet: <input name="adet" type="number" min="1" value="<?= (int)$k['adet'] ?>" required></p>
    <p>
      <button type="submit">Güncelle</button>
      <a href="kitaplar.php">Geri</a>
    </p>
  </form>
</body>
</html>
