<?php

session_start();
if (!isset($_SESSION['$login_guru'])) {
  header("Location: login.php");
  exit;
}

error_reporting(0);
require 'functions.php';
$Id = $_GET["Id"];

$alur = querys("SELECT * FROM alur  WHERE Id_Mapel = '$Id'");

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
  <title>Alur pembelajaran</title>
  <link rel="stylesheet" href="style.css">

</head>

<body>
  <!-- NAVBAR -->
  <?php require_once('navbar/navbarkelas_guru.php') ?>

  <!-- MAIN -->
  <div class="main-container">
    <div id="confirm-box">
      <h1>Apakah anda ingin keluar dari E-LEARNING SMANEL?</h1>
      <a href="logout.php" class="yes">Iya</a>
      <a href="" class="no">Tidak</a>
    </div>
    <div class="main-content-forum">
      <div class="forum-header d-flex">
        <span><a href="javascript:history.back()"><i class="fa fa-arrow-left"></i></a> </span>
        <h1>Alur Pembelajaran</h1>
        <div class="btn-start ml-auto">
          <button onclick="location.href='tambahalur.php?Id=<?= $Id; ?>'">Tambah</button>
        </div>
      </div>
      <div class="ujian-list">
        <div class="tautan-head">

          <?php foreach ($alur as $a) : ?>
            <table class="alur" style="margin-bottom: 10px; border-radius: 10px;">
              <tr class="isi" style="background: none;">
                <td style="border-radius: 10px;"><a style="font-weight: 500;" href="detailpertemuan_guru.php?Id=<?= $a["Id_Alur"] ?>"><?= $a["Judul"] ?></a></td>

              </tr>
            </table>

          <?php endforeach ?>
        </div>
      </div>
    </div>

    <!-- FOOTER -->
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
    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>

</body>

</html>