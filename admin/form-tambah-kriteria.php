<?php
session_start();
include '../config.php';

//JIKA TIDAK DITEMUKAN $_SESSION['status'] (USER/ADMIN TIDAK MELIWATI TAHAP LOGIN) MAKA LEMBAR ADMIN/USER KEHALAMAN LOGIN 
if (!isset($_SESSION['id'])) {
    echo "<script>
    alert('Maaf Anda Belum Login')
document.location.href='../login.php'
</script>";
    exit;
}
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
        <a href="../admin/kelola-kriteria.php">Kriteria</a>
        <a href="../admin/kelola-subkriteria.php">/ Sub-Kriteria</a>
        <a href="../admin/perbandingan-bobot-kriteria.php">/ Nilai Perbandingan Kepentingan Kriteria</a>

        <h3 class="h3">Tambah Data Kriteria</h3>

        <form role="form" method="post" action="tambah-kriteria.php">
            <span class="keterangan">Nama Kriteria</span>
            <input type="text" class="tambah" name="tpnama" id="tpnama" placeholder="K1" required>

            <span class="keterangan">Keterangan</span>
            <input type="text" class="tambah" name="tpketerangan" id="tpketerangan" placeholder="Keterangan Kriteria" required>

            <span class="keterangan">Type</span>
            <input type="text" class="tambah" name="tptype" id="tptype" placeholder="Benefit/Cost" required>

            <button type="submit" class="action_btn" style="
             text-decoration: none;
             color: black;
             border: 1px solid #da7e1c;
             background: #deb887;
             padding: 5px 15px;
             font-weight: bold;
             border-radius: 3px;
             transition: 0.5s ease-in-out;
             font-size: medium;
            ">Tambah Kriteria</button>
            <!-- <a href="kelola_pengguna.php">Tambah Kriteria</a> -->
        </form>
    </div>
</body>

</html>