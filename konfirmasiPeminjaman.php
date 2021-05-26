<?php

  require 'koneksi.php';

  $barang = $_POST['barang'];

  $ada = false;
  if ($barang) {
    $sql = "SELECT barang.*, (SELECT COUNT(*) FROM kuantitas WHERE kuantitas.id_barang = barang.id_barang) as jumlah FROM barang WHERE id_barang in ($barang)";
    $query = mysqli_query($koneksi, $sql);
    $ada = true;
  }

  // var_dump($query);
  // $item_barang = explode(',', $barang);
  // var_dump($item_barang);
?>

<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css"
        integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <title>Hello, world!</title>
    <script src="https://kit.fontawesome.com/f9069f9455.js" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.6.0.js" integrity="sha256-H+K7U5CnXl1h5ywQfKtSj8PCmoN9aaq30gDh27Xc0jk=" crossorigin="anonymous"></script>
</head>

<body>
    <nav class="navbar " style="background-color:  #65B1D1;">
        <div class="body container-fluid">
            <h1 class="text-white">SIMPAN DESA</h1>
            <img src="img/man (1).png" alt="">
        </div>
    </nav>

    <section class="py-5 mb-4">
        <div class="container">
            <h3>Konfirmasi peminjaman</h3>
            <hr>
            <?php if ($ada) : ?>
            <script>
            let kuantiti = [];
            </script>
            <ul class="list-unstyled">
                <?php $i = 0; while ($result = mysqli_fetch_assoc($query)) : ?>
                <li class="media mb-3">
                    <img class="mr-3" src="img/<?= $result['gambar'] ?>" alt="Generic placeholder image">
                    <div class="media-body">
                        <div class="content float-left mt-2">
                            <h5 class="mt-0 mb-1"><?= $result['nama_barang'] ?></h5>
                            <p>Stok : <?= $result['jumlah'] ?></p>
                            <hr>
                            <input placeholder="Masukan Jumlah" class="form-control form-control-sm" style="width:150px"
                                type="number" id="jumlah<?= $result['id_barang'] ?>" min="0" max="<?= $result['jumlah'] ?>" autocomplete="off">
                            <script>
                                $('#jumlah<?= $result['id_barang'] ?>').on('change', function () {
                                    kuantiti[<?= $i ?>] = `<?= $result['id_barang'] ?>, ${$(this).val()}`;
                                });
                            </script>
                        </div>
                        <!-- tong sampah masih kembali ke menu utama, belum jadi bisa dihapus data -->
                        <a href="index.php"><button type="button" class="btn btn-danger btn-lg float-right mt-5">
                        <i class="fas fa-fw fa-trash"></i></button></a>
                    </div>
                </li>
                <?php $i++; endwhile; ?>
            </ul>
            <hr>
            <h3>Data Lanjutan</h3>
            <br>
              <div class="row">
                <div class="col-md-6">
                    <div class="form-group">
                        <label for="tanggal_pinjam">Tanggal Peminjaman</label>
                        <input type="date" class="form-control form-control-sm" id="tanggal_pinjam"
                            placeholder="Masukan Tanggal Peminjaman">
                    </div>
                </div>
                <div class="col-md-6">
                  <div class="form-group">
                        <label for="tanggal_pengembalian">Tanggal Pengembalian</label>
                        <input type="date" class="form-control form-control-sm" id="tanggal_pengembalian"
                            placeholder="Masukan Tanggal Pengembalian">
                    </div>
                </div>
              </div> 
            <?php else : ?>
            <center>
                <h4>Tidak ada data!</h4>
            </center>
            <?php endif; ?>
            <hr>
            <a class="float-left btn btn-secondary" href="index.php"><i class="fas fa-fw fa-arrow-left"></i> kembali</a>
            <button id="konfirmasi" class="float-right btn btn-success text-white <?php if($ada == false) echo 'disabled'; ?>"  data-toggle="modal" data-target="#exampleModal"><i class="fas fa-fw fa-arrow-right"></i> Proses</button>
            </div>
        </div>
    </section>

    <section id="hidden_form_container"></section>

    <!-- Modal -->
    <div class="modal fade" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
        aria-hidden="true">
        <div class="modal-dialog  modal-dialog-centered" role="document">
            <div class="modal-content " style="background-color: #E2E2E2;">
                <div class="modal-header border-0">
                    <h3 class="modal-title m-auto" id="exampleModalLabel">keterangan </h3>
                    </button>
                </div>
                <div class="modal-body text-center"> <h5>

                  Terimakasih, peminjaman telah diproses.Harap segera datang ke gudang untuk mengambil barang.
                </h5>
                </div>
                <div class="modal-footer border-0">
                     <button id='konfirmasi_peminjaman' class="btn btn-primary m-auto">SELESAI !</button>
                </div>
            </div>
        </div>
    </div>

    <script>
        $("#konfirmasi_peminjaman").on('click',(e) => {
            let konfirmasi = confirm('yakin?');
            if (konfirmasi == true) {
                var theForm, newInput1, newInput2;
                // Start by creating a <form>
                theForm = document.createElement('form');
                theForm.action = 'konfirmasi.php';
                theForm.method = 'post';
                let i = <?= $i ?>;
                // Next create the <input>s in the form and give them names and values
                for (let index = 0; index < i; index++) {
                    console.log(kuantiti[index]);
                    newInput = document.createElement('input');
                    newInput.type = 'hidden';
                    newInput.name = `data${index+1}`;
                    newInput.value = kuantiti[index];
                    theForm.appendChild(newInput);
                }   

                tglpinjam = document.createElement('input');
                tglpinjam.type = 'hidden';
                tglpinjam.name = 'tanggal_pinjam';
                tglpinjam.value = $("#tanggal_pinjam").val();
                theForm.appendChild(tglpinjam);

                tglpengembalian = document.createElement('input');
                tglpengembalian.type = 'hidden';
                tglpengembalian.name = `tanggal_kembali`;
                tglpengembalian.value = $("#tanggal_pengembalian").val();
                theForm.appendChild(tglpengembalian);

                jumlah = document.createElement('input');
                jumlah.type = 'hidden';
                jumlah.name = `jumlah`;
                jumlah.value = i;
                theForm.appendChild(jumlah);
                
                // ...and it to the DOM...
                document.getElementById('hidden_form_container').appendChild(theForm);
                // ...and submit it
                theForm.submit();
            }
        })
    </script>

    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"
        integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"
        integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous">
    </script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"
        integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous">
    </script>
</body>

</html>