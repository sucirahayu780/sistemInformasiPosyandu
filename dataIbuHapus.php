<?php
session_start();
if (!isset($_SESSION['data'])) {
    header("Location: login.php");
}

require 'functions.php';

if (!isset($_GET['id'])) {
    header("Location: dataIbu.php");
    exit();
}

$id = $_GET['id'];

$dataIbu = mysqli_query($conn, "SELECT * FROM dataIbu WHERE id='$id'");

// Cek apakah data ibu ada
if (mysqli_num_rows($dataIbu) == 0) {
    header("Location: dataIbu.php");
    exit();
}

mysqli_query($conn, "DELETE FROM dataIbu WHERE id='$id'");

echo "<script>alert('Berhasil menghapus data ibu!'); window.location.href = 'dataIbu.php';</script>";
