<?php
session_start();
if (!isset($_SESSION['$login_admin'])) {
  header("Location: index.php");
  exit;
}

$previous = "javascript:history.go(-1)";

if (isset($_SERVER['HTTP_REFERER'])) {
  $previous = $_SERVER['HTTP_REFERER'];
}

require 'functions.php';

$a = querys("SELECT * FROM announcement ORDER BY id_announ DESC");
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
  <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
  <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
  <title>announcements</title>
  <link rel="stylesheet" href="style_annountcement.css?<?php echo time() ?>">
  <script src="script.js"></script>
  <link rel="stylesheet" href="lightslider.css">
  <script type="text/javascript" src="jquery.js"></script>
  <script type="text/javascript" src="lightslider.js"></script>
  <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
  <style>
    .edit2 {
      margin: 0px !important;
      margin-top: 20px !important;
    }

    .image img {
      width: 250px;
      height: 200px;
      margin-left: -40px;
    }
  </style>
</head>

<body>


  <!-- NAVBAR -->
  <?php require_once('navbar/navbarhome_admin.php') ?>
  <!-- HEADER -->
  <div class="header">
    <a id="back" href="homepage_admin.php">&#10094;</a>
    <a id="back" href="homepage_admin.php">Announcement</a>
  </div>
  <div id="confirm-box">
    <h1>Apakah anda ingin keluar dari E-LEARNING SMANEL?</h1>
    <a href="logout.php" class="yes">Iya</a>
    <a href="" class="no">Tidak</a>
  </div>
  <!-- BODY -->
  <div class="announce">
    <div id="exTab1" class=" container slider">

      <ul class="nav cs-hidden container" id="autoWidth">
        <?php $i = 1;
        foreach ($a as $i => $a) : ?>
          <?php if ($i == 0) { ?>
            <li class="active">
              <a style="text-decoration: none;" href="#section<?php echo $i; ?>" data-toggle="tab">
                <div class="swiper-slide" style="background: url(img_homepage/<?php echo $a["image"] ?>) no-repeat; background-position: 50%;background-size: cover;">
                  <a href="#section<?php echo $i; ?>" data-toggle="tab" onclick="">&#10095;</a>
                  <a style="text-decoration: none;" href="#section<?php echo $i; ?>" data-toggle="tab">
                    <h5><?php echo $a['judul']; ?></h5>
                  </a>
                  <a style="text-decoration: none;color:black;" href="#section<?php echo $i; ?>" data-toggle="tab">
                    <p><?= substr($a["deskripsi"], 0, 70) ?>...</p>
                  </a>
                </div>
              </a>
            </li>

          <?php } else { ?>
            <li><a style="text-decoration: none;" href="#sectionB<?php echo $i; ?>" data-toggle="tab">
                <div class="swiper-slide" style="background: url(img_homepage/<?php echo $a["image"] ?>) no-repeat; background-position: 50%;background-size: cover;">
                  <a href="#sectionB<?php echo $i; ?>" data-toggle="tab" onclick="">&#10095;</a>
                  <a style="text-decoration: none;" href="#sectionB<?php echo $i; ?>" data-toggle="tab">
                    <h5><?php echo $a['judul']; ?></h5>
                  </a>
                  <a style="text-decoration: none;color:black;" href="#sectionB<?php echo $i; ?>" data-toggle="tab">
                    <p><?= substr($a["deskripsi"], 0, 70) ?>...</p>
                  </a>
                </div>
              </a></li>
          <?php } ?>
        <?php endforeach ?>
      </ul>
    </div>

    <div class="details">
      <div class="tab-content detail container">
        <?php $al = querys("SELECT * FROM announcement ORDER BY id_announ DESC"); ?>
        <?php $i = 1;
        foreach ($al as $i => $al) :  ?>
          <?php if ($i == 0) { ?>
            <div class="tab-pane text active" id="section<?php echo $i; ?>">
              <div class="content">
                <div class="edit2 d-flex" style="flex-direction:column"><button onclick="location.href='editannouncement.php?Id=<?= $al['id_announ'] ?>'" class="edit"><i class="fa fa-pencil"></i></button>
                  &nbsp;<button onclick="location.href='hapusannoun.php?Id=<?= $al['id_announ'] ?>'" class="edit"><i class="fa fa-trash-o"></i></button>
                </div>
                <div class="image col-md-3">
                  <img src="img_homepage/<?= $al["image"]; ?>" alt="">
                </div>
                <div class="text col-md-7">
                  <h3><?= $al["judul"]; ?></h3>
                  <p><?php echo $al["deskripsi"]; ?></p>
                </div>
              </div>
            </div>
          <?php } else { ?>
            <div class="tab-pane text" id="sectionB<?php echo $i; ?>">
              <div class="content">
                <div class="edit2 d-flex" style="flex-direction:column"><button onclick="location.href='editannouncement.php?Id=<?= $al['id_announ'] ?>'" class="edit"><i class="fa fa-pencil"></i></button>
                  &nbsp;<button onclick="location.href='hapusannouncement.php?Id=<?= $al['id_announ'] ?>'" class="edit"><i class="fa fa-trash-o"></i></button>
                </div>
                <div class="image col-md-3">
                  <img src="img_homepage/<?= $al["image"]; ?>" alt="">
                </div>
                <div class="text col-md-7">
                  <h3><?= $al["judul"]; ?></h3>
                  <p><?php echo $al["deskripsi"]; ?></p>
                </div>
              </div>
            </div>
          <?php } ?>
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

  <script>
    $(document).ready(function() {
      $('#autoWidth').lightSlider({
        autoWidth: true,
        loop: true,
        onSliderLoad: function() {
          $('#autoWidth').removeClass('cS-hidden');
        }
      });
    });
  </script>
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
  <!-- Placed at the end of the document so the pages load faster -->
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.1/jquery.min.js"></script>
  <script src="//maxcdn.bootstrapcdn.com/bootstrap/3.2.0/js/bootstrap.min.js"></script>
</body>

</html>