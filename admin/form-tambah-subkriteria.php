<?php
include('../config.php');
include('../fungsi.php');

session_start();
//JIKA TIDAK DITEMUKAN $_SESSION['status'] (USER/ADMIN TIDAK MELIWATI TAHAP LOGIN) MAKA LEMBAR ADMIN/USER KEHALAMAN LOGIN 
if (!isset($_SESSION['id'])) {
    echo "<script>
    alert('Maaf Anda Belum Login')
document.location.href='../login.php'
</script>";
  exit;
}

$user = $mysqli->query("SELECT * from kriteria");
if (!$user) {
    echo $mysqli->connect_errno . " - " . $mysqli->connect_error;
    exit();
}
$i = 0;

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

        <h3 class="h3">Tambah Data Sub Kriteria</h3>

        <form role="form" method="post" action="tambah-subkriteria.php">
            <span class="keterangan">Nama Kriteria</span>
                <select class="tambah" style="height: 30px; font-size:medium;" id="kriteria" name="kriteria">
                <?php  
                $i = 1;
                while ($row = $user->fetch_assoc())  { ?>
                <option value="<?php echo $row['id_kriteria']; ?>"><?php echo $row['keterangan']; ?></option>
                
            <?php } 
            ?></select>

            <span class="keterangan">Sub-Kriteria</span>
            <input type="text" class="tambah" name="sub_kriteria" id="sub_kriteria" placeholder="Sub-Kriteria" required>

            <span class="keterangan">Nilai Rasio</span>
            <input type="number" class="tambah" name="nilai_rasio" id="nilai_rasio" placeholder="1" required>

            <button type="submit" name="tambah" class="action_btn" style="
             text-decoration: none;
             color: black;
             border: 1px solid #da7e1c;
             background: #deb887;
             padding: 5px 15px;
             font-weight: bold;
             border-radius: 3px;
             transition: 0.5s ease-in-out;
             font-size: medium;
            ">Tambah Data</button>
            <!-- <a href="kelola_pengguna.php">Tambah Kriteria</a> -->
        </form>
    </div>
</body>

</html>