<?php

include 'functions.php';
$connect = mysqli_connect("localhost", "root", "", "elearning");
if(!empty($_POST))
{
 $output = '';
 $soal = mysqli_real_escape_string($connect, $_POST["nama"]);  
 $direktori = "dokumen/";
 $lampiran = $_FILES['file']['name'];
 move_uploaded_file($_FILES['file']['tmp_name'], $direktori . $lampiran);
 $query = "INSERT INTO soal_pg(soal) VALUES('$soal')";

 header('Location: tambahujian.php?Id=<?=$Id_Mapel?>');
}
?>