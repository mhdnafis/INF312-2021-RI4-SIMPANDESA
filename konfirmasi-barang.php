<?php

require 'koneksi.php';

$id_barang = $_GET['konfirmasi'];
$user = $_GET['user'];

$sql = "UPDATE konfirmasi SET status_kembali = '1' WHERE id_konfirmasi = $id_barang";
$query = mysqli_query($koneksi, $sql);

header("location: detail-pinjam.php?id=".$user);
?>