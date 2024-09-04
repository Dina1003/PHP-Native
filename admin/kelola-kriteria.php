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

        <script>
            document.addEventListener("DOMContentLoaded", function() {
                var tambahLink = document.getElementById('tambah-link');
                var rowCount = document.getElementById('data-table').rows.length;

                // cek total data
                if (rowCount > 5) {
                    // tentukan apa yang mau di non-aktifkan
                    tambahLink.removeAttribute('href');
                    tambahLink.style.pointerEvents = 'none'; // link tidak bisa di klik
                    tambahLink.style.color = 'grey'; // ganti warna jadi abu abu
                }
            });
        </script>

        <br><span class="action_btn">
            <a id="tambah-link" href="../admin/form-tambah-kriteria.php">Tambah Kriteria</a>
        </span>

    </div>

    <?php
    include '../config.php';
    include('../fungsi.php');
    // menjalankan perintah delete
    if (isset($_POST['delete'])) {
        $id = $_POST['id'];
        deleteKriteria($id);
    }

    $user = $mysqli->query("SELECT * from kriteria");
    if (!$user) {
        echo $mysqli->connect_errno . " - " . $mysqli->connect_error;
        exit();
    }
    $i = 0;
    ?>

    <div class="isi">
        <table id="data-table">
            <thead>
                <tr>
                    <th>Nama Kriteria</th>
                    <th>Keterangan</th>
                    <th>Tipe</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $i = 1;
                while ($row = $user->fetch_assoc()) {
                    echo '<tr>';
                    echo '<td>' . $row["nama_kriteria"] . '</td>';
                    echo '<td>' . $row["keterangan"] . '</td>';
                    echo '<td>' . $row["type"] . '</td>';
                    echo '<td>';
                ?>




                    <span class="action_btn1">
                        <a href="../admin/form-edit-kriteria.php?id_kriteria=<?php echo $row['id_kriteria']; ?>">Edit</a>
                        <form class="action_btn1" method="post" action="kelola-kriteria.php">
                            <input type="hidden" name="id" value="<?php echo $row['id_kriteria'] ?>">
                            <button type="submit" name="delete" style="
                            text-decoration: none;
                            color: white;
                            border: 1px solid rgb(138, 136, 135);
                            display: inline-block;
                            padding: 5px 15px;
                            font-weight: bold;
                            border-radius: 3px;
                            background-color: #ff0000;
                            font-size:medium;
                            transition: 0.5s ease-in-out;">Hapus</button>
                        </form>
                    </span>


                    <!-- <a href="hapus-kriteria.php?id_kriteria=<?php echo $row['id_kriteria']; ?>" onclick="return confirm('Anda yakin akan menghapus data kriteria <?php echo $row['keterangan']; ?> ?')">Hapus</a> -->
                    </td>
                <?php
                    echo '</tr>';
                }
                ?>
            </tbody>
        </table>
    </div>

</body>

</html>