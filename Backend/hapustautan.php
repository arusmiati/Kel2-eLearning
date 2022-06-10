<?php 
session_start();

if(!isset($_SESSION['$login_guru'])){
    header("Location: login.php");
    exit;
}

require 'functions.php';

$Id = $_GET['id'];
$tgs = query("SELECT * FROM tautan WHERE Id_Tautan = $Id");
$idm = $tgs["Id_Mapel"];
if(HapusTautan($Id) > 0){
    echo "<script>
        alert('Data berhasil dihapus');
        </script>";
    header("Location:tautanguru.php?Id=$idm");
}else{
    echo 'Data gagal dihapus';
}
