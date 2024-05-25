<?php 
require_once("connect.php");

// make an if of $_POST

if (isset($_POST['submit-sidenote'])) {
    $sidenote = $_POST['sidenote'];
    $nomorPengajuan = $_POST['nomor-pengajuan'];
    $progressReport = $_POST['progress-report'];
    $sql = "INSERT INTO notes (id, nomor_pengajuan, sidenote, assign_to) VALUES (0, '$nomorPengajuan', '$sidenote', '')";
    mysqli_query($conn, $sql);
    
    if ($progressReport === "1") {
        
    }
    else if ($progressReport === "2") {
        $sql = "UPDATE reports SET progress='$progressReport' WHERE nomor_pengajuan = '$nomorPengajuan'";
        mysqli_query($conn, $sql);
    }

    header("Location: dashboard.php");
}

?>