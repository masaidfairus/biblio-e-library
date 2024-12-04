<?php
session_start();
session_destroy(); // Hapus semua sesi
session_abort();
header('Location: login.php'); // Redirect ke halaman login
exit();
?>
