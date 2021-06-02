<?php
session_start();

if ($_SESSION['login'] != "true") {
    header('location: login.php');
}

require 'koneksi.php';

$sql = "SELECT barang.*, (SELECT COUNT(*) FROM kuantitas WHERE kuantitas.id_barang = barang.id_barang) as jumlah, (SELECT COUNT(*) FROM konfirmasi WHERE konfirmasi.id_barang = barang.id_barang AND konfirmasi.status_kembali = 0) as jumlah_dipakai FROM `barang`";

$query = mysqli_query($koneksi, $sql);

require 'header.php';

?>

<section id="list-barang">
    <div class="container pt-3 pb-5">
        <h4>Selamat Datang,
            <span class="text-primary font-weight-bold"><?= $_SESSION['username'] ?></span>
        </h4>
        <hr>
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
                        <p class="card-text">jumlah : <?= ($result['jumlah'] - $result['jumlah_dipakai']) ?>
                            dari
                            <?= $result['jumlah'] ?> </p>
                        <a href="#"
                            class="btn btn-primary pinjam <?php if(($result['jumlah'] - $result['jumlah_dipakai']) <= 0) echo 'disabled'; ?>"
                            data-id="<?= $result['id_barang'] ?>"><i class="fas fa-fw fa-plus"></i>
                            Pinjam</a>
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
    <form action="konfirmasiPeminjaman.php" method="get">
        <input type="hidden" id="barang_input" name="barang" value="">
        <button id="confirm" type="submit" class="btn btn-success">KONFIRMASI</button>
    </form>
</center>

<?php require 'footer.php'; ?>