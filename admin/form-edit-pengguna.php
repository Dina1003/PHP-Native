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

<?php
	include('../config.php');

	// // mendapatkan data edit
	// if(isset($_GET['jenis']) && isset($_GET['id'])) {
	// 	$id 	= $_GET['id'];
	// 	$jenis	= $_GET['jenis'];

	// 	// hapus record
	// 	$query 	= "SELECT nama FROM $jenis WHERE id=$id";
	// 	$result	= mysqli_query($koneksi, $query);
		
	// 	while ($row = mysqli_fetch_array($result)) {
	// 		$nama = $row['nama'];
	// 	}
	// }

	// if (isset($_POST['update'])) {
	// 	$id 	= $_POST['id'];
	// 	$jenis	= $_POST['jenis'];
	// 	$nama 	= $_POST['nama'];

	// 	$query 	= "UPDATE $jenis SET nama='$nama' WHERE id=$id";
	// 	$result	= mysqli_query($koneksi, $query);

	// 	if (!$result) {
	// 		echo "Update gagal";
	// 		exit();
	// 	} else {
	// 		header('Location: '.$jenis.'.php');
	// 		exit();
	// 	}
	// }

?>

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

        <h3 class="h3">Edit Data Pengguna</h3>

        <?php 
       include('../config.php');
        $result = $mysqli->query("select * from pengguna where id_pengguna = ".$_GET['id_pengguna']."");
        if(!$result){
            echo $mysqli->connect_errno." gagal cuk.. sabar ".$mysqli->connect_error;
            exit();
        }
        

        while($row = $result->fetch_assoc()) {
        ?>

        
        <form role="form" method="post" action="edit-pengguna.php?id_pengguna=<?php echo $_GET['id_pengguna'];?>">

            <span class="keterangan">Username</span>
           <input type="text" class="tambah" name="tpusername" id="username" value= <?php echo $row['username']; ?>>

           <span class="keterangan">Password</span>
           <input type="password" class="tambah" name="tppass" id="pass" value= <?php echo $row['pass']; ?>>

           <span class="keterangan">Nama Lengkap</span>
           <input type="text" class="tambah" name="tpnama" id="nama_lengkap" value= <?php echo $row['nama_lengkap']; ?>>

           <button type="submit" class="action_btn" 
           style="
             text-decoration: none;
             color: black;
             border: 1px solid #da7e1c;
             background: #deb887;
             padding: 5px 15px;
             font-weight: bold;
             border-radius: 3px;
             transition: 0.5s ease-in-out;
             font-size: medium;
           ">Edit Pengguna</button>
           
           <!-- <span class="action_btn">
           <button type="submit" class="btn btn-primary">Edit Kriteria</button>
        </span> -->
        </form>
        <?php
        }
        ?>
    </div>
</body>
</html>