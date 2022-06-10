<?php
session_start();
if (!isset($_SESSION['$login_siswa'])) {
  header("Location: login.php");
  exit;
}

$previous = "javascript:history.go(-1)";
if (isset($_SERVER['HTTP_REFERER'])) {
  $previous = $_SERVER['HTTP_REFERER'];
}

error_reporting(0);
require 'functions.php';
$Id = $_GET['Id'];
$f = query("SELECT * FROM forum_cat WHERE Id_ForumCat = $Id");
$forum = querys("SELECT * FROM forum_thread WHERE Id_ForumCat = $Id");
if (isset($_POST['cari'])) {
  $forum = cari_thread($_POST['keyword']);
}


$idt = $forum["Id_ForumThr"];
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
  <title>Forum Categories</title>
  <link rel="stylesheet" href="style.css?<?php echo time() ?>">

</head>

<body>
  <?php require_once('navbar/navbarmapel.php') ?>

  <div class="main-container">
    <div id="confirm-box-logout">
      <h1>Apakah anda ingin keluar dari E-LEARNING SMANEL?</h1>
      <a href="logout.php" class="yes">Iya</a>
      <a href="" class="no">Tidak</a>
    </div>
    <div id="confirm-box-delete">
      <h1>Apakah anda yakin ingin menghapus forum ini?</h1>
      <a href="#" onclick="deleteYaps()" class="yes">Iya</a>
      <a href="" class="no">Tidak</a>
    </div>
    <div id="confirm-box-delete-yaps">
      <h1>Thread ini Berhasil Dihapus</h1>
    </div>
    <div class="class">
      <div class="new-class">
        <div class="dokumen">
          <div class="search-sidebar">
            <div class="search-box d-flex">
              <form action="" method="post">
                <span><i class="fa fa-search"></i></span>
                <input type="text" class="keyword" name="keyword" style="background: none !important;border: none;outline: none;height: 20px;font-size: 12px;" placeholder="Search Here"></input>
                <button type="submit" style="width: 20px; display: none;" name="cari" class="tombol-cari">Cari</button>
              </form>
            </div>
          </div>
          <div class="doc-content">
            <div class="doc-header">
              <div class="d-flex">
                <span><a href="javascript:history.back()"><i class="fa fa-arrow-left"></i></a> </span>
                <h1>Forum Categories</h1>
                <div class="btn-start ml-auto">
                  <button onclick="location.href='tambah_forumthread.php?Id=<?= $f["Id_ForumCat"] ?>'" type="submit" name="TambahForum">Tambah</button>
                </div>
              </div>
              <div class="search-box1 doc-guru ml-auto">
                <form action="" method="post">
                  <span><i class="fa fa-search"></i></span>
                  <input type="text" class="keyword" name="keyword" style="background: none !important;border: none;outline: none;height: 20px;font-size: 12px;" placeholder="Search Here"></input>
                  <button type="submit" style="width: 20px; display: none;" name="cari" class="tombol-cari">Cari</button>
                </form>
              </div>
            </div>

            <div class="forumthread-list">
              <?php if (empty($forum)) : ?>
                <p class="empty">Belum ada forum categories yang tersedia untuk forum ini</p>
              <?php endif ?>
              <?php $i = 1;
              foreach ($forum as $forum) : ?>
                <div class="forumthread-content">
                  <div class="main-item d-flex">
                    <div class="foto">
                      <?php
                      $nama = $forum["Nama"];
                      $us = query("SELECT Profil FROM user_guru WHERE Nama = '$nama' UNION SELECT Profil FROM user_siswa WHERE Nama = '$nama'");
                      ?>
                      <img src="img/<?= $us["Profil"] ?>" alt="Profil">
                      <h5><?= $forum["Nama"] ?></h5>
                    </div>
                    <div class="forumthread-description">
                      <div class="dropdown">
                        <button class="btn-mapel" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                          <img class="colon" src="img/titik3.png" alt="">
                        </button>
                        <div id="drop-history" class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                          <a class="dropdown-item" href="edit_forumthread.php?Id=<?= $forum["Id_ForumThr"] ?>">Edit</a>
                          <a class="dropdown-item" onclick="return confirm('Apakah anda yakin ingin menghapus thread ini?');" href="hapusforumthread1.php?Id=<?= $forum["Id_ForumThr"] ?>">Delete</a>
                        </div>
                      </div>
                      <div class="forumthread-title">
                        <h5><b><?= $forum["Judul"] ?></b></h5>
                        <p><?= nicetime($forum["Waktu"]) ?></p>
                      </div>
                      <div class="forumthread">
                        <p><?= $forum["Deskripsi"] ?></p>
                      </div>

                      <div class="buttom d-flex">
                        <div class="info">
                          <?php
                          $r = $forum["Id_ForumThr"];
                          $conn = koneksi();
                          $reply = "SELECT COUNT(*) FROM forum_reply WHERE Id_ForumThr = $r";
                          $result = mysqli_query($conn, $reply);
                          $row = mysqli_fetch_array($result);
                          $total = $row['COUNT(*)'];
                          ?>
                          <p><i class="fa fa-comment"></i> <?php echo $total ?> Reply </p>
                        </div>
                        <div class="btn-reply">
                          <button onclick="location.href='tambahkomentar.php?Id=<?= $forum['Id_ForumThr']; ?>'">Reply</button>
                        </div>
                      </div>
                    </div>
                  </div>
                  <?php $reply = getRepliesByCommentId($forum['Id_ForumThr']); ?>
                  <div class="replies_wrapper_<?php echo $forum['Id_ForumThr']; ?>">
                    <?php if (isset($reply)) : ?>
                      <?php foreach ($reply as $r) : ?>
                        <div class="sub-item d-flex">
                          <div class="foto">
                            <?php
                            $nama = $r["NamaUser"];
                            $us = query("SELECT Profil FROM user_guru WHERE Nama = '$nama' UNION SELECT Profil FROM user_siswa WHERE Nama = '$nama'");
                            ?>
                            <img src="img/<?= $us["Profil"] ?>" alt="Profil">
                            <h5><?= $r["NamaUser"] ?></h5>
                          </div>
                          <div class="forumthread-description">
                            <div class="dropdown">
                              <button class="btn-mapel" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                <img class="colon" src="img/titik3.png" alt="">
                              </button>
                              <div id="drop-history" class="dropdown-menu dropdown-menu-right" aria-labelledby="dropdownMenuButton">
                                <a class="dropdown-item" href="edit_forumreply.php?Id=<?= $r["Id_Reply"] ?>">Edit</a>
                                <a class="dropdown-item" onclick="return confirm('Apakah anda yakin ingin menghapus reply ini?')" href="hapusforumreply1.php?Id=<?= $r["Id_Reply"] ?>">Delete</a>
                              </div>
                            </div>

                            <div class="forumthread-title">
                              <h5><b><?= $r["JudulReply"] ?></b></h5>
                              <p><?php echo nicetime(($r['WaktuReply'])) ?></p>
                            </div>
                            <div class="forumthread">
                              <p><?= $r["DeskripsiReply"] ?></p>
                            </div>
                            <div class="buttom d-flex">
                              <div class="info">

                                <p><i class="fa fa-comment"></i> 0 Reply</p>
                              </div>
                              <div class="btn-reply">
                                <button onclick="location.href='tambahreply.php?Id=<?= $r['Id_Reply']; ?>'">Reply</button>
                              </div>
                            </div>
                          </div>
                        </div>

                      <?php endforeach ?>
                    <?php endif ?>
                  </div>

                <?php endforeach ?>
                </div>
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
        document.getElementById("confirm-box").style.display = "block"
        c = 1;
      } else {
        document.getElementById("confirm-box").style.display = "none"
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
          window.location.href = 'forumcategories_guru.html'
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