<?php 
session_start();

require 'koneksi.php';

if (isset($_POST['submit'])) {
    $nik = $_POST['nik'];
    $password = $_POST['password'];

    $sql = "SELECT * FROM user WHERE nik = '$nik'";
    $query = mysqli_query($koneksi, $sql);
    $result = mysqli_fetch_assoc($query);
    if ($result) {
        if (password_verify($password, $result['pass'])) {
            
            $_SESSION["username"] = $result['nama'];
            $_SESSION["id_user"] = $result['id_user'];
            $_SESSION["hak_akses"] = $result['hak_akses'];
            $_SESSION["login"] = "true";

            if ($result['hak_akses'] == "admin") {
                header('location: admin.php');
            } else {
                header('location: index.php');
            }
            
        } else {
            echo "<script>alert('Password Salah')</script>";
        }
    } else {
        echo "<script>alert('Tidak ada user dengan nik tersebut')</script>";
    }
}

?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" href="img/SD.png">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
        integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <script src="https://kit.fontawesome.com/f9069f9455.js" crossorigin="anonymous"></script>

    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>
</head>

<body class="d-flex align-items-center" style="background: #38728B; height: 100vh; width: 100%">

    <div class="content text-white" style="width:100%">
        <h1 class="text-center" style="letter-spacing: 0.1em;">SIMPAN DESA</h1>
        <p class="text-center">Sistem Informasi Peminjaman Peralatan Desa</p>
        <div class="col-md-6 m-auto">
            <?php if (isset($_GET['status'])) : ?>
            <?php if ($_GET['status'] == "registered") : ?>
            <div class="alert alert-warning alert-dismissible fade show" role="alert">
                <strong>Selamat!</strong> Akun anda telah terdaftar! silahkan login.
                <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <?php endif; ?>
            <?php endif; ?>
            <hr>
            <form action="" method="post">
                <div class="form-group">
                    <input type="text" class="form-control form-control-lg" name="nik" id="nik"
                        placeholder="NIK (Nomor Induk Kependudukan)">
                </div>
                <div class="form-group">
                    <input type="password" class="form-control form-control-lg" name="password" id="password"
                        placeholder="Password">
                </div>
                <hr>
                <center>
                    <button type="submit" name="submit" class="btn" style="width: 100px">Submit</button>
                    <br>
                    <br>
                    <small class="mt-3">Belum Punya Akun ? <a class="text-warning"
                            href="register.php">Daftar</a></small>
                </center>


            </form>
        </div>
    </div>



    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"
        integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"
        integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous">
    </script>
</body>

</html>