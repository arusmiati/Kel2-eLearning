<?php 
session_start();

if(!isset($_SESSION['$login_guru'])){
    header("Location: login.php");
    exit;
}

require 'functions.php';

$Id = $_GET["Id"];
$forumcat = query("SELECT * FROM forum_cat WHERE Id_ForumCat = $Id");
$Idc = $forumcat["Id_Forum"];
if (HapusForumC($Id) > 0) {
    echo "<script>
        alert('Data berhasil dihapus');
        </script>";
    header("Location:forumcategories_guru.php?Id=$Idc");
} else {
    echo 'Data gagal dihapus';
}