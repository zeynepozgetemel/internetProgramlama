<?php
require __DIR__ . '/auth.php';
require_role('uye');
$u = $_SESSION['user'];
?>
<!doctype html>
<html lang="tr">
<head><meta charset="utf-8"><title>Üye</title></head>
<body style="font-family:system-ui">
  <p>Hoş geldin, <b><?= htmlspecialchars($u['kulad']) ?></b> (Üye)</p>
  <p><a href="logout.php">Çıkış</a></p>
</body>
</html>
