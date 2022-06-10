<?php 
session_start();

if(!isset($_SESSION['$login_guru'])){
    header("Location: login.php");
    exit;
}

require 'functions.php';

$Id = $_GET['id'];
$tgs = query("SELECT * FROM forum WHERE Id_Forum = $Id");
$idm = $tgs["Id_Mapel"];
if(HapusForum($Id) > 0){
    echo "<script>
        alert('Data berhasil dihapus');
        </script>";
    header("Location:forum_guru.php?Id=$idm");
}else{
    echo 'Data gagal dihapus';
}
