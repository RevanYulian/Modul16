<?php
include "koneksi.php";

// Proteksi: Jika belum login, lempar ke login.php
if (!isset($_SESSION['username'])) {
    header("Location: login.php");
    exit;
}

$query = "SELECT * FROM tb_siswa";
$hasil = mysqli_query($koneksi, $query);
$jum = mysqli_num_rows($hasil);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Daftar Peserta Ekskul</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="container mt-4">
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2>Data Pendaftaran Ekstrakurikuler</h2>
        <div>
            <span class="badge bg-primary">Halo, <?php echo $_SESSION['username']; ?> (<?php echo $_SESSION['level']; ?>)</span>
            <a href="logout.php" class="btn btn-danger btn-sm">Logout</a>
        </div>
    </div>

    <?php if ($_SESSION['level'] == 'admin') : ?>
        <a href="insert.php" class="btn btn-success mb-3">+ Tambah Siswa Baru</a>
    <?php endif; ?>

    <table class="table table-bordered table-striped">
        <thead class="table-dark">
            <tr>
                <th>No</th>
                <th>NIS</th>
                <th>Nama</th>
                <th>Kelas</th>
                <th>Ekskul</th>
                <th>Aksi</th>
            </tr>
        </thead>
        <tbody>
            <?php 
            $no = 1;
            while ($data = mysqli_fetch_array($hasil)) { 
            ?>
            <tr>
                <td><?php echo $no++; ?></td>
                <td><?php echo $data['nis']; ?></td>
                <td><?php echo $data['nama']; ?></td>
                <td><?php echo $data['kelas']; ?></td>
                <td><?php echo $data['ekskul']; ?></td>
                <td>
                    <a href="detail.php?nis=<?php echo $data['nis']; ?>" class="btn btn-info btn-sm text-white">Detail</a>
                    
                    <?php if ($_SESSION['level'] == 'admin') : ?>
                        | <a href="form_update.php?nis=<?php echo $data['nis']; ?>" class="btn btn-warning btn-sm">Edit</a>
                        | <a href="delete.php?nis=<?php echo $data['nis']; ?>" class="btn btn-danger btn-sm" onclick="return confirm('Yakin ingin menghapus?')">Delete</a>
                    <?php endif; ?>
                </td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
    <p>Total Data: <b><?php echo $jum; ?></b></p>
</body>
</html>