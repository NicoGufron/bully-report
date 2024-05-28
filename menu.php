<?php
session_start();

?>
<div class='navbar-top'>
    <div style="display: flex; flex-direction: row; align-items:center;">
        <button class="offcanvas-menu" data-bs-toggle="offcanvas" data-bs-target="#offcanvasLeft" aria-controls="offcanvasLeft" style="background-color: transparent; color: #384C67; border: 0px"><i class="fa-solid fa-bars fa-xl"></i></button>
        <h4>Selamat datang, <?= $_SESSION['username'] ?></h4>
    </div>
    <span><a href='logout.php' class='logout-button'><i class="fa-solid fa-right-from-bracket"></i>Keluar</a></span>
</div>
<div class="offcanvas offcanvas-start" tabindex="-1" id="offcanvasLeft" aria-labelledby="offcanvasExampleLabel">
    <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="offcanvasExampleLabel">Dashboard Admin</h5>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
    </div>
    <div class="offcanvas-body">
        <h5 style="color: gray;margin-top:35px;margin-bottom: 15px">MENU</h5>
        <a class="offcanvas-nav-link nav-link" href="dashboard.php"><i class="fa-solid fa-box fa-lg"></i>Dashboard</a>
        <a class="offcanvas-nav-link nav-link" href="assign-case-list.php"><i class="fa-solid fa-file fa-lg"></i>Kasus Yang di Tugaskan</a>
        <a class="offcanvas-nav-link nav-link" href="completed-case-list.php"><i class="fa-solid fa-clipboard-check fa-lg"></i>Kasus Selesai</a>
    </div>
</div>