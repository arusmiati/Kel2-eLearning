<?php
session_start();

if (!isset($_SESSION['$login_admin'])) {
    header("Location: index.php");
    exit;
}
require 'functions.php';

$previous = "javascript:history.go(-1)";
if (isset($_SERVER['HTTP_REFERER'])) {
    $previous = $_SERVER['HTTP_REFERER'];
}
$conn = koneksi();
if (isset($_POST['save'])) {
    $checkbox = $_POST['check'];
    for ($i = 0; $i < count($checkbox); $i++) {
        $del_id = $checkbox[$i];
        mysqli_query($conn, "DELETE FROM user_siswa WHERE Id ='" . $del_id . "'");
        $message = "Data deleted successfully !";
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
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;300;500;700;800&display=swap" rel="stylesheet">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
    <title>Tabel Siswa</title>
    <link rel="stylesheet" href="style.css?<?php echo time() ?>">
    <style>
        .doc-header.kelola.d-flex {
            min-height: 0px !important;
        }

        form {
            margin-top: 50px !important;
        }
    </style>
</head>

<body>
    <?php require_once('navbar/navbaruser_admin.php') ?>
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
                <div class="doc-header kelola d-flex">

                    <div class="head d-flex">
                        <span><a href="kelola_user.php"><i class="fa fa-arrow-left"></i></a> </span>
                        <div class="icon"><img src="img/student1.png" alt=""></div>
                        <?php
                        $conn = koneksi();
                        $user = "SELECT COUNT(*) FROM user_siswa";
                        $result = mysqli_query($conn, $user);
                        $row = mysqli_fetch_array($result);
                        $total = $row['COUNT(*)'];
                        ?>
                        <h1>Siswa (<?= $total ?>)</h1>
                    </div>
                    <br>
                    <div class="search-bar bar2 d-flex">
                        <form action="" method="post">
                            <input type="search" name="keyword" placeholder="Search Name Here" class="keyword input-field"></input>
                            <button type="submit" style="width: 20px; display: none;" name="cari" class="tombol-cari">Cari</button>
                        </form>
                    </div>
                </div>

                <form action="" method="post" id="delete_form">
                    <div class="del-sel">
                        <button style="cursor: pointer;" type="submit" id="submit" name="save" onclick="return confirm('Apakah Anda Yakin Ingin Menghapus Data Ini?')" class="del-item">Delete Selected Row</button>
                        <button style="background: #58BAAB;color: white;outline: none;cursor: pointer;"><a style="color: white;text-decoration: none;" href="tambahsiswa.php">Tambah Data Siswa</a></button>
                    </div>

                    <div class="item-tabel">
                        <table>
                            <tr class="title">
                                <th class="th1"><input type="checkbox" id="checkAl"></th>
                                <th>Nama</th>
                                <th>NIS</th>
                                <th>Kelas</th>
                                <th>TTL</th>
                                <th>Alamat</th>
                                <th>Email</th>
                                <th>Username</th>
                                <th>Password</th>
                                <th class="th2">Opsi</th>
                            </tr>
                            <?php
                            $user = querys("SELECT * FROM user_siswa");
                            if (isset($_POST['cari'])) {
                                $user = cari_siswa1($_POST['keyword']);
                            }
                            foreach ($user as $u) : ?>
                                <tr class="item items">
                                    <td><input type="checkbox" id="checkItem" name="check[]" value="<?= $u["Id"] ?> id=""></td>
                                <td><?php echo $u["Nama"] ?></td>
                                <td><?= $u["Nis"] ?></td>
                                <td><?= strtoupper($u["Kelas"]) ?></td>
                                <td><?= $u["Tempat"] ?>, <?= date("j F Y", strtotime($u["Tanggal"])) ?></td>
                                <td><?= $u["Alamat"] ?></td>
                                <td><?php echo $u["Email"] ?></td>
                                <td><?= $u["Username"] ?></td>
                                <td><input value=" <?= $u["Password"] ?>" name="password" type="teks" id="password-field" readonly>
                                    <td>
                                        <div class="opsi">
                                            <button class="edit" onclick="location.href='editsiswa.php?Id=<?= $u["Id"] ?>'"><a href="editsiswa.php?Id=<?= $u["Id"] ?>">edit</a></button>
                                        </div>
                                    </td>

                                </tr>
                            <?php endforeach ?>
                        </table>

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
        $("#checkAl").click(function() {
            $('input:checkbox').not(this).prop('checked', this.checked);
        });
    </script>


    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js" integrity="sha384-DfXdz2htPH0lsSSs5nCTpuj/zy4C+OGpamoFVy38MVBnE+IbbVYUew+OrCXaRkfj" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js" integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous"></script>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js" integrity="sha384-OgVRvuATP1z7JjHLkuOU7Xw704+h835Lr+6QL9UvYjZE3Ipu6Tp75j7Bh/kR0JKI" crossorigin="anonymous"></script>
</body>

</html>