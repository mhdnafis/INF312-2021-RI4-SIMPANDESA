<?php
// date_default_timezone_set('Asia/Jakarta');
$koneksi = mysqli_connect('localhost', 'root', 'root', 'simpandesa');

if (!$koneksi) {
    die('Database error : ' . mysql_error());
}