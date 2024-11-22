<?php
session_start();
if (!isset($_SESSION['data'])) {
    header("Location: login.php");
}

require 'functions.php';

if (!isset($_GET['id'])) {
    header("Location: imunisasi.php");
    exit();
}

$id = $_GET['id'];

$dataImunisasi = mysqli_query($conn, "SELECT * FROM imunisasi WHERE id='$id'");

if (mysqli_num_rows($dataImunisasi) == 0) {
    header("Location: imunisasi.php");
    exit();
}

mysqli_query($conn, "DELETE FROM imunisasi WHERE id='$id'");

echo "<script>alert('Berhasil menghapus data imunisasi!'); window.location.href = 'imunisasi.php';</script>";
