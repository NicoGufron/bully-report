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
include("navbar.php");
?>

<body>
    <div class="container-fluid">
        <section>
            <div class="container lapor-perundungan">
                <br>
                <form method="post">
                    <div class="formulir">
                        <h4 class="title" style="text-align: center";>Formulir Laporan Perundungan</h4>
                        <div class="notice">
                            <ul>
                                <li>Laporan dan data hanya bisa dilihat oleh Pelapor dan Tim Investigasi dari Universitas Kalbe.</li>
                                <li>Informasi Nama dan NIM Pelapor bersifat opsional, tetapi dibutuhkan untuk mempercepat proses investigasi.</li>
                                <li>Informasi Email Pelapor bersifat opsional, tetapi dibutuhkan untuk menerima status tracking laporan.</li>
                            </ul>
                        </div>
                        <label>Status pelapor (<span style="color:red">*</span>)</label>
                        <select class="form-control">
                            <option value="" selected readonly hidden>Silahkan dipilih</option>
                            <option>Korban</option>
                            <option>Saksi</option>
                        </select>
                        <label>Jenis Perundungan (<span style="color:red">*</span>)</label>
                        <select class="form-control">
                            <option value="" selected readonly hidden>Silahkan dipilih</option>
                            <option>Perundungan</option>
                            <option>Kekerasan Seksual</option>
                            <option>Intoleransi</option>
                        </select>
                        <label>Dampak Perundungan (<span style="color:red">*</span>)</label>
                        <div class="checkboxes">
                            <input type="checkbox"><label for="">Physical</label>
                        </div>
                        <div class="checkboxes">
                            <input type="checkbox"><label>Mental</label>
                        </div>
                        <label>Nama Korban (<span style="color:red">*</span>)</label>
                        <input class="form-control" type="text" name="nama-korban" required>
                        <p class="hint">*Dengan memberikan nama Anda, Anda membantu proses investigasi menjadi lebih cepat</p>
                        <label>NIM Korban (Opsional)</label>
                        <input class="form-control" type="text" name="nim-korban" required>
                        <label>Jurusan Korban (<span style="color:red">*</span>)
                        <select class="form-control">
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
                        <input class="form-control" type="text" name="nama-pelaku">
                        <label>Waktu Kejadian (<span style="color:red">*</span>)</label>
                        <input class="form-control" type="date" name="nama-korban">
                        <p class="hint">* Masukkan tanggal terakhir kejadian</p>
                        <label>Frekuensi Kejadian (<span style="color:red">*</span>)</label>
                        <select class="form-control">
                            <option>Jarang (1 atau 2 kali dalam setahun)</option>
                            <option>Kadang-Kadang (1 atau 2 kali dalam sebulan)</option>
                            <option>Sering (1 atau 2 kali dalam seminggu)</option>
                            <option>Setiap Hari</option>
                        </select>
                        <label>Lokasi Kejadian (<span style="color:red">*</span>)</label>
                        <input class="form-control" type="text" name="nama-korban">
                        <label>Deskripsi Kejadian (<span style="color:red">*</span>)</label>
                        <textarea class="form-control" col="5" rows="5" placeholder="Tuliskan deskripsi kejadian secara detil. "></textarea>
                        <label>Nomor yang dapat dihubungi (<span style="color:red">*</span>)</label>
                        <input class="form-control" type="text" name="nomor-hp">
                        <label>Email yang dapat dihubungi (<span style="color:red">*</span>)</label>
                        <input class="form-control" type="text" name="email-korban">

                        <div style="display: flex; flex-direction:column;margin-top: 50px">
                            <button type="submit" class="submit-button">Ajukan Laporan</button>
                        </div>
                    </div>
                </form>
            </div>
        </section>
    </div>

</body>

</html>