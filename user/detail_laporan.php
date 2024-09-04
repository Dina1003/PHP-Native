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

//MENGAMBIL DATA YG DI KLIK  DARI LAPORAN
$kode = $_GET['kode'];


//TAMPILKAN SEMUA DATA DIMANA YANG kode_hasil NYA BERDASARKAN DARI $kode 
$data = query("SELECT * FROM detail_keputusan WHERE kode_hasil = '$kode' ORDER BY total DESC ");
$kelas = query("SELECT detail_keputusan.id_kelas, kelas.id_kelas, kelas.nama_kelas FROM detail_keputusan, kelas WHERE kelas.id_kelas=detail_keputusan.id_kelas AND kode_hasil = '$kode'");
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

    include('../header1.php');
    ?>

    <div class="isi">
        <a href="../user/laporan.php">Rekap Data Hasil Perhitungan</a>
    </div>

    <div class="isi">
        <h3 align="center" class="h32">REKAP DATA HASIL SPK PENEMPATAN WALI KELAS MDA PADANG LUA</h3><br>
        <table class="perbandingan" style="float: left; margin-right: -1px; margin-top: 12px;">
            <thead>
                <tr>
                    <th>Kode</th>
                    <th>Nama Alternatif</th>
                    <th>Total</th>
                    <th>Rank</th>
                </tr>
            </thead>
            <tbody>

                <?php $i = 1; ?>
                <?php foreach ($data as $detail_data) { ?>
                    <tr>
                        <td><?= $detail_data['kode_hasil']; ?></td>
                        <td><?= $detail_data['nama_alternatif']; ?></td>
                        <td><?= number_format($detail_data['total'],5); ?></td>
                        <td><?= $i++ ?></td>
                    </tr>
                <?php } ?>
        </table>
    </div>

    </tbody>
    </table>

    <table class="table2">
        <thead>
            <tr>
                <th> Penempatan Kelas</th>
            </tr>
        </thead>

        <tbody>
            <?php foreach ($kelas as $kelas1) { ?>
                <tr>
                    <td><?= $kelas1['nama_kelas']; ?></td>
                </tr>
            <?php } ?>
        </tbody>
    </table>

    </div>

</body>

</html>