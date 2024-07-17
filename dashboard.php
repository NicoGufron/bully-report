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
    <script src="https://cdn.datatables.net/2.0.8/js/dataTables.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.8/css/dataTables.dataTables.css">
    </script>
    <link rel="apple-touch-icon" sizes="180x180" href=".//assets/favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="./assets/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="./assets/favicon/favicon-16x16.png">
    <link rel="stylesheet" href="style/style.css" />
</head>

<?php
include("menu.php");
require_once("connect.php");
if (!isset($_SESSION['username']) && !isset($_SESSION['id'])) {
    header('Location: index.php');
}

$id = $_SESSION['id'];
$usernameSession = $_SESSION['username'];
$totalReports = 0;

$sqlPerundungan = "SELECT * FROM reports WHERE progress = '1' AND jenis_kasus = 'Perundungan' ORDER BY form_id DESC";
$sqlKekerasanSeksual = "SELECT * FROM reports WHERE progress = '1' AND jenis_kasus = 'Kekerasan Seksual' ORDER BY form_id DESC";
$sqlIntoleransi = "SELECT * FROM reports WHERE progress = '1' AND jenis_kasus = 'Intoleransi' ORDER BY form_id DESC";
$sqlAssigned = "SELECT * FROM reports WHERE progress = '1' AND assign_to = '$id'";

$qp = mysqli_query($conn, $sqlPerundungan);
$qks = mysqli_query($conn, $sqlKekerasanSeksual);
$qi = mysqli_query($conn, $sqlIntoleransi);
$qa = mysqli_query($conn, $sqlAssigned);

$totalReportsPerundungan = mysqli_num_rows($qp);
$totalReportsKekerasanSeksual = mysqli_num_rows($qks);
$totalReportsIntoleransi = mysqli_num_rows($qi);
$totalAssigned = mysqli_num_rows($qa);

?>

<body>
    <?php
    /// TODO buat tampilan untuk masing2 role admin
    /// Role admin:
    /// 1. Superadmin
    /// 2. Dosen
    /// 3. Tendik
    /// 4. Mahasiswa
    ?>
    <div class="container-fluid">
        <section class="dashboard-section">
            <h4 class='title'>Dashboard</h4>
            <div class="total-reports">
                <div class="report-cards">
                    <span class='top-cards'>
                        <h2><?= $totalReportsPerundungan ?></h2><i class="fa-solid fa-square-person-confined fa-2xl"></i>
                    </span>
                    <p>Laporan perundungan</p>

                </div>
                <div class="report-cards">
                    <span class='top-cards'>
                        <h2><?= $totalReportsKekerasanSeksual ?></h2><i class="fa-solid fa-heart-circle-exclamation fa-2xl"></i>
                    </span>
                    <p class='subtitle'>Laporan kekerasan seksual</p>
                </div>
                <div class="report-cards">
                    <span class='top-cards'>
                        <h2><?= $totalReportsIntoleransi ?></h2><i class="fa-solid fa-hand-fist fa-2xl"></i>
                    </span>
                    <p>Laporan intoleransi</p>
                </div>
                <div class="report-cards">
                    <span class='top-cards'>
                        <h2><?= $totalAssigned ?></h2><i class="fa-solid fa-magnifying-glass fa-2xl"></i>
                    </span>
                    <p>Kasus yang ditugaskan</p>
                </div>
            </div>
            <div class='table-responsive'>
                <table class="table table-striped table-hover" id="dataTable">
                    <thead>
                        <tr style="text-align: center" ;>
                            <th style='text-align:center;font-size:0.875rem'>Nomor Pengajuan</th>
                            <th style='text-align:center;font-size:0.875rem'>Jenis Kasus</th>
                            <th style='text-align:center;font-size:0.875rem'>Nama Pelapor</th>
                            <th style='text-align:center;font-size:0.875rem'>Status Pelapor</th>
                            <th style='text-align:center;font-size:0.875rem'>Nama Korban</th>
                            <th style='text-align:center;font-size:0.875rem'>Nama Pelaku</th>
                            <th style='text-align:center;font-size:0.875rem'>Status Pelaku</th>
                            <th style='text-align:center;font-size:0.875rem'>Progress</th>
                            <th style='text-align:center;font-size:0.875rem'>Details</th>
                        </tr>
                    </thead>
                    <tbody>
                        <?php
                        //progress
                        // 1 = on progress
                        // 2 = dibatalkan
                        // 3 = selesai
                        // 4 = baru
                        $counter = 1;
                        $offcanvas = "";

                        $sql = "SELECT * FROM reports WHERE progress = '1'";

                        if (isset($_SESSION['id']) && $_SESSION['id'] === "2") {
                            $sql = $sql . " AND status_pelaku = '2'";
                        } else if (isset($_SESSION['id']) && $_SESSION['id'] === "3") {
                            $sql = $sql . " AND status_pelaku = '3'";
                        } else if (isset($_SESSION['id']) && $_SESSION['id'] === "4") {
                            $sql = $sql . " AND status_pelaku = '4'";
                        }

                        $sql = $sql . "ORDER BY form_id ASC";


                        $q = mysqli_query($conn, $sql);
                        while ($row = mysqli_fetch_assoc($q)) {
                            $namaPelapor = $row['nama_pelapor'];
                            $nimPelapor = $row['nim_pelapor'];
                            $namaKorban = $row['nama_korban'];
                            $jenisKasus = $row['jenis_kasus'];
                            $nomorPengajuan = $row['nomor_pengajuan'];
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
                            $statusPelaku = $row['status_pelaku'];

                            $detailStatusPelaku = "";
                            if ($statusPelaku === "2") {
                                $detailStatusPelaku = "Dosen";
                            } else if ($statusPelaku === "3") {
                                $detailStatusPelaku = "Tendik (Tenaga Pendidik)";
                            } else if ($statusPelaku === "4") {
                                $detailStatusPelaku = "Mahasiswa";
                            }

                            $waktuKejadian = $row['waktu_kejadian'];
                            $frekuenseiKejadian = $row['frekuensi_kejadian'];
                            $lokasiKejadian = $row['lokasi_kejadian'];
                            $deskripsiKejadian = $row['deskripsi_kejadian'];
                            $buktiKejadian = $row['bukti_kejadian'];
                            $nomorHp = $row['nomor_hp'];
                            $emailPelapor = $row['email'];
                            // $assignTo = $row['assign_to'];
                            $progress = $row['progress'];

                            if ($progress === "1") {
                                $progressStatus = "Diterima";
                            } else if ($progress === "2") {
                                $progressStatus = "On Progress - Rapat Tim Satgas";
                            } else if ($progress === "3") {
                                $progressStatus = "Pertemuan dengan Pelapor";
                            } else if ($progress === "4") {
                                $progressStatus = "Sesi Diskusi";
                            } else if ($progress === "5") { 
                                $progressStatus = "Perekaman Bukti";
                            } else if ($progress === "6") {
                                $progressStatus = "Rapat Rektorat, CSD, Program Studi yang Terlibat, dan Satgas";
                            } else if ($progres === "7") {
                                $progressStatus = "Selesai";
                            }

                            $offcanvasId = "offcanvasRight$nomorPengajuan";

                            if ($buktiKejadian == "") {
                                $buktiKejadian = "Tidak ada bukti kejadian";
                            } else if (strpos($buktiKejadian, "https://") !== false) {
                                $buktiKejadian = "<a target='_blank' href='$buktiKejadian'>$buktiKejadian</a>";
                            }

                            $convertedWaktuKejadian = date('d M Y', strtotime($waktuKejadian));

                            // if ($_SESSION['id'] !== "1") {
                            //     $assignmentSql = "SELECT * FROM accounts";


                            //     $assignmentTop = "<label class='result-label'>Tugaskan kasus ini ke: </label>
                            //         <select class='form-control custom-select' id='assign-to-$nomorPengajuan' name='assign-to'>";
                            //     $assignmentMiddle = '';
                            // }

                            // $result = mysqli_query($conn, $assignmentSql);

                            // while ($accounts = mysqli_fetch_assoc($result)) {
                            //     $id = $accounts['id'];
                            //     $username = $accounts['username'];

                            //     $assignmentMiddle .= "<option value='$id'>$username</option>";
                            // }

                            // $assignmentEnd = "</select>";

                            // $assignment = $assignmentTop . $assignmentMiddle . $assignmentEnd;

                            $convertedDeskripsi = nl2br($deskripsiKejadian);

                            $dokumen = "
                            <span class='top-form'>
                                <h5 class='title' style='text-align:center'>LAPORAN PERUNDUNGAN</h5>
                                <p class='nomor-pengajuan'>#$nomorPengajuan</p>
                            </span>
                            <span style='display: block'>
                            <form method='post' action='action.php'>
                                <input type='hidden' name='nomor-pengajuan' value=$nomorPengajuan>
                                <div style='display: flex;flex-direction: column'>
                                    <label class='result-label'>Status Kasus: </label>
                                    <select class='form-control custom-select' name='progress-report'>

                                        <option value='1'>Diterima</option>
                                        <option value='2'>On Progress - Rapat Tim Satgas</option>
                                        <option value='3'>Pertemuan dengan Pelapor</option>
                                        <option value='4'>Sesi Diskusi</option>
                                        <option value='5'>Perekaman Bukti</option>
                                        <option value='6'>Rapat Rektorat, CSD, Program Studi yang Terlibat, dan Satgas</option>
                                        <option value='7'>Selesai</option>
                                    </select>
                                    </div>
                                <input name='save-changes' type='submit' class='submit-button' value='Simpan Perubahan'>
                            </form>
                            </span>
                            <label class='result-label'>Jenis Kasus</label>
                            <p>$jenisKasus</p>
                            <label class='result-label'>Status Pelapor</label>
                            <p>$statusPelapor</p>
                            <label class='result-label'>Nama Pelapor</label>
                            <p>$namaPelapor</p>
                            <label class='result-label'>NIM Pelapor</label>
                            <p>$nimPelapor</p>
                            <label class='result-label'>NIM Korban</label>
                            <p>$nimKorban</p>
                            <label class='result-label'>Nomor HP Pelapor</label>
                            <p>$nomorHp</p>
                            <label class='result-label'>E-mail Pelapor</label>
                            <p>$emailPelapor</p>
                            <label class='result-label'>Dampak Kasus</label>
                            <p>$dampakKasus</p>
                            <label class='result-label'>Jurusan Korban</label>
                            <p>$jurusanKorban</p>
                            <label class='result-label'>Nama Pelaku</label>
                            <p>$namaPelaku</p>
                            <label class='result-label'>Status Pelaku</label>
                            <p>$detailStatusPelaku</p>
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
                            ";

                            echo "<tr>
                                <td class='table-child' style='text-align:center'>$nomorPengajuan</td>
                                <td class='table-child' style='text-align:center'>$jenisKasus</td>
                                <td class='table-child' style='text-align:center'>$namaPelapor</td>
                                <td class='table-child' style='text-align:center'>$statusPelapor</td>
                                <td class='table-child' style='text-align:center'>$namaKorban</td>
                                <td class='table-child' style='text-align:center'>$namaPelaku</td>
                                <td class='table-child' style='text-align:center'>$detailStatusPelaku</td>
                                <td class='table-child' style='text-align:center'>$progressStatus</td>
                                <td class='table-child' style='text-align:center'><button data-bs-toggle='offcanvas' data-bs-target='#$offcanvasId' data-bs-dokumen='' aria-controls='offcanvasRight'><i class='fa-solid fa-eye'></i></button></td>
                            </tr>";

                            echo " <div class='offcanvas offcanvas-end w-75' tabindex='-1' id='$offcanvasId' aria-labelledby='offcanvasRightLabel'>
                                <div class='offcanvas-header'>
                                    <h3 id='offcanvasRightLabel$nomorPengajuan' class='title'><strong>Detail Laporan</strong></h3>
                                    <button type='button' class='btn-close text-reset' data-bs-dismiss='offcanvas' aria-label='Close'></button>
                                </div>
                                <div class='offcanvas-body'>
                                    $dokumen
                                </div>
                            </div>";
                        }
                        ?>
                    </tbody>
                </table>
            </div>
    </div>
    </section>
    </div>

    <script>
        $(document).ready(function() {
            $('#dataTable').DataTable({
                paging: true,
                ordering: true,
            });
        });
    </script>

</body>

</html>