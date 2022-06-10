<?php 
session_start();

if(!isset($_SESSION['$login_guru'])){
    header("Location: login.php");
    exit;
}

require 'functions.php';

$Id = $_GET['Id'];
$p = query("SELECT * FROM pengumuman WHERE Id_Pengumuman = $Id");
$idf = $p["Id_Mapel"];
if (HapusPengumuman($Id) > 0) {
    echo "<script>
        alert('Data berhasil dihapus');
        </script>";
    header("Location:pengumuman_guru.php?Id=$idf");
} else {
    echo 'Data gagal dihapus';
}

