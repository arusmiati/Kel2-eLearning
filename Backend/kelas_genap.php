<?php

session_start();
if (!isset($_SESSION['$login_guru'])) {
    header("Location: login.php");
    exit;
}

include 'functions.php';
$Nama = $_SESSION['Nama'];
$mapel = querys("SELECT * FROM guru_terdaftar JOIN matapelajaran ON guru_terdaftar.Id_Kelas = matapelajaran.Id_Kelas WHERE Nama = '$Nama' and Semester = 'Genap'");

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
    <title>Kelasku</title>
    <link rel="stylesheet" href="style.css">

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
            <a href="login.html" class="yes">Iya</a>
            <a href="" class="no">Tidak</a>
        </div>

        <div class="main-content-mapel">
            <div class="detail-mapel">
                <div class="detail-header d-flex">
                    <h2 class="detail-title">Semester Genap</h2>
                    <div class="dropdown ml-auto">
                        <button class="btn-mapel dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                            History Mata Pelajaran
                        </button>
                        <div id="drop-history" class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <a class="dropdown-item" href="kelas.php">Semester Ganjil</a>
                            <a class="dropdown-item" href="kelas_genap.php">Semester Genap</a>
                        </div>
                    </div>
                </div>
            </div>
            <div class="list-mapel">
                <div class="add-mapel">
                    <button onclick="location.href='detailtambahmapel.php'">Tambah<br>Mata Pelajaran</button>
                </div>
                <?php $i = 1;
                foreach ($mapel ?: [] as $k) :
                ?>
                    <div class="list-mapel-item">
                        <div class="logo-mapel">
                            <img src="img/<?= $k["Sampul"] ?>" width="300px">
                        </div>
                        <div class="class-mapel">
                            <p>Class</p>
                            <h1><?= $k["Tipe_Kelas"] ?></h1>
                        </div>
                        <div class="nama-mapel">
                            <h3>
                                <td><?= $k["Nama_Mapel"] ?></td>
                            </h3>
                        </div>
                        <div class="ket-mapel">
                            <p><i class="fa fa-user"></i><?= $k["Nama_Guru"] ?></p>
                            <p><i class="fa fa-calendar"></i><?= $k["Hari"]; ?>, Pukul <?= $k["Waktu"]; ?> WITA</p>
                        </div>
                        <div class="deskripsi">
                            <p><?= substr($k["Deskripsi"], 0, 110) . "..."; ?></p>
                        </div>
                        <div class="jlh-siswa d-flex">
                            <p><i class="fa fa-user"></i>32 Siswa</p>
                            <div class="btn-detail">
                                <button onclick="location.href='detailkelas.php?Id=<?= $k['Id_Kelas']; ?>'">Detail</button>
                            </div>
                        </div>
                    </div>
                <?php endforeach; ?>

            </div>
        </div>

    </div>

    <div class="footer">
        <div class="nama-footer-mapel">
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