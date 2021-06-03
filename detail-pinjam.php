<?php
session_start();

require "koneksi.php";

if ($_SESSION['login'] != "true") {
    header('location: login.php');
}

if ($_SESSION['hak_akses'] == 'user') {
    header("location: index.php");
}

include "header.php";

$id_user = $_GET['id'];

$sql = "SELECT * FROM konfirmasi JOIN barang ON konfirmasi.id_barang=barang.id_barang WHERE konfirmasi.id_user = $id_user ORDER BY konfirmasi.status_kembali ASC";
$query = mysqli_query($koneksi, $sql);

// $sql_card_info = "SELECT (SELECT count(*) FROM barang) as jumlah_barang, (SELECT count(*) FROM user) as jumlah_user, (SELECT count(DISTINCT id_user) FROM konfirmasi) as jumlah_peminjam";
// $query_info = mysqli_query($koneksi, $sql_card_info);
// $result_info = mysqli_fetch_assoc($query_info);

?>

<div class="container py-5">
    <h3>Konfirmasi Pengembalian</h3>
    <hr>
    <ul class="list-unstyled">
        <?php while ($result = mysqli_fetch_assoc($query)) : ?>
        <div class="media">
            <img class="align-self-start mr-3" src="img/<?= $result['gambar'] ?>" height="60"
                alt="Generic placeholder image">
            <div class="media-body">
                <h5 class="mt-0"><?= $result['nama_barang'] ?></h5>
                <p>Durasi : <strong><i><?= date("d F Y  ", $result['tgl_pinjem']) ?></i></strong> sampai <strong><i
                            class="text-danger">
                            <?= date("d F Y  ", $result['tgl_kembali']) ?> </i></strong>
                </p>
            </div>
            <?php if ($result['status_kembali'] == 0): ?>
            <a href="konfirmasi-barang.php?konfirmasi=<?= $result['id_konfirmasi'] ?>&user=<?= $id_user ?>"
                class="btn mt-3 btn-warning">Confirm
                Item <i class="far fa-fw fa-square"></i></a>
            <?php else : ?>
            <button class="btn mt-3 btn-success disabled">Confirmed
                <i class="fas fa-fw fa-check-square"></i></button>
            <?php endif; ?>
        </div>
        <hr>
        <?php endwhile; ?>
    </ul>
    <a href="admin.php"><i class="fas fa-fw fa-arrow-left"></i> Kembali</a>
</div>

<?php include 'footer.php'; ?>