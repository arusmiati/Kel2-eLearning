<?php

session_start();
if (!isset($_SESSION['$login_admin'])) {
    header("Location: index.php");
    exit;
}
require 'functions.php';

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
    <?php require_once('navbar/navbarhome_admin.php') ?>
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
                    $nama = $_SESSION["Nama"];
                    $user = query("SELECT * FROM user_admin WHERE Nama = '$nama'");
                    
                    ?>
                    <a href="profil_admin.php"><img src="img/<?=$user["Profil"] ?>" alt="" style="border-radius: 50%;"></a>
                    <br>
                    <span>Profil</span>
                </li>
                <li class="icon ">
                    <a href="bantuan_admin.php"><img src="img/bantuan.png" alt=""></a>
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
                <?php 
                $nama = $_SESSION["Username"];
                
                $user = query("SELECT * FROM user_admin WHERE Username = '$nama'");
                ?>
                <button type="button" id="password" class="profil-sidebar-page " onclick="location.href='password_admin.php?Id=<?=$user["Id"]?>'">
                    <i class="fa fa-lock"></i>Password
                </button>
            </div>
        </div>
        <?php 
        
        $nama = $_SESSION["Nama"];
        $user = query("SELECT * FROM user_admin WHERE Nama = '$nama'");
        ?>
        <div class="profil-user">
            <div class="rectangle">
                <img alt="your image" src="img/<?php echo $user["Profil"]; ?>" style="border-radius='50px';" title="<?php echo  $user["Profil"];  ?>">
            </div>
            <div class="nama-profil">
                <p id="NamaPengguna"><?php echo $user["Nama"]?></p>
                <p id="NomorInduk"><?=$user["Nip"]?></p>
            </div>
            <form class="field-user" >
                <div class="container-field-user">
                    <label for="username">Nama User</label>
                    <input type="text" placeholder="" value="<?=$user["Username"]?>" readonly>
                    <br>
                    <label for="namaLengkap">Nama Lengkap</label>
                    <input type="text" placeholder="" value="<?=$user["Nama"]?>" name="namaLengkap" id="namaLegkap"  readonly>
                    <br>
                    <label for="email">Email</label>
                    <input type="email" placeholder="" value="<?=$user["Email"]?>" name="email" id="email"  readonly>
                    <br>
                    <label for="no-hp">TTL</label>
                    <input type="text" placeholder="" value="<?=$user["Tempat"]?>, <?= date("j F Y", strtotime($user["Tanggal"]))?>" name="no-hp" id="no-hp"  readonly>
                    <br>
                    <label for="alamat">Alamat</label>
                    <input type="text" placeholder="" name="alamat" value="<?=$user["Alamat"]?>" id="alamat"  readonly>
                    <br>
                    <br>
                    <button><a href="editprofiladmin.php?Id=<?= $user["Id"]?>" style="text-decoration: none; color: white">Edit Profile</a></button>
                    <br><br>
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