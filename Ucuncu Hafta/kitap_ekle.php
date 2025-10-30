<?php
require __DIR__ . '/auth.php'; require_role('admin');
require __DIR__ . '/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $ad    = trim($_POST['ad'] ?? '');
  $yazar = trim($_POST['yazar'] ?? '');
  $isbn  = trim($_POST['isbn'] ?? '');
  $adet  = (int)($_POST['adet'] ?? 1);

  if ($ad === '' || $yazar === '' || $adet < 1) {
    $err = "Ad, yazar ve adet zorunlu (adet ≥ 1).";
  } else {
    $stmt = $pdo->prepare("INSERT INTO kitaplar (ad, yazar, isbn, adet) VALUES (?,?,?,?)");
    $stmt->execute([$ad,$yazar,$isbn,$adet]);
    header('Location: kitaplar.php'); exit;
  }
}
?>
<!doctype html>
<html lang="tr">
<head><meta charset="utf-8"><title>Kitap Ekle</title></head>
<body style="font-family:system-ui;margin:24px">
  <h1>Kitap Ekle</h1>
  <?php if(!empty($err)) echo "<p style='color:#b91c1c'>$err</p>"; ?>
  <form method="post">
    <p>Ad: <input name="ad" required></p>
    <p>Yazar: <input name="yazar" required></p>
    <p>ISBN: <input name="isbn"></p>
    <p>Adet: <input name="adet" type="number" min="1" value="1" required></p>
    <p>
      <button type="submit">Kaydet</button>
      <a href="kitaplar.php">İptal</a>
    </p>
  </form>
</body>
</html>
