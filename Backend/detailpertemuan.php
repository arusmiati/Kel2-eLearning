<?php

session_start();
if (!isset($_SESSION['$login_siswa'])) {
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

if (isset($_POST['TambahAlur'])) {
  $conn = koneksi();
  header("Location: tambahalur.php?Id=$Id_Mapel");
}
$alurs = query("SELECT * FROM alur WHERE Id_Alur = '$Id'");
$alur = querys("SELECT * FROM materi_alur WHERE Id_Alur = '$Id'");
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
  <script src="//ajax.googleapis.com/ajax/libs/angularjs/1.2.13/angular.min.js"></script>
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;300;500;700;800&display=swap" rel="stylesheet">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
  <title>Alur Pembelajaran</title>
  <link rel="stylesheet" href="style.css?<?php echo time(); ?>">
  <style>
    .progress {
      height: 20px;
      border-radius: 20px;
      background: white;
    }

    .progress-inner {
      background-color: #0F3B92;
      width: 0%;
      height: 100%;
    }
  </style>

</head>

<body>
  <!-- NAVBAR -->
  <?php require_once('navbar/navbarmapel.php') ?>

  <!-- MAIN -->
  <div class="main-container">
    <div id="confirm-box">
      <h1>Apakah anda ingin keluar dari E-LEARNING SMANEL?</h1>
      <a href="logout.php" class="yes">Iya</a>
      <a href="" class="no">Tidak</a>
    </div>
    <div id="confirm-box-delete">
      <h1>Apakah anda yakin ingin menghapus Forum ini?</h1>
      <a href="#" onclick="deleteYaps()" class="yes">Iya</a>
      <a href="" class="no">Tidak</a>
    </div>
    <div id="confirm-box-delete-yaps">
      <h1>Forum ini Berhasil Dihapus</h1>
    </div>
    <div class="alur-mapel">
      <div class="detail-alur row">
        <br>
        <div class="col-md-3">
          <div class="header d-flex" style="color: white;">
            <span><a href="javascript:history.back()"><i class="fa fa-arrow-left"></i></a>
            </span>&nbsp;&nbsp;
            <h4><?= $alurs["Judul"] ?></h4>
          </div>
          <div class="tambah-materi">

          </div>
          <br>

          <ul class="nav alur-nav nav-pills flex-column" id="experienceTab" role="tablist">

            <?php $i = 1;
            foreach ($alur as $i => $a) : ?>
              <?php if ($i == 0) { ?>
                <li class="active" style="width: 100%;">
                  <a data-toggle="tab" href="#section<?php echo $i; ?>"><?php echo $a['Nama']; ?></a>
                </li>
              <?php } else { ?>
                <li style="width: 100%;">
                  <a data-toggle="tab" href="#sectionB<?php echo $i; ?>"><?php echo $a['Nama']; ?></a>
                </li>
              <?php } ?>
            <?php endforeach ?>
          </ul>
        </div>

        <div class="col-md-9">
          <div class="details">
            <div class="tab-content" id="experienceTabContent">
              <?php foreach ($alur as $i => $alur) {  ?>
                <?php if ($i == 0) { ?>
                  <div id="section<?php echo $i; ?>" class="tab-pane fade in show active">
                    <?php echo $alur['Deskripsi']; ?>
                    <iframe src="dokumen/<?php echo $alur['Lampiran']; ?>" frameborder="0"></iframe>
                  </div>
                <?php } else { ?>
                  <div id="sectionB<?php echo $i; ?>" class="tab-pane fade in">
                    <?php echo $alur['Deskripsi']; ?>
                    <iframe src="dokumen/<?php echo $alur['Lampiran']; ?>" frameborder="0"></iframe>
                  </div>
                <?php } ?>
              <?php } ?>
            </div>
            <!--tab content end-->
          </div><!-- col-md-8 end -->
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
  </div>

  <script src="script.js"></script>
  <script>
    function checkMe() {
      const checkBoxes = document.querySelectorAll(".myCheckBox");
      const progress = document.querySelector(".progress-inner");
      const checklistProgressInterval = 100 / checkBoxes.length;
      let width = 0;

      for (let i = 0; i < checkBoxes.length; i++) {
        if (checkBoxes[i].checked) {
          width += checklistProgressInterval;
        }
      }
      progress.style.width = `${width}%`;
    }


    var c = 0;

    function LogConfirm() {
      if (c == 0) {
        document.getElementById("confirm-box-logout").style.display = "block"
        c = 1;
      } else {
        document.getElementById("confirm-box-logout").style.display = "none"
        c = 0;
      }
    }

    function DeleteConfirm() {
      if (c == 0) {
        document.getElementById("confirm-box-delete").style.display = "block";
        c = 1;
      } else {
        document.getElementById("confirm-box-delete").style.display = "none";
        c = 0;
      }
    }

    function deleteYaps() {
      if (c == 0) {
        document.getElementById("confirm-box-delete-yaps").style.display = "block";
        setTimeout(() => {
          window.location.href = 'forum_guru.html'
        }, 3000);
        c = 1;
      } else {
        document.getElementById("confirm-box-delete-yaps").style.display = "none";
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