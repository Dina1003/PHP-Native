<?php
    include('../config.php');
    $username 	= $_POST['tpusername'];
    $pass     	= (md5($_POST['tppass']));
    $nama_lengkap 	= $_POST['tpnama'];
    $role 	= $_POST['tppengguna'];
    
    
    
    $result = $mysqli->query("INSERT INTO `pengguna` (`id_pengguna`,`username`, `pass`, `nama_lengkap`, `role`) 
                                VALUES ('', '".$username."', '".$pass."', '".$nama_lengkap."', '".$role."');");
    if(!$result){
        echo"<script language='javascript'> window.alert('Mohon perhatikan inputan data, gunakan username yang unik agar proses lancar'); window.location=('../admin/form-tambah-pengguna.php')
				</script>"; 
        exit();
    }
    else{
        header('Location: ../admin/kelola-pengguna.php');
    }
?>