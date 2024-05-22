<?php
session_start();

?>

<!DOCTYPE html>
<html>

<head>
    <!-- <link rel="stylesheet" ref="style/style.css"> -->
</head>
<nav class="navbar navbar-expand-lg">
    <a class="navbar-brand" href="index.php">
        <img src="assets/images/logo.png">
        
    </a>
    <button class="drawer-menu" data-bs-toggle="offcanvas" data-bs-target="#offcanvasRight" aria-controls="offcanvasRight" style="background-color: transparent; color: #384C67; border: 1px solid black;border-radius: 10px; padding: 10px;"><i class="fa-solid fa-bars fa-xl"></i></button>
    <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
        <ul class="navbar-nav">
            <li class="nav-item active">
                <a class="nav-link" href="index.php">Beranda </a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="report.php">Lapor Perundungan</a>
            </li>
            <li class="nav-item">
                <a class="nav-link" href="about-us.php">Cek Status Laporan</a>
            </li>
        </ul>
    </div>

    <!-- BUAT MOBILE -->

    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasRight" aria-labelledby="offcanvasRightLabel">
        <div class="offcanvas-header">
            <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
        </div>
        <div class="offcanvas-body">
            <ul class="navbar-nav">
                <li class="nav-item active">
                    <a class="nav-link">Beranda </a>
                </li>
                <li class="nav-item">
                    <a class="nav-link">Lapor Perundungan</a>
                </li>
                <li class="nav-item">
                    <a class="nav-link">Cek Status Laporan</a>
                </li>
            </ul>
        </div>
    </div>
</nav>

</html>