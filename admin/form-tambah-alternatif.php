<?php
include '../config.php';
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

$user1 = $mysqli->query("SELECT * from detail_kriteria ORDER BY id_kriteria");
if (!$user1) {
    echo $mysqli->connect_errno . " - " . $mysqli->connect_error;
    exit();
}
$i = 0;

//JIKA TOMBOL SIMPAN DITEKAN MAKA JALANKAN
if (isset($_POST['simpan'])) {
    //JIKA function tambah alternatif > 0 (sukses) MAKA JALANKAN FUNGSI
    if (tambah_alternatif($_POST) > 0) {
        echo "<script>
          alert ('Data Berhasil Di Tambah')
          document.location.href='../admin/kelola-alternatif.php'
          </script>";
    }
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
        <a href="../admin/kelola-alternatif.php">Alternatif</a>
        <a href="../admin/form-tambah-alternatif.php">/ Tambah Alternatif</a>

        <h3 class="h3">Tambah Data Alternatif</h3>

        <form role="form" method="post">
            <span class="keterangan">Nama Kandidat</span>
            <input type="text" class="tambah" name="nama_alternatif" id="nama_alternatif" placeholder="Nama Lengkap Kandidat" required>

            <span class="keterangan">Hubungan Dengan Siswa (K1)</span>
            <select class="tambah" style="height: 26px; font-size:medium;" id="K1" name="K1">
                <?php foreach ($user1 as $pilih) { ?>
                    <option value="<?= $pilih['nilai_rasio']; ?>"><?= $pilih['sub_kriteria']; ?> : <?= $pilih['nilai_rasio']; ?></option>
                <?php }
                ?>
            </select>

            <span class="keterangan">Metode Pembelajaran (K2)</span>
            <select class="tambah" style="height: 26px; font-size:medium;" id="K2" name="K2">
                <?php foreach ($user1 as $pilih) { ?>
                    <option value="<?= $pilih['nilai_rasio']; ?>"><?= $pilih['sub_kriteria']; ?> : <?= $pilih['nilai_rasio']; ?></option>
                <?php }
                ?>
            </select>

            <span class="keterangan">Metode Evaluasi Pembelajaran (K3)</span>
            <select class="tambah" style="height: 26px; font-size:medium;" id="K3" name="K3">
                <?php foreach ($user1 as $pilih) { ?>
                    <option value="<?= $pilih['nilai_rasio']; ?>"><?= $pilih['sub_kriteria']; ?> : <?= $pilih['nilai_rasio']; ?></option>
                <?php }
                ?>
            </select>

            <span class="keterangan">Kehadiran (K4)</span>
            <select class="tambah" style="height: 26px; font-size:medium;" id="K4" name="K4">
                <?php foreach ($user1 as $pilih) { ?>
                    <option value="<?= $pilih['nilai_rasio']; ?>"><?= $pilih['sub_kriteria']; ?> : <?= $pilih['nilai_rasio']; ?></option>
                <?php }
                ?>
            </select>

            <span class="keterangan">Masa Kerja (K5)</span>
            <select class="tambah" style="height: 26px; font-size:medium;" id="K5" name="K5">
                <?php foreach ($user1 as $pilih) { ?>
                    <option value="<?= $pilih['nilai_rasio']; ?>"><?= $pilih['sub_kriteria']; ?> : <?= $pilih['nilai_rasio']; ?></option>
                <?php }
                ?>
            </select>

            <button type="submit" name="simpan" class="action_btn" style="
             text-decoration: none;
             color: black;
             border: 1px solid #da7e1c;
             background: #deb887;
             padding: 5px 15px;
             font-weight: bold;
             border-radius: 3px;
             transition: 0.5s ease-in-out;
             font-size: medium;
            ">Tambah Alternatif</button>
            <!-- <a href="kelola_pengguna.php">Tambah Kriteria</a> -->
        </form>
    </div>
</body>

</html>