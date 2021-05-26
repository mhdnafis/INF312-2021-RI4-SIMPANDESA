<?php

require 'koneksi.php';
//   var_dump($_POST);

$sql = "INSERT INTO konfirmasi (id_kuantitas, id_barang, tgl_pinjem, tgl_kembali) VALUES ";
for ($i=0; $i < (int) $_POST['jumlah']; $i++) { 
      $data_Exp = explode(',', $_POST['data'.$i+1]);
      if ($i != 0) {
          $sql .= ", ";
      }
      for ($u=0; $u < $data_Exp[1]; $u++) { 
        if ($u != 0) {
            $sql .= ", ";
        }
        $sql .= '(0,' . $data_Exp[0] . ',' . strtotime($_POST['tanggal_pinjam']) . ',' . strtotime($_POST['tanggal_kembali']) . ')';
      }
  }

  $query =mysqli_query($koneksi, $sql);

  echo "data masuk!";

  header('location: index.php');
?>