<?php
include('../config.php');

// Sambungkan ke database
$koneksi = new mysqli("localhost", "root", "", "tadina");

// Periksa koneksi
if ($koneksi->connect_error) {
	die("Koneksi ke database gagal: " . $koneksi->connect_error);
}

// ambil data dari form
$nama_kriteria 	= $_POST['tpnama'];
$keterangan 	= $_POST['tpketerangan'];
$type 	= $_POST['tptype'];
echo $nama_kriteria . " - " . $keterangan . " - " . $type;

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = $_POST['tpnama'];
    $keterangan = $_POST['tpketerangan'];

    // // Query untuk memeriksa apakah data sudah ada di database
    // $check_query = "SELECT nama_kriteria,keterangan FROM kriteria WHERE nama_kriteria = '$nama' OR keterangan= '$keterangan' ";
    // $check_result = $koneksi->query($check_query);

    // if ($check_result->num_rows > 0) {
    //     // Jika data sudah ada di database, tampilkan pesan
    //     echo "<script>
    //       alert ('Maaf, Data Sudah Tersedia')
    //       document.location.href='../admin/kelola-kriteria.php'
    //       </script>";
    // } else {
        $result = $mysqli->query("UPDATE kriteria SET `nama_kriteria` = '" . $nama_kriteria . "', `keterangan` = '" . $keterangan . "',`type` = '" . $type . "' WHERE `id_kriteria` = " . $_GET['id_kriteria'] . ";");
        if (!$result) {
            echo "<script language='javascript'> window.alert('Mohon perhatikan inputan data'); window.location=('../admin/form-edit-kriteria.php')</script>";
            exit();
        } else {
            header('Location: ../admin/kelola-kriteria.php');
        }
    }

// Tutup koneksi database
$koneksi->close();

// $result = $mysqli->query("UPDATE kriteria SET `nama_kriteria` = '" . $nama_kriteria . "', `keterangan` = '" . $keterangan . "',`type` = '" . $type . "' WHERE `id_kriteria` = " . $_GET['id_kriteria'] . ";");
// 		if (!$result) {
// 			echo $mysqli->connect_errno . " - " . $mysqli->connect_error;
// 			exit();
// 		} else {
// 			header('Location: ../admin/kelola-kriteria.php');
// 		}
