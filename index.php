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

$pertanyaan = [
    "Bagaimana cara untuk lapor perundungan?",
    "Apa itu perundungan?",
    "Apa saja tipe perundungan?",
    "Apabila tidak memiliki bukti, apa yang saya harus lakukan?",
    "Apa saja peraturan UU yang dianggap berhubungan dengan perundungan?",
];

$jawaban = [
    "Pelapor dapat menekan tombol <b>Lapor Perundungan</b> untuk melapor perundungan yang terjadi, dan memasukkan informasi yang dibutuhkan. Pelapor diharapkan untuk selalu aktif untuk mempermudah proses investigasi perundungan. 
    
    Apabila sudah mengajukan laporan, maka pelapor akan mendapatkan kode untuk melacak proses pelaporan tersebut.",
    "Perundungan adalah sebuah tingkah laku yang terjadi dengan tujuan menyakiti orang lain baik secara fisik maupun mental, baik secara langsung maupun tidak langsung, dan bisa terjadi sekali maupun berulang kali.",
    "Perundungan dibagi 3 tipe:
    1. Tradisional, yaitu perundungan secara fisik, verbal dan emosional, mencakup tindakan seperti memukul, menendang, mengejek, menghina dan tindakan lain yang bertujuan untuk menyakiti secara langsung.

    2. Seksual, yaitu perundungan yang mengganggu secara seksual
    
    3. <i>Cyberbullying</i>, yaitu perundungan yang terjadi melalui teknologi seperti media sosial, pesan teks dan platform online lainnya.",
    "Apabila pelapor tidak memiliki bukti, maka SATGAS akan mengadakan pertemuan dengan pelapor. Pelapor diminta untuk menyampaikan setiap detil dan menuliskan kronologis pada formulir secara manual.\n\nSesi diskusi dilakukan untuk menggali lebih dalam informasi dari pelapor, seluruh percakapan direkam dan terjadi selama 30 menit hingga 1 jam untuk mencari informasi dan sebagai bukti.",
    ""
];
?>

<body>
    <div class="container-fluid">
        <section class="main-section">
            <h4 class="title" style="text-align:center">Selamat datang di Sistem Pelaporan Perundungan</h4>
            <p class="subtitle" style="text-align:center">Laporkan dan berantas bersama!</p>
            <div class="boxes">
                <div class="box">
                    <h5><strong>Lapor Perundungan</strong></h5>
                    <p>Laporkan kejadian perundungan untuk memberi suara pada korban dengan aman dan rahasia.</p>
                    <a href="report.php"><button class="main-button">Lapor Perundungan</button></a>
                </div>
                <div class="box">
                    <h5><strong>Cek Status Laporan</strong></h5>
                    <p>Sudah pernah melapor? Cek proses laporan anda disini.</p>
                    <a href="check-report.php"><button class="main-button">Cek Laporan Saya</button></a>
                </div>
            </div>
            <div class="accordionFaq">
                <h4 class="title" style="text-align: left;">Pertanyaan yang sering ditanyakan</h4>
                <br>
                <div class="accordion home">
                    <?php
                    for ($i = 0; $i < count($pertanyaan); $i++) {
                        echo "<h2 class='accordion-header' id='heading'>
                            <button class='accordion-button' type='button' data-bs-toggle='collapse' data-bs-target='#collapse$i' aria-expanded='false' aria-controls='collapse'>
                                <strong>$pertanyaan[$i]</strong>
                            </button>
                        </h2>
                        <div id='collapse$i' class='accordion-collapse collapse' aria-labelledby='headingOne' data-bs-parent='#accordionExample'>
                            <div class='accordion-body'>
                                " . nl2br($jawaban[$i]) . "
                            </div>
                        </div>";
                    }
                    ?>
                    <div class="accordion-item">

                    </div>
                </div>
            </div>
            <div class="hotline">
                <div class="hotline-box">
                    <h4>Hubungi Hotline (Telepon atau Whatsapp)</h4>
                    <span style="display: flex; flex-direction:row;align-items: baseline">
                        <i class="fa-solid fa-phone fa-lg" style="padding-right: 20px"></i>
                        <h4>0812-3456-7890</h4>
                    </span>
                    <p>Untuk aduan dan bentuk bantuan lainnya</p>
                </div>
            </div>

        </section>
    </div>
</body>

</html>