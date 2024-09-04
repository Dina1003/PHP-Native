


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


    <?php
    include '../config.php';
    include('../fungsi.php');

    //Tampilkan Data Dengan Menggunakan Inner Join
    $user = $mysqli->query("SELECT detail_kriteria.id_dkriteria, detail_kriteria.id_kriteria, detail_kriteria.sub_kriteria, detail_kriteria.nilai_rasio, kriteria.keterangan, kriteria.id_kriteria FROM detail_kriteria, kriteria WHERE kriteria.id_kriteria=detail_kriteria.id_kriteria ORDER BY detail_kriteria.id_kriteria");
    if (!$user) {
        echo $mysqli->connect_errno . " - " . $mysqli->connect_error;
        exit();
    }
    $i = 0;

    //Cari Nilai Rasio Terbesar
    $data_kriteria = $mysqli->query("SELECT * FROM kriteria");
    if (!$data_kriteria) {
        echo $mysqli->connect_errno . " - " . $mysqli->connect_error;
        exit();
    }
    $row = mysqli_fetch_array($data_kriteria);
    $nilai = $row[0];

    //ambil data
    $id_kriteria = $_GET['id_kriteria'];

    $user1 = $mysqli->query("SELECT detail_kriteria.id_dkriteria,detail_kriteria.id_kriteria, detail_kriteria.sub_kriteria, detail_kriteria.nilai_rasio, kriteria.keterangan, kriteria.id_kriteria FROM detail_kriteria, kriteria WHERE kriteria.id_kriteria=detail_kriteria.id_kriteria AND detail_kriteria.id_kriteria=$id_kriteria ");
    if (!$user1) {
        echo $mysqli->connect_errno . " - " . $mysqli->connect_error;
        exit();
    }
    $i = 0;
    ?>

    <div class="isi">
        <a href="../admin/kelola-kriteria.php">Kriteria</a>
        <a href="../admin/kelola-subkriteria.php">/ Sub-Kriteria</a>
        <a href="../admin/perbandingan-bobot-kriteria.php">/ Nilai Perbandingan Kepentingan Kriteria</a>

        <br><span class="action_btn">
            <a href="../admin/form-tambah-subkriteria.php">Tambah Sub-Kriteria</a>
        </span>
    </div>

    <div class="isi">
        <table class="perbandingan" style="float: left; margin-right: 50px; margin-top:10px;">
            <thead>
                <tr>
                    <th>Nama Kriteria</th>
                    <th>Aksi</th>
                </tr>

            </thead>
            <tbody>
                <?php foreach ($data_kriteria as $kriteria) { ?>
                    <tr>
                        <td><?= $kriteria['keterangan']; ?></td>
                        <td>
                            <span class="action_btn1">
                                <a href="../admin/kelola-subkriteria1.php?id_kriteria=<?= $kriteria['id_kriteria']; ?>" style="background-color: #deb887; color: black;">Detail</a>
                            </span>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>

        <table class="table2">
            <thead>
                <tr>
                    <th> Sub Kriteria</th>
                    <th> Nilai Rasio</th>
                    <th> Aksi</th>
                </tr>
            </thead>

            <tbody>
                <?php
                foreach ($user1 as $kriteria) { ?>
                    <tr>
                        <td><?= $kriteria['sub_kriteria']; ?></td>
                        <td><?= $kriteria['nilai_rasio']; ?></td>
                        <td>
                            <span class="action_btn1">
                                <a href="../admin/form-edit-subK.php?id_dkriteria=<?= $kriteria['id_dkriteria']; ?>">Edit</a>
                                <a href="../admin/hapus-subkriteria.php?id_dkriteria=<?= $kriteria['id_dkriteria']; ?>"
                                onclick="return confirm('Anda yakin akan menghapus data sub-kriteria <?php echo $kriteria['sub_kriteria']; ?> ?')">Hapus</a>
                            </span>
                        </td>
                    </tr>
                <?php } ?>
            </tbody>
        </table>
    </div>

</body>

</html>