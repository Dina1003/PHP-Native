<?php
	include('../config.php');
	
	$result = $mysqli->query("delete from kriteria where id_kriteria = ".$_GET['id_kriteria'].";");
	if(!$result){
		echo $mysqli->connect_errno." - ".$mysqli->connect_error;
		exit();
	}
	else{
		header('Location: ../admin/kelola-kriteria.php');
	}
?>