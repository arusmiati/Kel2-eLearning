<?php

session_start();
if (!isset($_SESSION['$login_guru'])) {
    header("Location: login.php");
    exit;
}

require 'functions.php';
$Id_Mapel = $_GET["Id"];
$kelas = query("SELECT * FROM matapelajaran WHERE Id_Kelas = $Id_Mapel");

$conn = koneksi();
$tugas = "SELECT COUNT(*) FROM tugas where Id_Mapel = $Id_Mapel";
$result = mysqli_query($conn, $tugas);
$row = mysqli_fetch_array($result);
$total = $row['COUNT(*)'];
$to = ($total / 1000) * 10000;

if (isset($_POST['tugas'])) {
    $conn = koneksi();
    header("Location: tugas_guru.php?Id=$Id_Mapel");
}

if (isset($_POST['forum'])) {
    $conn = koneksi();
    header("Location: forum_guru.php?Id=$Id_Mapel");
}
if (isset($_POST['siswa'])) {
    $conn = koneksi();
    header("Location: daftarsiswa_guru.php?Id=$Id_Mapel");
}
if (isset($_POST['tautan'])) {
    $conn = koneksi();
    header("Location: tautanguru.php?Id=$Id_Mapel");
}
if (isset($_POST['alur'])) {
    $conn = koneksi();
    header("Location: alur_guru.php?Id=$Id_Mapel");
}
if (isset($_POST['ujian'])) {
    $conn = koneksi();
    header("Location: ujian_guru.php?Id=$Id_Mapel");
}
if (isset($_POST['dokumen'])) {
    $conn = koneksi();
    header("Location: dokumen_guru.php?Id=$Id_Mapel");
}
if (isset($_POST['pengumuman'])) {
    $conn = koneksi();
    header("Location: pengumuman_guru.php?Id=$Id_Mapel");
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
    <title>Detail Kelas</title>
    <link rel="stylesheet" href="style1.css?<php echo time()?>">
    <link rel="stylesheet" href="style.css?<php echo time()?>">
    <style>
        .progres-bar1 progress::after,
        .progres-bar2 progress::after,
        .progres-bar3 progress::after {
            width: <?= "$to%" ?>;
            max-width: 100% !important;
        }
    </style>
</head>

<body>
    <nav class="navbar navbar-expand-lg navbar-light fixed-top">
        <div class="navbar-header">
            <img src="img/logo.png" alt="">
        </div>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarNav">
            <ul class="navbar-nav ml-auto">
                <li class="name nav-item">
                    <a href="homepage.php" class="btn" aria-hidden="true">Homepage</a>
                </li>
                <li class="mapel nav-item">
                    <a href="kelas.php" class="btn active" aria-hidden="true">Kelasku</a>
                </li>
                <li class="search-mapel nav-item">
                    <a href="pencarian.php" class="btn" aria-hidden="true">Pencarian Kelas</a>
                </li>
                <li class="leader nav-item">
                    <a href="leaderboards.php" class="btn" aria-hidden="true">Leaderboards</a>
                </li>
            </ul>
            <div class="profil nav-item dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <img class="icon-profil" src="img/profil.png" alt="" srcset="">
                <div class="dropdown-menu dropdown-menu-right">
                    <center>
                        <div class="name">
                            <img class="bg" src="img/bg.png" alt=""><br>
                            <img class="profil-img" src="img/profil.png" alt="">
                            <h3><?php echo $_SESSION['Nama']; ?></h3>
                            <p><?php echo $_SESSION['Nip']; ?></p>
                        </div>
                        <button class="dropdown-item" type="button">Profil</button>
                        <button class="dropdown-item" type="button" onclick="window.location.href='progress.html'">Progress</button>
                        <button class="dropdown-item" type="button" onclick="window.location.href='bantuan.html'">Bantuan</button>
                        <button onclick="LogConfirm()" class="log-out dropdown-item" type="button">Logout</button>
                </div>
                </center>
            </div>
        </div>
    </nav>

    <div class="main-container">
        <div id="confirm-box">
            <h1>Apakah anda ingin keluar dari E-LEARNING SMANEL?</h1>
            <a href="logout.php" class="yes">Iya</a>
            <a href="" class="no">Tidak</a>
        </div>
        <div class="detail">
            <div class="detail-sidebar">
                <center>
                    <div class="profil-detail">
                        <img src="img/profil.png" alt="">
                    </div>
                    <div class="nama-detail">
                        <h3><?php echo $_SESSION['Nama']; ?></h3>
                        <p><?php echo $_SESSION['Nip']; ?></p>
                    </div>
                    <div class="progres-detail">
                        <div class="progres-item">
                            <ul>
                                <li class="progres-name"><i class="fa fa-cog"></i> Progress</li>
                                <li class="progres-subitem">
                                    <div class="tprogress d-flex">
                                        <p class="title-mapel">Alur Pembelajaran</p>
                                        <?php
                                        if ($to > 100) {
                                            $to = 100;
                                        }
                                        ?>
                                        <p class="persen ml-auto"><?php echo floor($to); ?>%</p>
                                    </div>
                                    <p class="progres-bar1"><progress value="75" max="100"></progress></p>

                                </li>
                                <li class="progres-subitem">
                                    <div class="tprogress d-flex">
                                        <p class="title-mapel">Tugas</p>
                                        <?php
                                        if ($to > 100) {
                                            $to = 100;
                                        }
                                        ?>
                                        <p class="persen ml-auto"><?php echo floor($to); ?>%</p>
                                    </div>
                                    <p class="progres-bar3"><progress value="50" max="100"></progress></p>

                                </li>
                                <li class="progres-subitem">
                                    <div class="tprogress d-flex">
                                        <p class="title-mapel">Ujian</p>
                                        <?php
                                        if ($to > 100) {
                                            $to = 100;
                                        }
                                        ?>
                                        <p class="persen ml-auto"><?php echo floor($to); ?>%</p>
                                    </div>
                                    <p class="progres-bar3"><progress value="90" max="100"></progress></p>
                                </li>
                            </ul>
                        </div>
                    </div>
                </center>

            </div>
            <div class="detail-fitur">
                <div class="title-kelas">
                    <h1><?= $kelas["Nama_Mapel"]; ?></h1>
                </div>
                <div class="list-fitur container">
                    <div class="list-fitur-item">
                        <div class="item-img">
                            <form action="" method="post">
                                <button class="btn-fitur" type="submit" name="tugas"><img src="img/fitur1.png" alt=""></button>
                            </form>
                        </div>
                        <p class="title-fitur">Tugas</p>
                    </div>
                    <div class="list-fitur-item">
                        <div class="item-img">
                            <form action="" method="post">
                                <button class="btn-fitur" onclick="location.href='alur_guru.php?Id=<?= $Id_Mapel ?>'" type="submit" name="alur"><img src="img/fitur2.png" alt=""></button>
                            </form>
                        </div>
                        <p class="title-fitur">Alur Pembelajaran</p>
                    </div>
                    <div class="list-fitur-item">
                        <div class="item-img">
                            <form action="" method="post">
                                <button class="btn-fitur" type="submit" name="forum"><img src="img/fitur3.png" alt=""></button>
                            </form>
                        </div>
                        <p class="title-fitur">Forum</p>
                    </div>
                    <div class="list-fitur-item">
                        <div class="item-img">
                            <form action="" method="post">
                                <button class="btn-fitur" type="submit" name="ujian"><img src="img/fitur4.png" alt=""></button>
                            </form>
                        </div>
                        <p class="title-fitur">Ulangan Harian</p>
                    </div>
                    <div class="list-fitur-item">
                        <div class="item-img">
                            <form action="" method="post">
                                <button class="btn-fitur" type="submit" name="dokumen"><img src="img/fitur5.png" alt=""></button>
                            </form>
                        </div>
                        <p class="title-fitur">Document</p>
                    </div>
                    <div class="list-fitur-item">
                        <div class="item-img">
                            <form action="" method="post">
                                <button class="btn-fitur" type="submit" name="siswa"><img src="img/fitur6.png" alt=""></button>
                            </form>
                        </div>
                        <p class="title-fitur">Daftar Siswa</p>
                    </div>
                    <div class="list-fitur-item">
                        <div class="item-img">
                            <form action="" method="post">
                                <button class="btn-fitur" type="submit" name="pengumuman"><img src="img/fitur7.png" alt=""></button>
                            </form>
                        </div>
                        <p class="title-fitur">Pengumuman</p>
                    </div>
                    <div class="list-fitur-item">
                        <div class="item-img">
                            <form action="" method="post">
                                <button class="btn-fitur" type="submit" name="tautan"><img src="img/fitur8.png" alt=""></button>
                            </form>
                        </div>
                        <p class="title-fitur">Tautan</p>
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
    </script>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
</body>

</html>