<?php 
session_start();

if(!isset($_SESSION['$login_guru'])){
    header("Location: login.php");
    exit;
}

require 'functions.php';

$Id = $_GET['Id'];
$docs = query("SELECT * FROM docs WHERE Id_Docs = $Id");
$idm = $docs["Id_Mapel"];
if(HapusDocs($Id) > 0){
    echo "<script>
        alert('Data berhasil dihapus');
        </script>";
    header("Location:dokumen_guru.php?Id=$idm");
}else{
    echo 'Data gagal dihapus';
}
