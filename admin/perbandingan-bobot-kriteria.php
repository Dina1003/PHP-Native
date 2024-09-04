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

    <?php
    include '../config.php';
    include('../fungsi.php');
    ?>

    <div class="isi">

    <h3 align="center" class="h32">Perbandingan Kepentingan Antar Kriteria</h3>
    <?php showTabelPerbandingan('kriteria','kriteria'); ?>

</body>

</html>