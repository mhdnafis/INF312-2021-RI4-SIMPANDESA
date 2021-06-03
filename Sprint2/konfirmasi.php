<?php
session_start();

if ($_SESSION['login'] != "true") {
  header('location: login.php');
}

require 'koneksi.php';

$sql = "INSERT INTO konfirmasi (id_kuantitas, id_barang, tgl_pinjem, tgl_kembali, id_user, status_kembali) VALUES ";
for ($i=0; $i < $_POST['jumlah']; $i++) { 
      $data_Exp = explode(',', $_POST['data'.($i+1)]);
      if ($i != 0) {
          $sql .= ", ";
      }
      for ($u=0; $u < $data_Exp[1]; $u++) { 
        if ($u != 0) {
            $sql .= ", ";
        }
        $sql .= '(0,' . $data_Exp[0] . ',' . strtotime($_POST['tanggal_pinjam']) . ',' . strtotime($_POST['tanggal_kembali']) . ',' . $_SESSION['id_user'] . ',0)';
      }
  }

  // echo $sql;

  $query =mysqli_query($koneksi, $sql);
  
  if(!$query){
    echo("Error description: " . mysqli_error($koneksi));
  }

  echo "data masuk!";

  header('location: index.php');
?>