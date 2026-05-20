<?php
include 'koneksi.php';

$query = mysqli_query($conn, "SELECT * FROM lowongan");

$data = [];

while($row = mysqli_fetch_assoc($query)){
    $data[] = $row;
}

echo json_encode($data);
?>