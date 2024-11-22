<?php
session_start();
if (!isset($_SESSION['data'])) {
    header("Location: login.php");
}

require 'functions.php';

if (!isset($_GET['id'])) {
    header("Location: dataJenisImunisasi.php");
    exit();
}

$id = $_GET['id'];

$dataImunisasi = mysqli_query($conn, "SELECT * FROM dataImunisasi WHERE id='$id'");

// Cek apakah data ibu ada
if (mysqli_num_rows($dataImunisasi) == 0) {
    header("Location: dataJenisImunisasi.php");
    exit();
}

mysqli_query($conn, "DELETE FROM dataImunisasi WHERE id='$id'");

echo "<script>alert('Berhasil menghapus data jenis imunisasi!'); window.location.href = 'dataJenisImunisasi.php';</script>";
