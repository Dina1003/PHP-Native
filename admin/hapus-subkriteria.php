<?php
	include('../config.php');
	
	$result = $mysqli->query("delete from detail_kriteria where id_dkriteria = ".$_GET['id_dkriteria'].";");
	if(!$result){
		echo $mysqli->connect_errno." - ".$mysqli->connect_error;
		exit();
	}
	else{
		header('Location: ../admin/kelola-subkriteria.php');
	}
?>