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
        <section class="main-section">
            <h4 class="title">Selamat datang di Sistem Pelaporan Perundungan</h4>
            <p class="subtitle">Laporkan dan berantas bersama!</p>
            <div class="boxes">
                <div class="box">
                    <h5>Lapor Perundungan</h5>
                    <p>Laporkan kejadian perundungan untuk memberi suara pada korban dengan aman dan rahasia.</p>
                    <a href=""><button class="main-button">Lapor Perundungan</button></a>
                </div>
                <div class="box">
                    <h5>Cek Status Laporan</h5>
                    <p>Sudah pernah melapor? Cek proses laporan anda disini.</p>
                    <a href=""><button class="main-button">Cek Laporan Saya</button></a>
                </div>
            </div>
            <div class="hotline">
                <h4>Hubungi Hotline (Telepon atau Whatsapp)</h4>
                <span style="display: flex; flex-direction:row;align-items: baseline">
                    <i class="fa-solid fa-phone fa-lg" style="padding-right: 20px"></i>
                    <h4>0812-3456-7890</h4>
                </span>
                <p>Untuk aduan dan bentuk bantuan lainnya</p>
            </div>
            
        </section>
    </div>
</body>

</html>