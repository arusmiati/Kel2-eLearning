<?php

session_start();
if (!isset($_SESSION['$login_guru'])) {
  header("Location: login.php");
  exit;
}

error_reporting(0);
require 'functions.php';

$previous = "javascript:history.go(-1)";
if (isset($_SERVER['HTTP_REFERER'])) {
  $previous = $_SERVER['HTTP_REFERER'];
}

$Id = $_GET['Id'];

$p = query("SELECT * FROM pengumuman  WHERE Id_Pengumuman = '$Id'");
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;300;500;700;800&display=swap"rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <title>Pengumuman</title>
    <link rel="stylesheet" href="style.css">

</head>

<body>
    <?php require_once('navbar/navbarkelas_guru.php') ?>

    <div class="main-container">
        <div id="confirm-box-logout">
            <h1>Apakah anda ingin keluar dari E-LEARNING SMANEL?</h1>
            <a href="logout.php" class="yes">Iya</a>
            <a href="" class="no">Tidak</a>
        </div>
        <div id="confirm-box-unduh">
            <h1>Apakah anda ingin mengunduh file ini?</h1>
            <a href="#" onclick="unduhYaps()" class="yes">Iya</a>
            <a href="" class="no">Tidak</a>
        </div>
        <div id="confirm-box-unduh-yaps">
            <h1>Anda Berhasil Mengunduh File ini</h1>
        </div>
        <div id="confirm-box-delete">
            <h1>Apakah anda yakin ingin menghapus pengumuman ini?</h1>
            <a href="#" onclick="deleteYaps()" class="yes">Iya</a>
            <a href="" class="no">Tidak</a>
        </div>
        <div id="confirm-box-delete-yaps">
            <h1>Pengumuman ini Berhasil Dihapus</h1>
        </div>
        <div class="tabel">
            <div class="tabel-content doc-content">
                <div class="doc-header d-flex">
                    <span><a href="javascript:history.back()"><i class="fa fa-arrow-left"></i></a> </span>
                    <h1>Pengumuman</h1>
                </div>
                <div class="tugas-list">
                    <div class="tugas-list-item">
                       <div class="title-tugas d-flex">
                           <p><?=$p["Judul"]?></p>
                           <div class="dropdown">
                            <button class="btn-mapel" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <img class="colon" src="img/titik3.png" alt="">
                            </button>
                            <div id="drop-history" class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                              <a class="dropdown-item" href="editpengumuman.php?Id=<?=$p["Id_Pengumuman"]?>">Edit Pengumuman</a>
                              <a class="dropdown-item" onclick="DeleteConfirm()" href="hapuspengumuman.php?Id=<?=$p["Id_Pengumuman"]?>">Delete Pengumuman</a>
                            </div>
                        </div>
                       </div>
                        <div class="item-tugas">
                           <div class="dl">
                               <p><?= date("D, j F Y", strtotime($p["Waktu"]))?></p>
                           </div>
                           <div class="desk">
                               <p>
                               <?=$p["Deskripsi"]?>
                               </p>
                           </div>
                       </div>
                    </div>
                </div>
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
                document.getElementById("confirm-box-logout").style.display = "block"
                c = 1;
            }
            else {
                document.getElementById("confirm-box-logout").style.display = "none"
                c = 0;
            }
        }

        

        function DeleteConfirm() {
            if (c == 0) {
                document.getElementById("confirm-box-delete").style.display = "block"; 
                c = 1;  
            }
            else {
                document.getElementById("confirm-box-delete").style.display = "none";
                c = 0;
            }
        }


        function deleteYaps() {
            if (c == 0) {
                document.getElementById("confirm-box-delete-yaps").style.display = "block"; 
                setTimeout (()=>{
                    window.location.href='pengumuman_guru.html'
                },3000);       
                c = 1;
            }
            else {
                document.getElementById("confirm-box-delete-yaps").style.display = "none";
                c = 0;
            }
        }
    </script>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI"crossorigin="anonymous"></script>
</body>

</html>