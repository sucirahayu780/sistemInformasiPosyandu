<?php
session_start();
if (!isset($_SESSION['data'])) {
    header("Location: login.php");
}

require 'functions.php';

if (!isset($_GET['id'])) {
    header("Location: penimbanganBalita.php");
    exit();
}

$id = $_GET['id'];

$dataPenimbanganBalita = mysqli_query($conn, "SELECT * FROM dataPenimbanganBalita WHERE id='$id'");

// Cek apakah data ibu ada
if (mysqli_num_rows($dataPenimbanganBalita) == 0) {
    header("Location: penimbanganBalita.php");
    exit();
}

mysqli_query($conn, "DELETE FROM dataPenimbanganBalita WHERE id='$id'");

echo "<script>alert('Berhasil menghapus data penimbangan balita!'); window.location.href = 'penimbanganBalita.php';</script>";
