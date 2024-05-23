<?php
require_once("connect.php");
$result = "";
session_start();
if (isset($_SESSION["username"]) && isset($_SESSION['id'])) {
    header("Location: dashboard-admin.php");
} else {
    if ($_POST) {
        $username = $_POST["username"];
        $password = $_POST["password"];

        $sql = "SELECT * FROM accounts WHERE username = '$username' AND password = '$password' AND id_wijk = '6'";
        $q = mysqli_query($conn, $sql);

        while ($row = mysqli_fetch_assoc($q)) {
            $_SESSION['id'] = $row['id'];
        }
        $_SESSION['username'] = $username;

        $accountFound = mysqli_num_rows($q);

        if ($accountFound == 1) {
            $_SESSION['username'] = $username;
            $result = "<div class='alert alert-success' role='alert'>
                <i class='fa-solid fa-check' style='padding-right: 10px;padding-top: 5px'></i>
                Login berhasil!
            </div>";
            header("Refresh: 3, url= dashboard-admin.php");
        } else {
            $result = "<div class='alert alert-danger' role='alert'>
                <i class='fa-solid fa-xmark' style='padding-right: 10px;padding-top: 5px'></i>
                Gagal mengirim pengajuan kegiatan, mohon coba lagi!
            </div>";
        }
    }
}

?>
<!DOCTYPE html>
<html>

<head>
    <title>Akses Admin Panel</title>
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

<body>
    <div class="container-fluid">
        <section>
            <div class="container">

                <div class="admin-access">
                    <h3 class="title"> Akses Admin Panel</h3>
                    <div class="login-section">
                        <h3>Masuk ke Akun</h3>
                        <br>
                        <?= $result; ?>
                        <form class="form-group signup-form" method="post">
                            <label>Username</label>
                            <input class="form-control" type="text" name="username">
                            <p></p>
                            <label style="padding-top: 20px;">Kata Sandi</label>
                            <input class="form-control" type="password" name="password">
                            <button class="btn login-button">Masuk</button>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </div>
</body>

</html>