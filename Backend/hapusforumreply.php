<?php 
session_start();

if(!isset($_SESSION['$login_guru'])){
    header("Location: login.php");
    exit;
}

require 'functions.php';

$Id = $_GET["Id"];
$forumcat = query("SELECT * FROM forum_reply WHERE Id_Reply = $Id");
$idf = $forumcat["Id_ForumCat"];
if (HapusForumR($Id) > 0) {
    echo "<script>
        alert('Data berhasil dihapus');
        </script>";
    header("Location:forumthread_guru.php?Id=$idf");
} else {
    echo 'Data gagal dihapus';
}

