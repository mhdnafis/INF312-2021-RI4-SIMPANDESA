<?php
session_start();

if ($_SESSION['login'] != "true") {
    header('location: login.php');
}

  require 'koneksi.php';

  $barang = $_GET['barang'];

  if (isset($_GET['remove'])) {
    $remove = $_GET['remove'];
    echo 'hapus barang dengan id ' . $remove;
    echo '<br>';
    
    $barangs = explode(',', $barang);

    $newbarang = '';

    $no = 1;
    for ($i=0; $i < count($barangs); $i++) { 
        if ($barangs[$i] != $remove) {
            if ($no != 1) {
                $newbarang .= ',';
            }
           $newbarang .= $barangs[$i];
           $no++;
        }
    }

    header('location: konfirmasiPeminjaman.php?barang='.$newbarang);
  }

  $ada = false;
  if ($barang) {
    $sql = "SELECT barang.*, (SELECT COUNT(*) FROM kuantitas WHERE kuantitas.id_barang = barang.id_barang) as jumlah FROM barang WHERE id_barang in ($barang)";
    $query = mysqli_query($koneksi, $sql);
    $ada = true;
  }

  require 'header.php';
?>

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
                            type="number" id="jumlah<?= $result['id_barang'] ?>" min="0" max="<?= $result['jumlah'] ?>"
                            autocomplete="off">
                        <script>
                        $('#jumlah<?= $result['id_barang'] ?>').on('change', function() {
                            kuantiti[<?= $i ?>] = `<?= $result['id_barang'] ?>, ${$(this).val()}`;
                        });
                        </script>
                    </div>
                    <!-- tong sampah masih kembali ke menu utama, belum jadi bisa dihapus data -->
                    <a href="konfirmasiPeminjaman.php?barang=<?= $barang ?>&remove=<?= $result['id_barang'] ?>"><button
                            type="button" class="btn btn-danger btn-lg float-right mt-5">
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
        <hr>
        <a class="float-left btn btn-secondary" href="index.php"><i class="fas fa-fw fa-arrow-left"></i> kembali</a>
        <button id="konfirmasi" class="float-right btn btn-success text-white" data-toggle="modal"
            data-target="#exampleModal"><i class="fas fa-fw fa-arrow-right"></i> Proses</button>
    </div>
    <?php else : ?>
    <center>
        <h4>Tidak ada data!</h4>
        <hr>
        <a class="float-left btn btn-secondary" href="index.php"><i class="fas fa-fw fa-arrow-left"></i> kembali</a>
        <button id="konfirmasi" class="float-right btn btn-success text-white disabled"><i
                class="fas fa-fw fa-arrow-right"></i> Proses</button>
        </div>
    </center>
    <?php endif; ?>

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
            <div class="modal-body text-center">
                <h5>

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
$("#konfirmasi_peminjaman").on('click', (e) => {
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

<?php require 'footer.php'; ?>