<?php
session_start();

if (!isset($_SESSION['$login_admin'])) {
    header("Location: index.php");
    exit;
}

$previous = "javascript:history.go(-1)";
if (isset($_SERVER['HTTP_REFERER'])) {
    $previous = $_SERVER['HTTP_REFERER'];
}
include 'functions.php';
$id = $_GET['Id'];
$s = query("SELECT * FROM announcement WHERE id_announ = $id");

if (isset($_POST['slide'])) {
    if (editannoun($_POST) > 0) {
        header("Location:announcement_admin.php");
    } else {
        echo 'Pengumuman Gagal Ditambahkan';
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
    <title>Edit Announcement</title>
    <link rel="stylesheet" href="style.css?<?php echo time() ?>">

    <style>
        textarea {
            width: 84%;
        }

        .doc-header {
            height: max-content;
            padding-bottom: 0px !important;
        }

        .title-item.d-flex {
            margin-bottom: 20px;
        }
    </style>

</head>

<body>
    <?php require_once('navbar/navbarhome_admin.php') ?>
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
            <div class="doc-content tabel-content">
                <div class="doc-header">
                    <div class="title-item d-flex">
                        <span><a href="javascript:history.back()"><i class="fa fa-arrow-left"></i></a> </span>
                        <h1>Edit Announcement</h1>
                        <br>
                    </div>

                </div>

                <form action="" method="post" enctype="multipart/form-data" class="dropzone" id="image-upload">
                    <div class="add-docs tambah-tugas">
                        <input type="hidden" name="Id">
                        <div class="title d-flex">
                            <p>Judul</p>
                            <input name="judul1" value="<?= $s['judul'] ?>" type="text" placeholder="Ketikkan judul disini">
                        </div>
                        <div class="title d-flex">
                            <p>Deskripsi</p>
                            <textarea name="deskripsi1" placeholder="Ketikkan deskripsi disini (optional)"><?= $s['deskripsi'] ?></textarea>
                        </div>
                        <div class="title tambah d-flex">
                            <p>Tambah File</p>
                            <input id="upfile" type="file" value="<?= $s['image'] ?>" name="NamaFile1" multiple />
                        </div>
                    </div>
                    <div class="click d-flex" style="justify-content:center ; margin-bottom: 50px;">
                        <div class="btn-back">
                            <button onclick="location.href='javascript:history.back()'">Kembali</button>
                        </div>
                        <div class="btn-start">
                            <button name="slide" type="submit" onclick="return confirm('Apakah Anda Yakin Ingin Mengubah Pengumuman Ini?');">Edit</button>
                        </div>
                    </div>
                </form>

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