<?php
include '../config.php';
include('../fungsi.php');

session_start();
//JIKA TIDAK DITEMUKAN $_SESSION['id'] (USER TIDAK MELIWATI TAHAP LOGIN) MAKA LEMBAR USER KEHALAMAN LOGIN 
if (!isset($_SESSION['id'])) {
    echo "<script>
    alert('Maaf Anda Belum Login')
document.location.href='../login.php'
</script>";
    exit;
}

$kode = $_GET['kode'];

//MEMBUKA TABEL KRITERIA
$user = $mysqli->query("SELECT * from kriteria");
if (!$user) {
    echo $mysqli->connect_errno . " - " . $mysqli->connect_error;
    exit();
}
$i = 0;

//MEMBUKA TABEL ALTERNATIF
$data_alternatif = $mysqli->query("SELECT * from alternatif");
if (!$data_alternatif) {
    echo $mysqli->connect_errno . " - " . $mysqli->connect_error;
    exit();
}
$i = 0;

//MEMBUKA TABEL KEPUTUSAN
$keputusan = query("SELECT * FROM keputusan ORDER BY kode DESC");

//MEMBUKA TABEL DETAIL KEPUTUSAN
$data = query("SELECT * FROM detail_keputusan WHERE kode_hasil = '$kode' ORDER BY total DESC ");
$data1 = query("SELECT * FROM detail_keputusan WHERE kode_hasil = '$kode'");
$kelas = query("SELECT detail_keputusan.id_kelas, kelas.id_kelas, kelas.nama_kelas FROM detail_keputusan, kelas WHERE kelas.id_kelas=detail_keputusan.id_kelas AND kode_hasil = '$kode'");
$tanggal = query("SELECT * FROM keputusan WHERE kode = '$kode'");

?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>SPK TA</title>
    <style>
        /* Style untuk kop surat */
        .kop-surat {
            text-align: center;
            margin-bottom: 20px;
            border-bottom: 1px solid black;
            /* Menambahkan garis bawah pada div kop-surat */
            padding-bottom: 5px;
            /* Memberikan sedikit ruang di bawah garis */
        }

        .kop-surat h1 {
            font-size: 24px;
            margin-bottom: 5px;
        }
    </style>
    <link rel="stylesheet" href="../style/style.css">
</head>

<body onload="print()">
    <center>
        <div class="kop-surat">
            <!-- Isi Kop Surat -->
            <h2>MADRASAH DINIYAH AWALIYAH NAGARI PADANG LUA</h2>
            <p>Jalan Mesjid Jami' Belakang Mesjid Nagari Padang Lua, Kec. Banuhampu, Kab. Agam, Sumatera Barat</p>
            <p>Kode Pos : 26181</p>
        </div>
    </center>
    <section>
        <center>
            <h1>SURAT KEPUTUSAN</h1>
        </center>
        <div class="isi">
            <p style="text-align: justify;"> Berdasarkan hasil perhitungan dengan menerapkan metode
                AHP dan metode MOORA dalam menentukan Penempatan Wali Kelas Madrasah Diniyah Awaliyah (MDA) Nagari Padang Lua,
                maka didapatkanlah keputusan penempatan wali kelas disesuaikan dengan alternatif yang ditetapkan sebelumnya sebagai
                uraian berikut berdasarkan kriteria yang telah ditetapkan sebelumnya.</p>
        </div>

        <!-- <center>
            <h3 class="h3">PENETAPAN DATA KRITERIA</h3>
        </center>
        <div class="isi">
            <table>
                <thead>
                    <tr>
                        <th>Nama Kriteria</th>
                        <th>Keterangan</th>
                        <th>Tipe</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 1;
                    while ($row = $user->fetch_assoc()) {
                        echo '<tr>';
                        echo '<td>' . $row["nama_kriteria"] . '</td>';
                        echo '<td>' . $row["keterangan"] . '</td>';
                        echo '<td>' . $row["type"] . '</td>'; ?>
                    <?php
                        echo '</tr>';
                    }
                    ?>
                </tbody>
            </table>
        </div> -->

        <center>
            <h3 class="h3">PENETAPAN DATA ALTERNATIF</h3>
        </center>

        <div class="isi">
            <table>
                <thead>
                    <tr>
                        <th>No</th>
                        <th>Nama Calon Wali Kelas</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    $i = 1;
                    while ($row = $data_alternatif->fetch_assoc()) {
                        echo '<tr>';
                        echo '<td>' . $i++ . '</td>';
                        echo '<td>' . $row["nama"] . '</td>'; ?>
                    <?php
                        echo '</tr>';
                    }
                    ?>
                </tbody>
            </table>
        </div>

        <center>
           <br><br><br> <h3 class="h3">PENETAPAN PENILAIAN ALTERNATIF</h3>
        </center>

        <div class="isi">
            <table>
                <thead>
                    <tr>
                        <th>Nama</th>
                        <th>Hubungan Dengan Siswa</th>
                        <th>Metode Pembelajaran</th>
                        <th>Metode Evaluasi Pembelajaran</th>
                        <th>Kehadiran</th>
                        <th>Masa Kerja</th>
                    </tr>
                </thead>
                <tbody>
                    <?php foreach ($data_alternatif as $alternatif) { ?>
                        <tr>
                            <td><?= $alternatif['nama']; ?></td>
                            <td><?= $alternatif['K1']; ?></td>
                            <td><?= $alternatif['K2']; ?></td>
                            <td><?= $alternatif['K3']; ?></td>
                            <td><?= $alternatif['K4']; ?></td>
                            <td><?= $alternatif['K5']; ?></td>
                        </tr>

                    <?php } ?>
                </tbody>
            </table>
        </div>

        <!-- <center>
            <h3 class="h3">BOBOT SETIAP KRITERIA</h3>
        </center>

        <div class="isi">
            <table>
                <thead>
                    <tr>
                        <th>Kriteria</th>
                        <th>Bobot Prioritas</th>
                </thead>
                <tbody>
                    <?php foreach ($user as $kriteria) { ?>
                        <tr>
                            <td><?= $kriteria['keterangan']; ?></td>
                            <td><?= number_format($kriteria['bobot_prioritas'],5); ?></td>
                        </tr>
                    <?php } ?>
                </tbody>
            </table>
        </div> -->

        <!-- <center>
            <h3 class="h3">HASIL PERHITUNGAN PENILAIAN ALTERNATIF</h3>
        </center>

        <div class="isi">
            <table>
                <thead>
                    <tr>
                        <th>Nama Alternatif</th>
                        <th>Total</th>
                    </tr>
                </thead>
                <tbody>

                    <?php $i = 1; ?>
                    <?php foreach ($data1 as $detail_data) { ?>
                        <tr>
                            <td><?= $detail_data['nama_alternatif']; ?></td>
                            <td><?= number_format($detail_data['total'],5);?></td>
                        </tr>
                    <?php } ?>
            </table>
        </div><br> -->

        <center>
            <h3 class="h3">HASIL PENEMPATAN WALI KELAS</h3>
        </center>

        <div class="isi">
            <table class="perbandingan" style="float: left; margin-right: -1px; margin-top: 10px;">
                <thead>
                    <tr>
                        <th>Nama Alternatif</th>
                        <th>Total</th>
                        <th>Rank</th>
                    </tr>
                </thead>
                <tbody>

                    <?php $i = 1; ?>
                    <?php foreach ($data as $detail_data) { ?>
                        <tr>
                            <td><?= $detail_data['nama_alternatif']; ?></td>
                            <td><?= $detail_data['total']; ?></td>
                            <td><?= $i++ ?></td>
                        </tr>
                    <?php } ?>
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

        <br><br>
        <div class="isi">
        <?php foreach ($tanggal as $tanggal1) { ?>
        <p style="text-align: right;">Padang Lua, <?= $tanggal1['tanggal_keputusan'] ?></p>
        <?php } ?>

        <br><br><p style="margin-left: 515px;"> <strong>MENGETAHUI</strong></p>
        <p style="text-align: right;">KEPALA MDA PADANG LUA</p><br><br><br><br>
        <p style="margin-left: 500px;"><strong>RONI TRIANTO, SH</strong></p>
        </div>
    </section>

</body>

</html>