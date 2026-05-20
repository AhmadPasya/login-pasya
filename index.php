<?php
$conn = mysqli_connect("localhost", "root", "", "lokerinaja");

if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}
?>

<!DOCTYPE html>
<html lang="id">
<head>
<meta charset="UTF-8">
<title>LOKERINAJA</title>

<link rel="stylesheet" href="style.css">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css">
</head>

<body>

<nav class="navbar">
    <div class="logo">
    <img src="logo.png" alt="Lokerinaja Logo">  
</div>

    <div class="nav-center">
        <ul class="menu">
            <li><a href="index.php">Home</a></li>
            <li><a href="Daftarlowongan.php">Daftar Lowongan</a></li>
        </ul>
    </div>

    <div class="nav-right">
        <select class="nav-lokasi">
            <option value="">Semua Lokasi</option>
            <option value="jakarta">Jakarta</option>
            <option value="bandung">Bandung</option>
            <option value="surabaya">Surabaya</option>
            <option value="medan">Medan</option>
        </select>

        <div class="profile">PROFILE</div>
    </div>
</nav>

<section class="hero">
<div class="overlay">
<h1>Temukan Lowongan Kerja Impianmu</h1>

<div class="search-box">
<input type="text" placeholder="Cari pekerjaan...">
<input type="text" placeholder="Lokasi...">
<button>Cari</button>
</div>
</div>
</section>

<section class="testimoni">
<h2>Apa Kata Mereka?</h2>

<div class="testi-list">

<div class="testi">
<p>"Aku dapet kerja dalam 2 minggu lewat Lokerinaja!"</p>
<h4>- Andi</h4>
</div>

<div class="testi">
<p>"Web nya gampang banget dipakai, recommended!"</p>
<h4>- Sinta</h4>
</div>

</div>
</section>

<section class="kategori">
<h2>Kategori Populer</h2>

<div class="kategori-grid">
<div class="card" data-kategori="it">IT</div>
<div class="card" data-kategori="marketing">Marketing</div>
<div class="card" data-kategori="admin">Admin</div>
<div class="card" data-kategori="retail">Retail</div>
<div class="card" data-kategori="human resource">Human Resource</div>
<div class="card" data-kategori="teknisi">Teknisi</div>
<div class="card" data-kategori="akutansi & keuangan">Akutansi & Keuangan</div>
</div>
</section>

<section class="jobs">
<h2>Lowongan Terbaru</h2>

<div class="job-list">
    <?php
    $query = "SELECT * FROM lowongan";
    $result = mysqli_query($conn, $query);

    while ($row = mysqli_fetch_assoc($result)) {
    ?>
    <div class="job-card" data-kategori="<?php echo $row['kategori']; ?>">
        <img src="<?php echo $row['gambar']; ?>">

        <h3><?php echo $row['posisi']; ?></h3>

        <span class="location"><?php echo $row['lokasi']; ?></span> 

        <button 
        class="apply-btn"
        data-id="<?php echo $row['id']; ?>"
        data-posisi="<?php echo $row['posisi']; ?>"
        data-lokasi="<?php echo $row['lokasi']; ?>">
        Apply
        </button>
    </div>
    <?php } ?>
</div>
</section>

<section class="featured">
<h2>🔥 Lowongan Unggulan</h2>

<div class="featured-list">

<div class="featured-card">
<img src="job1.png">
<div class="featured-info">
<h3>Senior Frontend Developer</h3>
<p>PT Digital Tech • Jakarta</p>
<button>Lihat Detail</button>
</div>
</div>

<div class="featured-card">
<img src="job2.png">
<div class="featured-info">
<h3>UI/UX Designer</h3>
<p>Creative Studio • Bandung</p>
<button>Lihat Detail</button>
</div>
</div>

</div>
</section>

<footer class="footer">
<div class="footer-container">

<div class="footer-col">
<h3>LOKERINAJA</h3>
<p>Dapatkan info lowongan kerja terbaru langsung ke email kamu</p>
<form class="subscribe">
<input type="email" placeholder="Masukkan email">
<button type="button">➤</button>
</form>
</div>

<div class="footer-col">
<h3>Kontak</h3>
<p>Jl. Sudirman No.123, Jakarta</p>
<p>lokerinaja@gmail.com</p>
<p>+62 812-3456-7890</p>
</div>

<div class="footer-col">
<h3>Akun</h3>
<p>My Account</p>
<p>Login / Register</p>
<p>Wishlist</p>
<p>Lowongan</p>
</div>

<div class="footer-col">
<h3>Link Cepat</h3>
<p>Privacy Policy</p>
<p>Terms Of Use</p>
<p>FAQ</p>
<p>Contact</p>
</div>

<div class="footer-col">
<h3>Download App</h3>
<p>Download aplikasi Lokerinaja</p>
<img src="https://api.qrserver.com/v1/create-qr-code/?size=100x100" class="qr">

<div class="social">
<a href="#"><i class="fab fa-facebook-f"></i></a>
<a href="#"><i class="fab fa-instagram"></i></a>
<a href="#"><i class="fab fa-linkedin-in"></i></a>
</div>
</div>

</div>

<div class="footer-bottom">
©️ 2026 Lokerinaja. All rights reserved.
</div>
</footer>

<a href="#" class="wa">💬</a>

<script src="script.js"></script>
</body>
</html>