<?php

include('../config.php');

session_start();
//JIKA TIDAK DITEMUKAN $_SESSION['status'] (USER/ADMIN TIDAK MELIWATI TAHAP LOGIN) MAKA LEMBAR ADMIN/USER KEHALAMAN LOGIN 
if (!isset($_SESSION['id'])) {
    echo "<script>
    alert('Maaf Anda Belum Login')
document.location.href='../login.php'
</script>";
    exit;
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css">
    <style>
        /* Initially hide the card */
        #myCard {
            display: none;
        }

        /* Style the card as needed */
        .card {
            width: 300px;
            margin: 20px;
            border: 1px solid #ddd;
            border-radius: 8px;
            box-shadow: 0 4px 8px rgba(0, 0, 0, 0.1);
            padding: 10px;
            text-align: center;
        }

        .images {
            display: flex;
            height: 400px;
            width: 100%;
            transition: 2s;
        }

        .images img{
            width: 100%;
        }

        .wrapper {
            width: 60%;
            margin: auto;
            border-radius: 5px;
            overflow: hidden;
        }

        #slide-1:target ~ .images{
            margin-left: 0px;
        }
        #slide-2:target ~ .images{
            margin-left: -100%;
        }
        #slide-3:target ~ .images{
            margin-left: -200%;
        }

        .navigasi a{
            display: inline-block;
            height: 25px;
            width: 25px;
            background-color: #dedede;
            font-size: 0px;
            border-radius: 50%;
            margin: 3px;
            transition: 1s;
        }
        .navigasi a:hover{
            background-color: #666;
        }
        .navigasi{
            position: absolute;
            margin-left: auto;
            margin-right: auto;
            left: 0;
            right: 0;
            text-align: center;
            margin-top: -50px;
        }
        @media screen and (max-width: 1000px){
            .wrapper{
                width: 90%;
            }
        }
        
    </style>
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="../style/style.css">
    <title>SPK TA</title>
</head>

<body>
    <header>
        <div class="logo">SPK Penempatan Wali Kelas</div>
        <input type="checkbox" id="nav_check" hidden>
        <nav>
            <ul>
                <li style="margin-top: 15px;">
                    <a href="../user/index.php" class="active">Home</a>
                </li>
                <li style="margin-top: 15px;">
                    <a href="../user/kelola-alternatif.php">Alternatif</a>
                </li>
                <li style="margin-top: 15px;">
                    <a href="../user/laporan.php">Rekap</a>
                </li>
                <li style="margin-top: 15px;">
                    <a href="../logout.php">Log-Out</a>
                </li>

            </ul>
        </nav>
        <label for="nav_check" class="hamburger">
            <div></div>
            <div></div>
            <div></div>
        </label>
    </header>


    <div class="isi">

        <h3 style="text-align: center;">SELAMAT DATANG 👋</h3><br>

        <div class="wrapper">
            <div class="slide">

                <span id="slide-1"></span>
                <span id="slide-2"></span>
                <span id="slide-3"></span>

                <div class="images">
                    <img src="../image/user/user1.gif" class="slide" alt="Slide 1">
                    <img src="../image/user/user2.gif" class="slide" alt="Slide 2">
                    <img src="../image/user/user3.gif" class="slide" alt="Slide 3">
                </div>
            </div>

            <!-- navigasi -->
            <div class="navigasi">
                <a href="#slide-1">1</a>
                <a href="#slide-2">2</a>
                <a href="#slide-3">3</a>
            </div>
        </div>

        <div class="container mt-5">
            <div class="row">
                <div class="card card-body col-md-4" style="background: linear-gradient(to right, #A4D0A4, #faebd7);">
                    <h5 class="card-title">Nilai Random Index</h5>
                    <p class="card-text">Nilai Random Index (RI) ini sudah sesuai dengan ketetapan dalam perhitungan metode AHP</p>
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#cardModal" style="
                    text-decoration: none;
                    color: black;
                    border: 1px solid #da7e1c;
                    background: #deb887;
                    padding: 5px 15px;
                    font-weight: bold;
                    border-radius: 3px;
                    transition: 0.5s ease-in-out;
                    font-size: medium;
                    ">
                        Lihat
                    </button>
                </div>

                <div class="modal fade" id="cardModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel">Nilai Random Index</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>

                            <div style="margin-left: 19px;">
                                <table style="width:90%; text-align: center;">


                                    <?php
                                    include '../config.php';
                                    $user = $mysqli->query("SELECT * from ir");
                                    if (!$user) {
                                        echo $mysqli->connect_errno . " - " . $mysqli->connect_error;
                                        exit();
                                    }
                                    $i = 0;
                                    ?>

                                    <table style="width:90%; text-align: center;">
                                        <thead>
                                            <tr>
                                                <th>Random Index</th>
                                                <th>Nilai</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $i = 1;
                                            while ($row = $user->fetch_assoc()) {
                                                echo '<tr>';
                                                echo '<td>' . $row["ri"] . '</td>';
                                                echo '<td>' . $row["nilai"] . '</td>';
                                                echo '</tr>';
                                            }
                                            ?>
                                        </tbody>
                                    </table>

                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card card-body col-md-4" style="background: linear-gradient(to right, #A4D0A4, #faebd7);">
                    <h5 class="card-title">Data Calon Wali Kelas</h5>
                    <p class="card-text">Data calon wali kelas ini ditampilkan sesuai dengan inputan pada fitur alternatif</p>
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#cardModal1" style="
                        text-decoration: none;
                        color: black;
                        border: 1px solid #da7e1c;
                        background: #deb887;
                        padding: 5px 15px;
                        font-weight: bold;
                        border-radius: 3px;
                        transition: 0.5s ease-in-out;
                        font-size: medium;
                        ">
                        Lihat
                    </button>
                </div>

                <div class="modal fade" id="cardModal1" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel1" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel1">Data Calon Wali Kelas</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>

                            <div style="margin-left: 19px;">
                                <table style="width:90%; text-align: center;">
                                    <?php
                                    include '../config.php';
                                    $user = $mysqli->query("SELECT * from alternatif");
                                    if (!$user) {
                                        echo $mysqli->connect_errno . " - " . $mysqli->connect_error;
                                        exit();
                                    }
                                    $i = 0;
                                    ?>

                                    <table style="width:90%; text-align: center;">
                                        <thead>
                                            <tr>
                                                <th>No</th>
                                                <th>Nama</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $i = 1;
                                            while ($row = $user->fetch_assoc()) {
                                                echo '<tr>';
                                                echo '<td>' . $i++ . '</td>';
                                                echo '<td>' . $row["nama"] . '</td>';
                                                echo '</tr>';
                                            }
                                            ?>
                                    </table>
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="card card-body col-md-4" style="background: linear-gradient(to right, #A4D0A4, #faebd7);">
                    <h5 class="card-title">Data Kriteria</h5>
                    <p class="card-text">Data kriteria yang ditampilkan disesuaikan dengan data input pada fitur tambah kriteria. Data kriteria
                        dapat di kelola pada fitur kriteria.
                    </p>
                    <button type="button" class="btn btn-primary" data-toggle="modal" data-target="#cardModal2" style="
                        text-decoration: none;
                        color: black;
                        border: 1px solid #da7e1c;
                        background: #deb887;
                        padding: 5px 15px;
                        font-weight: bold;
                        border-radius: 3px;
                        transition: 0.5s ease-in-out;
                        font-size: medium;
                        ">
                        Lihat
                    </button>
                </div>

                <div class="modal fade" id="cardModal2" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel2" aria-hidden="true">
                    <div class="modal-dialog" role="document">
                        <div class="modal-content">
                            <div class="modal-header">
                                <h5 class="modal-title" id="exampleModalLabel2">Data Kriteria</h5>
                                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                    <span aria-hidden="true">&times;</span>
                                </button>
                            </div>

                            <div style="margin-left: 19px;">
                                <table style="width:90%; text-align: center;">
                                    <?php
                                    include '../config.php';
                                    $user = $mysqli->query("SELECT * from kriteria");
                                    if (!$user) {
                                        echo $mysqli->connect_errno . " - " . $mysqli->connect_error;
                                        exit();
                                    }
                                    $i = 0;
                                    ?>

                                    <table style="width:90%; text-align: center;">
                                        <thead>
                                            <tr>
                                                <th>Kriteria</th>
                                                <th>Nama Kriteria</th>
                                                <th>Bobot</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            $i = 1;
                                            while ($row = $user->fetch_assoc()) {
                                                echo '<tr>';
                                                echo '<td>' . $row["nama_kriteria"] . '</td>';
                                                echo '<td>' . $row["keterangan"] . '</td>';
                                                echo '<td>' . number_format($row["bobot_prioritas"],5) . '</td>';
                                                echo '</tr>';
                                            }
                                            ?>
                                    </table>
                            </div>

                            <div class="modal-footer">
                                <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
                            </div>
                        </div>
                    </div>
                </div>

            </div>
        </div>
    </div>

    <!-- Bootstrap JS and Popper.js (for Bootstrap) -->
    <script src="https://code.jquery.com/jquery-3.2.1.slim.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
</body>

</html>