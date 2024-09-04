<?php
	include('../config.php');
	
	$result = $mysqli->query("delete from pengguna where id_pengguna = ".$_GET['id_pengguna'].";");
	if(!$result){
		echo $mysqli->connect_errno." - ".$mysqli->connect_error;
		exit();
	}
	else{
		header('Location: ../admin/kelola-pengguna.php');
	}
?>