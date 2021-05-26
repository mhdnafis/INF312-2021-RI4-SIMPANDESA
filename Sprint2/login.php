<!DOCTYPE html>
<html lang="en">
  <head>
    
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-eOJMYsd53ii+scO/bJGFsiCZc+5NDVN2yr8+0RDqr0Ql0h+rP48ckxlpbzKgwra6" crossorigin="anonymous">
    <link href='https://fonts.googleapis.com/css?family=Montserrat' rel='stylesheet'>

    <link rel="icon" href="assets/img/SD.png">
    <link rel="stylesheet" href="style.css">

    <title>Login</title>
  </head>

  <body class="container" style="background-color:#38728B">
    
    <div class="jumbotron text-center">
    <h1 class="body fw-bold text-white">SIMPAN DESA</h1>   
    <p class="paragraph text-white">Sistem Informasi Peminjaman<br>Peralatan Desa</p>
    </div>

        <div class="row justify-content-center">
            <div class="col-md-6 col-lg-4">
                <div class="login-wrap p-0">
                    <form action="cek_login.php" class="signin-form" method="post">
                        <div class="form-group">
                            <label for="nik"></label>
                            <input type="text" name="nik" id="nik" class="form-control" placeholder="NIK" required>
                        </div>
                        <div class="form-group">
                            <label for="pass"></label>
                            <input id="password-field" type="password" name="pass" id="pass" class="form-control" placeholder="Password" required>
                        </div>
                        <?php 
                            if(isset($_GET['pesan'])){
                                if($_GET['pesan']=="gagal"){
                                    echo "<div class='alert text-white'>Username dan Password tidak sesuai !</div>";
                                }
                            }
                        ?>
                        <div class="tombol btn-group justify-content-center">
                            <button type="submit" name="masuk" class="margin fw-bold form-control btn-white btn-lg mt-5">Masuk</button>
                        </div>
                    </form>
                    <div class="justify-content-center text-center mt-3">
                       <p class="text-white"> Belum punya akun? <a href="register.php" style="color: #8ba7ff" class="text-decoration-underline">daftar</a> </p>
                    </div>
                </div>
            </div>
        </div>

        <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.0-beta3/dist/js/bootstrap.bundle.min.js" integrity="sha384-JEW9xMcG8R+pH31jmWH6WWP0WintQrMb4s7ZOdauHnUtxwoG2vI5DkLtS3qm9Ekf" crossorigin="anonymous"></script>

  </body>
</html>