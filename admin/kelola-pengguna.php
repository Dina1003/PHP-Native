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

        <br><span class="action_btn">
            <a href="../admin/form-tambah-pengguna.php">Tambah Pengguna</a>
        </span>
    </div>

    <?php 
        include '../config.php';
        $user = $mysqli->query("SELECT * from pengguna");
        if(!$user){
            echo $mysqli->connect_errno." - ".$mysqli->connect_error;
            exit();
        }
        $i = 0;
    ?>

    <section class="isi">
        <table>
            <thead>
                <tr>       
                    <th>Username</th>
                    <th>Password</th>
                    <th>Nama Lengkap</th>
                    <th>Role</th>
                    <th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                <?php
                    $i = 1;
                    while($row = $user->fetch_assoc()) {
                        echo '<tr>';
                        echo '<td>'.$row["username"].'</td>';
                        echo '<td>'.$row["pass"].'</td>';
                        echo '<td>'.$row["nama_lengkap"].'</td>';
                        echo '<td>'.$row["role"].'</td>';
                        echo '<td>';
                ?>

                <span class="action_btn1">
                    <a href="../admin/form-edit-pengguna.php?id_pengguna=<?php echo $row['id_pengguna'];?>">Edit</a>
                    <a href="../admin/hapus-pengguna.php?id_pengguna=<?php echo $row['id_pengguna'];?>" onclick="return confirm('Anda yakin akan menghapus data atas nama <?php echo $row['nama_lengkap'];?> ?')">Hapus</a>
                </span></td>
                <?php 
                echo '</tr>';
                }
                ?>
            </tbody>
        </table>

    </section>

</body>

</html>