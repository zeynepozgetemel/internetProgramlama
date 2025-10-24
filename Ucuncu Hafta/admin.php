<?php
require __DIR__ . '/auth.php';
require_role('admin');
$u = $_SESSION['user'];
?>
<!doctype html>
<html lang="tr">
<head><meta charset="utf-8"><title>Admin</title></head>
<body style="font-family:system-ui">
  <p>Hoş geldin, <b><?= htmlspecialchars($u['kulad']) ?></b> (Admin)</p>
  <p><a href="logout.php">Çıkış</a></p>
</body>
</html>
