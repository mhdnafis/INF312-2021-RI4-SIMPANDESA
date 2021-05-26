<?php

include ('koneksi.php');

function query($query) {
	global $koneksi;
	$result = mysqli_query($koneksi, $query);
	$rows = [];
	while( $row = mysqli_fetch_assoc($result) ) {
		$rows[] = $row;
	}
	return $rows;
}

function registrasi($data) {
	global $koneksi;

	$nik = $data["nik"];
	$nama = strtolower(stripslashes($data["nama"]));
	$pass = mysqli_real_escape_string($koneksi, $data["pass"]);
	// $pass2 = mysqli_real_escape_string($conn, $data["pass2"]);


	// cek username sudah ada atau belum
	$result = mysqli_query($koneksi, "SELECT nik FROM user WHERE nik = 'nik'");

	if( mysqli_fetch_assoc($result) ) {
		echo "<script>
				alert('NIK anda sudah terdaftar')
		      </script>";
		return false;
	}

	// if( $pass !== $pass2 ) {
	// 	echo "<script>
	// 			alert('password tidak sesuai!');
	// 	      </script>";
	// 	return false;
	// }

	// enkripsi password
	$pass = password_hash($pass, PASSWORD_DEFAULT);

	// tambahkan userbaru ke database
	mysqli_query($koneksi, "INSERT INTO user VALUES('','$nama', '$nik', '$pass')");

	return mysqli_affected_rows($koneksi);

}





// session_start(); 
// include "config.php";

// if (isset($_POST['nama']) && isset($_POST['ttl'])
//     && isset($_POST['nik']) && isset($_POST['jkelamin']) 
//     && isset($_POST['email']) && isset($_POST['password'])
//     && isset($_POST[password2'])) {
        
//         function validate($data){
//             $data = trim($data);
//             $data = stripslashes($data);
//             $data = htmlspecialchars($data);
//             return $data;
//         }
        
//         $nama = validate($_POST['nama']);
//         $ttl = validate($_POST['ttl']);
//         $nik = validate($_POST['nik']);
//         $jkelamin = validate($_POST['jkelamin']);
//         $email = validate($_POST['email']);
//         $password = validate($_POST['password']);
//         $password2 = validate($_POST['password2']);
        
//         $user_data = 'nama='. $nama. '&email='. $email;
        
        
//         if (empty($nama)){
//             header("Location: register.php?error=Name is required&$user_data");
//             exit();
//         }else if(empty($ttl)){
//             header("Location: register.php?error=Birthdate is required&$user_data");
//             exit();
//         }else if(empty($nik)){
//             header("Location: register.php?error=NIK is required&$user_data");
//             exit();
//         }else if(empty($jkelamin)){
//             header("Location: register.php?error=Gender is required&$user_data");
//             exit();
//         }else if(empty($email)){
//             header("Location: register.php?error=Email is required&$user_data");
//             exit();
//         }else if(empty($password)){
//             header("Location: register.php?error=Password is required&$user_data");
//             exit();
//         }else if($password !== $password2){
//             header("Location: register.php?error=The confirmation password  does not match&$user_data");
//             exit();
//         }else{
//             // hashing the password
//             $password = md5($password);
//             $password2 = md5($password2);
            
//             $sql = "SELECT * FROM akun WHERE nama='$nama' ";
//             $result = mysqli_query($conn, $sql);
            
//             if (mysqli_num_rows($result) > 0) {
//                 header("Location: register.php?error=The username is taken try another&$user_data");
//                 exit();
//             }else {
//                 $sql2 = "INSERT INTO akun (nama, tgl_lahir, nik, jenis_kelamin, email, password, k_password) 
//                         VALUES('$nama', '$ttl', '$nik', '$jkelamin', '$email', '$password', '$password2')";
//                 $result2 = mysqli_query($conn, $sql2);
//                 if ($result2){
//                     header("Location: login.php?success=Your account has been created successfully");
//                     exit();
//                 }else{
//                     header("Location: register.php?error=unknown error occurred&$user_data");
//                     exit();
//                 }
//             }
//         }
//     }else{
//         header("Location: register.php");
//         exit();
//     }
?>