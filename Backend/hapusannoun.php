<?php
session_start();

if (!isset($_SESSION['$login_admin'])) {
    header("Location: index.php");
    exit;
}

require 'functions.php';

$Id = $_GET['Id'];
$announ = query("SELECT * FROM announcement WHERE id_announ = $Id");
if (HapusAnnoun($Id) > 0) {
    echo "<script>
        alert('Data berhasil dihapus');
        </script>";
    header("Location:announcement_admin.php");
} else {
    echo 'Data gagal dihapus';
}
