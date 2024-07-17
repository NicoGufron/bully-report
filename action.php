<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require './PHPMailer/src/Exception.php';
require './PHPMailer/src/PHPMailer.php';
require './PHPMailer/src/SMTP.php';


function sendMail($to)
{
    $env = parse_ini_file('.env');
    $mail = new PHPMailer();

    try {
        $mail->isSMTP();

        // Sandbox Mailtrap
        // $mail->Host = 'sandbox.smtp.mailtrap.io';
        // $mail->Port = 2525;
        // $mail->Username = $env['SANDBOX_MAILTRAP_USERNAME'];
        // $mail->Password = $env['SANDBOX_MAILTRAP_PASSWORD'];


        // Live Mailtrap
        $mail->Host = 'live.smtp.mailtrap.io';
        $mail->SMTPAuth = true;
        $mail->Username = $env["LIVE_MAILTRAP_USERNAME"];
        $mail->Password = $env["LIVE_MAILTRAP_PASSWORD"];
        $mail->Port = 587;
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;

        $mail->isHTML();

        $mail->setFrom('mailtrap@demomailtrap.com', "Kalbis University");
        // 2020104938@student.kalbis.ac.id (email abi)
        $mail->addAddress($to);
        $mail->Subject = "Sistem Laporan Perundungan";
        $mail->Body = "<body width='600' style='margin: 0; padding: 0; color: black'>
            <center style='padding: 20px; border-radius:10px; background-color: #D1E7DD'>
                <div>
                    <table align='center' width='600px' style='margin: auto; width:600px;color:#0a3622'>
                        <tr>
                            <h2 style='text-align:center'>Sistem Laporan Perundungan<h2>
                                <p style='font-size: 14px;text-align:center;font-weight:bold;color: #0a3622'>
                                    Mohon untuk menyimpan, atau dengan mencatat nomor pengajuan ini!
                                </p>
                                <p style='text-align:center;font-size: 14px;color:#0a3622'>Terima kasih atas laporan anda! Nomor pengajuan anda: <br><br><span style='border-radius: 10px;padding: 5px; font-size: 20px;font-weight:bold'>#" . 12345 . "</p>
                        </tr>
                    </table>
                </div>
                <div style='background-color:#D54444; border-radius:10px;padding: 2.5%;width: 300px'>
                <table align='center' width='300px' style='margin: auto; width: 300px'>
                    <tr>
                        <h4 style='color: white;margin:0'>Hubungi Hotline (Telepon atau Whatsapp)</h4>
                        <h4 style='font-weight: 700;color: white;font-size: 20px;'>0812-3456-7890</h4>
                        <p style='color: white;margin:0'>Untuk aduan dan bentuk bantuan lainnya</p>
                    </tr>
                </table>
            </div>
            </center>
        </body>";
        $mail->AltBody = "Test AltBody";

        $mail->send();
    } catch (Exception $e) {
        echo "PHPMailer Error: {$mail->ErrorInfo}";
    }

    // $message = ;
}
require_once("connect.php");


$sql = "INSERT INTO reports (jenis_kasus, nama_pelapor, nim_pelapor, status_pelapor, dampak_kasus, nama_korban, email, nomor_hp, nim_korban, jurusan_korban, nama_pelaku, status_pelaku, waktu_kejadian, frekuensi_kejadian, lokasi_kejadian, deskripsi_kejadian, bukti_kejadian, nomor_pengajuan, progress, assign_to) VALUES";
/// random generator number
function generateNomorPengajuan(): string {
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
    $postStatusPelaku = $_POST['status-pelaku'];

    $postWaktuKejadian = $_POST['waktu-kejadian'];
    if (count($postWaktuKejadian) === 1) {
        $waktuKejadianList = $waktuKejadianList[0];
    } else {
        $waktuKejadianList = implode(', ', $postWaktuKejadian);
    }
    
    $postFrekuensiKejadian = $_POST['frekuensi-kejadian'];
    $postLokasiKejadian = $_POST['lokasi-kejadian'];
    $postDeskripsiKejadian = $_POST['deskripsi-kejadian'];
    $postNomorHP = $_POST['nomor-hp'];
    $postBuktiKejadian = $_POST['bukti-kejadian'];
    $postEmailPelapor = $_POST['email-pelapor'];

    $nomorPengajuan = '';
    $nomorPengajuan = generateNomorPengajuan();

    $values = $sql . "('$postJenisKasus', '', '', '$postStatusPelapor', '$dampakList', '$postNamaKorban', '$postEmailPelapor', '$postNomorHP', '$postNimKorban', '$postJurusanKorban', '$postNamaPelaku', '$postStatusPelaku', '$waktuKejadianList', '$postFrekuensiKejadian', '$postLokasiKejadian', '$postDeskripsiKejadian', '$postBuktiKejadian', '$nomorPengajuan', '1', '1')";
    $q = mysqli_query($conn, $values);
    if ($q) {
        $message = urlencode("success");
        sendMail($postEmailPelapor, $nomorPengajuan);
        header("Location: report.php?message=".$message."&code=".$nomorPengajuan."&role=korban");
    } else {
        $message = urlencode("failed");
        header("Location: report.php?message=".$message);
    }
}

if (isset($_POST["submit-saksi"])) {
    $postJenisKasus = $_POST["jenis-kasus"];
    $postStatusPelapor = $_POST['status-pelapor'];
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
    $postStatusPelaku = $_POST['status-pelaku'];
    $postWaktuKejadian = $_POST['waktu-kejadian'];
    $postFrekuensiKejadian = $_POST['frekuensi-kejadian'];
    $postLokasiKejadian = $_POST['lokasi-kejadian'];
    $postDeskripsiKejadian = $_POST['deskripsi-kejadian'];
    $postNomorHP = $_POST['nomor-hp'];
    $postEmailPelapor = $_POST['email-pelapor'];
    $postBuktiKejadian = $_POST['bukti-kejadian'];

    $nomorPengajuan = '';
    $nomorPengajuan = generateNomorPengajuan();

    $values = $sql . " ('$postJenisKasus', '$postNamaPelapor', '$postNimPelapor', '$postStatusPelapor', '$dampakList', '$postNamaKorban', '$postEmailPelapor', '$postNomorHP', '$postNimKorban', '$postJurusanKorban', '$postNamaPelaku', '$postStatusPelaku','$postWaktuKejadian', '$postFrekuensiKejadian', '$postLokasiKejadian', '$postDeskripsiKejadian', '$postBuktiKejadian', '$nomorPengajuan', '1', '1')";
    $q = mysqli_query($conn, $values);

    if ($q) {

        $message = urlencode("success");
        header("Location: report.php?message=".$message."&code=".$nomorPengajuan."&role=saksi");
        sendMail($postEmailPelapor, $nomorPengajuan);
    } else {
        $message = urlencode("failed");
        header("Location: report.php?message=".$message);
    }
}

if (isset($_POST['save-changes'])) {
    $assignTo = $_POST['assign-to'];
    $progressReport = $_POST['progress-report'];
    $nomorPengajuan = $_POST['nomor-pengajuan'];

    if ($progressReport == "2") {
        $assignTo = "0";
    }

    $sql = "UPDATE reports SET assign_to = '$assignTo', progress = '$progressReport' WHERE nomor_pengajuan = '$nomorPengajuan'";
    $q = mysqli_query($conn, $sql);
}

?>