<?php
include "koneksi.php";

if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

$nis = $_GET['nis'];
$query = "SELECT * FROM tb_siswa WHERE nis = '$nis'";
$hasil = mysqli_query($koneksi, $query);
$data = mysqli_fetch_array($hasil);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Detail Siswa</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-5">
    <div class="card mx-auto" style="max-width: 600px;">
        <div class="card-header bg-info text-white"><h4>Detail Informasi Siswa</h4></div>
        <div class="card-body">
            <table class="table table-bordered">
                <tr><th width="30%">NIS</th><td><?php echo $data['nis'];?></td></tr>
                <tr><th>Nama</th><td><?php echo $data['nama']; ?></td></tr>
                <tr><th>Kelas</th><td><?php echo $data['kelas']; ?></td></tr>
                <tr><th>Tgl Lahir</th><td><?php echo $data['ttl']; ?></td></tr>
                <tr><th>Alamat</th><td><?php echo $data['alamat']; ?></td></tr>
                <tr><th>Kota</th><td><?php echo $data['kota']; ?></td></tr>
                <tr><th>Gender</th><td><?php echo ($data['jk'] == 'L') ? 'Laki-laki' : 'Perempuan'; ?></td></tr>
                <tr><th>Hobby</th><td><?php echo $data['hobi']; ?></td></tr>
                <tr><th>Ekskul</th><td><?php echo $data['ekskul']; ?></td></tr>
            </table>
            <a href="tampil.php" class="btn btn-secondary">Kembali</a>
        </div>
    </div>
</body>
</html>