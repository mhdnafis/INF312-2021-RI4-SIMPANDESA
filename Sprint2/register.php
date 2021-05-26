<?php

require 'cek_regis.php';

if( isset($_POST["submit"]) ) {

    if( registrasi($_POST) > 0 ) {
        // echo "<script>
        //         alert('registrasi berhasil!');
        //       </script>";
        header("Location: login.php");
    } else {
        echo mysqli_error($koneksi);
    }

}

?>

<!DOCTYPE html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet'>

    <link rel="icon" href="assets/img/SD.png">
    <link rel="stylesheet" href="style.css">

    <title>Register</title>
  </head>

   <body>
    <nav class="navbar " style="background-color:  #65B1D1;" >
            <div class="body container-fluid" >
                <h1 class="paragraph fw-bold text-white">SIMPAN DESA</h1>
                <img src="img/man (1).png" alt="">
            </div>
        </nav>
    <div class="mx-5 mt-5">
    <h3 class="paragraph fw-bold text-black">Untuk mendaftar, mohon masukkan</h3>
    </div>

        <div class="row mx-5" >
            <div class="col-md-6 col-lg-4">
                <div class="login-wrap p-0">
                    <form method="post" action="" class="signin-form">
                        <div class="form-group" >
                            <label for="nik"></label>
                            <input type="text" name="nik" id="nik" class="form-control" placeholder="NIK" required>
                        </div>
                        <div class="form-group">
                            <label for="nama"></label>
                            <input type="text" name="nama" id="nama" class="form-control" placeholder="Nama" required>
                        </div>
                        <div class="form-group">
                            <label for="pass"></label>
                            <input id="password-field" type="password" name="pass" id="pass" class="form-control" placeholder="Password" required>
                        </div>
                        <p class="info mt-3">*Data Anda terjamin aman dan tidak akan disalahgunakan</p>
                    </form>
                    <div class="row justify-content-center tombol btn-group">
                        <button name="submit" class="form-control btn-lg mt-5" style="background-color: #B1F998;">Konfirmasi</button>
                    </div>
                </div>
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>

  </body>
</html>