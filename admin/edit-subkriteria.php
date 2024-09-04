<?php
include('../config.php');

// Sambungkan ke database
$koneksi = new mysqli("localhost", "root", "", "tadina");

// Periksa koneksi
if ($koneksi->connect_error) {
	die("Koneksi ke database gagal: " . $koneksi->connect_error);
}

$sub_kriteria 	= $_POST['sub_kriteria'];
$nilai_rasio 	= $_POST['nilai_rasio'];
echo $sub_kriteria . " - " . $nilai_rasio;

$result = $mysqli->query("UPDATE detail_kriteria SET `sub_kriteria` = '" . $sub_kriteria . "', `nilai_rasio` = '" . $nilai_rasio . "'
					WHERE `id_dkriteria` = " . $_GET['id_dkriteria'] . ";");
if (!$result) {
	echo $mysqli->connect_errno . " - " . $mysqli->connect_error;
	exit();
} else {
	header('Location: ../admin/kelola-subkriteria.php');
}
