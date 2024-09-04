<?php
session_start();

session_destroy();
session_unset();

// echo "<script>
//           alert ('Logout Berhasil! Terima Kasih')
//           document.location.href='kelola-alternatif.php'
//           </script>";

echo "<script>
	 				alert('Terima Kasih! Klik OK Untuk Log-Out')
           document.location.href='Login.php'
	 			</script>";
