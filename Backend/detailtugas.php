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
$Nis = $_SESSION['Nis'];
$tugas = query("SELECT * FROM tugas WHERE Id_Tugas = $Id");
$kumpul = querys("SELECT * FROM kumpul_tugas WHERE Id_Tugas = '$Id' AND Nis = '$Nis'");
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
    <title>Tugas</title>
    <link rel="stylesheet" href="style.css?<?php echo time()?>">

</head>

<body>
    <?php require_once('navbar/navbarmapel.php') ?>

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
        <div class="tabel">
            <div class="tabel-content">
                <div class="doc-header">
                    <div class="d-flex">
                        <span><a href="javascript:history.back()"><i class="fa fa-arrow-left"></i></a> </span>
                        <h1>Tugas</h1>
                        <div class="btn-start ml-auto upload-btn-wrapper kumpul">
                            <a href="kumpul_tugas.php?id=<?= $tugas['Id_Tugas']; ?>"><button>Kumpul Tugas</button></a>
                        </div>
                    </div>

                </div>
                <div class="tabel">
                    <div class="tabel-content">
                    <div class="tugas-list-item">
                        <div class="title-tugas">
                            <p><?= $tugas["judul_tugas"] ?></p>
                        </div>
                        <div class="item-tugas">
                            <div class="dl">
                                <p>Deadline: <?= date("D, j F Y", strtotime($tugas["dl_tugas"])) ?>&nbsp;<?= date("G:i", strtotime($tugas["jam_dl"])) ?>&nbsp;Wita</p>
                            </div>
                            <div class="desk">
                                <p><?= $tugas["deskripsi_tugas"] ?></p>
                            </div>
                        </div>
                    </div>
                    <div class="kumpul-tugas">
                        <table>
                            <tr>
                                <th>No</th>
                                <th>Nama File</th>
                                <th>Deadline</th>
                                <th>Tanggal Upload</th>
                                <th>Detail</th>
                            </tr>
                            <?php $i = 1;
                            foreach ($kumpul as $k) : ?>
                                <tr>
                                    <td><?= $i++ ?></td>
                                    <td><?= $k["Lampiran"] ?></td>
                                    <td><?= $tugas["dl_tugas"] ?> <?= $tugas["jam_dl"]?></td>
                                    <td><?= $k["Waktu"] ?></td>
                                    <td>
                                        <a href="dokumen/<?= $k["Lampiran"]?>" target="_blank"><i class="fa fa-file-text-o"></i></a>
                                        &nbsp;&nbsp;
                                        <a href="download.php?filename=<?= $k["Lampiran"] ?>"><i class="fa fa-download"></i>
                                    </a></td>

                                </tr>
                            <?php endforeach ?>
                        </table>
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
                        window.location.href = 'dokumen.html'
                    }, 3000);
                } else {
                    document.getElementById("confirm-box-unduh-yaps").style.display = "none";
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