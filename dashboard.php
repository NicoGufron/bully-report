<!DOCTYPE html>

<html>

<head>
    <meta name="viewport" content="width= device-width, initial-scale=1" />
    <title>Dashboard</title>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/500e5d004e.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="apple-touch-icon" sizes="180x180" href=".//assets/favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="./assets/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="./assets/favicon/favicon-16x16.png">
    <link rel="stylesheet" href="style/style.css" />
</head>

<?php
require_once("connect.php");
session_start();
if (!isset($_SESSION['username']) && !isset($_SESSION['id'])) {
    header('Location: index.php');
}

$totalReports = 0;

$sqlPerundungan = "SELECT * FROM reports WHERE progress = '1' AND jenis_kasus = 'Perundungan' ORDER BY form_id DESC";
$sqlKekerasanSeksual = "SELECT * FROM reports WHERE progress = '1' AND jenis_kasus = 'Kekerasan Seksual' ORDER BY form_id DESC";
$sqlIntoleransi = "SELECT * FROM reports WHERE progress = '1' AND jenis_kasus = 'Intoleransi' ORDER BY form_id DESC";

$qp = mysqli_query($conn, $sqlPerundungan);
$qks = mysqli_query($conn, $sqlKekerasanSeksual);
$qi = mysqli_query($conn, $sqlIntoleransi);

$totalReportsPerundungan = mysqli_num_rows($qp);
$totalReportsKekerasanSeksual = mysqli_num_rows($qks);
$totalReportsIntoleransi= mysqli_num_rows($qi);

?>

<body>
    <div class='navbar-top'>
        <div style="display: flex; flex-direction: row; align-items:center;">
            <button class="offcanvas-menu" data-bs-toggle="offcanvas" data-bs-target="#offcanvasLeft" aria-controls="offcanvasLeft" style="background-color: transparent; color: #384C67; border: 0px"><i class="fa-solid fa-bars fa-xl"></i></button>
            <h4>Selamat datang, <?= $_SESSION['username'] ?></h4>
        </div>
        <button class='logout-button'><i class="fa-solid fa-right-from-bracket"></i>Keluar</button>
    </div>
    <div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasLeft" aria-labelledby="offcanvasExampleLabel">
        <div class="offcanvas-header">
            <h5 class="offcanvas-title" id="offcanvasExampleLabel">Dashboard Admin</h5>
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <h5 style="color: gray;margin-top:35px;margin-bottom: 15px">MENU</h5>
            <a class="offcanvas-nav-link nav-link" href="#"><i class="fa-solid fa-box fa-lg"></i>Dashboard</a>
            <a class="offcanvas-nav-link nav-link" href="#"><i class="fa-solid fa-file fa-lg"></i>Laporan On Progress</a>
            <a class="offcanvas-nav-link nav-link" href="#"><i class="fa-solid fa-clipboard-check fa-lg"></i>Laporan Selesai</a>
        </div>
    </div>
    <div class="container-fluid">
        <section class="dashboard-section">
            <div class="container">
                <h2>Dashboard</h2>
                <div class="total-reports">
                    <div class="report-cards">
                    <span class='top-cards'><h2><?= $totalReportsPerundungan ?></h2><i class="fa-solid fa-square-person-confined fa-2xl"></i></span>
                        <p>Laporan perundungan</p>
                        
                    </div>
                    <div class="report-cards">
                        <span class='top-cards'><h2><?= $totalReportsKekerasanSeksual ?></h2><i class="fa-solid fa-heart-circle-exclamation fa-2xl"></i></span>
                        <p class='subtitle'>Laporan kekerasan seksual</p>
                    </div>
                    <div class="report-cards">
                    <span class='top-cards'><h2><?= $totalReportsIntoleransi ?></h2><i class="fa-solid fa-hand-fist fa-2xl"></i></span>
                        <p>Laporan intoleransi</p>

                    </div>
                </div>
                <div class="reports">
                    <h4 class="title">Laporan Perundungan On Progress</h4>
                    <p class="subtitle">Diurut berdasarkan paling baru</p>
                    <div class="accordion">
                        <?php
                        $counter = 1;
                        $sql = "SELECT * FROM reports WHERE progress = '1' ORDER BY form_id DESC";
                        $q = mysqli_query($conn, $sql);
                        while ($row = mysqli_fetch_assoc($q)) {
                            $namaPelapor = $row['nama_pelapor'];
                            $nimPelapor = $row['nim_pelapor'];
                            $namaKorban = $row['nama_korban'];
                            $jenisKasus = $row['jenis_kasus'];
                            $nomorPengajuan = $row['nomor_pengajuan'];
                            $statusPelapor = $row['status_pelapor'];
                            $nimKorban = $row['nim_korban'];
                            $dampakKasus = $row['dampak_kasus'];
                            $jurusanKorban = $row['jurusan_korban'];
                            $namaPelaku = $row['nama_pelaku'];
                            $waktuKejadian = $row['waktu_kejadian'];
                            $frekuenseiKejadian = $row['frekuensi_kejadian'];
                            $lokasiKejadian = $row['lokasi_kejadian'];
                            $deskripsiKejadian = $row['deskripsi_kejadian'];
                            $buktiKejadian = $row['bukti_kejadian'];

                            if ($buktiKejadian == "") {
                                $buktiKejadian = "Tidak ada bukti kejadian";
                            } else if (strpos($buktiKejadian, "https://") !== false){
                                $buktiKejadian = "<a target='_blank' href='$buktiKejadian'>$buktiKejadian</a>";
                            }

                            $convertedWaktuKejadian = date('d M Y', strtotime($waktuKejadian));

                            $assignmentSql = "SELECT * FROM accounts";

                            $assignmentTop = "<label class='result-label'>Tugaskan kasus ini ke: </label>
                            <select class='form-control custom-select' name='assign-to'>";
                            $assignmentMiddle = '';

                            $result = mysqli_query($conn, $assignmentSql);

                            while($accounts = mysqli_fetch_assoc($result)) {
                                $username = $accounts['username'];

                                $assignmentMiddle .= "<option value='$username'>$username</option>";
                            }

                            $assignmentEnd = "</select>";

                            $assignment = $assignmentTop . $assignmentMiddle . $assignmentEnd;

                            $convertedDeskripsi = nl2br($deskripsiKejadian);
                            echo $accordionItem = "
                                <div class='accordion-item'>
                                    <h2 class='accordion-header' id='heading$counter'>
                                        <button class='accordion-button' type='button' data-bs-toggle='collapse' data-bs-target='#collapse$counter' aria-expanded='false' aria-controls='collapse$counter'>
                                            <strong>Laporan Nomor Pengajuan #$nomorPengajuan - $jenisKasus</strong>
                                        </button>
                                    </h2>
                                    <div id='collapse$counter' class='accordion-collapse collapse' aria-labelledby='headingOne' data-bs-parent='#accordionExample'>
                                        <div class='accordion-body'>
                                        <span class='top-form'>
                                            <h5 class='title' style='text-align:center'>LAPORAN PERUNDUNGAN</h5>
                                            <p class='nomor-pengajuan'>#$nomorPengajuan</p>
                                        </span>
                                        <label class='result-label'>Jenis Kasus</label>
                                        <p>$jenisKasus</p>
                                        <label class='result-label'>Nama Korban</label>
                                        <p>$namaKorban</p>
                                        <label class='result-label'>NIM Korban</label>
                                        <p>$nimKorban</p>
                                        <label class='result-label'>Dampak Kasus</label>
                                        <p>$dampakKasus</p>
                                        <label class='result-label'>Jurusan Korban</label>
                                        <p>$jurusanKorban</p>
                                        <label class='result-label'>Nama Pelaku</label>
                                        <p>$namaPelaku</p>
                                        <label class='result-label'>Bukti Kejadian</label>
                                        <p>$buktiKejadian</p>
                                        <label class='result-label'>Waktu Kejadian</label>
                                        <p>$convertedWaktuKejadian</p>
                                        <label class='result-label'>Frekuensi Kejadian</label>
                                        <p>$frekuenseiKejadian</p>
                                        <label class='result-label'>Lokasi Kejadian</label>
                                        <p>$lokasiKejadian</p>
                                        <label class='result-label'>Deskripsi Kejadian</label>
                                        <p>$convertedDeskripsi</p>
                                        <div style='border:1px solid black;height: 1px; margin-top: 2.5%'></div>
                                        <form method='post' action='submit.php'>
                                            <input type='hidden' name='nomor-pengajuan' value='$nomorPengajuan'>
                                            <div class='sidenote'>
                                                $assignment
                                                <label class='result-label'>Status Kasus: </label>
                                                <select class='form-control custom-select' name='progress-report'>
                                                    <option value='1'>On Progress</option>
                                                    <option value='2'>Selesai</option>
                                                </select>
                                                <label class='result-label' style='margin-bottom: 10px;'>Catatan untuk laporan ini:</label>
                                                <textarea class='form-control' col='4' rows='4' name='sidenote'></textarea>
                                                <input name='submit-sidenote' type='submit' class='submit-button''>
                                            </div>
                                        </form>
                                        </div>
                                    </div>
                                </div>
                                ";
                            $counter = $counter + 1;
                        }
                        ?>

                    </div>
                </div>
            </div>
        </section>
    </div>
</body>

</html>