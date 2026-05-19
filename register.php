<?php
include "config.php";

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    $nama      = trim($_POST['nama']);
    $username  = trim($_POST['username']);
    $email     = trim($_POST['email']);
    $password  = trim($_POST['password']);
    $confirm   = trim($_POST['confirmPassword']);

    // VALIDASI
    if (
        empty($nama) ||
        empty($username) ||
        empty($email) ||
        empty($password) ||
        empty($confirm)
    ) {

        $message = "Semua form wajib diisi 😹";

    } elseif ($password !== $confirm) {

        $message = "Password tidak sama 😹";

    } else {

        $passwordHash = password_hash($password, PASSWORD_DEFAULT);

        // cek email
        $cek = $conn->prepare("SELECT id FROM users WHERE email = ?");
        $cek->bind_param("s", $email);
        $cek->execute();
        $cek->store_result();

        if ($cek->num_rows > 0) {

            $message = "Email sudah terdaftar 😹";

        } else {

            // simpan database
            $stmt = $conn->prepare("INSERT INTO users (nama, username, email, password) VALUES (?, ?, ?, ?)");

            $stmt->bind_param("ssss", $nama, $username, $email, $passwordHash);

            if ($stmt->execute()) {

                header("Location: login.php");
                exit();

            } else {

                $message = "Registrasi gagal 😹";
            }

            $stmt->close();
        }

        $cek->close();
    }

    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrasi</title>

    <link rel="stylesheet" href="registrasi.css">

    <!-- FONT AWESOME -->
    <link rel="stylesheet"
href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>

<body>

<div class="right">

    <div class="login-box">

        <h1>Registrasi</h1>

        <!-- PESAN -->
        <?php if ($message != "") : ?>
            <p style="color:white; text-align:center;">
                <?php echo $message; ?>
            </p>
        <?php endif; ?>

        <form action="" method="POST">

            <!-- NAMA -->
            <div class="input-box">
                <input type="text"
                name="nama"
                placeholder="Nama Lengkap"
                required>
            </div>

            <!-- USERNAME -->
            <div class="input-box">
                <input type="text"
                name="username"
                placeholder="Username"
                required>
            </div>

            <!-- EMAIL -->
            <div class="input-box">
                <input type="email"
                name="email"
                placeholder="Email"
                required>
            </div>

            <!-- PASSWORD -->
<div class="input-box">
    
    <input 
    type="password"
    id="password"
    name="password"
    placeholder="Password"
    required>

    <i class="fa-solid fa-eye-slash" id="togglePassword"></i>

</div>

<!-- CONFIRM PASSWORD -->
<div class="input-box">

    <input 
    type="password"
    id="confirmPassword"
    name="confirmPassword"
    placeholder="Konfirmasi Password"
    required>

    <i class="fa-solid fa-eye-slash" id="toggleConfirmPassword"></i>

</div>

            <!-- BUTTON -->
            <button type="submit" class="btn">
                Daftar
            </button>

        </form>

        <p class="register-text">
            Sudah punya akun?
            <a href="login.php">Login Disini</a>
        </p>

        <div class="divider">
            <span>atau</span>
        </div>

        <button class="google-btn">

            <img src="https://www.svgrepo.com/show/475656/google-color.svg">

            <span>Daftar Dengan Google</span>

        </button>

    </div>

</div>

<footer class="footer">

    <div class="footer-content">

        <a href="#">Tentang Kami</a>
        <a href="#">Kontak</a>
        <a href="#">Kebijakan Privasi</a>
        <a href="#">Pusat Bantuan</a>

    </div>

</footer>

<!-- JS -->
<script src="regis.js"></script>

</body>
</html>