<?php
include "koneksi.php";

$posisi = $_POST['posisi'];
$lokasi = $_POST['lokasi'];

$query = "INSERT INTO lamaran(posisi,lokasi)
VALUES('$posisi','$lokasi')";

mysqli_query($conn, $query);

echo "success";
?>