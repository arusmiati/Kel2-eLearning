<?php
session_start();
if (!isset($_SESSION['$login_guru'])) {
    header("Location: login.php");
    exit;
}

require 'functions.php';
$id = $_GET["Id"];

if (isset($_POST['Tugas'])) {
    if (TambahSoalEssay($_POST) > 0) {
        header("Location:listsoal.php?Id=$id");
    } else {
        echo 'Tugas Gagal Ditambahkan';
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
    <script src="ckfinder/ckfinder.js"></script>
    <script src="ckeditor/ckeditor.js"></script>

    <script src="bootstrap.fd.js"></script>
    <title>Tambah Soal</title>
    <link rel="stylesheet" href="style.css?<?php echo time(); ?>">
    <link rel="stylesheet" href="style1.css?<?php echo time(); ?>">

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
            <h1>Kelas Mata Pelajaran <br> Berhasil Ditambahkan</h1>
        </div>
        <div class="tabel">
            <div class="doc-content">
                <div class="doc-header">
                    <div class="d-flex">
                        <span><a href="javascript:history.back()"><i class="fa fa-arrow-left"></i></a> </span>
                        <h1>Tambah Soal</h1>
                    </div>

                    <div class="search-box1 doc-guru ml-auto">
                        <span><i class="fa fa-search"></i>
                            <p>Search Bar</p>
                        </span>
                    </div>
                </div>
                <div class="add-docs tambah-alur">
                    <form action="" method="post" enctype="multipart/form-data" class="dropzone" id="image-upload">
                        <input type="hidden" name="Id">
                        <div class="title d-flex">
                            <p>Soal</p>
                            <textarea name="editor" id="editor" cols="30" rows="10"></textarea>
                        </div>

                        <div class="click">
                            <div class="btn-back">
                                <button onclick="location.href='tugas_guru.html'">Kembali</button>
                            </div>
                            <div class="btn-start">
                                <button name="Tugas" type="submit" onclick="return confirm('Apakah Anda Yakin Ingin Menambahkan Tugas Ini?');">Tambah</button>
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
        CKEDITOR.replace('editor', {
            filebrowserUploadUrl: 'ckeditor/ck_upload.php',
            filebrowserUploadMethod: 'form'
        });

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