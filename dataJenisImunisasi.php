<?php
session_start();
if (!isset($_SESSION['data'])) {
    header("Location: login.php");
}

require 'functions.php';

$dataImunisasi = mysqli_query($conn, "SELECT * FROM dataImunisasi");

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
    <!-- DataTables CSS -->
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.11.5/css/jquery.dataTables.min.css">
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/2.0.0/css/buttons.dataTables.min.css">
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
                    <h2 class="main-title">Data Jenis Imunisasi</h2>
                    <a href="dataJenisImunisasiTambah.php" class="primary-default-btn">Tambah Data Imunisasi</a>
                    <br><br>
                    <div class="users-table table-wrapper">
                        <table id="dataJenisImunisasi" class="posts-table">
                            <thead>
                                <tr class="users-table-info">
                                    <th>Nama Imunisasi</th>
                                    <th>Keterangan</th>
                                    <th>Menu</th>
                                </tr>
                            </thead>
                            <tbody>
                                <?php
                                foreach ($dataImunisasi as $imunisasi) {
                                ?>
                                    <tr>
                                        <td><?= $imunisasi['nama'] ?></td>
                                        <td><?= $imunisasi['keterangan'] ?></td>
                                        <td>
                                            <a href="dataJenisImunisasiEdit.php?id=<?= $imunisasi['id'] ?>" class="primary-default-btn">Sunting</a>
                                            <br>
                                            <a href="dataJenisImunisasiHapus.php?id=<?= $imunisasi['id'] ?>" onclick="return confirm('Konfirmasi hapus data?')" class="primary-default-btn" style="background-color: red;">Hapus</a>
                                        </td>
                                    </tr>
                                <?php
                                }
                                ?>
                            </tbody>
                        </table>
                    </div>
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
    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- DataTables JS -->
    <script src="https://cdn.datatables.net/1.11.5/js/jquery.dataTables.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.0.0/js/dataTables.buttons.min.js"></script>
    <script src="https://cdn.datatables.net/buttons/2.0.0/js/buttons.html5.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.70/pdfmake.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.70/vfs_fonts.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>

    <script>
        $(document).ready(function() {
            $('#dataJenisImunisasi').DataTable({
                "pageLength": 10, // Menampilkan 10 data per halaman
                dom: 'Bfrtip',
                buttons: [
                    'pdfHtml5',
                    'excelHtml5'
                ]
            });
        });
    </script>


    <!-- Chart library -->
    <script src="plugins/chart.min.js"></script>
    <!-- Icons library -->
    <script src="plugins/feather.min.js"></script>
    <!-- Custom scripts -->
    <script src="js/script.js"></script>
</body>

</html>