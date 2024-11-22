<?php
session_start();
if (!isset($_SESSION['data'])) {
    header("Location: login.php");
}

require 'functions.php';


if (!isset($_GET['id'])) {
    header("Location: dataBalita.php");
}

$id = $_GET['id'];

$dataBalita = mysqli_query($conn, "SELECT * FROM dataBalita WHERE id='$id'");
$balita = mysqli_fetch_assoc($dataBalita);
$ibu_id = $balita['ibu_id'];
$dataIbu = mysqli_query($conn, "SELECT * FROM dataIbu WHERE id='$ibu_id'");
$dataIbu = mysqli_fetch_assoc($dataIbu);

if (isset($_POST['SUNTINGDATABALITA'])) {
    $result = suntingDataBalita($_POST);
    if ($result == 200) {
        echo "<script>alert('Berhasil menyunting data balita!'); window.location.href = 'dataBalita.php';</script>";
    } else {
        echo "<script>alert('Gagal menyunting data balita! Terjadi kesalahan.'); window.location.href = 'dataBalita.php';</script>";
    }
}


?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <title>Sistem Informasi Posyandu</title>
    <!-- Favicon -->
    <link rel="shortcut icon" href="./img/svg/logo.svg" type="image/x-icon" />
    <!-- Custom styles -->
    <link rel="stylesheet" href="css/style.min.css" />
</head>

<body>
    <!-- ! Body -->
    <div class="page-flex">
        <!-- ! Sidebar -->
        <aside class="sidebar">
            <div class="sidebar-start">

                <div class="sidebar-head">
                    <a href="" class="logo-wrapper" title="Home">
                        <span class="icon logo" aria-hidden="true"></span>
                        <div class="logo-text">
                            <span class="logo-title">Posyandu</span>
                        </div>
                    </a>

                    <button class="sidebar-toggle transparent-btn" title="Menu" type="button">
                        <span class="sr-only">Toggle menu</span>
                        <span class="icon menu-toggle" aria-hidden="true"></span>
                    </button>
                </div>

                <div class="sidebar-body">
                    <ul class="sidebar-body-menu">

                        <li>
                            <a href="index.php"><span class="icon home" aria-hidden="true"></span>Dashboard</a>
                        </li>

                        <li>
                            <a class="show-cat-btn active" href="##">
                                <span class="icon document" aria-hidden="true"></span>Master Data
                                <span class="category__btn transparent-btn" title="Open list">
                                    <span class="sr-only">Open list</span>
                                    <span class="icon arrow-down" aria-hidden="true"></span>
                                </span>
                            </a>
                            <ul class="cat-sub-menu">
                                <li>
                                    <a href="dataIbu.php">Data Ibu</a>
                                </li>
                                <li>
                                    <a href="dataBalita.php">Data Balita</a>
                                </li>
                                <li>
                                    <a href="dataJenisImunisasi.php">Data Jenis Imunisasi</a>
                                </li>
                                <?php
                                if ($_SESSION['data']['role'] == 1) {
                                ?>
                                    <li>
                                        <a href="dataPetugas.php">Data Petugas</a>
                                    </li>
                                <?php
                                }
                                ?>
                            </ul>
                        </li>

                        <li>
                            <a class="show-cat-btn" href="##">
                                <span class="icon category" aria-hidden="true"></span>Layanan
                                <span class="category__btn transparent-btn" title="Open list">
                                    <span class="sr-only">Open list</span>
                                    <span class="icon arrow-down" aria-hidden="true"></span>
                                </span>
                            </a>
                            <ul class="cat-sub-menu">
                                <li>
                                    <a href="penimbanganBalita.php">Penimbangan Balita</a>
                                </li>
                                <li>
                                    <a href="imunisasi.php">Imunisasi</a>
                                </li>
                            </ul>
                        </li>

                        <li>
                            <a class="show-cat-btn" href="##">
                                <span class="icon paper" aria-hidden="true"></span>Laporan
                                <span class="category__btn transparent-btn" title="Open list">
                                    <span class="sr-only">Open list</span>
                                    <span class="icon arrow-down" aria-hidden="true"></span>
                                </span>
                            </a>
                            <ul class="cat-sub-menu">
                                <li>
                                    <a href="laporanKehadiran.php">Laporan Kehadiran</a>
                                </li>
                                <li>
                                    <a href="laporanBalita.php">Laporan Balita</a>
                                </li>
                                <li>
                                    <a href="laporanStatusGizi.php">Laporan Status Gizi</a>
                                </li>
                                <li>
                                    <a href="laporanImunisasi.php">Laporan Imunisasi</a>
                                </li>
                            </ul>
                        </li>
                    </ul>
                </div>
            </div>
        </aside>

        <div class="main-wrapper">
            <!-- ! Main nav -->
            <nav class="main-nav--bg">
                <div class="container main-nav">
                    <div class="main-nav-start">
                        <h1>Sistem Informasi Posyandu</h1>
                    </div>
                    <div class="main-nav-end">
                        <button class="sidebar-toggle transparent-btn" title="Menu" type="button">
                            <span class="sr-only">Toggle menu</span>
                            <span class="icon menu-toggle--gray" aria-hidden="true"></span>
                        </button>

                        <button class="theme-switcher gray-circle-btn" type="button" title="Switch theme">
                            <span class="sr-only">Switch theme</span>
                            <i class="sun-icon" data-feather="sun" aria-hidden="true"></i>
                            <i class="moon-icon" data-feather="moon" aria-hidden="true"></i>
                        </button>

                        <div class="nav-user-wrapper">
                            <a class="danger" href="logout.php">
                                <i data-feather="log-out" aria-hidden="true"></i>
                            </a>
                        </div>
                    </div>
                </div>
            </nav>

            <!-- ! Main -->
            <main class="main users chart-page" id="skip-target">
                <div class="container">
                    <h2 class="main-title">Sunting Data Balita</h2>

                    <article class="sign-up">
                        <form class="sign-up-form form" action="" method="post">
                            <input type="hidden" name="id" value="<?= $balita['id'] ?>">
                            <label class="form-label-wrapper">
                                <p class="form-label">Nama</p>
                                <input class="form-input" type="text" name="nama" value=<?= $balita['nama'] ?> autocomplete="off" required>
                            </label>
                            <label class="form-label-wrapper">
                                <p class="form-label">Tempat Lahir</p>
                                <input class="form-input" type="text" name="tempat_lahir" value=<?= $balita['tempat_lahir'] ?> autocomplete="off" required>
                            </label>
                            <label class="form-label-wrapper">
                                <p class="form-label">Tanggal Lahir</p>
                                <input class="form-input" type="date" name="tanggal_lahir" value=<?= $balita['tanggal_lahir'] ?> required>
                            </label>
                            <label class="form-label-wrapper">
                                <p class="form-label">Jenis Kelamin</p>
                                <select name="jenis_kelamin" class="form-input" required>
                                    <option <?php if ($balita['jenis_kelamin'] === "Laki-laki") {
                                                echo 'selected';
                                            } ?> value="Laki-laki">Laki-laki</option>
                                    <option <?php if ($balita['jenis_kelamin'] === "Perempuan") {
                                                echo 'selected';
                                            } ?> value="Perempuan">Perempuan</option>
                                </select>
                            </label>
                            <label class="form-label-wrapper">
                                <p class="form-label">Nama Ibu</p>
                                <select name="ibu_id" class="form-input" required>
                                    <option value="<?= $balita['ibu_id'] ?>"><?= $dataIbu['nik'] ?> - <?= $dataIbu['nama'] ?></option>
                                </select>
                            </label>

                            <br>
                            <button type="submit" name="SUNTINGDATABALITA" class="form-btn primary-default-btn transparent-btn">Sunting Data Balita</button>
                        </form>
                    </article>
                </div>
            </main>

            <!-- ! Footer -->
            <footer class="footer">
                <div class="container footer--flex">
                    <div class="footer-start">
                        <p>
                            2024 © Sistem Informasi Posyandu
                        </p>
                    </div>
                </div>
            </footer>
        </div>
    </div>
    <!-- Chart library -->
    <script src="plugins/chart.min.js"></script>
    <!-- Icons library -->
    <script src="plugins/feather.min.js"></script>
    <!-- Custom scripts -->
    <script src="js/script.js"></script>
</body>

</html>