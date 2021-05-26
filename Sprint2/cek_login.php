<?php 
// mengaktifkan session pada php
//session_start();

// menghubungkan php dengan koneksi database
include 'koneksi.php';

// menangkap data yang dikirim dari form login
$nik = $_POST['nik'];
$pass = $_POST['pass'];

$sql = "select * from user where nik = '$nik'";
$result = $koneksi-> query($sql);
$row = $result->fetch_assoc();

if($row){
	// verifikasi nik
	if($row["pass"]){
            // buat Session
            session_start();
            $_SESSION["row"] = $row;
            // login sukses, alihkan ke halaman timeline
            header("Location:homepage.php");
        }else{
        	// buat session login dan username
			$_SESSION['nik'] = $nik;
			$_SESSION['status'] = "login";
		// alihkan ke halaman dashboard 
			header("location:login.php?pesan=gagal");
        }
		
}else{
	header("location:login.php?pesan=gagal");
}

?>