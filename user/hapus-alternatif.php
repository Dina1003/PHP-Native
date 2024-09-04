<?php

require '../fungsi.php';

//ambil data yang mau di hapus
$id_alternatif = $_GET['id_alternatif'];

//JALANKAN FUNGSI HAPUS
if (hapus_alternatif($id_alternatif)) {
    echo "<script>
          alert ('Data Berhasil Di Hapus')
          document.location.href='../user/kelola-alternatif.php'
          </script>";
}
