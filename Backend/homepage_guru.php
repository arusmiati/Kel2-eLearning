<?php
session_start();

if (!isset($_SESSION['$login_guru'])) {
  header("Location: login.php");
  exit;
}

include 'functions.php';

$slide = querys("SELECT * FROM slide");

?>

<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <!-- Bootstrap CSS -->
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
  <script src="https://cdn.jsdelivr.net/npm/chart.js@2.8.0"></script>
  <script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
  <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;300;500;700;800&display=swap" rel="stylesheet">
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
  <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
  <title>homepage</title>
  <link rel="stylesheet" href="style_homepage.css">
  <link rel="stylesheet" href="style.css">
</head>

<body>
  <!-- NAVBAR -->
  <?php require_once('navbar/navbarhome_guru.php') ?>

  <!-- BODY -->
  <div id="confirm-box">
    <h1>Apakah anda ingin keluar dari E-LEARNING SMANEL?</h1>
    <a href="logout.php" class="yes">Iya</a>
    <a href="" class="no">Tidak</a>
  </div>
  <div class="container">
    <div class="content-slide">
      <?php $i = 1;
      foreach ($slide as $s) : ?>
        <div class="imgslide">
          <img class="img" src="img_homepage/<?= $s["image"] ?>" alt="gambar 3">
          <div class="txt1">
            <h1><?= $s["judul"] ?></h1>
            <p><?= $s["deskripsi"] ?></p>
          </div>
        </div>
      <?php endforeach; ?>

      <a class="prev" onclick="nextslide(-1)">&#10094;</a>
      <a class="next" onclick="nextslide(1)">&#10095;</a>

      <div class="page">
        <span class="dot" onClick="dotslide(1)"></span>
        <span class="dot" onClick="dotslide(2)"></span>
        <span class="dot" onClick="dotslide(3)"></span>
      </div>
    </div>

    <div class="content-announcements">
      <div class="first">
        <?php $al = query("SELECT * FROM announcement ORDER BY id_announ DESC LIMIT 1"); ?>
        <div class="image" style="background: url(img_homepage/<?php echo $al["image"] ?>) no-repeat; background-position: 50%;background-size:cover"></div>
        <br>
        <div class="text">
          <h5><?= $al["judul"]; ?></h5>
          <p><?= $al["deskripsi"] ?>
          </p>
        </div>
      </div>
      <br><br>
      <div class="announcement">
        <?php $al = querys("SELECT * FROM announcement ORDER BY id_announ DESC LIMIT 1 OFFSET 1"); ?>
        <a id="announcement" href="announcement.php">Announcement</a>
        <a id="announcement" href="announcement.php">&#10095;</a>
        <?php $i = 1;
        foreach ($al as $i => $al) :  ?>
          <div class="announ1" style="background: url(img_homepage/<?php echo $al["image"] ?>) no-repeat; background-position: 50%;background-size: cover;">
            <a href="announcement_admin.php">&#10095;</a>
            <img class="new" src="img/new.png" alt="">
            <h5><?= $al["judul"]; ?></h5>
            <p><?= substr($al["deskripsi"], 0, 70) ?>...
            </p>
          </div>
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

  <!-- jscript -->
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


    var slideIndex = 1;
    showSlide(slideIndex);

    function nextslide(n) {
      showSlide(slideIndex += n);
    }

    function dotslide(n) {
      showSlide(slideIndex = n);
    }

    function showSlide(n) {
      var i;
      var slides = document.getElementsByClassName("imgslide");
      var dot = document.getElementsByClassName("dot");

      if (n > slides.length) {
        slideIndex = 1
      }
      if (n < 1) {
        slideIndex = slides.length;
      }
      for (i = 0; i < slides.length; i++) {

        slides[i].style.display = "none";
      }

      for (i = 0; i < slides.length; i++) {

        dot[i].className = dot[i].className.replace(" active", "");
      }

      slides[slideIndex - 1].style.display = "block";

      dot[slideIndex - 1].className += " active";
    }
  </script>
  <!-- Optional JavaScript -->
  <!-- jQuery first, then Popper.js, then Bootstrap JS -->
  <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
  <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>


</body>

</html>