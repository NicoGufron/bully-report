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
                        <input type="submit" value="Cek Laporan">
                    </div>
                </form>
            </div>
        </section>
    </div>
</body>

</html>