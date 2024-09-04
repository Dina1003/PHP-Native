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

//MEMBUKA SEMUA DATA YG ADA DI TABLE ALTERNATIF
$data_alternatif = tampilalternatif("SELECT * FROM alternatif");

//MEMBUKU KEMBALI UNTUK MEMBACA TOTAL DATA YANG ADA
$data_alternatif1 = mysqli_query($con, "SELECT * FROM alternatif");

//JIKA DI KLIK BUTTON CARI MAKA
if (isset($_POST['cari'])) {
    $input = $_POST['input'];
    //TAMPILKAN DATA YANG DI INPUTKAN 
    $data_alternatif = tampilalternatif("SELECT * FROM alternatif WHERE nama LIKE '%$input%' OR id_alternatif LIKE '%$input%' ");
}

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style/style.css">
    <style>
        @media (min-width: 1050px) {

            .hitung {
                display: none;
            }

        }
    </style>
    <title>SPK TA</title>
</head>

<body>
    <?php

    include('../header1.php');
    ?>


    <div class="isi">

        <script>
            document.addEventListener("DOMContentLoaded", function() {
                var tambahLink = document.getElementById('tambah-link');
                var rowCount = document.getElementById('data-table').rows.length;

                // cek total data
                if (rowCount > 15) {
                    // tentukan yang mau di non-aktifkan
                    tambahLink.removeAttribute('href');
                    tambahLink.style.pointerEvents = 'none'; // buat link tidak bisa di klik
                    tambahLink.style.color = 'grey'; // ubah warna jadi abu abu
                }
            });
        </script>

        <a href="../user/kelola-alternatif.php">Alternatif</a>
        <a id="tambah-link" href="../user/form-tambah-alternatif.php">/ Tambah Alternatif</a>

        <h2 class="h3" style="text-align: center;">Data Calon Wali Kelas MDA Padang Lua</h2>

        <form method="POST" action="" class="form-group">
            <input type="text" name="input" autofocus autocomplete="off" class="form-control shadow" style="height: 26px; font-size:medium;">
            <button type="submit" name="cari" class="action_btn1" style="
                            text-decoration: none;
                            color: white;
                            border: 1px solid rgb(138, 136, 135);
                            display: inline-block;
                            padding: 5px 15px;
                            font-weight: bold;
                            border-radius: 3px;
                            background-color: #da7e1c;
                            font-size:medium;
                            transition: 0.5s ease-in-out;">Cari</button>
        </form>
        <div class="hitung">
            <button type="submit" name="perhitungan" class="btn btn-primary" style=" margin-top: -10px;"><b>hitung</b></button>
        </div>

        <script>
            function checkAll(ele) {
                var checkboxes = document.getElementsByTagName('input');
                if (ele.checked) {
                    for (var i = 0; i < checkboxes.length; i++) {
                        if (checkboxes[i].type == 'checkbox') {
                            checkboxes[i].checked = true;
                        }
                    }
                } else {
                    for (var i = 0; i < checkboxes.length; i++) {
                        if (checkboxes[i].type == 'checkbox') {
                            checkboxes[i].checked = false;
                        }
                    }
                }
            }
        </script>
        <form method="post" action="perhitungan.php">
            <button type="submit" name="perhitungan" class="action_btn" style="
             text-decoration: none;
             color: black;
             border: 1px solid #da7e1c;
             background: #deb887;
             padding: 5px 15px;
             font-weight: bold;
             border-radius: 3px;
             transition: 0.5s ease-in-out;
             font-size: medium;
            ">Proses Penempatan</button><br>



            <table id="data-table">
                <?php $tot = mysqli_num_rows($data_alternatif1);
                echo "Total Data : <b>" . $tot . "</b>";
                ?>
                <thead>
                    <tr>
                        <!-- <th>Pilih <br> (semua) <br>
                            <input type="checkbox" onChange="checkAll(this)" name="chk[]">
                        </th> -->
                        <th>Nama</th>
                        <th>Hubungan Dengan Siswa</th>
                        <th>Metode Pembelajaran</th>
                        <th>Metode Evaluasi Pembelajaran</th>
                        <th>Kehadiran</th>
                        <th>Masa Kerja</th>
                        <th>Aksi</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($data_alternatif as $alternatif) { ?>
                        <tr>
                            <input type="hidden" type="checkbox" name="id_alternatif[]" id="pilih" value="<?= $alternatif['id_alternatif']; ?>" >
                            <td><?= $alternatif['nama']; ?></td>
                            <td><?= $alternatif['K1']; ?></td>
                            <td><?= $alternatif['K2']; ?></td>
                            <td><?= $alternatif['K3']; ?></td>
                            <td><?= $alternatif['K4']; ?></td>
                            <td><?= $alternatif['K5']; ?></td>
                            <td>
                                <span class="action_btn1">
                                    <a href="../user/form-edit-alternatif.php?id_alternatif=<?= $alternatif['id_alternatif']; ?>">Edit</a>
                                    <a href="../user/hapus-alternatif.php?id_alternatif=<?= $alternatif['id_alternatif']; ?>">Hapus</a>
                                </span>
                            </td>
                        </tr>

                    <?php } ?>
        </form>

        </tbody>
        </table>
    </div>

</body>

</html>