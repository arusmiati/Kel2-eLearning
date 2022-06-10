<?php

session_start();
if (!isset($_SESSION['$login_siswa'])) {
    header("Location: login.php");
    exit;
}

require 'functions.php';

$previous = "javascript:history.go(-1)";
if (isset($_SERVER['HTTP_REFERER'])) {
    $previous = $_SERVER['HTTP_REFERER'];
}

$Id = $_GET['Id'];

$ujian = query("SELECT * FROM ujian WHERE id_ujian = '$Id'");
$idm = $ujian["Id_Mapel"];
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
    <title>Ujian</title>
    <link rel="stylesheet" href="style.css?<?php echo time() ?>">
    <style>
        .item button {
            background-color: #082C73;
            border: none;
            outline: none;
            color: white;
            padding: 5px 20px;
            border-radius: 10px;
            font-size: 12px;
        }

        .item button:hover {
            background-color: #ffff;
            color: #082C73;
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

        <div class="tabel">
            <div class="tabel-content doc-content">
                <div class="doc-header d-flex">
                    <span><a href="javascript:history.back()"><i class="fa fa-arrow-left"></i></a> </span>
                    <h1>Ulangan Harian</h1>
                </div>
                <div class="ujian-detail">
                    <div class="title">
                        <h1><?= $ujian["judul_ujian"] ?></h1>
                    </div>
                    <div class="time det-ujian">
                        <table border="0">
                            <tbody>
                                <tr>
                                    <td>Mulai</td>
                                    <td>:</td>
                                    <td><?= date("D, j F Y, H:i", strtotime($ujian["Waktu_Aktif"])) ?> WITA</td>
                                </tr>
                                <tr>
                                    <td>Berakhir</td>
                                    <td>:</td>
                                    <td><?= date("D, j F Y, H:i", strtotime($ujian["Waktu_Berakhir"])) ?> WITA</td>
                                </tr>
                            </tbody>
                        </table>
                    </div>
                    <?php
                    $today = time();
                    $date_exam = date($ujian["Waktu_Berakhir"]);
                    $date_exam1 = date($ujian["Waktu_Aktif"]);

                    date_default_timezone_set('Asia/Makassar');
                    if (strtotime($date_exam1) > $today) { ?>
                        <p class="notif">Ujian Belum Mulai</p>
                    <?php } elseif (strtotime($date_exam) < $today) { ?>
                        <p class="notif-end">Ujian Telah Selesai!!!</p>
                    <?php } else { ?>
                        <div class="btn-start">
                            <button onclick="location.href='startujian.php?Id=<?= $ujian["id_ujian"] ?>'">Mulai</button>
                        </div>
                        <div class="btn-back">
                            <button onclick="location.href='javascript:history.back()'">Kembali</button>
                        </div>
                    <?php } ?>
                </div>
                <?php 
                $nama = $_SESSION['Nama'];
                $uj = querys("SELECT * FROM jawaban_ujian WHERE id_ujian = '$Id' AND nama = '$nama' LIMIT 1");

                if (empty($uj)) : ?>
                        <p></p>
                <?php else : ?>
                
                    <div class="item-tabel">
                    <table>
                        <tr class="title">
                            <th class="th1">Nama Siswa</th>
                            <th>Nomor Induk Siswa</th>
                            <th>Skor</th>
                            <th class="th2">Opsi</th>
                        </tr>
                        <?php foreach ($uj as $u) : ?>
                            <tr class="item">
                                <td style=" text-align: left !important;"><?php echo $_SESSION['Nama'] ?></td>
                                <td style="text-align: left !important;"><?php echo $_SESSION['Nis'] ?></td>

                                <td style="text-align: left !important;"><?php echo $u['skor'] ?>/100</td>
                                <?php

                                $user = query("SELECT * FROM siswa_terdaftar WHERE Nama = '$nama' and Id_Kelas = '$idm' ");
                                $ids = $user["Id_Anggota"];
                                ?>
                                <td style="text-align: left !important;"><button onclick="location.href='detailpengerjaansiswa.php?Id=<?= $ids ?>'">View</button></td>
                            </tr>
                        <?php endforeach ?>
                    </table>
                </div>
                <?php endif ?>
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
    </script>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
</body>

</html>