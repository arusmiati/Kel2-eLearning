<?php
session_start();
if (!isset($_SESSION['$login_admin'])) {
    header("Location: login.php");
    exit;
}

require 'functions.php';


if (isset($_POST['submit'])) {
    if (EditSiswa($_POST) > 0) {
        header("Location:tabelsiswa.php");
    } else {
        echo 'Data Gagal Ditambahkan';
    }
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

    <script src="bootstrap.fd.js"></script>
    <title>E-LEARNING SMANEL</title>
    <link rel="stylesheet" href="style.css?<?php echo time(); ?>">
    <link rel="stylesheet" href="style1.css?<?php echo time(); ?>">

</head>

<body>
    <?php require_once('navbar/navbaruser_admin.php') ?>

    <div class="main-container">
        <div id="confirm-box">
            <h1>Apakah anda ingin keluar dari E-LEARNING SMANEL?</h1>
            <a href="login.html" class="yes">Iya</a>
            <a href="" class="no">Tidak</a>
        </div>
        <div id="confirm-box-tambah">
            <h1>Data Siswa<br> Berhasil Ditambahkan</h1>
        </div>
        <div class="tabel">
            <div class="tabel-content doc-content">
                <div class="doc-header">
                    <div class="d-flex">
                        <span><a href="tabelsiswa.php"><i class="fa fa-arrow-left"></i></a> </span>
                        <h1>Edit Data Siswa</h1>
                    </div>

                   
                </div>
                <div class="add-docs tambah-tugas">
                    <form action="" method="post" enctype="multipart/form-data" class="dropzone" id="image-upload">
                        <input type="hidden" name="Id">
                        <?php

                        $Id = $_GET['Id'];
                        $siswa = query("SELECT * FROM user_siswa WHERE Id = $Id");

                        ?>
                        <div class="title d-flex">
                            <p>Nama Siswa</p>
                            <input name="nama" value="<?php echo $siswa["Nama"] ?>" type="text" placeholder="Ketikkan nama siswa disini">
                        </div>
                        <div class="title d-flex">
                            <p>Nis</p>
                            <input name="nis" value="<?php echo $siswa["Nis"] ?>" type="text" placeholder="Ketikkan nis siswa disini" require>
                        </div>
                        <div class="title d-flex">
                            <p>Kelas</p>
                            <input name="kelas" value="<?php echo $siswa["Kelas"] ?>" type="text" placeholder="Ketikkan kelas siswa disini (Mis: X Mipa 1)" require>
                        </div>
                        <div class="title d-flex">
                            <p>TTL</p>
                            <div class="waktu">
                                <input name="tempat" value="<?php echo $siswa["Tempat"] ?>" style="width:200px;" type="text" placeholder="Ketikkan tempat lahir siswa disini">
                                <input name="tanggal" type="date" value="<?php echo $siswa["Tanggal"] ?>" placeholder="Ketikkan tempat lahir siswa disini">

                            </div>
                        </div>
                        <div class="title d-flex">
                            <p>Alamat</p>
                            <input name="alamat" value="<?php echo $siswa["Alamat"] ?>" type="text" placeholder="Ketikkan alamat siswa disini (opsional)">
                        </div>
                        <div class="title d-flex">
                            <p>Email</p>
                            <input name="email" type="text" value="<?php echo $siswa["Email"] ?>" placeholder="Ketikkan email siswa disini (opsional)">
                        </div>
                        <div class="title d-flex">
                            <p>Username</p>
                            <input name="username" type="text" value="<?php echo $siswa["Username"] ?>" placeholder="Ketikkan username siswa disini">
                        </div>
                        <div class="title d-flex">
                            <p>Password</p>
                            <input name="password" type="text" value="<?php echo $siswa["Password"] ?>" placeholder="Ketikkan password siswa disini">
                        </div>
                        <div class="title d-flex">
                            <p>Profil (Optional)</p>
                            <div class="upload-btn-wrapper">
                                <button id="uploadFile" class="add">Add Image</button>
                                <div class="upload-wrapper d-flex">
                                    <input type="file" id="file-upload" name="Sampul"></label>
                                </div>
                            </div>
                        </div>
                        <div class="click">
                            <div class="btn-back">
                                <button onclick=""><a style="color: white; text-decoration: none;" href="tabelsiswa.php">Kembali</a></button>
                            </div>
                            <div class="btn-start">
                                <button name="submit" type="submit" onclick="return confirm('Apakah Anda Yakin Ingin Mengubah Data Ini?');">Edit</button>
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
                    window.location.href = 'tugas_guru.php?Id=<?= $id; ?>'
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