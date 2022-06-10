<?php 
session_start();

if(!isset($_SESSION['$login_guru'])){
    header("Location: login.php");
    exit;
}

require 'functions.php';

$Id = $_GET['id'];
$tgs = query("SELECT * FROM tugas WHERE Id_Tugas = $Id");
$idm = $tgs["Id_Mapel"];
if(HapusTugas($Id) > 0){
    echo "<script>
        alert('Data berhasil dihapus');
        </script>";
    header("Location:tugas_guru.php?Id=$idm");
}else{
    echo 'Data gagal dihapus';
}
