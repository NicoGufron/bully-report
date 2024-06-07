<!DOCTYPE html>

<html>

<head>
    <meta name="viewport" content="width= device-width, initial-scale=1" />
    <title>Kasus Yang Selesai</title>
    <script src="https://code.jquery.com/jquery-3.7.1.min.js" integrity="sha256-/JqT3SQfawRcv/BIHPThkBvs0OEvtFFmqPF/lYI/Cxo=" crossorigin="anonymous"></script>
    <script src="https://kit.fontawesome.com/500e5d004e.js" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@3.3.7/dist/js/bootstrap.min.js" integrity="sha384-Tc5IQib027qvyjSMfHjOMaLkfuWVxZxUPnCJA7l2mCWNIpG9mGCD8wGNIcPD7Txa" crossorigin="anonymous"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-YvpcrYf0tY3lHB60NNkmXc5s9fDVZLESaAA55NDzOxhy9GkcIdslK1eN7N6jIeHz" crossorigin="anonymous"></script>
    <link rel="apple-touch-icon" sizes="180x180" href=".//assets/favicon/apple-touch-icon.png">
    <link rel="icon" type="image/png" sizes="32x32" href="./assets/favicon/favicon-32x32.png">
    <link rel="icon" type="image/png" sizes="16x16" href="./assets/favicon/favicon-16x16.png">
    <script src="https://cdn.datatables.net/2.0.8/js/dataTables.min.js"></script>
    <link rel="stylesheet" href="https://cdn.datatables.net/2.0.8/css/dataTables.dataTables.css">
    <link rel="stylesheet" href="style/style.css" />
</head>

<body>
    <?php
    require_once("connect.php");
    include("menu.php");

    $id = $_SESSION['id'];
    $usernameSession = $_SESSION['username'];

    ?>

    <div class="container-fluid">
        <section class='completed-cases'>
            <h4 class='title'>Laporan Perundungan yang sudah Selesai</h4>
            <p class="subtitle">Data diurutkan dari yang paling baru</p>

            <div class='table-responsive'>
                <table class="table table-striped table-hover" id="dataTable">
                    <thead>
                        <tr style="text-align: center" ;>
                            <th style='text-align:center'>Nomor Pengajuan</th>
                            <th style='text-align:center'>Jenis Kasus</th>
                            <th style='text-align:center'>Nama Pelapor</th>
                            <th style='text-align:center'>Status Pelapor</th>
                            <th style='text-align:center'>Nama Korban</th>
                            <th style='text-align:center'>Nama Pelaku</th>
                            <th style='text-align:center'>Progress</th>
                            <th style='text-align:center'>Details</th>
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
                        $sql = "SELECT * FROM reports WHERE progress = '3' ORDER BY form_id DESC";
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
                                $progressStatus = "On Progress";
                            } else if ($progress === "2") {
                                $progressStatus = "Dibatalkan";
                            } else if ($progress === "3") {
                                $progressStatus = "Selesai";
                            }
                            $offcanvasId = "offcanvasRight$nomorPengajuan";

                            if ($buktiKejadian == "") {
                                $buktiKejadian = "Tidak ada bukti kejadian";
                            } else if (strpos($buktiKejadian, "https://") !== false) {
                                $buktiKejadian = "<a target='_blank' href='$buktiKejadian'>$buktiKejadian</a>";
                            }

                            $convertedWaktuKejadian = date('d M Y', strtotime($waktuKejadian));

                            $assignmentSql = "SELECT * FROM accounts";

                            $assignmentTop = "<label class='result-label'>Tugaskan kasus ini ke: </label>
                            <select class='form-control custom-select' id='assign-to-$nomorPengajuan' name='assign-to'>";
                            $assignmentMiddle = '';

                            $result = mysqli_query($conn, $assignmentSql);

                            while ($accounts = mysqli_fetch_assoc($result)) {
                                $id = $accounts['id'];
                                $username = $accounts['username'];

                                $assignmentMiddle .= "<option value='$id'>$username</option>";
                            }

                            $assignmentEnd = "</select>";

                            $assignment = $assignmentTop . $assignmentMiddle . $assignmentEnd;

                            $convertedDeskripsi = nl2br($deskripsiKejadian);

                            $dokumen = "
                            <span class='top-form'>
                                <h5 class='title' style='text-align:center'>LAPORAN PERUNDUNGAN</h5>
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