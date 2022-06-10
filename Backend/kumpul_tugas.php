<?php
session_start();
if (!isset($_SESSION['$login_siswa'])) {
    header("Location: login.php");
    exit;
}

error_reporting(0);
$previous = "javascript:history.go(-1)";
if (isset($_SERVER['HTTP_REFERER'])) {
    $previous = $_SERVER['HTTP_REFERER'];
}

require 'functions.php';
$Id = $_GET['id'];
$tugas = query("SELECT * FROM tugas WHERE Id_Tugas = $Id");
if (isset($_POST['Tugas'])) {
    KumpulTugas($_POST);
}
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap CSS -->
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.3/css/all.min.css" />
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;300;500;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <title>Tugas</title>
    <link rel="stylesheet" href="style.css?<?php echo time(); ?>">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css" integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <script src="sweetalert2.min.js"></script>
    <script src="//cdn.jsdelivr.net/npm/sweetalert2@11"></script>
    <link rel="stylesheet" href="sweetalert2.min.css">
    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>

</head>

<body>
    <?php require_once('navbar/navbarmapel.php')?>

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
            <div class="tabel-content">
                <div class="doc-header">
                    <div class="d-flex">
                        <span><a href="javascript:history.back()"><i class="fa fa-arrow-left"></i></a> </span>
                        <h1><?= $tugas["judul_tugas"] ?></h1>
                    </div>
                </div>
                <div class="kumpul">
                    <div class="wrapper">
                        <form action="" method="post" enctype="multipart/form-data" class="dropzone" id="image-upload">
                            <i class="fas fa-cloud-upload-alt"></i>
                            <input type="file" value="upload" name="file" id="select_file" multiple />
                            <header>Select File</header>
                            <button name="Tugas" type="submit" onclick="move()" class="serahkan">Serahkan</button>
                        </form>
                        <div class="progress">
					  <div class="progress-bar" id="pro"  role="progressbar" aria-valuenow="25" aria-valuemin="0" aria-valuemax="100"></div>
					</div>
                    <p class="alert-success" id="status"></p>
                    
                    </div>
                </div>
                <br>

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
    <script src="http://code.jquery.com/jquery-latest.min.js"></script>
    <script>
        function move() {
            var pro = document.getElementById("pro");   
              
			  var width = 1;
			  var id = setInterval(kondisiPro, 10);
 
			  function kondisiPro() {
			    if (width >= 100) {
			      clearInterval(id);
			    } else {
			      width++; 
			      pro.style.width = width + '%'; 
			      pro.innerHTML = width + "%"; 
			    }
			    if (width == 100 ) {
			    	document.getElementById("status").innerHTML = " File Berhasil Di Upload ";
                    document.getElementById("status").style.padding = "20px";
                    document.getElementById("status").style.margin = "10px auto";
			    }
                
			  }
              document.getElementById("status").innerHTML = 
                swal("Congratulation!", "You Got 50 Point XP", "success");
            }
    </script>
    <script>
        function _(element) {
            return document.getElementById(element);
        }

        _('select_file').onchange = function(event) {
            var form_data = new FormData();
            var image_number = 1;
            var error = '';
            for (var count = 0; count < _('select_file').files.length; count++) {
                form_data.append("images[]", _('select_file').files[count]);
                image_number++;
            }
            if (error != '') {
                _('uploaded_image').innerHTML = error;
                _('select_file').value = '';
            } else {
                _('progress_bar').style.display = 'block';
                var ajax_request = new XMLHttpRequest();
                ajax_request.open("POST", "upload.php");
                ajax_request.upload.addEventListener('progress', function(event) {
                    var percent_completed = Math.round((event.loaded / event.total) * 100);
                    _('progress_bar_process').style.width = percent_completed + '%';
                    _('progress_bar_process').innerHTML = percent_completed + '% completed';
                });

                ajax_request.addEventListener('load', function(event) {
                    _('uploaded_image').innerHTML = '<div class="alert alert-success">Files Uploaded Successfully</div>';
                    _('select_file').value = '';
                });
                ajax_request.send(form_data);
            }
        };

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
    <script src="js/sweetalert.js"></script>
    <script src="js/jquery.js"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
</body>

</html>