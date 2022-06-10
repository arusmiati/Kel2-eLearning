<?php

session_start();

error_reporting(0);
if (!isset($_SESSION['$login_siswa'])) {
    header("Location: login.php");
    exit;
}

require 'functions.php';
$Id_Mapel = $_GET["Id"];
$kelas = query("SELECT * FROM matapelajaran WHERE Id_Kelas = $Id_Mapel");

if (isset($_POST['tugas'])) {
    $conn = koneksi();
    header("Location: tugas.php?Id=$Id_Mapel");
}

if (isset($_POST['forum'])) {
    $conn = koneksi();
    header("Location: forum.php?Id=$Id_Mapel");
}

$conn = koneksi();
$nama = $_SESSION["Nama"];
$tugas = "SELECT COUNT(*) FROM tugas where Id_Mapel = $Id_Mapel";
$result = mysqli_query($conn,$tugas);
$row = mysqli_fetch_array($result);
$total = $row['COUNT(*)'];

$t = "SELECT COUNT(*) FROM kumpul_tugas WHERE Nama = '$nama'";
$result1 = mysqli_query($conn,$t);
$row1 = mysqli_fetch_array($result1);
$total1 = $row1['COUNT(*)'];
$to = (($total/$total1)*100);

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
    <title>Detail Mata Pelajaran</title>
    <link rel="stylesheet" href="style.css?<?php echo time() ?>">
    <style>
        .progres-bar1 progress::after,
        .progres-bar2 progress::after,
        .progres-bar3 progress::after {
        width: <?= "$to%"?>;
        max-width: 100% !important;
    }
    </style>

</head>

<body>
    <?php require_once('navbar/navbarmapel.php') ?>

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
                        <?php
                        $nis = $_SESSION["Nis"];
                        $u = query("SELECT * FROM user_siswa WHERE Nis = '$nis'");
                        ?>
                        <img src="img/<?=$u["Profil"]?>" alt="">
                    </div>
                    <div class="nama-detail">
                        <h4><?php echo $_SESSION['Nama']; ?></h4>
                        <p><?php echo $_SESSION['Nis']; ?></p>
                    </div>
                    <div class="progres-detail">
                        <div class="progres-item">
                            <ul>
                                <li class="progres-name"><i class="fa fa-cog"></i> Progress</li>
                                <li class="progres-subitem">
                                    <div class="tprogress d-flex">
                                        <p class="title-mapel">Alur Pembelajaran</p>
                                        <?php
                                         if ($to > 100){
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
                                         if ($to > 100){
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
                                         if ($to > 100){
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
                            <a href="alur.php?Id=<?=$Id_Mapel?>"><img src="img/fitur2.png" alt=""></a>
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
                            <a href="ujian.php?Id=<?=$Id_Mapel?>"><img src="img/fitur4.png" alt=""></a>
                        </div>
                        <p class="title-fitur">Ulangan Harian</p>
                    </div>
                    <div class="list-fitur-item">
                        <div class="item-img">
                            <a href="dokumen.php?Id=<?=$Id_Mapel?>"><img src="img/fitur5.png" alt=""></a>
                        </div>
                        <p class="title-fitur">Document</p>
                    </div>
                    <div class="list-fitur-item">
                        <div class="item-img">
                        <a href="daftarsiswa.php?Id=<?=$Id_Mapel?>"><img src="img/fitur6.png" alt=""></a>
                        </div>
                        <p class="title-fitur">Daftar Siswa</p>
                    </div>
                    <div class="list-fitur-item">
                        <div class="item-img">
                        <a href="pengumuman.php?Id=<?=$Id_Mapel?>"><img src="img/fitur7.png" alt=""></a>
                        </div>
                        <p class="title-fitur">Pengumuman</p>
                    </div>
                    <div class="list-fitur-item">
                        <div class="item-img">
                        <a href="tautan.php?Id=<?=$Id_Mapel?>"><img src="img/fitur8.png" alt="">
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