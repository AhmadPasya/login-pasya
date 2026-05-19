<?php
session_start();
include "config.php";

$message = "";

if ($_SERVER["REQUEST_METHOD"] == "POST") {

    if (!isset($_POST['email']) || !isset($_POST['password'])) {
        $message = "Form tidak lengkap 😹";
    } else {

        $email = $_POST['email'];
        $password = $_POST['password'];

        $stmt = $conn->prepare("SELECT id, username, password FROM users WHERE email = ?");
        $stmt->bind_param("s", $email);
        $stmt->execute();

        $result = $stmt->get_result();

        if ($result->num_rows > 0) {

            $user = $result->fetch_assoc();

            if (password_verify($password, $user['password'])) {

                $user_id = $user['id'];
                $ip = $_SERVER['REMOTE_ADDR'];

                $_SESSION['user_id'] = $user_id;
                $_SESSION['username'] = $user['username'];

                // login history
                $log = $conn->prepare("INSERT INTO login_history (user_id, ip_address) VALUES (?, ?)");
                $log->bind_param("is", $user_id, $ip);
                $log->execute();

                $message = "Login berhasil 😹🔥";

            } else {
                $message = "Password salah 😹";
            }

        } else {
            $message = "Email tidak ditemukan 😹";
        }
    }
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Page</title>

    <link rel="stylesheet" href="login.css">
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
</head>

<body>

<div class="right">
    <div class="login-box">

        <h1>Login</h1>

        <!-- PESAN LOGIN -->
        <?php if ($message != "") : ?>
            <p style="color:white; text-align:center;">
                <?php echo $message; ?>
            </p>
        <?php endif; ?>

        <!-- LOGIN FORM -->
        <form action="" method="POST">

            <div class="input-box">
                <input type="email" name="email" placeholder="Email" required>
            </div>

           <div class="input-box">
    <input type="password" id="password" placeholder="Password">

    <i class="fa-solid fa-eye-slash" id="togglePassword"></i>
</div>

            <button class="btn" type="submit">Login</button>

        </form>

        <p class="register-text">
            Belum punya akun? <a href="register.php">Registrasi Disini</a>
        </p>

        <div class="divider">
            <span>atau</span>
        </div>

        <button class="google-btn">
            <img src="https://www.svgrepo.com/show/475656/google-color.svg" alt="google">
            <span>Lanjutkan Dengan Google</span>
        </button>

        <div class="social">
            <p>Follow Us</p>
            <div class="icons">
                <a href="#"><i class="fab fa-instagram"></i></a>
                <a href="#"><i class="fab fa-facebook"></i></a>
                <a href="#"><i class="fab fa-tiktok"></i></a>
            </div>
        </div>

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

<script src="login.js"></script>

</body>
</html>