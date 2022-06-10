<?php 
session_start();

if(!isset($_SESSION['$login_siswa'])){
    header("Location: login.php");
    exit;
}

require 'functions.php';

$Id = $_GET['Id'];
$forumcat = query("SELECT * FROM forum_thread WHERE Id_ForumThr = $Id");
$Idc = $forumcat["Id_ForumCat"];
if (HapusForumT($Id) > 0) {
    echo "<script>
        alert('Data berhasil dihapus');
        </script>";
    header("Location:forumthread.php?Id=$Idc");
} else {
    echo 'Data gagal dihapus';
}
