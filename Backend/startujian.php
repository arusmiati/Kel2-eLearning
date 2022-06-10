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

$uj = query("SELECT * FROM ujian WHERE id_ujian = '$Id'");
$ujian = querys("SELECT * FROM soal_pg  WHERE id_ujian = '$Id'");

$ujian1 = querys("SELECT * FROM soal_essay  WHERE id_ujian = '$Id'");

if (isset($_POST['submit'])) {
    if (Jawaban($_POST) > 0) {
        return true;
    } else {
        return false;
    }
}
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
    <script src="https://cdn.ckeditor.com/4.18.0/standard/ckeditor.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;300;500;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.12.2/jquery.min.js"></script>
    <script src="ckfinder/ckfinder.js"></script>
    <script src="ckeditor/ckeditor.js"></script>

    <title>E-LEARNING SMANEL</title>
    <link rel="stylesheet" href="style.css">
    <style>
        td{
            background: none;
            border-radius: 10px;
        }
    </style>
    <script>
        function timeout() {
            var hours = Math.floor(timeleft / 3600);
            var mins = Math.floor((timeleft - (hours * 60 * 60)) / 60);
            var secs = timeleft % 60;
            var hrs = checktime(hours);
            var mint = checktime(mins);
            var sec = checktime(secs);
            if (timeleft <= 0) {
                clearTimeout(tm);
                document.getElementById("form").submit();
            } else {
                document.getElementById("timeout").innerHTML = hrs + ":" + mint + ":" + sec;
            }
            timeleft--;
            var tm = setTimeout(function() {
                timeout()
            }, 1000);
        }

        function checktime(msg) {
            if (msg < 10) {
                msg = "0" + msg;
            }
            return msg;
        }
    </script>
</head>

<body onload="timeout()">
    <?php require_once('navbar/navbarmapel.php') ?>
    <div class="main-container">
        <div id="confirm-box">
            <h1>Apakah anda ingin keluar dari E-LEARNING SMANEL?</h1>
            <a href="logout.php" class="yes">Iya</a>
            <a href="" class="no">Tidak</a>
        </div>
        <div class="tabel">
            <div class="tabel-content">
                <div class="doc-header">
                    <center>
                        <h2>
                            <script>
                                var timeleft = <?= $uj["durasi"] ?>;
                            </script>
                            <div style="font-weight: 600;" id="timeout">00:00:00</div>
                        </h2>
                    </center>
                </div>
                <form action="" method="post" enctype="multipart/form-data" id="soal">
                    <table>
                        <?php
                        $host = "localhost";
                        $user = "root";
                        $pass = "";
                        $db   = "elearning";
                        $conn = null;

                        try {
                            $conn = new PDO("mysql:host={$host};dbname={$db};", $user, $pass);
                        } catch (Exception $e) {
                        }
                        $selQuest = $conn->query("SELECT * FROM soal_pg WHERE id_ujian='$Id' ORDER BY rand() ");
                        $i = 1;
                        while ($selQuestRow = $selQuest->fetch(PDO::FETCH_ASSOC)) {
                            $questId = $selQuestRow['id_soal']; ?>
                            <tr style="background-color: none !important;">
                                <td>
                                    <div class="mulai" style="border-radius:10px;">
                                        <p><b>SOAL <?php echo $i++; ?></b><br> <?php echo $selQuestRow['soal']; ?></p>
                                        <div class="col-md-4 float-left">
                                            <div class="form-group pl-4 ">
                                                <input name="answer[<?php echo $selQuestRow['id_soal']; ?>][correct]" value="<?php echo $selQuestRow['opsi1']; ?>" class="form-check-input" type="radio" value="" id="invalidCheck">

                                                <label class="form-check-label" for="invalidCheck">
                                                    <?php echo $selQuestRow['opsi1']; ?>
                                                </label>
                                            </div>

                                            <div class="form-group pl-4">
                                                <input name="answer[<?php echo $selQuestRow['id_soal']; ?>][correct]" value="<?php echo $selQuestRow['opsi2']; ?>" class="form-check-input" type="radio" value="" id="invalidCheck">
                                                <label class="form-check-label" for="invalidCheck">
                                                    <?php echo $selQuestRow['opsi2']; ?>
                                                </label>
                                            </div>
                                        </div>
                                        <div class="col-md-8 float-left">
                                            <div class="form-group pl-4">
                                                <input name="answer[<?php echo $selQuestRow['id_soal']; ?>][correct]" value="<?php echo $selQuestRow['opsi3']; ?>" class="form-check-input" type="radio" value="" id="invalidCheck">

                                                <label class="form-check-label" for="invalidCheck">
                                                    <?php echo $selQuestRow['opsi3']; ?>
                                                </label>
                                            </div>

                                        </div>
                                    </div>
                                </td>
                            </tr>

                        <?php } ?>
                        <?php $selQuest1 = $conn->query("SELECT * FROM soal_essay WHERE id_ujian='$Id' ORDER BY rand() ");
                        while ($selQuestRow1 = $selQuest1->fetch(PDO::FETCH_ASSOC)) { ?>
                            <tr>
                                <td>
                                    <p><b>SOAL <?php echo $i++; ?></b><br> <?php echo $selQuestRow1['soal']; ?></p>
                                    <textarea name="answer[<?php echo $selQuestRow1['id_soal']; ?>][correct]" type="text" id="editor"></textarea>

                                </td>
                            </tr>
                        <?php } ?>
                    </table>


                    <div class="click">
                        <div class="btn-start" style="text-align: center !important; margin-bottom: 50px;">
                            <button type="submit" id="submit" value="submit" name="submit" onclick="submit()">Submit</button>
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

    <script src="js/script.js"></script>

    <script>
        function submit() {
            document.getElementById("soal").submit();
        }
        CKEDITOR.replace('editor', {
            filebrowserUploadUrl: 'ckeditor/ck_upload.php',
            filebrowserUploadMethod: 'form'
        });
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