<?php
include "koneksi.php";

// Keamanan: Cek apakah levelnya admin
if (!isset($_SESSION['level']) || $_SESSION['level'] != "admin") {
    die("Akses Ilegal!");
}

if (isset($_POST['submit'])) {
    $nis    = $_POST['nis'];
    $nama   = $_POST['nama'];
    $kelas  = $_POST['kelas'];
    $ttl    = $_POST['thn'] . "-" . $_POST['bln'] . "-" . $_POST['tgl'];
    $alamat = $_POST['alamat'];
    $kota   = $_POST['kota'];
    $jk     = ($_POST['jk'] == "Laki-Laki") ? "L" : "P";
    $hobi   = isset($_POST['hobby']) ? implode(", ", $_POST['hobby']) : "";
    $ekskul = $_POST['ekskul'];

    $query = "UPDATE tb_siswa SET 
              nama='$nama', 
              kelas='$kelas', 
              ttl='$ttl', 
              alamat='$alamat', 
              kota='$kota', 
              jk='$jk', 
              hobi='$hobi', 
              ekskul='$ekskul' 
              WHERE nis='$nis'";
    
    $hasil = mysqli_query($koneksi, $query);

    if ($hasil) {
        echo "<script>alert('Data Berhasil Diupdate'); window.location='tampil.php';</script>";
    } else {
        echo "Gagal update data: " . mysqli_error($koneksi);
    }
}
?>