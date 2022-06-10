<?php
session_start();
if (!isset($_SESSION['$login_guru'])) {
    header("Location: login.php");
    exit;
}

$previous = "javascript:history.go(-1)";

if (isset($_SERVER['HTTP_REFERER'])) {
    $previous = $_SERVER['HTTP_REFERER'];
}

require 'functions.php';
$Id = $_GET['Id'];
$siswa = querys("SELECT * FROM siswa_terdaftar WHERE Id_Kelas = $Id");
if (isset($_POST['cari'])) {
    $siswa = cari_siswa($_POST['keyword']);
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
    <title>Daftar Siswa</title>
    <link rel="stylesheet" href="style.css">

</head>

<body>
    <?php require_once('navbar/navbarkelas_guru.php') ?>

    <div class="main-container">
        <div id="confirm-box-logout">
            <h1>Apakah anda ingin keluar dari E-LEARNING SMANEL?</h1>
            <a href="logout.php" class="yes">Iya</a>
            <a href="" class="no">Tidak</a>
        </div>
        <div id="confirm-box-unduh">
            <h1>Apakah anda ingin mengunduh file ini?</h1>
            <a href="#" onclick="unduhYaps()" class="yes">Iya</a>
            <a href="" class="no">Tidak</a>
        </div>
        <div id="confirm-box-unduh-yaps">
            <h1>Anda Berhasil Mengunduh File ini</h1>
        </div>
        <div id="confirm-box-delete">
            <h1>Apakah anda yakin ingin menghapus pengumuman ini?</h1>
            <a href="#" onclick="deleteYaps()" class="yes">Iya</a>
            <a href="" class="no">Tidak</a>
        </div>
        <div id="confirm-box-delete-yaps">
            <h1>Pengumuman ini Berhasil Dihapus</h1>
        </div>
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
                <div class="doc-header d-flex">
                    <span><a href="javascript:history.back()"><i class="fa fa-arrow-left"></i></a> </span>
                    <h1>Daftar Siswa</h1>

                </div>
                <div class="search-box1 doc-guru ml-auto" style="width: 250px;">
                    <form action="" method="post">
                        <span><i class="fa fa-search"></i></span>
                        <input type="text" class="keyword" name="keyword" style="background: none !important;border: none;outline: none;height: 20px;font-size: 12px;" placeholder="Search Here"></input>
                        <button type="submit" style="width: 20px; display: none;" name="cari" class="tombol-cari">Cari</button>
                    </form>
                </div>
                <div class="item-tabel mapel">
                    <table>
                        <tr class="title">
                            <th class="th1">No</th>
                            <th>Nama Siswa</th>
                            <th class="th2">Nis</th>
                        </tr>
                        <center>
                            <?php $i = 1;
                            foreach ($siswa as $s) : ?>
                                <tr class="item items">
                                    <td><?= $i++ ?></td>
                                    <td><?= $s["Nama"] ?></td>
                                    <td><?= $s["Nis"]  ?></td>
                                </tr>
                            <?php endforeach ?>
                        </center>
                    </table>
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
                        window.location.href = 'pengumuman_guru.html'
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