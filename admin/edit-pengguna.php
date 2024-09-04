<?php
	include('../config.php');
    $username 	    = $_POST['tpusername'];
    $pass     	    = (md5($_POST['tppass']));
    $nama_lengkap 	= $_POST['tpnama'];
	echo $username." - ".$pass." - ".$nama_lengkap;
	
	$result = $mysqli->query("UPDATE pengguna SET `username` = '".$username."', `pass` = '".$pass."',`nama_lengkap` = '".$nama_lengkap."' 
					WHERE `id_pengguna` = ".$_GET['id_pengguna'].";");
	if(!$result){
		echo $mysqli->connect_errno." - ".$mysqli->connect_error;
		exit();
	}
	else{
		header('Location: ../admin/kelola-pengguna.php');
	}
?>