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


include '../config.php';
include('../fungsi.php');

//AMBIL DATA YG DIKLIK EDIT DI HALAMAN kelola-alternatif.php TADI 
$id_alternatif = $_GET['id_alternatif'];

//TAMPILKAN DATA DIMANA id_alternatif nya ADALAH $id_alternatif
$data_alternatif = tampilalternatif("SELECT * FROM alternatif WHERE id_alternatif = '$id_alternatif' ")[0];

//CEK DATA ALTERNATIF
$query      = mysqli_query($mysqli, "SELECT * FROM alternatif ");
$row        = mysqli_fetch_array($query);
$num_row    = mysqli_num_rows($query);

$user1 = $mysqli->query("SELECT * from detail_kriteria ORDER BY id_kriteria");
if (!$user1) {
    echo $mysqli->connect_errno . " - " . $mysqli->connect_error;
    exit();
}
$i = 0;

//JIKA DIKLIK BUTTON EDIT MAKA
if (isset($_POST['edit'])) {
    
    if (edit_alternatif($_POST) > 0) {
        echo "<script>
          alert ('Data Berhasil Di Edit')
          document.location.href='../user/kelola-alternatif.php'
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

include('../header1.php');
?>


    <div class="isi">
        <a href="../user/kelola-alternatif.php">Alternatif</a>

        <h3 class="h3">Edit Data Alternatif</h3>

        <form role="form" method="post">
            <span class="keterangan">Nama Kandidat</span>
            <input type="text" class="tambah" name="nama_alternatif" id="nama_alternatif" value="<?= $data_alternatif['nama']; ?>" required>

            <span class="keterangan">Hubungan Dengan Siswa (K1)</span>
            <select class="tambah" style="height: 26px; font-size:medium;" id="K1" name="K1">
                <option value="<?= $data_alternatif['K1']; ?>">K1: <?= $data_alternatif['K1']; ?></option>
                <?php foreach ($user1 as $pilih) { ?>
                    <option value="<?= $pilih['nilai_rasio']; ?>"><?= $pilih['sub_kriteria']; ?> : <?= $pilih['nilai_rasio']; ?></option>
                <?php }
                ?>
            </select>

            <span class="keterangan">Metode Pembelajaran (K2)</span>
            <select class="tambah" style="height: 26px; font-size:medium;" id="K2" name="K2">
            <option value="<?= $data_alternatif['K2']; ?>">K2: <?= $data_alternatif['K2']; ?></option>
                <?php foreach ($user1 as $pilih) { ?>
                    <option value="<?= $pilih['nilai_rasio']; ?>"><?= $pilih['sub_kriteria']; ?> : <?= $pilih['nilai_rasio']; ?></option>
                <?php }
                ?>
            </select>

            <span class="keterangan">Metode Evaluasi Pembelajaran (K3)</span>
            <select class="tambah" style="height: 26px; font-size:medium;" id="K3" name="K3">
            <option value="<?= $data_alternatif['K3']; ?>">K3: <?= $data_alternatif['K3']; ?></option>
                <?php foreach ($user1 as $pilih) { ?>
                    <option value="<?= $pilih['nilai_rasio']; ?>"><?= $pilih['sub_kriteria']; ?> : <?= $pilih['nilai_rasio']; ?></option>
                <?php }
                ?>
            </select>

            <span class="keterangan">Kehadiran (K4)</span>
            <select class="tambah" style="height: 26px; font-size:medium;" id="K4" name="K4">
            <option value="<?= $data_alternatif['K4']; ?>">K4: <?= $data_alternatif['K4']; ?></option>
                <?php foreach ($user1 as $pilih) { ?>
                    <option value="<?= $pilih['nilai_rasio']; ?>"><?= $pilih['sub_kriteria']; ?> : <?= $pilih['nilai_rasio']; ?></option>
                <?php }
                ?>
            </select>

            <span class="keterangan">Masa Kerja (K5)</span>
            <select class="tambah" style="height: 26px; font-size:medium;" id="K5" name="K5">
            <option value="<?= $data_alternatif['K5']; ?>">K5: <?= $data_alternatif['K5']; ?></option>
                <?php foreach ($user1 as $pilih) { ?>
                    <option value="<?= $pilih['nilai_rasio']; ?>"><?= $pilih['sub_kriteria']; ?> : <?= $pilih['nilai_rasio']; ?></option>
                <?php }
                ?>
            </select>

            <button type="submit" name="edit" class="action_btn" style="
             text-decoration: none;
             color: black;
             border: 1px solid #da7e1c;
             background: #deb887;
             padding: 5px 15px;
             font-weight: bold;
             border-radius: 3px;
             transition: 0.5s ease-in-out;
             font-size: medium;
            ">Edit Alternatif</button>
           
        </form>
    </div>
</body>

</html>