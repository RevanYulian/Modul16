<?php
include "koneksi.php";

// PROTEKSI: Cek apakah sudah login dan levelnya admin
if (!isset($_SESSION['username']) || $_SESSION['level'] != "admin") {
    echo "<script>alert('Akses Ditolak! Anda tidak memiliki izin untuk menghapus data.'); window.location='tampil.php';</script>";
    exit;
}

if (isset($_GET['nis'])) {
    $nis = $_GET['nis'];
    $query = "DELETE FROM tb_siswa WHERE nis = '$nis'";
    $hasil = mysqli_query($koneksi, $query);

    if ($hasil) {
        echo "<script>alert('Data Berhasil Dihapus'); window.location='tampil.php';</script>";
    } else {
        echo "Gagal hapus data: " . mysqli_error($koneksi);
    }
} else {
    header("Location: tampil.php");
}
?>