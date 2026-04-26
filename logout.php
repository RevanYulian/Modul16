<?php
session_start();
// hapus semua data session
session_unset();
// hancurkan session
session_destroy();
// keterangn setelah logout
echo "Anda Sudah Logout <br>";
echo "<a href='login.php'>Login Kembali</a>";

// Langsung redirect ke halaman login
//header("Location: login.php");
exit();
?>