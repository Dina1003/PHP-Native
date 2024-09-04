<!DOCTYPE html>

<?php
session_start();

include('config.php');
require 'fungsi.php';


?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login Form</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #68B984;
            background-repeat: no-repeat;
            margin: 0;
            display: flex;
            align-items: center;
            justify-content: center;
            height: 100vh;
        }

        .login-container {
            background-color: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
        }

        label {
            display: block;
            margin-bottom: 8px;
        }

        input {
            width: 100%;
            padding: 8px;
            margin-bottom: 16px;
            box-sizing: border-box;
        }

        button {
            background-color: #4caf50;
            color: #fff;
            padding: 10px 15px;
            border: none;
            border-radius: 4px;
            cursor: pointer;
        }
    </style>
</head>
<body">


    <div class="login-container">
        <h2>Login</h2>
        <form action="#" method="post">
            <label for="username">Username:</label>
            <input type="text" id="username" name="user" required autofocus required>

            <label for="password">Password:</label>
            <input type="password" id="password" name="pass" required>

            <input type="submit" class="button" title="Log In" name="login" value="Login"></input>

            <!-- <button type="submit" onclick="pindah()">Login</button> -->

        </form>

        <?php

        if (isset($_POST['login'])) {
            $username = mysqli_real_escape_string($mysqli, $_POST['user']);
            $pass = mysqli_real_escape_string($mysqli, (md5($_POST['pass'])));

            $query      = mysqli_query($mysqli, "SELECT * FROM pengguna WHERE username='$username' and  pass='$pass' ");
            $row        = mysqli_fetch_array($query);
            $num_row    = mysqli_num_rows($query);

            if ($num_row > 0) {
                $_SESSION['id'] = $row['id_pengguna'];

                if ($row['role'] == 'admin') {
                    echo "<script>
                    alert('Anda Berhasil Login')
                document.location.href='admin/index.php'
                </script>";
                } elseif ($row['role'] == 'wkmda') {
                    echo "<script>
                    alert('Anda Berhasil Login')
                document.location.href='user/index.php'
                </script>";
                }
                // header('location:index.php');
            //     echo "<script>
            // 			alert('Anda Berhasil Login')
            //    document.location.href='admin/index.php'
            // 		</script>";
            } else {
                echo "Password atau Username Salah!!!";
            }
        }

        ?>


        <!-- <script>
        function pindah() {
            window.location.href = "index.html";
        }
    </script> -->

    </div>

    </body>

</html>