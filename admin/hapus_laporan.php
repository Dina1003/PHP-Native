<?php
require '../fungsi.php';

// Pastikan 'id_keputusan' tersedia sebelum digunakan
if(isset($_GET['id_keputusan'])) {
    $id_keputusan = $_GET['id_keputusan'];

    // Jalankan fungsi hapus_laporan
    if (hapus_laporan($id_keputusan)) {
        echo "<script>
             document.location.href='../admin/laporan.php'
               </script>";
    } else {
        echo "<script>
              alert ('Data Berhasil Di Hapus Total')
              document.location.href='../admin/laporan.php'
              </script>";
    }
} else {
    echo "<script>
          alert ('ID Keputusan tidak ditemukan')
          document.location.href='../admin/laporan.php'
          </script>";
}
?>
