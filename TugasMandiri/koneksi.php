<?php
$host = "localhost";
$username = "root";
$password = "";
$database = "db_biodata"; // GANTI KE NAMA DB YANG ADA DI PHPMYADMIN ANDA

$koneksi = mysqli_connect($host, $username, $password, $database);

if (!$koneksi) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

if (session_status() === PHP_SESSION_NONE) {
    session_start();
}
?>