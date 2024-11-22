<?php
session_start();
if (!isset($_SESSION['data'])) {
    header("Location: login.php");
}

require 'functions.php';

$dataBalita = mysqli_query($conn, "SELECT * FROM dataBalita");


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
                            <a class="show-cat-btn" href="##">
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
                            <a class="show-cat-btn active" href="##">
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
                    <h2 class="main-title">Laporan Balita</h2>
                    <article class="sign-up">
                        <?php
                        if (isset($_POST['PROSESDATA'])) {
                            $balita_id = $_POST['balita_id'];
                            $dataBalita = mysqli_query($conn, "SELECT * FROM dataBalita WHERE id='$balita_id'");
                            $dataBalita = mysqli_fetch_assoc($dataBalita);

                            $ibu_id = $dataBalita['ibu_id'];
                            $dataIbu = mysqli_query($conn, "SELECT * FROM dataIbu WHERE id='$ibu_id'");
                            $dataIbu = mysqli_fetch_assoc($dataIbu);

                            $dataKesehatan = mysqli_query($conn, "SELECT pb.id AS penimbangan_id, 
                                    pb.tanggal AS tanggal_penimbangan, 
                                    pb.balita_id, 
                                    pb.ibu_id, 
                                    pb.tanggal_lahir AS tanggal_lahir_penimbangan, 
                                    pb.berat_badan, 
                                    pb.tinggi_badan, 
                                    pb.lingkar_kepala, 
                                    pb.deteksi_tbu, 
                                    pb.keterangan AS keterangan_penimbangan,
                                    im.id AS imunisasi_id,
                                    im.tanggal AS tanggal_imunisasi,
                                    im.tanggal_lahir AS tanggal_lahir_imunisasi,
                                    im.vitamin_a,
                                    im.keterangan AS keterangan_imunisasi
                                FROM 
                                    dataPenimbanganBalita pb
                                LEFT JOIN 
                                    imunisasi im ON pb.balita_id = im.balita_id AND pb.tanggal = im.tanggal
                                ORDER BY 
                                    pb.tanggal, pb.balita_id
                            ");
                        ?>
                            <button onclick="generatePDF()" class="primary-default-btn transparent-btn">Pdf</button>
                            <br><br>
                            <div id="printableArea">
                                <div class="sign-up-form form">
                                    <center>
                                        <h1>LAPORAN BALITA Sistem Informasi Posyandu</h1>
                                    </center>
                                    <br><br><br><br>
                                    <table>
                                        <tr>
                                            <th>
                                                Nama Balita
                                            </th>
                                            <th> : </th>
                                            <th><?= $dataBalita['nama'] ?></th>
                                        </tr>
                                        <tr>
                                            <th>
                                                Jenis Kelamin
                                            </th>
                                            <th> : </th>
                                            <th><?= $dataBalita['jenis_kelamin'] ?></th>
                                        </tr>
                                        <tr>
                                            <th>
                                                Tanggal Lahir
                                            </th>
                                            <th> : </th>
                                            <th><?= $dataBalita['tempat_lahir'] ?>, <?= date('d-F-Y', strtotime($dataBalita['tanggal_lahir'])) ?></th>
                                        </tr>
                                        <tr>
                                            <th>
                                                Usia
                                            </th>
                                            <th> : </th>
                                            <th><?= hitungUmur($dataBalita['tanggal_lahir']) ?></th>
                                        </tr>
                                        <tr>
                                            <th>
                                                Nama Ibu
                                            </th>
                                            <th> : </th>
                                            <th><?= $dataIbu['nama'] ?></th>
                                        </tr>
                                        <tr>
                                            <th>
                                                Nama Ayah
                                            </th>
                                            <th> : </th>
                                            <th><?= $dataIbu['suami'] ?></th>
                                        </tr>
                                    </table>
                                    <br><br>
                                    <div class="users-table table-wrapper">
                                        <table class="posts-table">
                                            <tr>
                                                <th>Tanggal Periksa</th>
                                                <th>Detail</th>
                                                <th>Deteksi</th>
                                                <th>Keterangan</th>
                                                <th>Imunisasi</th>
                                                <th>Vitamin A</th>
                                            </tr>
                                            <?php
                                            foreach ($dataKesehatan as $kesehatan) {
                                                $imunisasi_id = $kesehatan['imunisasi_id'];
                                                $dataImunisasi = mysqli_query($conn, "SELECT * FROM dataImunisasi WHERE id='$imunisasi_id'");
                                                $dataImunisasi = mysqli_fetch_assoc($dataImunisasi);
                                            ?>
                                                <tr>
                                                    <td><?= date('d-F-Y', strtotime($kesehatan['tanggal_penimbangan'])) ?></td>
                                                    <td>
                                                        Berat badan : <?= $kesehatan['berat_badan'] ?><br>
                                                        Tinggi badan : <?= $kesehatan['tinggi_badan'] ?><br>
                                                        Lingkar kepala : <?= $kesehatan['lingkar_kepala'] ?>
                                                    </td>
                                                    <td><?= $kesehatan['deteksi_tbu'] ?></td>
                                                    <td><?= $kesehatan['keterangan_penimbangan'] ?></td>
                                                    <td><?= $dataImunisasi['nama'] ?></td>
                                                    <td><?= $kesehatan['vitamin_a'] ?></td>
                                                </tr>
                                            <?php } ?>
                                        </table>
                                    </div>
                                </div>
                            </div>
                        <?php
                        } else {
                        ?>
                            <form class="sign-up-form form" action="" method="post">
                                <label class="form-label-wrapper">
                                    <p class="form-label">Nama Balita - Nama Ibu - NIK Ibu</p>
                                    <select name="balita_id" class="form-input" required>
                                        <?php
                                        foreach ($dataBalita as $balita) {
                                            $ibu_id = $balita['ibu_id'];
                                            $dataIbu = mysqli_query($conn, "SELECT * FROM dataIbu WHERE id='$ibu_id'");
                                            $dataIbu = mysqli_fetch_assoc($dataIbu);
                                        ?>
                                            <option value="<?= $balita['id'] ?>"><?= $balita['nama'] ?> - <?= $dataIbu['nama'] ?> - <?= $dataIbu['nik'] ?></option>
                                        <?php } ?>
                                    </select>
                                </label>
                                <br>
                                <button type="submit" name="PROSESDATA" class="form-btn primary-default-btn transparent-btn">Tampilkan</button>
                            </form>
                        <?php } ?>
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

    <!-- jQuery -->
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <!-- html2pdf.js -->
    <script src="https://cdnjs.cloudflare.com/ajax/libs/html2pdf.js/0.9.2/html2pdf.bundle.min.js"></script>
    <script>
        function generatePDF() {
            const element = document.getElementById('printableArea');
            var opt = {
                margin: 0,
                filename: 'Laporan_Balita.pdf',
                image: {
                    type: 'jpeg',
                    quality: 0.98
                },
                html2canvas: {
                    scale: 1
                },
                jsPDF: {
                    unit: 'in',
                    format: 'letter',
                    orientation: 'landscape'
                }
            };
            html2pdf().from(element).set(opt).save();
        }
    </script>

    <!-- Chart library -->
    <script src="plugins/chart.min.js"></script>
    <!-- Icons library -->
    <script src="plugins/feather.min.js"></script>
    <!-- Custom scripts -->
    <script src="js/script.js"></script>
</body>

</html>