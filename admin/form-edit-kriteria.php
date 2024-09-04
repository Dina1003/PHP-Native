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

        <h3 class="h3">Edit Data Kriteria</h3>

        <?php
        include('../config.php');
        $result = $mysqli->query("select * from kriteria where id_kriteria = " . $_GET['id_kriteria'] . "");
        if (!$result) {
            echo $mysqli->connect_errno . " gagal.. sabar " . $mysqli->connect_error;
            exit();
        }


        while ($row = $result->fetch_assoc()) {
        ?>

            <form role="form" method="post" action="edit-kriteria.php?id_kriteria=<?php echo $_GET['id_kriteria']; ?>">
                <span class="keterangan">Nama Kriteria</span>
                <input type="text" class="tambah" name="tpnama" id="tpnama" value=<?php echo $row['nama_kriteria']; ?>>

                <span class="keterangan">Keterangan</span>
                <input type="text" class="tambah" name="tpketerangan" id="tpketerangan" value="<?php echo $row['keterangan']; ?>">

                <span class="keterangan">Type</span>
                <input type="text" class="tambah" name="tptype" id="tptype" value="<?php echo $row['type']; ?>">

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
            ">Edit Kriteria</button>
                <!-- <a href="kelola_pengguna.php">Tambah Kriteria</a> -->
            </form>
        <?php
        }
        ?>
    </div>
</body>

</html>