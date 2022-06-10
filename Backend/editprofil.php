<?php

session_start();
if (!isset($_SESSION['$login_siswa'])) {
    header("Location: login.php");
    exit;
}
require 'functions.php';

$id = $_GET["Id"];

if (isset($_POST['edit'])) {
    if (EditProfil($_POST) > 0) {
      header("Location:profil.php?Id=$id");
    } else {
      echo '<script> alert: Profil Gagal Diedit';
    }
  }
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css"integrity="sha384-9aIt2nRpC12Uk9gS9baDl411NQApFmC26EwAOH8WgZl5MYYxFfc+NcPb1dKGj7Sk" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100&display=swap" rel="stylesheet">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;300;500;700;800&display=swap"rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css"integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <title>Profil</title>
    <link rel="stylesheet" href="style.css?<?php echo time() ?>">
    <script type="text/javascript">
    function preview() {
        thumb.src=URL.createObjectURL(event.target.files[0]);
    }
    </script>
</head>

<body>
    <?php require_once('navbar/navbarhome.php') ?>
    <div class="main-container">
        <div id="confirm-box">
            <h1>Apakah anda ingin keluar dari E-LEARNING SMANEL?</h1>
            <a href="logout.php" class="yes">Iya</a>
            <a href="" class="no">Tidak</a>
        </div>
        <div class="sidebar" id="sidebar">
            <ul>
                <li class="icon active">
                    <?php
                    $nama = $_SESSION["Nis"];
                    $user = query("SELECT * FROM user_siswa WHERE Nis = '$nama'");
                    
                    ?>
                    <a href="profil.php"><img src="img/<?=$user["Profil"] ?>" alt="" style="border-radius: 50%;"></a>
                    <br>
                    <span>Profil</span>
                </li>
                <li class="icon">
                    <a href="progress.php"><img src="img/progress.png" alt=""></a>
                    <br>
                    <span>Progress</span>
                </li>
                <li class="icon ">
                    <a href="bantuan.php"><img src="img/bantuan.png" alt=""></a>
                    <br>
                    <span>Bantuan</span>
                </li>
                <li class="icon">
                    <a href="#" onclick="LogConfirm()"><img src="img/logout.png" alt=""></a>
                    <br>
                    <span>Logout</span>
                </li>
            </ul>
        </div>
    </div>

    <div class="profil-header">
        <div class="profil-sidebar">
            <div class="button">
                <button type="button" id="user" class="profil-sidebar-page">
                    <i class="fa fa-user"></i>User Profil
                </button>
                <button type="button" id="password" class="profil-sidebar-page " onclick="location.href='password.php?Id=<?=$user["Id"]?>'">
                    <i class="fa fa-lock"></i>Password
                </button>
            </div>
        </div>
        <?php 
        
        $nama = $_SESSION["Nis"];
        $user = query("SELECT * FROM user_siswa WHERE Nis = '$nama'");
        ?>
        <div class="profil-user">
            <div class="rectangle">
                <img alt="your image" src="img/<?php echo $user["Profil"]; ?>" style="border-radius='50px';" title="<?php echo  $user["Profil"];  ?>">
            </div>
            <div class="nama-profil">
                <p id="NamaPengguna"><?=$user["Nama"]?></p>
                <p id="NomorInduk"><?=$user["Nis"]?></p>
            </div>
            <form class="field-user" id="form" action="" method="POST" enctype="multipart/form-data">
            <div class="container-field-user" action="">
                    <label for="username">Nama User</label>
                    <input type="text" placeholder="Masukkan Username" value="<?=$user["Username"]?>" name="username" id="username" required>
                    <br>
                    <label for="namaLengkap">Nama Lengkap</label>
                    <input type="text" placeholder="Masukkan Nama Lengkap" value="<?=$user["Nama"]?>" name="namaLengkap" id="namaLegkap" required>
                    <br>
                    <label for="email">Email</label>
                    <input type="text" placeholder="Masukkan E-mail" value="<?=$user["Email"]?>" name="email" id="email" >
                    <br>
                    <label for="no-hp">Tempat Lahir</label>
                    <input type="text" name="tempat" value="<?=$user["Tempat"]?>" placeholder="Masukkan tempat lahir" id="">
                    <br>
                    <label for="no-hp">Tanggal Lahir</label>
                    <input type="date" placeholder="Masukkan Nomor Handphone" value="<?=$user["Tanggal"]?>" name="tanggal" id="no-hp" required>
                    <br>
                    <label for="alamat">Alamat</label>
                    <input type="text" placeholder="Masukkan Alamat" name="alamat" value="<?=$user["Alamat"]?>" id="alamat" required>
                    <br>
                    <label for="alamat">Profil</label>
                    <input type="file" onchange="preview();" name="file" class="image" accept=".jpg, .jpeg, .png" id="alamat">
                    <br><img id="thumb" src="" width="150px"/>
                    <br>
                    <div class="click d-flex">
                        <div class="btn-back">
                            <button onclick="location.href='javascript:history.back()'">Kembali</button>
                        </div>
                        <div class="btn-start">
                            <button type="submit" name="edit" onclick="tambahConfirm()">Submit</button>
                        </div>
                    </div>
                    <br>
                </div>
            
            </form>
        </div>
    </div>

    <div class="footer">
        <div class="nama-footer">
            <p class="tfooter">SMA Negeri 5 Luwu</p>
            <p>Jl.Jambu Kec. Bajo Kab. Luwu 91995</p>
        </div>
        <div class="web">
            <ul>
                <li><a href="http://sman5luwu.sch.id/index.php"><i class="fa fa-globe"></i><span>sman5luwu.sch.id</span></a></li>
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
            }
            else {
                document.getElementById("confirm-box").style.display = "none"
                c = 0;
            }
        }
    </script>


    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj"crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo"crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI"crossorigin="anonymous"></script>
</body>

</html>