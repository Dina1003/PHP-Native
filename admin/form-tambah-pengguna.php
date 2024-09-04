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
        <a href="../admin/laporan.php">Rekap Data Hasil Perhitungan</a>
        <a href="../admin/kelola-pengguna.php">/ Kelola Pengguna</a>

        <h3 class="h3">Tambah Data Pengguna</h3>

        <form role="form" method="post" action="tambah-pengguna.php">
            <span class="keterangan">Username</span>
            <input type="text" class="tambah" name="tpusername" id="username" placeholder="Username" required>

            <span class="keterangan">Password</span>
            <input type="password" class="tambah" name="tppass" id="pass" placeholder="Password" required>

            <span class="keterangan">Nama Lengkap</span>
            <input type="text" class="tambah" name="tpnama" id="nama_lengkap" placeholder="Nama Lengkap" required>

            <span class="keterangan">Role</span>
            <select class="tambah" style="height: 30px; font-size:medium;" id="pengguna" name="tppengguna">
                <option value="admin">Admin</option>
                <option value="wkmda">Wakil Kepala MDA</option>
            </select>

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
            ">Tambah Pengguna</button>
            <!-- <a href="kelola_pengguna.php">Tambah Kriteria</a> -->
        </form>
    </div>
</body>

</html>