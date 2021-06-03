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


$sql = "SELECT DISTINCT konfirmasi.id_user, user.* FROM konfirmasi JOIN user ON konfirmasi.id_user=user.id_user ORDER BY konfirmasi.id_user ASC";
$query = mysqli_query($koneksi, $sql);

$sql_card_info = "SELECT (SELECT count(*) FROM barang) as jumlah_barang, (SELECT count(*) FROM user) as jumlah_user, (SELECT count(DISTINCT id_user) FROM konfirmasi) as jumlah_peminjam";
$query_info = mysqli_query($koneksi, $sql_card_info);
$result_info = mysqli_fetch_assoc($query_info);

?>

<div class="container my-5">
    <div class="row">
        <div class="col-md-3">
            <div class="card bg-info text-center text-white" style="height:100%">
                <div class=" card-header">
                    Welcome,
                    <strong><?= $_SESSION['username'] ?></strong>
                </div>
                <div class="card-body text-center d-flex align-items-center justify-content-center">
                    <h6 id="jam">

                    </h6>
                    <script>
                    setInterval(() => {
                        $.ajax({
                            url: 'jam.php',
                            success: function(data) {
                                $("#jam").html(data);
                            }
                        });
                    }, 1000);
                    </script>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-info text-center text-white">
                <div class="card-header">
                    Jenis Barang
                </div>
                <div class="card-body text-center">
                    <h1>
                        <?= $result_info['jumlah_barang']; ?>
                    </h1>
                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-info text-center text-white">
                <div class="card-header">
                    Jumlah User
                </div>
                <div class="card-body text-center">
                    <h1><?= $result_info['jumlah_user']; ?></h1>

                </div>
            </div>
        </div>
        <div class="col-md-3">
            <div class="card bg-info text-center text-white">
                <div class="card-header">
                    Jumlah Peminjam
                </div>
                <div class="card-body text-center">
                    <h1><?= $result_info['jumlah_peminjam']; ?></h1>

                </div>
            </div>
        </div>

    </div>
    <section class="py-5 mb-4">
        <h3>List Peminjam Barang</h3>
        <hr>
        <ul class="list-unstyled">
            <li class="">
                <div>
                    <table id="example" class="table table-striped table-bordered" style="width:100%">
                        <script>
                        $(document).ready(function() {
                            $('#example').DataTable();
                        });
                        </script>
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>NIK</th>
                                <th>Nama</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $i = 1; while ($result = mysqli_fetch_assoc($query)) : ?>
                            <tr>
                                <td>
                                    <?= $i++ ?>)
                                </td>
                                <td>
                                    <?= $result['nik'] ?>
                                </td>
                                <td><?= $result['nama'] ?></td>
                                <td><a href="detail-pinjam.php?id=<?= $result['id_user'] ?>"
                                        class="badge badge-info badge-pill"><i class="fas fa-fw fa-info"></i>
                                        detail</a></td>
                            </tr>
                            <?php endwhile; ?>
                        </tbody>
                    </table>
                </div>
            </li>
        </ul>
        <hr>
    </section>
</div>

<script>
$(document).ready(function() {
    $('#tableAdmin').DataTable();
});
</script>

<?php include 'footer.php'; ?>