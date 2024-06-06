<!DOCTYPE html>

<html>

<head>
    <meta name="viewport" content="width= device-width, initial-scale=1" />
    <title>Cek Laporan Perundungan</title>
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
include("navbar.php");

$result = "";

if ($_POST) {
    $nomorPengajuan = $_POST['nomor-pengajuan'];
    $sql = "SELECT * FROM reports WHERE nomor_pengajuan = '$nomorPengajuan'";

    $q = mysqli_query($conn, $sql);

    if (mysqli_num_rows(($q)) >= 1) {
        while ($row = mysqli_fetch_assoc($q)) {
            $jenisKasus = $row["jenis_kasus"];
            $namaPelapor = $row['nama_pelapor'];
            $nimPelapor = $row['nim_pelapor'];
            $namaKorban = $row['nama_korban'];
            $statusPelapor = $row['status_pelapor'];
            if ($statusPelapor === "korban") {
                $statusPelapor = "Korban";
            } else if ($statusPelapor === "saksi") {
                $statusPelapor = "Saksi";
            }
            $nimKorban = $row['nim_korban'];
            $dampakKasus = $row['dampak_kasus'];
            $jurusanKorban = $row['jurusan_korban'];
            $namaPelaku = $row['nama_pelaku'];
            $waktuKejadian = $row['waktu_kejadian'];
            $frekuenseiKejadian = $row['frekuensi_kejadian'];
            $lokasiKejadian = $row['lokasi_kejadian'];
            $deskripsiKejadian = $row['deskripsi_kejadian'];
            $buktiKejadian = $row['bukti_kejadian'];
            $progress = $row['progress'];

            $progressReport = "";

            if ($progress === "1") {
                $progressReport = "Sedang Berjalan";
            } else if ($progress === "2") {
                $progressReport = "Dibatalkan";
            } else if ($progress === "3") {
                $progressReport = "Selesai";
            }

            $convertedWaktuKejadian = date('d M Y', strtotime($waktuKejadian));

            $convertedDeskripsi = nl2br($deskripsiKejadian);

            if ($buktiKejadian == "") {
                $buktiKejadian = "Tidak ada bukti kejadian";
            } else if (strpos($buktiKejadian, "https://") !== false) {
                $buktiKejadian = "<a target='_blank' href='$buktiKejadian'>$buktiKejadian</a>";
            }

            if ($namaPelapor === "") {

                $result = "
                <div class='result-form'>
                    <span class='top-form'>
                        <div style='display: flex;flex-direction: column'>
                            <h5 class='title' style='text-align:center'>LAPORAN PERUNDUNGAN</h5>
                            <p class='subtitle'>Status: <strong>$progressReport</strong></p> 
                        </div>
                        <p class='nomor-pengajuan'>#$nomorPengajuan</p>
                    </span>
                    <label class='result-label'>Jenis Kasus</label>
                    <p>$jenisKasus</p>
                    <label class='result-label'>Status Pelapor</label>
                    <p>$statusPelapor</p>
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
                </div>
            ";
            } else if ($namaPelapor !== "") {
                $result = "
                <div class='result-form'>
                    <span class='top-form'>
                        <div style='display: flex;flex-direction: column'>
                            <h5 class='title' style='text-align:center'>LAPORAN PERUNDUNGAN</h5>
                            <p class='subtitle'>Status: <strong>$progressReport</strong></p> 
                        </div>
                        <p class='nomor-pengajuan'>#$nomorPengajuan</p>
                    </span>
                    <label class='result-label'>Jenis Kasus</label>
                    <p>$jenisKasus</p>
                    <label class='result-label'>Status Pelapor</label>
                    <p>$statusPelapor</p>
                    <label class='result-label'>Nama Pelapor</label>
                    <p>$namaPelapor</p>
                    <label class='result-label'>NIM Pelapor</label>
                    <p>$nimPelapor</p>
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
                </div>
            ";
            }
        }
    } else {
        $result = "<div class='red-notice'>
            <p>Mohon maaf, sistem tidak menemukan nomor pengajuan!</p>
        </div>";
    }
}

?>

<body>
    <div class="container-fluid">
        <section class="main-section">
            <div class="container cek-laporan">
                <h4 class="title" style="text-align: center;">Status Laporan Perundungan</h4>
                <div class="notice">
                    <ul>
                        <li>Cek status laporan perundungan anda dengan menggunakan <strong>nomor pengajuan</strong> yang anda telah terima saat melaporkan</li>
                    </ul>
                </div>
                <form method="post" style="display: flex; flex-direction: column">
                    <label for="nomor-pengajuan">Nomor Pengajuan: </label>
                    <div style="display: flex; flex-direction: row">
                        <input class="form-control" type="number" name="nomor-pengajuan" placeholder="Cth: 123456">
                        <input type="submit" value="Cek Laporan" class="submit-button" style="margin-left: 20px">
                    </div>
                </form>
                <?php if ($result != "") : ?>
                    <?= $result ?>
                <?php endif; ?>
            </div>
        </section>
    </div>
</body>

</html>