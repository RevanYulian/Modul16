<?php
include "koneksi.php";

// PROTEKSI: Cek apakah sudah login dan levelnya admin
if (!isset($_SESSION['username']) || $_SESSION['level'] != "admin") {
    echo "<script>alert('Akses Ditolak! Hanya Admin yang boleh menambah data.'); window.location='tampil.php';</script>";
    exit;
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

    $query = "INSERT INTO tb_siswa (nis, nama, kelas, ttl, alamat, kota, jk, hobi, ekskul) 
              VALUES ('$nis', '$nama', '$kelas', '$ttl', '$alamat', '$kota', '$jk', '$hobi', '$ekskul')";
    
    $hasil = mysqli_query($koneksi, $query);

    if ($hasil) {
        echo "<script>alert('Data Berhasil Disimpan'); window.location='tampil.php';</script>";
    } else {
        echo "Gagal menyimpan: " . mysqli_error($koneksi);
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Pendaftaran Ekstrakurikuler</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <style>
        .container { border: 1px solid black; padding: 20px; width: 550px; margin: 20px auto; font-family: sans-serif; }
        .title { color: #8A2BE2; text-align: center; font-weight: bold; font-size: 1.2em; margin-bottom: 10px; }
        .required { color: red; }
    </style>
</head>
<body>
    <div class="container">
        <div class="title">PENDAFTARAN PESERTA EKSTRAKURIKULER</div>
        <hr>
        <form action="" method="post">
            <table>
                <tr>
                    <td>NIS <span class="required">*</span></td>
                    <td>: <input type="text" name="nis" required></td>
                </tr>
                <tr>
                    <td>Nama Siswa <span class="required">*</span></td>
                    <td>: <input type="text" name="nama" size="40" required></td>
                </tr>
                <tr>
                    <td>Kelas</td>
                    <td>: 
                        <input type="radio" name="kelas" value="X"> X 
                        <input type="radio" name="kelas" value="XI"> XI 
                        <input type="radio" name="kelas" value="XII"> XII
                    </td>
                </tr>
                <tr>
                    <td>Tgl Lahir</td>
                    <td>: 
                        <select name="tgl">
                            <?php for($i=1; $i<=31; $i++) echo "<option value='$i'>$i</option>"; ?>
                        </select>
                        <select name="bln">
                            <?php 
                            $bulan = [1=>"Januari", "Februari", "Maret", "April", "Mei", "Juni", "Juli", "Agustus", "September", "Oktober", "November", "Desember"];
                            foreach($bulan as $k => $v) echo "<option value='$k'>$v</option>";
                            ?>
                        </select>
                        <input type="text" name="thn" size="4" placeholder="YYYY">
                    </td>
                </tr>
                <tr>
                    <td valign="top">Alamat</td>
                    <td>: <textarea name="alamat" rows="3" cols="30"></textarea></td>
                </tr>
                <tr>
                    <td>Kota</td>
                    <td>: <input type="text" name="kota"></td>
                </tr>
                <tr>
                    <td>Jenis Kelamin</td>
                    <td>: 
                        <select name="jk">
                            <option value="Laki-Laki">Laki-Laki</option>
                            <option value="Perempuan">Perempuan</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td valign="top">Hobby</td>
                    <td>: 
                        <input type="checkbox" name="hobby[]" value="Membaca"> Membaca <br>
                        <input type="checkbox" name="hobby[]" value="Menyanyi"> Menyanyi <br>
                        <input type="checkbox" name="hobby[]" value="Menari"> Menari <br>
                        <input type="checkbox" name="hobby[]" value="Traveling"> Traveling
                    </td>
                </tr>
                <tr>
                    <td valign="top">Pilihan Ekskul</td>
                    <td>: 
                        <select name="ekskul" size="5">
                            <option value="Pramuka">Pramuka</option>
                            <option value="Basket">Basket</option>
                            <option value="Volly">Volly</option>
                            <option value="Band">Band</option>
                            <option value="Robotic">Robotic</option>
                        </select>
                    </td>
                </tr>
                <tr>
                    <td></td>
                    <td>
                        <input type="submit" name="submit" value="Kirim" class="btn btn-primary btn-sm"> 
                        <a href="tampil.php" class="btn btn-secondary btn-sm">Batal</a>
                    </td>
                </tr>
            </table>
        </form>
    </div>
</body>
</html>