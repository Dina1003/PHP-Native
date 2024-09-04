<?php

session_start();
//JIKA TIDAK DITEMUKAN $_SESSION['status'] (USER/ADMIN TIDAK MELIWATI TAHAP LOGIN) MAKA LEMBAR ADMIN/USER KEHALAMAN LOGIN 
if (!isset($_SESSION['id'])) {
    echo "<script>
    alert('Maaf Anda Belum Login')
document.location.href='../login.php'
</script>";
  exit;
}

require '../fungsi.php';

//BUKA SEMUA DATA YANG ADA DI TABLE hasil_akhir DAN URUTKAN KODE TERBARU TAMPIL DIATAS
$data = query("SELECT * FROM keputusan ORDER BY kode DESC");

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style/style.css">
    <title>SPK TA</title>
</head>

<body>
<?php

include('../header.php');
?>


    <div class="isi">
        <a href="../admin/laporan.php">Rekap Data Hasil Perhitungan</a>
        <a href="../admin/kelola-pengguna.php">/ Kelola Pengguna</a>
    </div>

    <div class="isi">
    <h3 align="center" class="h32">REKAP DATA HASIL SPK PENEMPATAN WALI KELAS MDA PADANG LUA</h3><br>
        <table class="perbandingan" style="float: left; margin-right: 50px;">
            <thead>
                <tr>
                    <th>Kode</th>
                    <th>Tanggal</th>
                    <th>Total Data</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>

                <?php $no = 1; ?>
                <?php
                foreach ($data as $hasil_akhir) {
                ?>

                    <?php
                    //memanggil kode yang ada di table keputusan
                    $kode = $hasil_akhir['kode'];
                    $id_keputusan = $hasil_akhir['id_keputusan'];
                    //menghitung total data dari data masing masing kode
                    $total = mysqli_query($con, "SELECT COUNT(kode_hasil) AS TOTAL FROM detail_keputusan WHERE kode_hasil = '$kode'");
                    $totaldata = mysqli_fetch_assoc($total);
                    ?>

                    <tr>
                        <td><?= $hasil_akhir['kode']; ?></td>
                        <td><?= $hasil_akhir['tanggal_keputusan']; ?></td>
                        <td><?= $totaldata['TOTAL']; ?></td>
                        <td>
                            <span class="action_btn1">
                                <a href="../admin/detail_laporan.php?kode=<?= $hasil_akhir['kode']; ?>">Lihat</a>
                                <a href="../admin/hapus_laporan.php?id_keputusan=<?= $hasil_akhir['id_keputusan']; ?>" >Hapus</a>
                                <a href="../admin/cetak_laporan.php?kode=<?= $hasil_akhir['kode']; ?>" style="background: #da7e1c;">Cetak</a>
                            </span>
                        </td>
                    </tr>

                <?php } ?>
        </table>
    </div>

    </tbody>
    </table>

    </div>

</body>

</html>