<?php

require 'koneksi.php';

$sql = "SELECT barang.*, (SELECT COUNT(*) FROM kuantitas WHERE kuantitas.id_barang = barang.id_barang) as jumlah, (SELECT COUNT(*) FROM konfirmasi WHERE konfirmasi.id_barang = barang.id_barang) as jumlah_dipakai FROM `barang`";

$query = mysqli_query($koneksi, $sql);

// while ($result = mysqli_fetch_assoc($query)) {
  // var_dump($result);
// }

?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/css/bootstrap.min.css"
        integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">

    <script src="https://kit.fontawesome.com/f9069f9455.js" crossorigin="anonymous"></script>
    
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
        integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous">
    </script>
</head>

<body>
    <nav class="navbar " style="background-color:  #65B1D1;">
        <div class="body container-fluid">
            <h1 class="text-white">SIMPAN DESA</h1>
            <img src="img/man (1).png" alt="">
        </div>
    </nav>
    <section id="list-barang">
        <div class="container py-5">
          <h3 class="cart"><i class="fas fa-fw fa-shopping-cart"></i> <span id="jumlah_cart">0</span></h3>  
        <hr>
            <div class="row">
                <?php while ($result = mysqli_fetch_assoc($query)) : ?>
                <div class="col-md-3 my-3">
                    <div class="card">
                        <img class="card-img-top" src="img/<?= $result['gambar'] ?>" alt="Card image cap">
                        <div class="card-body">
                            <?= (($result['jumlah'] - $result['jumlah_dipakai']) > 0)?'<span class="badge badge-success">tersedia</span>':'<span class="badge badge-warning">tidak tersedia</span>'; ?>
                            <hr>
                            <h5 class="card-title"><?= $result['nama_barang'] ?></h5>
                            <p class="card-text">jumlah : <?= ($result['jumlah'] - $result['jumlah_dipakai']) ?> dari <?= $result['jumlah'] ?> </p>
                            <a href="#" class="btn btn-primary pinjam <?php if(($result['jumlah'] - $result['jumlah_dipakai']) <= 0) echo 'disabled'; ?>" data-id="<?= $result['id_barang'] ?>"><i class="fas fa-fw fa-plus"></i> Pinjam</a>
                        </div>
                    </div>
                </div>
                <?php endwhile; ?>
            </div>
        </div>

    </section>

    <script>

      let jumlah = [];
      
      $('.pinjam').on('click', function() {
        let id_barang = $(this).data('id');

        if (jumlah.includes(id_barang)) {
          alert('Barang sudah ada di cart');        
        } else {
          jumlah.push(id_barang);
        }

          $('#jumlah_cart').text(jumlah.length);

          $('#barang_input').val(jumlah.join(','));

          console.log(jumlah.join(','));
      });

    </script>

    <?php
      
    ?>

    <center class="mb-5">
      <form action="konfirmasiPeminjaman.php" method="post">
          <input type="hidden" id="barang_input" name="barang" value="">
          <button id="confirm" type="submit" class="btn btn-success">KONFIRMASI</button>
      </form>
    </center>

    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.3/umd/popper.min.js"
        integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous">
    </script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.1.3/js/bootstrap.min.js"
        integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous">
    </script>
</body>

</html>