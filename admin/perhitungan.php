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




// JIKA TIDAK MENERIMA DATA ID ALTERNATIF MAKA LEMPAR KEMBALI KE kelola-alternatif.php
if (!isset($_POST['id_alternatif'])) {
    echo "<script>
  alert('Pilih Data Alternatif Dahulu ! ')
  document.location.href='../admin/kelola-alternatif.php'
  </script>";
} else {

    //JIKA MENERIMA DATA ID ALTERNATIF MAKA JALANKAN HALAMAN perhitungan.php

    //BUKA TABLE KRITERIA DAN TAMPILKAN FIELD Hubungan Dengan Siswa
    $datakriterihubungan = mysqli_query($con, "SELECT * FROM kriteria WHERE keterangan = 'Hubungan Dengan Siswa'");
    $hubungan = mysqli_fetch_assoc($datakriterihubungan);

    //BUKA TABLE KRITERIA DAN TAMPILKAN FIELD Metode Pembelajaran
    $datakriteriampb = mysqli_query($con, "SELECT * FROM kriteria WHERE keterangan = 'Metode Pembelajaran'");
    $mpb = mysqli_fetch_assoc($datakriteriampb);

    //BUKA TABLE KRITERIA DAN TAMPILKAN FIELD Metode Evaluais Pembelajaran
    $datakriteriamep = mysqli_query($con, "SELECT * FROM kriteria WHERE keterangan = 'Metode Evaluasi Pembelajaran'");
    $mep = mysqli_fetch_assoc($datakriteriamep);

    //BUKA TABLE KRITERIA DAN TAMPILKAN FIELD Kehadiran
    $datakriteriakehadiran = mysqli_query($con, "SELECT * FROM kriteria WHERE keterangan = 'Kehadiran'");
    $kehadiran = mysqli_fetch_assoc($datakriteriakehadiran);

    //BUKA TABLE KRITERIA DAN TAMPILKAN FIELD Masa Kerja
    $datakriteriamasa = mysqli_query($con, "SELECT * FROM kriteria WHERE keterangan = 'Masa Kerja'");
    $masa = mysqli_fetch_assoc($datakriteriamasa);

    //BUKA TABLE KRITERIA
    $datakriteria = mysqli_query($con, "SELECT * FROM kriteria");
    $datakriteria1 = mysqli_fetch_assoc($datakriteria);

    //BUKA TABLE KELAS
    $data_kelas = $mysqli->query("SELECT * FROM kelas");
    if (!$data_kelas) {
        echo $mysqli->connect_errno . " - " . $mysqli->connect_error;
        exit();
    }
    $row = mysqli_fetch_array($data_kelas);
    $nilai = $row[0];


    //MENGAMBIL DATA DENGAN KODE PALING BESAR
    $a = mysqli_query($con, "SELECT max(kode) AS kodeterbesar from keputusan");
    $b = mysqli_fetch_array($a);
    $kode = $b['kodeterbesar'];

    //MENGAMBIL ANGKA DARI KODE TERBESAR MENGGUNAKAN FUNSI substr
    //DAN DIUBAH KE INTEGER (int)

    $urutan = (int) substr($kode, 3, 3);

    //BILANGAN YANG DIAMBIL INI DI TAMBAH 1 UNTUK MENENTUKAN NOMOR URUT BERIKUTNYA
    $urutan++;

    //MEMBENTUK KODE BARU
    //PERINTAH printf("%03s",$urutan); BERGUNA UNTUK MEMBUAT STRING MENJADI 3 KARAKTER
    //MISAL printf("%03s",15); MAKAMENGHASILKAN '015'
    $kode = "k" . sprintf("%03s", $urutan);

    //JIKA TOMBOL SIMPAN DITEKAN MAKA
    if (isset($_POST['simpan'])) {
        if (insert_hasil_perankingan($_POST) > 0) {
            echo "<script>
          alert('data tersimpan')
          document.location.href='../admin/laporan.php'
          </script>";
        }
    }







?>
    <!doctype html>
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
            <!-- <a href="kelola-alternatif.php">Alternatif</a>
            <a href="form-tambah-alternatif.php">/ Tambah Alternatif</a> -->

            <h2 class="h3" style="text-align: center;">Proses Perhitungan SPK Penentuan Wali Kelas MDA Padang Lua</h2><br><br>

            <div class="table-responsive p-4">
                <table class="table table-striped shadow">
                    <tr class="bg-info">
                        <th>Nama Alternatif</th>
                        <th>K1</th>
                        <th>K2</th>
                        <th>K3</th>
                        <th>K4</th>
                        <th>K5</th>
                    </tr>

                    <?php
                    $id_alternatifs = $_POST['id_alternatif'];

                    foreach ($id_alternatifs as $id_alternatif) {
                        $data = mysqli_query($con, "SELECT * FROM alternatif WHERE id_alternatif = '$id_alternatif' ");
                        while ($spk = mysqli_fetch_assoc($data)) {
                    ?>

                            <tr>
                                <td><?= $spk['nama']; ?></td>
                                <td><?= $spk['K1']; ?></td>
                                <td><?= $spk['K2']; ?></td>
                                <td><?= $spk['K3']; ?></td>
                                <td><?= $spk['K4']; ?></td>
                                <td><?= $spk['K5']; ?></td>
                            </tr>


                    <?php
                        }
                    }

                    ?>

                    </form>
                </table>
            </div>


            <br><br>
            <h1 style="border-bottom:3px dodgerblue solid"></h1>
            <br><br>

            <button id="nextButton" onclick="toggleTable()">Next</button>

            <div id="normalisasi" style="display:none;" class="alert alert-info">
                <center><b>NORMALISASI</b></center>
            </div>

            <div id="normalisasi1" style="display:none;" class="table-responsive p-4">
                <table class="table table-striped shadow">
                    <tr class="bg-info">
                        <th>Nama Alternatif</th>
                        <th>K1</th>
                        <th>K2</th>
                        <th>K3</th>
                        <th>K4</th>
                        <th>K5</th>
                    </tr>

                    <?php

                    $pembagi1 = 0;
                    $pembagi2 = 0;
                    $pembagi3 = 0;
                    $pembagi4 = 0;
                    $pembagi5 = 0;

                    $id_alternatifs = $_POST['id_alternatif'];
                    foreach ($id_alternatifs as $id_alternatif) {
                        $data = mysqli_query($con, "SELECT * FROM alternatif WHERE id_alternatif = '$id_alternatif' ");
                        while ($spk = mysqli_fetch_assoc($data)) {

                            $pembagi1 += pow($spk['K1'], 2);
                            $akar1 = sqrt($pembagi1);

                            $pembagi2 += pow($spk['K2'], 2);
                            $akar2 = sqrt($pembagi2);

                            $pembagi3 += pow($spk['K3'], 2);
                            $akar3 = sqrt($pembagi3);

                            $pembagi4 += pow($spk['K4'], 2);
                            $akar4 = sqrt($pembagi4);

                            $pembagi5 += pow($spk['K5'], 2);
                            $akar5 = sqrt($pembagi5);
                        }
                    }

                    ?>



                    <?php
                    $id_alternatifs = $_POST['id_alternatif'];
                    foreach ($id_alternatifs as $id_alternatif) {
                        $data = mysqli_query($con, "SELECT * FROM alternatif WHERE id_alternatif = '$id_alternatif' ");
                        while ($spk = mysqli_fetch_assoc($data)) {

                    ?>


                            <tr>
                                <td><?= $spk['nama']; ?></td>
                                <!-- -----------C1----------- -->
                                <td>
                                    <?php $c1 = $spk['K1'] / $akar1;
                                    echo number_format($c1, 5); ?>
                                </td>
                                <!-- -----------C2----------- -->
                                <td>
                                    <?php $c2 = $spk['K2'] / $akar2;
                                    echo number_format($c2, 5); ?>
                                </td>
                                <!-- -----------C3----------- -->
                                <td>
                                    <?php $c3 = $spk['K3'] / $akar3;
                                    echo number_format($c3, 5); ?>
                                </td>
                                <!-- -----------C4----------- -->
                                <td><?php $c4 = $spk['K4'] / $akar4;
                                    echo number_format($c4, 5); ?>
                                </td>
                                <!-- -----------C5----------- -->
                                <td><?php $c5 = $spk['K5'] / $akar5;
                                    echo number_format($c5, 5); ?>
                                </td>
                            </tr>


                    <?php

                        }
                    }
                    ?>
                </table>
            </div>


            <br><br>
            <h1 style="border-bottom:3px dodgerblue solid"></h1>
            <br><br>

            <button id="nextButton1" style="display:none;" onclick="toggleTable1()">Next</button>
            <div id="optimasilisasi" style="display:none;" class="alert alert-info">
                <center><b>OPTIMALISASI</b></center>
            </div>

            <div id="optimasilisasi1" style="display:none;" class="table-responsive p-4">
                <table class="table table-striped shadow">
                    <tr class="bg-info">
                        <th>Nama Alternatif</th>
                        <th>K1</th>
                        <th>K2</th>
                        <th>K3</th>
                        <th>K4</th>
                        <th>K5</th>
                    </tr>

                    <?php
                    $id_alternatifs = $_POST['id_alternatif'];
                    foreach ($id_alternatifs as $id_alternatif) {
                        $data = mysqli_query($con, "SELECT * FROM alternatif WHERE id_alternatif = '$id_alternatif' ");
                        while ($spk = mysqli_fetch_assoc($data)) {

                    ?>

                            <tr>
                                <td><?= $spk['nama']; ?></td>
                                <!-- -----------C1----------- -->
                                <td>
                                    <?php $c1 = $spk['K1'] / $akar1;
                                    $hubungan1 = $hubungan['bobot_prioritas'] * $c1;
                                    
                                    echo number_format($hubungan1, 5);
                                    ?>
                                </td>
                                <!-- -----------C2----------- -->
                                <td>
                                    <?php $c2 = $spk['K2'] / $akar2;
                                    $mpb1 = $mpb['bobot_prioritas'] * $c2;
                                    
                                    echo number_format($mpb1, 5);
                                    ?>
                                </td>
                                <!-- -----------C3----------- -->
                                <td>
                                    <?php $c3 = $spk['K3'] / $akar3;
                                    $mep1 = $mep['bobot_prioritas'] * $c3;
                                    
                                    echo number_format($mep1, 5);
                                    ?>
                                </td>
                                <!-- -----------C4----------- -->
                                <td>
                                    <?php $c4 = $spk['K4'] / $akar4;
                                    $kehadiran1 = $kehadiran['bobot_prioritas'] * $c4;
                                    
                                    echo number_format($kehadiran1, 5);
                                    ?>
                                </td>
                                <!-- -----------C5----------- -->
                                <td>
                                    <?php $c5 = $spk['K5'] / $akar5;
                                    $masa1 = $masa['bobot_prioritas'] * $c5;
                                    
                                    echo number_format($masa1, 5);
                                    ?>
                                </td>
                            </tr>

                    <?php
                        }
                    }

                    ?>

                </table>
            </div>


            <br><br>
            <h1 style="border-bottom:3px dodgerblue solid"></h1>
            <br><br>

            <button id="nextButton2" style="display:none;" onclick="toggleTable2()">Next</button>
            <div id="hasil" style="display:none;" class="alert alert-info">
                <center><b>HASIL AKHIR</b></center>
            </div>

            <div id="hasil1" style="display:none;" class="table-responsive p-4">
                <table class="table table-striped shadow">
                    <tr class="bg-info">
                        <th>Nama Alternatif</th>
                        <th>Total</th>
                    </tr>



                    <?php

                    $id_alternatifs = $_POST['id_alternatif'];
                    foreach ($id_alternatifs as $id_alternatif) {
                        $data = mysqli_query($con, "SELECT * FROM alternatif WHERE id_alternatif = '$id_alternatif' ");
                        while ($spk = mysqli_fetch_assoc($data)) {

                    ?>

                            <?php $spk['nama']; ?>
                            <!-- -----------C1----------- -->

                            <?php $c1 = $spk['K1'] / $akar1;
                            $hubungan1 = $hubungan['bobot_prioritas'] * $c1;
                            
                            number_format($hubungan1, 5);
                            ?>
                            <!-- -----------C2----------- -->
                            <?php $c2 = $spk['K2'] / $akar2;
                            $mpb1 = $mpb['bobot_prioritas'] * $c2;
                           
                            number_format($mpb1, 5);
                            ?>
                            <!-- -----------C3----------- -->
                            <?php $c3 = $spk['K3'] / $akar3;
                            $mep1 = $mep['bobot_prioritas'] * $c3;
                            
                            number_format($mep1, 5);
                            ?>
                            <!-- -----------C4----------- -->
                            <?php $c4 = $spk['K4'] / $akar4;
                            $kehadiran1 = $kehadiran['bobot_prioritas'] * $c4;
                           
                            number_format($kehadiran1, 5);
                            ?>
                            <!-- -----------C5----------- -->
                            <?php $c5 = $spk['K5'] / $akar5;
                            $masa1 = $masa['bobot_prioritas'] * $c5;
                            
                            number_format($masa1, 5);
                            ?>

                            <form action="" method="POST" class="form-group">
                                <tr>
                                    <input type="hidden" name="kode" value="<?= $kode; ?>">
                                    <!-- --------------ID ALTERNATIF-------------- -->
                                    <input type="hidden" name="id_alternatif[]" value="<?= $spk['id_alternatif'] ?>">
                                    <!-- --------------NAMA ALTERNATIF-------------- -->
                                    <input type="hidden" name="nama_alternatif[]" value="<?= $spk['nama'] ?>">
                                    <td><?= $spk['nama']; ?></td>
                                    <!-- --------------TOTAL HASIL-------------- -->
                                    <td>
                                        <?php
                                        $totalll = $hubungan1 + $mpb1 + $mep1 + $kehadiran1 + $masa1;
                                        echo number_format($totalll, 5);
                                        ?>
                                        <input type="hidden" name="total_hasil[]" value="<?= number_format($totalll, 5); ?>">
                                    </td>

                            <?php
                        }
                    } ?>

                                </tr>
                                <?php

                                $data = mysqli_query($con, "SELECT * FROM kelas ");
                                while ($spk = mysqli_fetch_assoc($data)) {
                                ?>
                                    <!-- --------------ID KELAS-------------- -->
                                    <input type="hidden" name="id_kelas[]" value="<?= $spk['id_kelas'] ?>">
                                <?php
                                }
                                ?>

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
                                ">Simpan</button>
                                <br><br>
                            </form>

                </table>
            </div>

        </div>
    <?php   } ?>


    <script>
        function toggleTable() {
            var judul = document.getElementById("normalisasi");
            var judul1 = document.getElementById("normalisasi1");
            var button1 = document.getElementById("nextButton1");
            var nextButton = document.getElementById("nextButton");

            if (judul.style.display === "none") {
                judul.style.display = "block";
                judul1.style.display = "block";
                button1.style.display = "inline-block"; // Menampilkan button1
                // nextButton.textContent = "Previous";
                nextButton.style.display = "none"
            } else {
                judul.style.display = "none";
                button1.style.display = "none"; // Menyembunyikan button1
                // nextButton.textContent = "Next";
                nextButton.style.display = "none"
            }
        }

        function toggleTable1() {
            var optimasilisasi = document.getElementById("optimasilisasi");
            var optimasilisasi1 = document.getElementById("optimasilisasi1");
            var button2 = document.getElementById("nextButton2");
            var nextButton = document.getElementById("nextButton1");

            if (optimasilisasi.style.display === "none") {
                optimasilisasi.style.display = "block";
                optimasilisasi1.style.display = "block";
                button2.style.display = "inline-block"; // Menampilkan button1
                // nextButton.textContent = "Previous";
                nextButton.style.display = "none"
            } else {
                optimasilisasi.style.display = "none";
                button2.style.display = "none"; // Menyembunyikan button1
                // nextButton.textContent = "Next";
                nextButton.style.display = "none"
            }
        }

        function toggleTable2() {
            var hasil = document.getElementById("hasil");
            var hasil1 = document.getElementById("hasil1");
            var nextButton = document.getElementById("nextButton2");


            if (hasil.style.display === "none") {
                hasil.style.display = "block";
                hasil1.style.display = "block";
                // nextButton.textContent = "Previous";
                nextButton.style.display = "none"
            } else {
                tableC.style.display = "none";
                // nextButton.textContent = "Next";
                nextButton1.style.display = "none"
            }
        }
    </script>

    </body>

    </html>