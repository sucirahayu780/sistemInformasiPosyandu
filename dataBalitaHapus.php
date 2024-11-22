<?php
session_start();
if (!isset($_SESSION['data'])) {
    header("Location: login.php");
}

require 'functions.php';

if (!isset($_GET['id'])) {
    header("Location: dataBalita.php");
    exit();
}

$id = $_GET['id'];

$dataBalita = mysqli_query($conn, "SELECT * FROM dataBalita WHERE id='$id'");

// Cek apakah data ibu ada
if (mysqli_num_rows($dataBalita) == 0) {
    header("Location: dataBalita.php");
    exit();
}

mysqli_query($conn, "DELETE FROM dataBalita WHERE id='$id'");

echo "<script>alert('Berhasil menghapus data balita!'); window.location.href = 'dataBalita.php';</script>";
