<?php
require __DIR__ . '/auth.php'; require_role('admin');
require __DIR__ . '/db.php';

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $adsoyad = trim($_POST['adsoyad'] ?? '');
  $email   = trim($_POST['email'] ?? '');
  $telefon = trim($_POST['telefon'] ?? '');
  $durum   = $_POST['durum'] ?? 'aktif';

  if ($adsoyad==='' || $email==='') {
    $err = "Ad Soyad ve E-posta zorunlu.";
  } else {
    $stmt = $pdo->prepare("INSERT INTO uyeler (adsoyad,email,telefon,durum) VALUES (?,?,?,?)");
    try {
      $stmt->execute([$adsoyad,$email,$telefon,$durum]);
      header('Location: uyeler.php'); exit;
    } catch(PDOException $e) {
      $err = "Hata: " . $e->getMessage();
    }
  }
}
?>
<!doctype html>
<html lang="tr">
<head><meta charset="utf-8"><title>Üye Ekle</title></head>
<body style="font-family:system-ui;margin:24px">
  <h1>Üye Ekle</h1>
  <?php if(!empty($err)) echo "<p style='color:#b91c1c'>$err</p>"; ?>
  <form method="post">
    <p>Ad Soyad: <input name="adsoyad" required></p>
    <p>E-posta: <input type="email" name="email" required></p>
    <p>Telefon: <input name="telefon"></p>
    <p>Durum:
      <select name="durum">
        <option value="aktif">aktif</option>
        <option value="pasif">pasif</option>
        <option value="engelli">engelli</option>
      </select>
    </p>
    <p>
      <button type="submit">Kaydet</button>
      <a href="uyeler.php">İptal</a>
    </p>
  </form>
</body>
</html>
