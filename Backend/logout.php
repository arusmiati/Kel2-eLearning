<?php 
session_start();
require 'functions.php';
$conn = koneksi();
$nama = $_SESSION['Nama'];

$user_siswa = query("SELECT * FROM user_siswa WHERE Nama = '$nama'");

$last = "UPDATE user_siswa SET last_login = CURRENT_TIMESTAMP(), status = 0 WHERE Nama = '$nama'";
mysqli_query($conn, $last);

session_destroy();
header("Location: login.php");

?>