<?php
session_start();
if (!isset($_SESSION['$login_admin'])) {
    header("Location: index.php");
    exit;
}

require 'functions.php';

if (isset($_POST['Tambah'])) {
    if (Tambah($_POST) > 0) {
        header("Location: kelola_mapel.php");
    } else {
        echo "data gagal ditambahkan";
    }
}

$previous = "javascript:history.go(-1)";
if (isset($_SERVER['HTTP_REFERER'])) {
  $previous = $_SERVER['HTTP_REFERER'];
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
    <title>Tambah Mata Pelajaran</title>
    <link rel="stylesheet" href="style.css">

</head>

<body>
    <?php require_once('navbar/navbarmapel_admin.php') ?>

    <div class="main-container">
        <div id="confirm-box">
            <h1>Apakah anda ingin keluar dari E-LEARNING SMANEL?</h1>
            <a href="logout.php" class="yes">Iya</a>
            <a href="" class="no">Tidak</a>
        </div>
        <div id="confirm-box-tambah">
            <h1>Kelas Mata Pelajaran <br> Berhasil Ditambahkan</h1>
        </div>
        <div class="tabel">
            <div class="tabel-content doc-content">
               <div class="doc-header">
                    <div class="d-flex">
                        <span><a href="kelola_mapel.php"><i class="fa fa-arrow-left"></i></a> </span>
                        <h1>Tambah Kelas Mata Pelajaran</h1>
                    </div>

                </div>
                <div class="add-docs tambah-tugas tambah-mapel">
                <form action="" method="post" enctype="multipart/form-data" class="dropzone" id="image-upload">
                    <div class="title d-flex">
                        <p>Nama Kelas </p>
                        <input name="Nama_Kelas" type="text" placeholder="Ketikkan nama kelas disini" required>
                    </div>
                    <div class="title d-flex">
                        <p>Tingkat Kelas </p>
                        <select name="Kelas" class="pilihKelas" required>
                            <option value="">Pilih Kelas</option>
                            <option value="X">Kelas X</option>
                            <option value="XI">Kelas XI</option>
                            <option value="XII">Kelas XII</option>
                        </select>
                    </div>
                    <div class="title d-flex">
                        <p>Tipe Kelas </p>
                        <select name="Tipe" class="pilihKelas" required>
                            <option value="">Pilih Tipe </option>
                            <option value="Mipa">Mipa</option>
                            <option value="IPS">IPS</option>
                        </select>
                    </div>
                    <div class="title d-flex">
                        <p>Jadwal Kelas</p>
                        <div class="waktu d-flex">
                            <select name="Hari" class="pilihHari" required>
                                <option value="">Hari</option>
                                <option value="Senin">Senin</option>
                                <option value="Selasa">Selasa</option>
                                <option value="Rabu">Rabu</option>
                                <option value="Kamis">Kamis</option>
                                <option value="Jumat">Jumat</option>
                                <option value="Sabtu">Sabtu</option>
                                <option value="Minggu">Minggu</option>
                            </select>
                            &nbsp;
                            <input name="Waktu" class="waktu" placeholder="Waktu" type="time" name="time" value="23:59" timeformat="24h" required />
                        </div>
                    </div>
                    <div class="title d-flex">
                        <p>Semester </p>
                        <select name="Semester" class="pilihSemester" required>
                            <option value="">Pilih Semester</option>
                            <option value="Ganjil">Semester Ganjil</option>
                            <option value="Genap">Semester Genap</option>
                        </select>
                    </div>
                    <div class="title d-flex">
                        <p>Deskripsi </p>
                        <textarea name="Deskripsi" name="paragraph_text" placeholder="Ketikkan deskripsi kelas disini (optional)"></textarea>
                    </div>
                    <div class="title d-flex">
                        <p>Bahan Kajian</p>
                        <textarea name="Kajian" name="paragraph_text" placeholder="Ketikkan bahan kajian kelas disini (optional)"></textarea>
                    </div>
                    <div class="title d-flex">
                        <p>Capaian Pelajaran</p>
                        <textarea name="Capaian" name="paragraph_text" placeholder="Ketikkan capaian pelajaran kelas disini (optional)"></textarea>
                    </div>
                    <div class="title d-flex">
                        <p>Bahan Ajar</p>
                        <textarea name="Bahan_Ajar" name="paragraph_text" placeholder="Ketikkan bahan ajar kelas disini (optional)"></textarea>
                    </div>
                    <div class="title d-flex">
                        <p>Sampul Kelas</p>
                        <div class="upload-btn-wrapper">
                            <button id="uploadFile" class="add">Add Image</button>
                            <div class="upload-wrapper d-flex">
                                <input type="file" id="file-upload" name="Sampul"></label>
                            </div>
                        </div>
                    </div>
                
                    <div class="click">
                        <div class="btn-back">
                            <button onclick="location.href='kelola_mapel.php'">Kembali</button>
                        </div>
                        <div class="btn-start">
                            <button name="Tambah" type="submit" onclick="tambahConfirm()">Tambah</button>
                        </div>
                    </div>
                    </form>
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

        function tambahConfirm() {
            if (c == 0) {
                document.getElementById("confirm-box-tambah").style.display = "block"
                setTimeout(() => {
                    window.location.href = 'kelas.php'
                }, 3000);
                c = 1;
            } else {
                document.getElementById("confirm-box-tambah").style.display = "none"
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