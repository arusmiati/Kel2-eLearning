<?php

session_start();
if (!isset($_SESSION['$login_guru'])) {
    header("Location: login.php");
    exit;
}

require 'functions.php';

$previous = "javascript:history.go(-1)";
if (isset($_SERVER['HTTP_REFERER'])) {
    $previous = $_SERVER['HTTP_REFERER'];
}

$Id = $_GET['Id'];

$ujian = querys("SELECT * FROM siswa_terdaftar WHERE Id_Kelas = $Id");
if (isset($_POST['cari'])) {
    $ujian = cari_siswa($_POST['keyword']);
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
    <?php require_once('navbar/navbarkelas_guru.php') ?>

    <div class="main-container">
        <div id="confirm-box">
            <h1>Apakah anda ingin keluar dari E-LEARNING SMANEL?</h1>
            <a href="logout.php" class="yes">Iya</a>
            <a href="" class="no">Tidak</a>
        </div>
        <div id="confirm-box-tambah">
            <h1>File Ini<br> Berhasil Ditambahkan</h1>
        </div>
        <div class="tabel">
            <div class="tabel-content">
                <div class="doc-header">
                    <div class="d-flex">
                        <span><a href="javascript:history.back()"><i class="fa fa-arrow-left"></i></a> </span>
                        <h1>Ulangan Harian</h1>
                    </div>

                    <div class="search-box1 doc-guru ml-auto">
                        <form action="" method="post">
                            <span><i class="fa fa-search"></i></span>
                            <input type="text" class="keyword" name="keyword" style="background: none !important;border: none;outline: none;height: 20px;font-size: 12px;" placeholder="Search Here"></input>
                            <button type="submit" style="width: 20px; display: none;" name="cari" class="tombol-cari">Cari</button>
                        </form>
                    </div>
                </div>
                <div class="item-tabel">
                    <table>
                        <tr class="title">
                            <th class="th1">Nama Siswa</th>
                            <th>Nomor Induk Siswa</th>
                            <th>Skor</th>
                            <th class="th2">Opsi</th>
                        </tr>
                        <?php foreach ($ujian as $u) : ?>
                            <tr class="item">
                                <td style=" text-align: left !important;"><?php echo $u['Nama'] ?></td>
                                <td style="text-align: left !important;"><?php echo $u['Nis'] ?></td>
                                <?php
                                $user_nama = $u["Nama"];
                                $ujian = query("SELECT * FROM jawaban_ujian WHERE nama = '$user_nama' LIMIT 1");
                                ?>
                                <td style="text-align: left !important;"><?php echo $ujian['skor'] ?>/100</td>
                                <td style="text-align: left !important;"><button onclick="location.href='detailpengerjaan.php?Id=<?= $u['Id_Anggota'] ?>'">View</button></td>
                            </tr>
                        <?php endforeach ?>
                    </table>
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


    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
</body>

</html>