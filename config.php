<?php
$mysqli = new mysqli('localhost','root','','tadina');
        if($mysqli->connect_errno){
            echo $mysqli->connect_errno." - ".$mysqli->connect_errno;
            exit();
        }
?>