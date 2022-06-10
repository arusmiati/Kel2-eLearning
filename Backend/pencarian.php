<?php

session_start();
if (!isset($_SESSION['$login_guru'])) {
    header("Location: login.php");
    exit;
}
include 'functions.php';

$kelas = query("SELECT * FROM tambah_kelas");

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

</head>

<body>
    <?php require_once('navbar/navbarcari_guru.php') ?>

    <div class="main-container">
        <div id="confirm-box">
            <h1>Apakah anda ingin keluar dari E-LEARNING SMANEL?</h1>
            <a href="logout.php" class="yes">Iya</a>
            <a href="" class="no">Tidak</a>
        </div>
        <div class="pencarian">

            <div class="filter-pencarian">
                <form action="" method="GET">
                    <div class="sc d-flex">
                        <h5>Filter</h5>
                        <button type="submit" name="search">Search</button>
                    </div>
                    <div class="dropdown ml-auto">
                        <div class="btn-mapel">
                            <p>Kelas X <i class="fa fa-angle-down"></i></p>

                        </div>
                        <div class="filter dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <?php
                            $conn = koneksi();
                            $kls = "SELECT * FROM kelas WHERE Tingkat_Kelas = 'X'";
                            $klsrun = mysqli_query($conn, $kls);
                            if (mysqli_num_rows($klsrun) > 0) {
                                foreach ($klsrun as $k) {
                                    $checked = [];
                                    if (isset($_GET['kelas'])) {
                                        $checked = $_GET['kelas'];
                                    }
                            ?>
                                    <div class="filter-item" style="font-size: 13px;">
                                        <input type="checkbox" name="kelas[]" value="<?php echo $k['Id_Kelas'] ?>" <?php if (in_array($k['Id_Kelas'], $checked)) {
                                                                                                                        echo "checked";
                                                                                                                    } ?> />
                                        <?php echo $k['Nama_Kelas'] ?>
                                    </div>

                                <?php } ?>
                            <?php } ?>
                        </div>
                    </div>
                    <div class="dropdown ml-auto">
                        <div class="btn-mapel">
                            <p>Kelas XI <i class="fa fa-angle-down"></i></p>

                        </div>
                        <div class="filter dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <?php
                            $conn = koneksi();
                            $kls = "SELECT * FROM kelas WHERE Tingkat_Kelas = 'XI'";
                            $klsrun = mysqli_query($conn, $kls);
                            if (mysqli_num_rows($klsrun) > 0) { ?>
                                <?php foreach ($klsrun as $k) {
                                    $checked = [];
                                    if (isset($_GET['kelas'])) {
                                        $checked = $_GET['kelas'];
                                    }
                                ?>
                                    <div class="filter-item" style="font-size: 13px;">
                                        <input type="checkbox" name="kelas[]" value="<?php echo $k['Id_Kelas'] ?>" <?php if (in_array($k['Id_Kelas'], $checked)) {
                                                                                                                        echo "checked";
                                                                                                                    } ?> />
                                        <?php echo $k['Nama_Kelas'] ?>
                                    </div>

                                <?php } ?>
                            <?php } ?>
                        </div>
                    </div>
                    <div class="dropdown ml-auto">
                        <div class="btn-mapel">
                            <p>Kelas XII <i class="fa fa-angle-down"></i></p>
                        </div>
                        <div class="filter dropdown-menu" aria-labelledby="dropdownMenuButton">
                            <?php
                            $conn = koneksi();
                            $kls = "SELECT * FROM kelas WHERE Tingkat_Kelas = 'XII'";
                            $klsrun = mysqli_query($conn, $kls);
                            if (mysqli_num_rows($klsrun) > 0) { ?>
                                <?php foreach ($klsrun as $k) {
                                    $checked = [];
                                    if (isset($_GET['kelas'])) {
                                        $checked = $_GET['kelas'];
                                    }
                                ?>
                                    <div class="filter-item" style="font-size: 13px;">
                                        <input type="checkbox" name="kelas[]" value="<?php echo $k['Id_Kelas'] ?>" <?php if (in_array($k['Id_Kelas'], $checked)) {
                                                                                                                        echo "checked";
                                                                                                                    } ?> />
                                        <?php echo $k['Nama_Kelas'] ?>
                                    </div>

                                <?php } ?>
                            <?php } ?>
                        </div>
                    </div>
                </form>
            </div>
            <div class="list-pencarian">
                <?php if (isset($_GET['kelas'])) {
                    $klschecked = [];
                    $klschecked = $_GET['kelas'];
                    foreach ($klschecked as $rowkls) {
                        $clas = query("SELECT * FROM kelas WHERE Id_Kelas IN ($rowkls)");
                        $kl = $clas['Nama_Kelas'];
                        $class = "SELECT * FROM tambah_kelas WHERE Nama_Kelas LIKE '%$kl%'";
                        $classrun = mysqli_query($conn, $class);
                        if (mysqli_num_rows($classrun) > 0) {
                            foreach ($classrun as $k) : ?>
                                <div class="list-pencarian-item">
                                    <div class="logo-mapel">
                                        <img src="img/<?= $k["Sampul"] ?>" alt="">
                                    </div>
                                    <div class="class-mapel">
                                        <p>Class</p>
                                        <h1><?= $k["Kelas"] ?></h1>
                                    </div>
                                    <div class="nama-mapel">
                                        <h3><?= $k["Nama_Kelas"] ?></h3>
                                    </div>
                                    <div class="ket-mapel">
                                        <p><i class="fa fa-user"></i><?= $k["Nama_Guru"] ?></p>
                                        <p><i class="fa fa-calendar"></i>13 Oktober</p>
                                    </div>
                                    <?php
                                    $conn = koneksi();
                                    $Id = $k["Id_TambahKls"];
                                    $siswa = "SELECT COUNT(*) FROM siswa_terdaftar where Id_Kelas = $Id";
                                    $result = mysqli_query($conn, $siswa);
                                    $row = mysqli_fetch_array($result);
                                    $total = $row['COUNT(*)'];
                                    ?>
                                    <div class="jlh-siswa d-flex">
                                        <p><i class="fa fa-user"></i><?= $total ?> Siswa</p>
                                        <div class="btn-detail">
                                            <button onclick="location.href='detailpencarian.php?Id=<?= $k['Id_TambahKls']; ?>'">Detail</button>
                                        </div>
                                    </div>
                                </div>
                    <?php endforeach;
                        }
                    }
                } else { ?>
                    <?php $i = 1;
                    foreach ($kelas as $k) :
                    ?>
                        <div class="list-pencarian-item">
                            <div class="logo-mapel">
                                <img src="img/<?= $k["Sampul"] ?>" alt="">
                            </div>
                            <div class="class-mapel">
                                <p>Class</p>
                                <h1><?= $k["Kelas"] ?></h1>
                            </div>
                            <div class="nama-mapel">
                                <h3><?= $k["Nama_Kelas"] ?></h3>
                            </div>
                            <div class="ket-mapel">
                                <p><i class="fa fa-user"></i><?= $k["Nama_Guru"] ?></p>
                                <p><i class="fa fa-calendar"></i>13 Oktober</p>
                            </div>
                            <?php
                            $conn = koneksi();
                            $Id = $k["Id_TambahKls"];
                            $siswa = "SELECT COUNT(*) FROM siswa_terdaftar where Id_Kelas = $Id";
                            $result = mysqli_query($conn, $siswa);
                            $row = mysqli_fetch_array($result);
                            $total = $row['COUNT(*)'];
                            ?>
                            <div class="jlh-siswa d-flex">
                                <p><i class="fa fa-user"></i><?= $total ?> Siswa</p>
                                <div class="btn-detail">
                                    <button onclick="location.href='detailpencarian.php?Id=<?= $k['Id_TambahKls']; ?>'">Detail</button>
                                </div>
                            </div>
                        </div>
                    <?php endforeach; ?>
                <?php } ?>
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

        var dropdown = document.getElementsByClassName("btn-mapel");
        var i;

        for (i = 0; i < dropdown.length; i++) {
            dropdown[i].addEventListener("click", function() {
                this.classList.toggle("active");
                var dropdownContent = this.nextElementSibling;
                if (dropdownContent.style.display === "block") {
                    dropdownContent.style.display = "none";
                } else {
                    dropdownContent.style.display = "block";
                }
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