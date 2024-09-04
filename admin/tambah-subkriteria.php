<?php
include('../config.php');

$koneksi = new mysqli("localhost", "root", "", "tadina");

// Periksa koneksi
if ($koneksi->connect_error) {
    die("Koneksi ke database gagal: " . $koneksi->connect_error);
}

$id_kriteria     = $_POST['kriteria'];
$sub_kriteria    = $_POST['sub_kriteria'];
$nilai_rasio     = $_POST['nilai_rasio'];

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nama = $_POST['sub_kriteria'];


        $result = $mysqli->query("INSERT INTO `detail_kriteria` (`id_dkriteria`,`id_kriteria`,`sub_kriteria`, `nilai_rasio`) VALUES ('', '" . $id_kriteria . "', '" . $sub_kriteria . "', '" . $nilai_rasio . "');");
        if (!$result) {
            echo "<script language='javascript'> window.alert('Mohon perhatikan inputan data'); window.location=('../admin/form-tambah-subkriteria.php')
				</script>";
            exit();
        } else {
            header('Location: ../admin/kelola-subkriteria.php');
        }
    // }
}

// Tutup koneksi database
$koneksi->close();
?>
