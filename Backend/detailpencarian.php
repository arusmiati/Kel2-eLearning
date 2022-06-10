<?php

session_start();
if (!isset($_SESSION['$login_guru'])) {
    header("Location: login.php");
    exit;
}

require 'functions.php';

$Id = $_GET['Id'];
$kelas = query("SELECT * FROM tambah_kelas WHERE Id_TambahKls = $Id");

if (isset($_POST['Daftar'])) {
    $conn = koneksi();

    $nama_mapel = $kelas["Nama_Kelas"];
    $nama_guru = $kelas["Nama_Guru"];
    $hari = $kelas["Hari"];
    $waktu = $kelas["Waktu"];
    $semester = $kelas["Semester"];
    $sampul = $kelas["Sampul"];
    $Id_Kelas = $kelas["Id_TambahKls"];
    $tkls = $kelas["Kelas"];
    $desk = $kelas["Deskripsi"];
    $Nama = $_SESSION["Nama"];
    $Nip = $_SESSION["Nip"];
    $id_mapel = rand(10, 10000);

    $mapel = "INSERT INTO matapelajaran VALUES ('$id_mapel','$nama_mapel', '$nama_guru', 0, '$hari', '$waktu', '$semester','$sampul','$tkls', '$desk','$Id_Kelas')";
    mysqli_query($conn, $mapel);

    $guru = "INSERT INTO guru_terdaftar VALUES (null, '$Nama', '$Nip', '$Id_Kelas')";
    mysqli_query($conn, $guru);

    $smstr = "INSERT INTO Semester VALUES (null, '$semester', '$Id_Kelas')";
    mysqli_query($conn, $smstr);
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
    <title>Pencarian Mata Pelajaran</title>
    <link rel="stylesheet" href="style.css?<?php echo time() ?>">
    <style>
        .logo-mapel img {
            width: 305px;
            height: 180px;
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
                    <a href="homepage_guru.php" class="btn" aria-hidden="true">Homepage</a>
                </li>
                <li class="mapel nav-item">
                    <a href="kelas.php" class="btn " aria-hidden="true">Kelasku</a>
                </li>
                <li class="search-mapel nav-item">

                    <a href="pencarian.php" class="btn active" aria-hidden="true">Pencarian Kelas</a>
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
                        <button class="dropdown-item" type="button" onclick="window.location.href='profil.html'">Profil</button>
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
        <div id="confirm-box-unduh">
            <h1>Apakah anda ingin mendaftar kelas ini?</h1>
            <div class="btn">
                <form action="" method="post">
                    <button class="yes" type="submit" name="Daftar" value="Daftar" onclick="unduhYaps()">Iya</button>
                </form>
                <a href="" class="no">Tidak</a>
            </div>
        </div>
        <div id="confirm-box-unduh-yaps">
            <h1>Anda Berhasil Mendaftar di Kelas ini</h1>
        </div>
        <div class="detail-pencarian">
            <div class="header">
                <div class="title-detail">
                    <h2><?= $kelas["Nama_Kelas"]; ?></h2>
                </div>
            </div>
            <div class="content-detail d-flex">
                <div class="sidebar">
                    <div class="logo-mapel">
                        <img src="img/<?= $kelas["Sampul"] ?>" alt="">
                    </div>

                    <div class="profil-guru">
                        <img src="img/profil.png" alt="">
                    </div>
                    <div class="ket-mapel">
                        <p class="nama"><?= $kelas["Nama_Guru"] ?></p>
                        <p class="status">Teacher</p>
                    </div>
                    <div class="jadwal-mapel">
                        <i class="fa fa-calendar"></i>
                        <p><?= $kelas["Hari"] ?>, Pukul <?= $kelas["Waktu"] ?> WITA</p>
                    </div>
                    <div class="btn-start">
                        <button type="submit" onclick="UnduhConfirm()">Daftar</button>

                    </div>
                    <div class="jlh-siswa">
                        <i class="fa fa-user"></i>
                        <p>32 Siswa Terdaftar</p>
                    </div>
                </div>
                <div class="tabs">
                    <div class="tabs-head">
                        <span class="tabs-toggle active">Deskripsi</span>
                        <span class="tabs-toggle">Bahan Kajian</span>
                        <span class="tabs-toggle">Capaian Pembelajaran</span>
                        <span class="tabs-toggle">Bahan Pelajaran</span>
                    </div>
                    <div class="tabs-body">
                        <div class="tabs-content active">
                            <h2 class="tabs-title">Deskripsi</h2>
                            <p class="deskripsi"><?= $kelas["Deskripsi"] ?>
                            </p>
                        </div>
                        <div class="tabs-content">
                            <h2 class="tabs-title">Bahan Kajian</h2>
                            <p class="deskripsi"><?= $kelas["Kajian"] ?></p>
                        </div>
                        <div class="tabs-content">
                            <h2 class="tabs-title">Capaian Pembelajaran</h2>
                            <p class="deskripsi"><?= $kelas["Capaian"] ?></p>
                        </div>
                        <div class="tabs-content">
                            <h2 class="tabs-title">Bahan Pelajaran</h2>
                            <p class="deskripsi"><?= $kelas["Bahan_Ajar"] ?></p>
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
            e4
            if (c == 0) {
                document.getElementById("confirm-box").style.display = "block"
                c = 1;
            } else {
                document.getElementById("confirm-box").style.display = "none"
                c = 0;
            }
        }

        function UnduhConfirm() {
            if (c == 0) {
                document.getElementById("confirm-box-unduh").style.display = "block";
                c = 1;
            } else {
                document.getElementById("confirm-box-unduh").style.display = "none";
                c = 0;
            }
        }

        function unduhYaps() {
            if (c == 0) {
                document.getElementById("confirm-box-unduh-yaps").style.display = "block";
                setTimeout(() => {
                    window.location.href = 'pencarian_siswa.php'
                }, 3000);
            } else {
                document.getElementById("confirm-box-unduh-yaps").style.display = "none";
                c = 0;
            }
        }
        var tab = document.querySelector(".tabs");
        var tabHead = tab.querySelector(".tabs-head");
        var tabBOdy = tab.querySelector(".tabs-body");
        var tabHeadNodes = tab.querySelectorAll(".tabs-toggle");
        var tabBodyNodes = tab.querySelectorAll(".tabs-content");

        for (let i = 0; i < tabHeadNodes.length; i++) {
            tabHeadNodes[i].addEventListener("click", () => {
                tabHead.querySelector(".active").classList.remove("active");
                tabHeadNodes[i].classList.add("active");
                tabBOdy.querySelector(".active").classList.remove("active");
                tabBodyNodes[i].classList.add("active");
            });
        }
    </script>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
</body>

</html>