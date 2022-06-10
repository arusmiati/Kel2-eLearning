<?php

session_start();
if (!isset($_SESSION['$login_siswa'])) {
    header("Location: login.php");
    exit;
}
require 'functions.php';
error_reporting(0);
$id = $_GET["Id"];

if (isset($_POST['edit'])) {
    if (EditProfil($_POST) > 0) {
        header("Location:profil.php?Id=$id");
    } else {
        echo '<script> alert: Profil Gagal Diedit';
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;300;500;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <title>Bantuan</title>
    <link rel="stylesheet" href="style.css">

</head>

<body>
    <?php require_once('navbar/navbarmapel.php') ?>
    <div class="main-container">
        <div id="confirm-box">
            <h1>Apakah anda ingin keluar dari E-LEARNING SMANEL?</h1>
            <a href="login.html" class="yes">Iya</a>
            <a href="" class="no">Tidak</a>
        </div>
        <div class="sidebar" id="sidebar">
            <ul>
                <li class="icon">
                    <a href="profil.php"><img src="img/profil.png" alt=""></a>
                    <br>
                    <span>Profil</span>
                </li>
                <li class="icon">
                    <a href="progress.php"><img src="img/progress.png" alt=""></a>
                    <br>
                    <span>Progress</span>
                </li>
                <li class="icon active">
                    <a href="bantuan.php"><img src="img/bantuan.png" alt=""></a>
                    <br>
                    <span>Bantuan</span>
                </li>
                <li class="icon">
                    <a href="#" onclick="LogConfirm()"><img src="img/logout.png" alt=""></a>
                    <br>
                    <span>Logout</span>
                </li>
            </ul>
        </div>
        <div class="main-content-bantuan">
            <h3>Panduan Mendaftar Kelas untuk Siswa</h3>
            <ol>
                <li>Buka Tab Pencarian Mata Pelajaran</li>
                <li>Cari Kelas dengan menggunakan Filter Pencarian Kelas pada sidebar di bagian kiri.</li>
                <li>Klik detail kelas yang ingin didaftari</li>
                <li>Klik Daftar pada Detail Kelas</li>
            </ol>
            <iframe class="video-tutorial" width="1264" height="480" src="https://www.youtube.com/embed/U4bUP8upgT0" title="YouTube video player" frameborder="0" allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture" allowfullscreen></iframe>

        </div>
    </div>


    <div class="footer">
        <div class="nama-footer">
            <p class="tfooter">SMA Negeri 5 Luwu</p>
            <p>Jl.Jambu Kec. Bajo Kab. Luwu 91995</p>
        </div>
        <div class="web">
            <ul>
                <li><a href="http://sman5luwu.sch.id/index.php"><i class="fa fa-globe"></i><span>sman5luwu.sch.id</span></a>
                </li>
                <li><a href="#"><i class="fa fa-envelope"></i><span>smanel5luwu@gmail.com</span></a></li>
                <li><a href="#"><i class="fa fa-phone"></i><span>085340062586</span></a></li>
            </ul>
        </div>
    </div>

    <script src="script.js"></script>
    <script>
        var c = 0;

        function LogConfirm() {
            if (c == 0) {
                document.getElementById("confirm-box").style.display = "block"
                c = 1;
            } else {
                document.getElementById("confirm-box").style.display = "none"
                c = 0;
            }
        }
    </script>
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>

</body>

</html>