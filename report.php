<!DOCTYPE html>

<html>

<head>
    <meta name="viewport" content="width= device-width, initial-scale=1" />
    <title>Laporan Perundungan</title>
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

$sql = "INSERT INTO reports (jenis_kasus, nama_pelapor, nim_pelapor, status_pelapor, dampak_kasus, nama_korban, email, nomor_hp, nim_korban, jurusan_korban, nama_pelaku, waktu_kejadian, frekuensi_kejadian, lokasi_kejadian, deskripsi_kejadian, bukti_kejadian, nomor_pengajuan, progress, assign_to) VALUES";

$result = "<div class='notice' style='display: flex; flex-direction: column;align-items: center; padding: 20px'>
<p style='font-size: 14px;text-align:center'><strong>Perhatian! Mohon untuk menyimpan, mencatat, atau dengan screenshot nomor pengajuan ini!</strong></p>
<p style='text-align:center'>Terima kasih atas laporan anda! Nomor pengajuan anda: <br><br><span style='border-radius: 10px;padding: 5px; font-size: 20px;'><strong>#123456</strong></p>
</div>";

function generateNomorPengajuan(): string
{
    $characters = "01234456789";
    $randomString = '';
    $maxNumber = strlen($characters) - 1;
    for ($i = 0; $i < 6; $i++) {
        $randomString .= $characters[rand(0, $maxNumber)];
    }
    return $randomString;
}

if (isset($_POST["submit-korban"])) {
    $postJenisKasus = $_POST["jenis-kasus"];
    $postStatusPelapor = $_POST['status-pelapor'];
    $postDampakKasus = $_POST['dampak-kasus'];

    if (isset($postDampakKasus) && is_array($postDampakKasus)) {
        // jika hanya ada 1 checkbox
        if (count($postDampakKasus) === 1) {
            $dampakList = $postDampakKasus[0];
        } else {
            $dampakList = implode(', ', $postDampakKasus);
        }

        // var_dump("Dampak: $dampakList");
    }

    $postNamaKorban = $_POST['nama-korban'];
    $postNimKorban = $_POST['nim-korban'];
    $postJurusanKorban = $_POST['jurusan-korban'];
    $postNamaPelaku = $_POST['nama-pelaku'];
    $postWaktuKejadian = $_POST['waktu-kejadian'];
    $postFrekuensiKejadian = $_POST['frekuensi-kejadian'];
    $postLokasiKejadian = $_POST['lokasi-kejadian'];
    $postDeskripsiKejadian = $_POST['deskripsi-kejadian'];
    $postNomorHP = $_POST['nomor-hp'];
    $postBuktiKejadian = $_POST['bukti-kejadian'];
    $postEmailPelapor = $_POST['email-pelapor'];

    $nomorPengajuan = '';
    $nomorPengajuan = generateNomorPengajuan();

    $values = $sql . "('$postJenisKasus', '', '', '$postStatusPelapor', '$dampakList', '$postNamaKorban', '$postEmailPelapor', '$postNomorHP', '$postNimKorban', '$postJurusanKorban', '$postNamaPelaku', '$postWaktuKejadian', '$postFrekuensiKejadian', '$postLokasiKejadian', '$postDeskripsiKejadian', '$postBuktiKejadian', '$nomorPengajuan', '1', '1')";
    $q = mysqli_query($conn, $values);

    $result = "<div class='notice' style='display: flex; flex-direction: row;align-items: baseline; padding: 20px'>
        <i class='fa-solid fa-circle-info' style='padding-left: 10px;padding-right: 10px'></i><p>Terima kasih atas laporan anda! Nomor pengajuan anda <span style='background: #338533;color: white;border-radius: 10px;padding: 5px;'>#$nomorPengajuan</span></p>
    </div>";
} else if (isset($_POST["submit-saksi"])) {
    $postJenisKasus = $_POST["jenis-kasus"];
    $postStatusPelapor = $_POST['status-pelapor'];
    var_dump($postStatusPelapor);
    $postNamaPelapor = $_POST['nama-pelapor'];
    $postNimPelapor = $_POST['nim-pelapor'];
    $postNamaKorban = $_POST['nama-korban'];
    $postNimKorban = $_POST['nim-korban'];
    $postDampakKasus = $_POST['dampak-kasus'];

    if (isset($postDampakKasus) && is_array($postDampakKasus)) {
        // jika hanya ada 1 checkbox
        if (count($postDampakKasus) === 1) {
            $dampakList = $postDampakKasus[0];
        } else {
            $dampakList = implode(', ', $postDampakKasus);
        }

        // var_dump("Dampak: $dampakList");
    }

    $postJurusanKorban = $_POST['jurusan-korban'];
    $postNamaPelaku = $_POST['nama-pelaku'];
    $postWaktuKejadian = $_POST['waktu-kejadian'];
    $postFrekuensiKejadian = $_POST['frekuensi-kejadian'];
    $postLokasiKejadian = $_POST['lokasi-kejadian'];
    $postDeskripsiKejadian = $_POST['deskripsi-kejadian'];
    $postNomorHP = $_POST['nomor-hp'];
    $postEmailPelapor = $_POST['email-pelapor'];
    $postBuktiKejadian = $_POST['bukti-kejadian'];

    $nomorPengajuan = '';
    $nomorPengajuan = generateNomorPengajuan();

    $values = $sql . " ('$postJenisKasus', '$postNamaPelapor', '$postNimPelapor', '$postStatusPelapor', '$dampakList', '$postNamaKorban', '$postEmailPelapor', '$postNomorHP', '$postNimKorban', '$postJurusanKorban', '$postNamaPelaku', '$postWaktuKejadian', '$postFrekuensiKejadian', '$postLokasiKejadian', '$postDeskripsiKejadian', '$postBuktiKejadian', '$nomorPengajuan', '1', '1')";
    $q = mysqli_query($conn, $values);
    $result = "<div class='notice' style='display: flex; flex-direction: row;align-items: baseline; padding: 20px'>
        <i class='fa-solid fa-circle-info' style='padding-left: 10px;padding-right: 10px'></i><p>Laporan sudah diajukan! Nomor pengajuan anda <span style='background: #338533;color: white;border-radius: 10px;padding: 5px;'>#$nomorPengajuan</span></p>
    </div>";
}
?>

<body>
    <div class="container-fluid">
        <section>
            <div class="container lapor-perundungan">
                <br>
                <div class="formulir">
                    <h4 class="title" style="text-align: center" ;>Formulir Laporan Perundungan</h4>
                    <div class="notice">
                        <ul>
                            <li>Laporan dan data hanya bisa dilihat oleh Pelapor dan Tim Investigasi dari Universitas Kalbe.</li>
                            <li>Informasi Nama dan NIM Pelapor bersifat opsional, tetapi dibutuhkan untuk mempercepat proses investigasi.</li>
                            <li>Informasi Email Pelapor bersifat opsional, tetapi dibutuhkan untuk menerima status tracking laporan.</li>
                        </ul>
                    </div>
                    <?= $result ?>
                    <label>Status pelapor (<span style="color:red">*</span>)</label>
                    <select id="form-selector" class="form-control" required>
                        <option value="" selected readonly hidden>Silahkan dipilih</option>
                        <option value="korban">Korban</option>
                        <option value="saksi">Saksi</option>
                    </select>
                    <!-- Formulir Korban -->
                    <form method="post" id="korban-form">
                        <input type='hidden' name='status-pelapor' class='status-pelapor'>
                        <label>Jenis Perundungan (<span style="color:red">*</span>)</label>
                        <select class="form-control" name="jenis-kasus" required>
                            <option value="" selected readonly hidden>Silahkan dipilih</option>
                            <option value="Perundungan">Perundungan</option>
                            <option value="Kekerasan Seksual">Kekerasan Seksual</option>
                            <option value="Intoleransi">Intoleransi</option>
                        </select>
                        <div style="display: flex; flex-direction: column">
                            <label>Dampak Perundungan (<span style="color:red">*</span>)</label>
                            <div class="checkboxes">
                                <input type="checkbox" name="dampak-kasus[]" value="Physical"><label for="">Fisik</label>
                            </div>
                            <div class="checkboxes">
                                <input type="checkbox" name="dampak-kasus[]" value="Mental"><label>Mental</label>
                            </div>
                            <div class="notice">
                                <span style="display: flex; flex-direction: row; align-items: baseline"><i class="fa-solid fa-circle-info" style="padding-left: 10px;padding-right: 10px"></i><strong>Catatan: </strong></span>
                                <ul>
                                    <li>Dampak fisik termasuk dengan: Kekerasan Fisik, Pemerkosaan, Ancaman Kekerasan </li>
                                    <li>Dampak mental termasuk dengan: Penghinaan, Trauma, dan Gangguan Emosi
                                </ul>
                            </div>
                        </div>
                        <label>Nama Korban (<span style="color:red">*</span>)</label>
                        <input class="form-control" type="text" name="nama-korban" required>
                        <p class="hint">*Dengan memberikan nama Anda, Anda membantu proses investigasi menjadi lebih cepat</p>
                        <label>NIM Korban (Opsional)</label>
                        <input class="form-control" type="text" name="nim-korban" required>
                        <label>Jurusan Korban (<span style="color:red">*</span>)</label>
                        <select class="form-control" name="jurusan-korban" required>
                            <option value="" selected readonly hidden>Silahkan dipilih</option>
                            <option>Akuntansi</option>
                            <option>Desain Komunikasi Visual</option>
                            <option>Informatika</option>
                            <option>Ilmu Komunikasi</option>
                            <option>Sistem Informasi</option>
                            <option>Manajemen</option>
                            <option>Magister Manajemen</option>
                        </select>
                        <label>Nama Pelaku (<span style="color:red">*</span>)</label>
                        <input class="form-control" type="text" name="nama-pelaku" required>
                        <label>Waktu Kejadian (<span style="color:red">*</span>)</label>
                        <input class="form-control" type="date" name="waktu-kejadian" required>
                        <p class="hint">* Masukkan tanggal terakhir kejadian</p>
                        <label>Frekuensi Kejadian (<span style="color:red">*</span>)</label>
                        <select class="form-control" name="frekuensi-kejadian" required>
                            <option value="" selected readonly hidden>Silakan dipilih</option>
                            <option value="Jarang">Jarang (1 atau 2 kali dalam setahun)</option>
                            <option value="Kadang-kadang">Kadang-Kadang (1 atau 2 kali dalam sebulan)</option>
                            <option value="Sering">Sering (1 atau 2 kali dalam seminggu)</option>
                            <option value="Setiap Hari">Setiap Hari</option>
                        </select>
                        <label>Lokasi Kejadian (<span style="color:red">*</span>)</label>
                        <input class="form-control" type="text" name="lokasi-kejadian" required>
                        <label>Deskripsi Kejadian (<span style="color:red">*</span>)</label>
                        <textarea class="form-control" name="deskripsi-kejadian" col="5" rows="5" placeholder="Tuliskan deskripsi kejadian secara detil." required></textarea>
                        <label>Bukti Kejadian (Opsional)</label>
                        <input class="form-control" type="text" name="bukti-kejadian">
                        <div class='notice' style='display: flex;flex-direction: row; justify-content: space-evenly; align-items: baseline; padding: 2.5%;'>
                            <i class="fa-solid fa-circle-info" style="padding-left: 10px;padding-right: 10px"></i>
                            <p>Mohon untuk memastikan link yang diberikan dapat diakses oleh siapapun. Universitas Kalbis menjaga kerahasiaan data anda</p>
                        </div>
                        <label>Nomor yang dapat dihubungi (<span style="color:red">*</span>)</label>
                        <input class="form-control" type="text" name="nomor-hp" required>
                        <label>Email yang dapat dihubungi (<span style="color:red">*</span>)</label>
                        <input class="form-control" type="text" name="email-pelapor" required>

                        <div style="display: flex; flex-direction:column;margin-top: 50px">
                            <div class='notice' style='display: flex;flex-direction: row; align-items: baseline; background-color: #ff9595; color:black; padding: 2.5%'>
                                <i class="fa-solid fa-circle-info" style="padding-left: 10px;padding-right: 10px"></i>
                                <p>Mohon untuk mengecek kembali laporan anda! Laporan yang sudah diajukan tidak bisa diubah!</p>
                            </div>
                            <input type="submit" class="submit-button" name='submit-korban' value='Laporkan'>
                        </div>
                    </form>

                    <!-- Formulir Saksi -->
                    <form method="post" id="saksi-form" style="display: none">
                        <input type='hidden' name='status-pelapor' class='status-pelapor'>
                        <!-- <label>Status pelapor (<span style="color:red">*</span>)</label>
                        <select id="form-selector" class="form-control">
                            <option value="" selected readonly hidden>Silahkan dipilih</option>
                            <option value="korban">Korban</option>
                            <option value="saksi">Saksi</option>
                        </select> -->
                        <label>Jenis Perundungan (<span style="color:red">*</span>)</label>
                        <select class="form-control" name="jenis-kasus">
                            <option value="" selected readonly hidden>Silahkan dipilih</option>
                            <option value="Perundungan">Perundungan</option>
                            <option value="Kekerasan Seksual">Kekerasan Seksual</option>
                            <option value="Intoleransi">Intoleransi</option>
                        </select>
                        <label>Nama pelapor (Opsional)</label>
                        <input class="form-control" type="text" name="nama-pelapor" required>
                        <label>NIM pelapor (Opsional)</label>
                        <input class="form-control" type="text" name="nim-pelapor" required>
                        <div style="display: flex; flex-direction: column">
                            <label>Dampak Perundungan (<span style="color:red">*</span>)</label>
                            <div class="checkboxes">
                                <input type="checkbox" name="dampak-kasus[]" value="Physical"><label for="">Fisik</label>
                            </div>
                            <div class="checkboxes">
                                <input type="checkbox" name="dampak-kasus[]" value="Mental"><label>Mental</label>
                            </div>
                            <div class="notice">
                                <span style="display: flex; flex-direction: row; align-items: baseline"><i class="fa-solid fa-circle-info" style="padding-left: 10px;padding-right: 10px"></i><strong>Catatan: </strong></span>
                                <ul>
                                    <li>Dampak fisik termasuk dengan: Kekerasan Fisik, Pemerkosaan, Ancaman Kekerasan </li>
                                    <li>Dampak mental termasuk dengan: Penghinaan, Trauma, dan Gangguan Emosi
                                </ul>
                            </div>
                        </div>
                        <label>Nama Korban (<span style="color:red">*</span>)</label>
                        <input class="form-control" type="text" name="nama-korban" required>
                        <label>NIM Korban (<span style="color:red">*</span>)</label>
                        <input class="form-control" type="text" name="nim-korban" required>
                        <label>Pilih jurusan yang sedang ditempuh korban (<span style="color:red">*</span>)</label>
                        <select class="form-control" name="jurusan-korban" required>
                            <option value="" selected readonly hidden>Silahkan dipilih</option>
                            <option value="Akuntansi">Akuntansi</option>
                            <option value="Desain Komunikasi Visual">Desain Komunikasi Visual</option>
                            <option value="Informatika">Informatika</option>
                            <option value="Ilmu Komunikasi">Ilmu Komunikasi</option>
                            <option value="Sistem Informasi">Sistem Informasi</option>
                            <option value="Manajemen">Manajemen</option>
                            <option value="Magister Manajemen">Magister Manajemen</option>
                        </select>
                        <label>Nama Pelaku (<span style="color:red">*</span>)</label>
                        <input class="form-control" type="text" name="nama-pelaku" required>
                        <label>Waktu Kejadian (<span style="color:red">*</span>)</label>
                        <input class="form-control" type="date" name="waktu-kejadian" required>
                        <p class="hint">* Masukkan tanggal terakhir kejadian</p>
                        <label>Frekuensi Kejadian (<span style="color:red">*</span>)</label>
                        <select class="form-control" name='frekuensi-kejadian' required>
                            <option value="" selected readonly hidden>Silakan dipilih</option>
                            <option value="Jarang">Jarang (1 atau 2 kali dalam setahun)</option>
                            <option value="Kadang-kadang">Kadang-Kadang (1 atau 2 kali dalam sebulan)</option>
                            <option value="Sering">Sering (1 atau 2 kali dalam seminggu)</option>
                            <option value="Setiap Hari">Setiap Hari</option>
                        </select>
                        <label>Lokasi Kejadian (<span style="color:red">*</span>)</label>
                        <input class="form-control" type="text" name="lokasi-kejadian">
                        <label>Deskripsi Kejadian dan Kronologis Waktu (<span style="color:red">*</span>)</label>
                        <textarea class="form-control" name='deskripsi-kejadian' col="5" rows="5" placeholder="Tuliskan deskripsi kejadian dan kronologis waktu secara detil. "></textarea>
                        <label>Bukti Kejadian (Opsional)</label>
                        <input class="form-control" type="text" name="bukti-kejadian">
                        <div class='notice' style='display: flex;flex-direction: row; justify-content: space-evenly; align-items: baseline; padding: 2.5%;'>
                            <i class="fa-solid fa-circle-info" style="padding-left: 10px;padding-right: 10px"></i>
                            <p>Mohon untuk memastikan link yang diberikan dapat diakses oleh siapapun. Universitas Kalbis menjaga kerahasiaan data anda</p>
                        </div>
                        <label>Nomor yang dapat dihubungi (<span style="color:red">*</span>)</label>
                        <input class="form-control" type="text" name="nomor-hp">
                        <label>Email yang dapat dihubungi (<span style="color:red">*</span>)</label>
                        <input class="form-control" type="text" name="email-pelapor">
                        <div style="display: flex; flex-direction:column;margin-top: 50px">
                            <div class='notice' style='display: flex;flex-direction: row; align-items: baseline; background-color: #ff9595; color:black; padding: 2.5%'>
                                <i class="fa-solid fa-circle-info" style="padding-left: 10px;padding-right: 10px"></i>
                                <p>Mohon untuk mengecek kembali laporan anda! Laporan yang sudah diajukan tidak bisa diubah!</p>
                            </div>
                            <input type="submit" class="submit-button" name='submit-saksi' value='Laporkan'></button>
                        </div>
                    </form>
                </div>
            </div>
        </section>
    </div>

    <script>
        $(document).ready(function() {

            $("#korban-form").show();
            $("#saksi-form").hide();
            $('#form-selector').change(function() {
                var selectedValue = $(this).val();
                $('.status-pelapor').val(selectedValue);
                if (selectedValue === "korban") {
                    $("#korban-form").show();
                    $("#saksi-form").hide();
                } else if (selectedValue === "saksi") {
                    $("#korban-form").hide();
                    $("#saksi-form").show();
                }
            });


        });
    </script>
</body>


</html>