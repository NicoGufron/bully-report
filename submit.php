<?php 
require_once("connect.php");

if (isset($_POST['submit-sidenote'])) {
    $commenter = $_POST['commenter'];
    $comment = $_POST['comment'];
    $assigned = $_POST['assign-to'];
    $nomorPengajuan = $_POST['nomor-pengajuan'];
    $progressReport = $_POST['progress-report'];
    $waktu_komen = date("d-M-Y H:i");

    // jika komen tidak kosong
    if ($comment != "") {
        $sql = "INSERT INTO notes (id, nomor_pengajuan, comment, waktu_komen, commenter) VALUES (0, '$nomorPengajuan', '$comment', '$waktu_komen', '$commenter')";
        mysqli_query($conn, $sql);
        
    } else {
        $sql = "INSERT INTO notes (id, nomor_pengajuan, comment, waktu_komen, commenter) VALUES (0, '$nomorPengajuan', '$comment', '$waktu_komen', '$commenter')";
    }

    $sql = "UPDATE reports SET progress='$progressReport', assign_to = '$assigned' WHERE nomor_pengajuan = '$nomorPengajuan'";
    mysqli_query($conn, $sql);
}

?>