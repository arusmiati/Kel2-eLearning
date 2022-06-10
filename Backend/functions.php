<?php

function koneksi()
{
    return mysqli_connect('localhost', 'root', '', 'elearning');
}

function query($query)
{
    $conn = koneksi();

    $result = mysqli_query($conn, $query);

    if(mysqli_num_rows($result)==1){
        return mysqli_fetch_assoc($result);
    }


    $rows = []; 
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }

    return $rows;
}

function querys($query)
{
    $conn = koneksi();

    $result = mysqli_query($conn, $query);

    if (mysqli_num_rows($result) == 0) {
        return mysqli_fetch_assoc($result);
    }

    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }

    return $rows;
}


function Login($data)
{
    $conn = koneksi();

    $username = htmlspecialchars($data['username']);
    $password = htmlspecialchars($data['password']);
    
    if ($user_siswa = query("SELECT * FROM user_siswa WHERE Username = '$username' and Password = '$password'")) {
        session_start();
        $_SESSION['$login_siswa'] = $user_siswa;
        $_SESSION['Nama'] = $user_siswa['Nama'];
        $_SESSION['Nis'] = $user_siswa['Nis'];
        $_SESSION['Username'] = $user_siswa['Username'];
        error_reporting(0);
        $nama = $user_siswa['Nama'];
        $last = "UPDATE user_siswa SET last_login = CURRENT_TIMESTAMP(), status = 1 WHERE Nama = '$nama'";
        mysqli_query($conn, $last);

        header("Location: homepage.php");
        exit;
           
    } else if ($user_guru = query("SELECT * FROM user_guru WHERE Username = '$username' and Password = '$password'")) {
        session_start();
        $_SESSION['$login_guru'] = $user_guru;
        $_SESSION['Nama'] = $user_guru['Nama'];
        $_SESSION['Nip'] = $user_guru['Nip'];

        header("Location: homepage_guru.php");
        exit;
    }else if ($user_admin = query("SELECT * FROM user_admin WHERE Username = '$username' and Password = '$password'")) {
        session_start();
        $_SESSION['$login_admin'] = $user_admin;
        $_SESSION['Nama'] = $user_admin['Nama'];
        $_SESSION['Nip'] = $user_admin['Nip'];
        $_SESSION['Username'] = $user_admin['Username'];
        header("Location: homepage_admin.php");
        exit;
    }
    return [
        'error' => true,
        'pesan' => 'Username/Password Salah'
    ];
}
function upload()
{
    $nama_file = $_FILES['Sampul']['name'];
    $tipe_file = $_FILES['Sampul']['type'];
    $ukuran_file = $_FILES['Sampul']['size'];
    $error = $_FILES['Sampul']['error'];
    $tmp_file = $_FILES['Sampul']['tmp_name'];

    if ($error == 4) {
        return 'none.png';
    }

    $daftar_gambar = ['jpg', 'jpeg', 'png'];
    $ekstensi_file = explode('.', $nama_file);
    $ekstensi_file = strtolower(end($ekstensi_file));

    if ($ukuran_file > 5000000) {
        echo "<script>
            alert('ukuran terlalu besar!');
          </script>";
        return false;
    }

    $nama_file_baru = uniqid();
    $nama_file_baru .= '.';
    $nama_file_baru .= $ekstensi_file;
    move_uploaded_file($tmp_file, 'img/' . $nama_file_baru);

    return $nama_file_baru;
}

function upload1()
{
    $nama_file = $_FILES['Sampul']['name'];
    $tipe_file = $_FILES['Sampul']['type'];
    $ukuran_file = $_FILES['Sampul']['size'];
    $error = $_FILES['Sampul']['error'];
    $tmp_file = $_FILES['Sampul']['tmp_name'];

    if ($error == 4) {
        return 'profil.png';
    }

    $daftar_gambar = ['jpg', 'jpeg', 'png'];
    $ekstensi_file = explode('.', $nama_file);
    $ekstensi_file = strtolower(end($ekstensi_file));

    if ($ukuran_file > 5000000) {
        echo "<script>
            alert('ukuran terlalu besar!');
          </script>";
        return false;
    }

    $nama_file_baru = uniqid();
    $nama_file_baru .= '.';
    $nama_file_baru .= $ekstensi_file;
    move_uploaded_file($tmp_file, 'img/' . $nama_file_baru);

    return $nama_file_baru;
}



function Tambah($data){
    $conn = koneksi();

    $Kelas = htmlspecialchars($data['Kelas']);
    $Tipe = htmlspecialchars($data['Tipe']);
    $Nama_Kelas = htmlspecialchars($data['Nama_Kelas']);
    $Hari = htmlspecialchars($data['Hari']);
    $Waktu = htmlspecialchars($data['Waktu']);
    $Semester = htmlspecialchars($data['Semester']);
    $Deskripsi = htmlspecialchars($data['Deskripsi']);
    $Kajian = htmlspecialchars($data['Kajian']);
    $Capaian = htmlspecialchars($data['Capaian']);
    $Bahan_Ajar = htmlspecialchars($data['Bahan_Ajar']);
    $Nama_Guru = $_SESSION["Nama"];
    $Nip = $_SESSION["Nip"];
    $id_kelas = rand(10, 10000);
    $id_mapel = rand(10, 10000);
    //upload gambar
   $Sampul = upload();
   if(!$Sampul){
       return false;
   }

   $query = "INSERT INTO tambah_kelas VALUES ('$id_kelas','$Kelas','$Nama_Kelas', '$Hari', '$Waktu', '$Semester','$Deskripsi','$Kajian', '$Capaian','$Bahan_Ajar', '$Sampul', CURRENT_TIMESTAMP , '$Nama_Guru');";
   mysqli_query($conn, $query);

   $mapel = "INSERT INTO matapelajaran VALUES ('$id_mapel','$Nama_Kelas', '$Nama_Guru', '$Hari', '$Waktu', '$Semester','$Sampul','$Kelas', '$Deskripsi','$id_kelas')";
    mysqli_query($conn, $mapel);
   
   $guru = "INSERT INTO guru_terdaftar VALUES (null, '$Nama_Guru', '$Nip', '$id_mapel')";
    mysqli_query($conn, $guru);

    $smstr = "INSERT INTO Semester VALUES (null, '$Semester', '$id_mapel')";
    mysqli_query($conn, $smstr);
   echo mysqli_error($conn);
   return mysqli_affected_rows($conn);

   header('Location: pencarian.php');

}

function TambahTugas($data){
    $conn = koneksi();

    $id = $_GET["Id"];
    $judul = htmlspecialchars($data['judul_tugas']);
    $dl = htmlspecialchars($data['dl_tugas']);
    $jam = htmlspecialchars($data['jam_dl']);
    $skor = htmlspecialchars($data['skor']);
    $Deskripsi = htmlspecialchars($data['deskripsi_tugas']);
    $direktori = "dokumen/";
    $lampiran = $_FILES['NamaFile']['name'];
    move_uploaded_file($_FILES['NamaFile']['tmp_name'], $direktori . $lampiran);
    $query = "INSERT INTO tugas VALUES ('','$judul', '$dl', '$jam', '$skor','$Deskripsi', '$lampiran', '$id');";
    mysqli_query($conn, $query);

    header("Location:tugas_guru.php?Id=$id");
    
}

function EditTugas($data){
    $conn = koneksi();

    $id = $_GET["Id"];
    $judul = htmlspecialchars($data['judul_tugas']);
    $dl = htmlspecialchars($data['dl_tugas']);
    $jam = htmlspecialchars($data['jam_dl']);
    $skor = htmlspecialchars($data['skor']);
    $Deskripsi = htmlspecialchars($data['deskripsi_tugas']);
    $direktori = "dokumen/";
    $lampiran = $_FILES['NamaFile']['name'];
    move_uploaded_file($_FILES['NamaFile']['tmp_name'], $direktori . $lampiran);
    $query = "UPDATE tugas SET 
                judul_tugas = '$judul', 
                dl_tugas = '$dl',
                jam_dl = '$jam',
                skor = '$skor',
                deskripsi_tugas = '$Deskripsi',
                lampiran ='$lampiran'
            WHERE Id_Tugas = '$id'";

    $tugas = query("SELECT * FROM tugas WHERE Id_Tugas = $id ");
    $idm = $tugas["Id_Mapel"];
    mysqli_query($conn, $query) or die(mysqli_error($conn));
    return mysqli_affected_rows($conn);
    header("Location:tugas_guru.php?Id=$idm");   
}

function HapusTugas($Id_Mapel)
{
    $conn = koneksi();

    $Id_Mapel = $_GET['id'];
    $tugas = query("SELECT * FROM tugas WHERE Id_Tugas = $Id_Mapel");

    unlink('dokumen/' .$tugas['Lampiran']);

    mysqli_query($conn, "DELETE FROM tugas WHERE Id_Tugas = $Id_Mapel") or die(mysqli_error($conn));
    return mysqli_affected_rows($conn);
}

function KumpulTugas(){
    $conn = koneksi();

    $Id = $_GET["id"];
    $nama = $_SESSION['Nama'];
    $nis = $_SESSION['Nis'];
    $now = date('Y-m-d H:i:s');
    $direktori = "dokumen/";
    $lampiran = $_FILES['file']['name'];
    move_uploaded_file($_FILES['file']['tmp_name'], $direktori . $lampiran);
    
    $skor = "INSERT INTO poin VALUES ('','$nama', '$nis', 50)";
    mysqli_query($conn, $skor);

    $point = "UPDATE leaderboard SET total = (SELECT SUM(skor) FROM poin WHERE nama = '$nama')";
    mysqli_query($conn, $point);

    $query = "INSERT INTO kumpul_tugas VALUES ('','$nama', '$nis', CURRENT_TIMESTAMP , '$lampiran', '$Id')";
    mysqli_query($conn, $query);
    return mysqli_affected_rows($conn);

}

function TambahForum($data)
{
    $conn = koneksi();

    $id = $_GET["Id"];
    $judul = htmlspecialchars($data['forum']);
    
    $query = "INSERT INTO forum VALUES ('','$id', '$judul');";
    mysqli_query($conn, $query);

    header("Location:forum_guru.php?Id=$id");
}

function EditForum($data)
{
    $conn = koneksi();

    $id = $_GET["Id"];
    $judul = htmlspecialchars($data['forum']);

    $query = "UPDATE forum SET 
                Nama_Forum = '$judul'
            WHERE Id_Forum = '$id'";
    mysqli_query($conn, $query);

    $forum = query("SELECT * FROM forum WHERE Id_Forum = $id ");
    $idm = $forum["Id_Mapel"];
    header("Location:forum_guru.php?Id=$idm");
}

function HapusForum($Id)
{
    $conn = koneksi();

    $Id = $_GET['id'];

    mysqli_query($conn, "DELETE FROM forum WHERE Id_Forum = $Id") or die(mysqli_error($conn));
    return mysqli_affected_rows($conn);
}

function HapusForumT($Id)
{
    $conn = koneksi();

    $Id = $_GET['Id'];

    mysqli_query($conn, "DELETE FROM forum_thread WHERE Id_ForumThr = $Id") or die(mysqli_error($conn));
    return mysqli_affected_rows($conn);
}

function HapusForumR($Id)
{
    $conn = koneksi();

    $Id = $_GET['Id'];

    mysqli_query($conn, "DELETE FROM forum_reply WHERE Id_Reply = $Id") or die(mysqli_error($conn));
    return mysqli_affected_rows($conn);
}

function TambahForumC($id)
{
    $conn = koneksi();

    $id = $_GET["Id"];
    $judul = $_POST['forum'];
    $desk = $_POST['editor'];
    $now = date('Y-m-d H:i:s');
    $nama = $_SESSION['Nama'];
    
    $query = "INSERT INTO forum_cat VALUES ('','$id', '$judul', '$desk', CURRENT_TIMESTAMP,'$nama');";
    mysqli_query($conn, $query);

    header("Location:forumcategories_guru.php?Id=$id");
}
function TambahForumC1($id)
{
    $conn = koneksi();

    $id = $_GET["Id"];
    $judul = $_POST['forum'];
    $desk = $_POST['editor'];
    $now = date('Y-m-d H:i:s');
    $nama = $_SESSION['Nama'];

    $query = "INSERT INTO forum_cat VALUES ('','$id', '$judul', '$desk', CURRENT_TIMESTAMP, '$nama');";
    mysqli_query($conn, $query);

    header("Location:forumcategories.php?Id=$id");
}

function UbahForumC($id)
{
    $conn = koneksi();

    $id = $_GET["Id"];
    $judul = $_POST['forum'];
    $desk = $_POST['editor'];

    $query = "UPDATE forum_cat SET 
                Judul = '$judul', 
                Deskripsi = '$desk'
            WHERE Id_ForumCat = '$id'";
    mysqli_query($conn, $query);

    $forum = query("SELECT * FROM forum_cat WHERE Id_ForumCat = $id ");
    $idm = $forum["Id_Forum"];
    header("Location:forumcategories_guru.php?Id=$idm");
}

function UbahForumC1($id)
{
    $conn = koneksi();

    $id = $_GET["Id"];
    $judul = $_POST['forum'];
    $desk = $_POST['editor'];

    $query = "UPDATE forum_cat SET 
                Judul = '$judul', 
                Deskripsi = '$desk'
            WHERE Id_ForumCat = '$id'";
    mysqli_query($conn, $query);

    $forum = query("SELECT * FROM forum_cat WHERE Id_ForumCat = $id ");
    $idm = $forum["Id_Forum"];
    header("Location:forumcategories.php?Id=$idm");
}


function HapusForumC($Id_categories)
{
    $conn = koneksi();

    $Id_categories = $_GET['Id'];

    mysqli_query($conn, "DELETE FROM forum_cat WHERE Id_ForumCat = $Id_categories") or die(mysqli_error($conn));
    return mysqli_affected_rows($conn);
}


function TambahForumT($id)
{
    $conn = koneksi();

    $id = $_GET["Id"];
    $judul = $_POST['forum'];
    $desk = $_POST['editor'];
    $now = date('Y-m-d H:i:s');
    $nama = $_SESSION['Nama'];

    $query = "INSERT INTO forum_thread VALUES ('','$id', '$judul', CURRENT_TIMESTAMP, '$desk', '$nama');";
    mysqli_query($conn, $query);

    header("Location:forumthread_guru.php?Id=$id");
}

function UbahForumT($id)
{
    $conn = koneksi();

    $Id = $_GET["Id"];
    $judul = $_POST['forum'];
    $desk = $_POST['editor'];

    $query = "UPDATE forum_thread SET 
                Judul = '$judul', 
                Deskripsi = '$desk'
            WHERE Id_ForumThr = '$Id'";
    mysqli_query($conn, $query);

    $forum = query("SELECT * FROM forum_thread WHERE Id_ForumThr = $Id ");
    $idm = $forum["Id_ForumCat"];
    header("Location:forumthread_guru.php?Id=$idm");
}

function UbahForumR($id)
{
    $conn = koneksi();

    $id = $_GET["Id"];
    $judul = $_POST['forum'];
    $desk = $_POST['editor'];

    $query = "UPDATE forum_reply SET 
                JudulReply = '$judul', 
                DeskripsiReply = '$desk'
            WHERE Id_Reply = '$id'";
    mysqli_query($conn, $query);

    $forum = query("SELECT * FROM forum_reply WHERE Id_Reply = $id ");
    $idm = $forum["Id_ForumThr"];
    $f = query("SELECT * FROM forum_thread WHERE Id_ForumThr = $idm ");
    $fr = $f["Id_ForumCat"];
    header("Location:forumthread_guru.php?Id=$fr");
}


function UbahForumR1($id)
{
    $conn = koneksi();

    $id = $_GET["Id"];
    $judul = $_POST['forum'];
    $desk = $_POST['editor'];

    $query = "UPDATE forum_reply SET 
                JudulReply = '$judul', 
                DeskripsiReply = '$desk'
            WHERE Id_Reply = '$id'";
    mysqli_query($conn, $query);

    $forum = query("SELECT * FROM forum_reply WHERE Id_Reply = $id ");
    $idm = $forum["Id_ForumThr"];
    $f = query("SELECT * FROM forum_thread WHERE Id_ForumThr = $idm ");
    $fr = $f["Id_ForumCat"];
    header("Location:forumthread.php?Id=$fr");
}

function TambahForumT1($id)
{
    $conn = koneksi();

    $id = $_GET["Id"];
    $judul = $_POST['forum'];
    $desk = $_POST['editor'];
    $now = date('Y-m-d H:i:s');
    $nama = $_SESSION['Nama'];

    $query = "INSERT INTO forum_thread VALUES ('','$id', '$judul', CURRENT_TIMESTAMP, '$desk','$nama');";
    mysqli_query($conn, $query);

    header("Location:forumthread.php?Id=$id");
}

function UbahForumT1($id)
{
    $conn = koneksi();

    $id = $_GET["Id"];
    $judul = $_POST['forum'];
    $desk = $_POST['editor'];

    $query = "UPDATE forum_thread SET 
                Judul = '$judul', 
                Deskripsi = '$desk'
            WHERE Id_ForumThr = '$id'";
    mysqli_query($conn, $query);

    $forum = query("SELECT * FROM forum_thread WHERE Id_ForumThr = $id ");
    $idm = $forum["Id_ForumCat"];
    header("Location:forumthread.php?Id=$idm");
}

function getRepliesByCommentId($id)
{
    $conn = koneksi();
    $result = mysqli_query($conn, "SELECT * FROM forum_reply WHERE Id_ForumThr=$id");
    $replies = mysqli_fetch_all($result, MYSQLI_ASSOC);
    return $replies;
}

function TambahReply($id)
{
    $conn = koneksi();

    $id = $_GET["Id"];
    $judul = $_POST['forum'];
    $desk = $_POST['editor'];
    $now = date('Y-m-d H:i:s');
    $nama = $_SESSION['Nama'];

    $forum = query("SELECT * FROM forum_thread WHERE Id_ForumThr = $id ");
    $idm = $forum["Id_ForumCat"];

    $query = "INSERT INTO forum_reply VALUES ('','$id', '$idm', '$nama','$judul', '$desk', CURRENT_TIMESTAMP);";
    mysqli_query($conn, $query);

    header("Location:forumthread_guru.php?Id=$idm");
}

function TambahReply1($id)
{
    $conn = koneksi();

    $id = $_GET["Id"];
    $judul = $_POST['forum'];
    $desk = $_POST['editor'];
    $now = date('Y-m-d H:i:s');
    $nama = $_SESSION['Nama'];

    $forum = query("SELECT * FROM forum_thread WHERE Id_ForumThr = $id ");
    $idm = $forum["Id_ForumCat"];
    $idf = $forum["Id_ForumThr"];

    $query = "INSERT INTO forum_reply VALUES ('','$idf', '$idm', '$nama','$judul', '$desk', CURRENT_TIMESTAMP);";
    mysqli_query($conn, $query);

    header("Location:forumthread.php?Id=$idm");
}

function TambahReply2($id)
{
    $conn = koneksi();

    $id = $_GET["Id"];
    $judul = $_POST['forum'];
    $desk = $_POST['editor'];
    $now = date('Y-m-d H:i:s');
    $nama = $_SESSION['Nama'];

    $forum = query("SELECT * FROM forum_reply WHERE Id_Reply = $id ");
    $idm = $forum["Id_ForumCat"];
    $idf = $forum["Id_ForumThr"];

    $query = "INSERT INTO forum_reply VALUES ('','$idf', '$idm', '$nama','$judul', '$desk', CURRENT_TIMESTAMP);";
    mysqli_query($conn, $query);

    header("Location:forumthread.php?Id=$idm");
}

function TambahReply3($id)
{
    $conn = koneksi();

    $id = $_GET["Id"];
    $judul = $_POST['forum'];
    $desk = $_POST['editor'];
    $now = date('Y-m-d H:i:s');
    $nama = $_SESSION['Nama'];

    $forum = query("SELECT * FROM forum_reply WHERE Id_Reply = $id ");
    $idm = $forum["Id_ForumCat"];
    $idf = $forum["Id_ForumThr"];

    $query = "INSERT INTO forum_reply VALUES ('','$idf', '$idm', '$nama','$judul', '$desk', CURRENT_TIMESTAMP);";
    mysqli_query($conn, $query);

    header("Location:forumthread_guru.php?Id=$idm");
}

function timeAgo($time_ago)
{
    $time_ago = strtotime($time_ago);
    $cur_time   = time();
    $time_elapsed   = $cur_time - $time_ago;
    $seconds    = $time_elapsed ;
    $minutes    = round($time_elapsed / 60 );
    $hours      = round($time_elapsed / 3600);
    $days       = round($time_elapsed / 86400 );
    $weeks      = round($time_elapsed / 604800);
    $months     = round($time_elapsed / 2600640 );
    $years      = round($time_elapsed / 31207680 );
    // Seconds
    if($seconds <= 60){
        return "just now";
    }
    //Minutes
    else if($minutes <=60){
        if($minutes==1){
            return "one minute ago";
        }
        else{
            return "$minutes minutes ago";
        }
    }
    //Hours
    else if($hours <=24){
        if($hours==1){
            return "an hour ago";
        }else{
            return "$hours hrs ago";
        }
    }
    //Days
    else if($days <= 7){
        if($days==1){
            return "yesterday";
        }else{
            return "$days days ago";
        }
    }
    //Weeks
    else if($weeks <= 4.3){
        if($weeks==1){
            return "a week ago";
        }else{
            return "$weeks weeks ago";
        }
    }
    //Months
    else if($months <=12){
        if($months==1){
            return "a month ago";
        }else{
            return "$months months ago";
        }
    }
    //Years
    else{
        if($years==1){
            return "one year ago";
        }else{
            return "$years years ago";
        }
    }
}

function tambahtautan($id)
{
    $conn = koneksi();

    $id = $_GET["Id"];
    $judul = $_POST['judul'];
    $url= $_POST['url'];

    $query = "INSERT INTO tautan VALUES ('','$id', '$judul', '$url');";
    mysqli_query($conn, $query);

    header("Location:tautanguru.php?Id=$id");
}

function edittautan($id)
{
    $conn = koneksi();

    $id = $_GET["Id"];
    $judul = $_POST['judul'];
    $url = $_POST['url'];

    $query = "UPDATE tautan SET 
                Judul = '$judul', 
                Link = '$url'
            WHERE Id_Tautan = '$id'";
    mysqli_query($conn, $query);

    $tautan = query("SELECT * FROM tautan WHERE Id_Tautan = $id ");
    $idm = $tautan["Id_Mapel"];
    header("Location:tautanguru.php?Id=$idm");
}

function HapusTautan($Id)
{
    $conn = koneksi();

    $Id= $_GET['id'];

    mysqli_query($conn, "DELETE FROM tautan WHERE Id_tautan = $Id") or die(mysqli_error($conn));
    return mysqli_affected_rows($conn);
}

function TambahAlur($data)
{
    $conn = koneksi();

    $id = $_GET["Id"];
    $judul = htmlspecialchars($data['Judul']);
    $query = "INSERT INTO alur VALUES ('','$id', '$judul');";
    mysqli_query($conn, $query);

    header("Location:alur_guru.php?Id=$id");
}

function TambahMateri($data){
    $conn = koneksi();

    $id = $_GET["Id"];
    $judul = htmlspecialchars($data['judul']);
    $desk = htmlspecialchars($data['deskripsi']);
    $direktori = "dokumen/";
    $lampiran = $_FILES['file']['name'];
    move_uploaded_file($_FILES['file']['tmp_name'], $direktori . $lampiran);
    $query = "INSERT INTO materi_alur VALUES ('','$id', '$judul', '$desk', '$lampiran');";
    mysqli_query($conn, $query);

    header("Location:detailpertemuan_guru.php?Id=$id");
}

function TambahPengumuman($data)
{
    $conn = koneksi();

    $id = $_GET["Id"];
    $judul = htmlspecialchars($data['judul']);
    $desk = htmlspecialchars($data['deskripsi']);
    $query = "INSERT INTO pengumuman VALUES ('','$id', '$judul', '$desk', CURRENT_TIMESTAMP);";
    mysqli_query($conn, $query);

    header("Location:pengumuman_guru.php?Id=$id");
}

function EditPengumuman($data)
{
    $conn = koneksi();

    $id = $_GET["Id"];
    $judul = htmlspecialchars($data['judul']);
    $desk = htmlspecialchars($data['deskripsi']);

    $query = "UPDATE pengumuman SET 
                Judul = '$judul', 
                Deskripsi = '$desk'
            WHERE Id_Pengumuman = '$id'";
    mysqli_query($conn, $query);

    $p = query("SELECT * FROM pengumuman WHERE Id_Pengumuman = $id ");
    $idm = $p["Id_Mapel"];
    header("Location:pengumuman_guru.php?Id=$idm");
}

function HapusPengumuman($Id)
{
    $conn = koneksi();

    $Id = $_GET["Id"];
    mysqli_query($conn, "DELETE FROM pengumuman WHERE Id_Pengumuman = $Id") or die(mysqli_error($conn));
    return mysqli_affected_rows($conn);
}

function TambahDocs($data){
    $conn = koneksi();

    $id = $_GET["Id"];
    $judul = htmlspecialchars($data['judul']);
    $direktori = "dokumen/";
    $lampiran = $_FILES['NamaFile']['name'];
    move_uploaded_file($_FILES['NamaFile']['tmp_name'], $direktori . $lampiran);
    $query = "INSERT INTO docs VALUES ('', '$id','$judul', '$lampiran', CURRENT_TIMESTAMP);";
    mysqli_query($conn, $query);

    header("Location:dokumen_guru.php?Id=$id");
    
}

function EditDocs($data){
    $conn = koneksi();

    $id = $_GET["Id"];
    $judul = htmlspecialchars($data['judul']);
    $direktori = "dokumen/";
    $lampiran = $_FILES['NamaFile']['name'];
    move_uploaded_file($_FILES['NamaFile']['tmp_name'], $direktori . $lampiran);

    $query = "UPDATE docs SET 
                Materi = '$judul', 
                Judul = '$lampiran'
            WHERE Id_Docs = '$id'";
    mysqli_query($conn, $query);

    $p = query("SELECT * FROM docs WHERE Id_Docs = $id ");
    $idm = $p["Id_Mapel"];
    header("Location:dokumen_guru.php?Id=$idm");
    
}

function HapusDocs($Id_Mapel)
{
    $conn = koneksi();

    $Id = $_GET['Id'];
    $docs = query("SELECT * FROM docs WHERE Id_Docs = $Id");

    unlink('dokumen/' .$docs['Judul']);

    mysqli_query($conn, "DELETE FROM docs WHERE Id_Docs = $Id") or die(mysqli_error($conn));
    return mysqli_affected_rows($conn);
}

function TambahUjian($data){
    $conn = koneksi();

    $id = $_GET['Id'];
    $judul = htmlspecialchars($data['judul']);
    $start = htmlspecialchars($data['start']);
    $end = htmlspecialchars($data['end']);
    $durasi = htmlspecialchars($data['durasi']);
    $query = "INSERT INTO ujian VALUES ('', '$id','$judul','$start','$end','$durasi');";
    mysqli_query($conn, $query);

    header("Location:ujian_guru.php?Id=$id");
}

function TambahSoal($data){
    $conn = koneksi();

    $id = $_GET['Id'];
    $soal = $_POST['editor'];
    $opsi1 = htmlspecialchars($data['opsi1']);
    $opsi2 = htmlspecialchars($data['opsi2']);
    $opsi3 = htmlspecialchars($data['opsi3']);
    $query = "INSERT INTO soal_pg VALUES ('', '$id','$soal','$opsi1','$opsi2', '$opsi3');";
    mysqli_query($conn, $query);

    header("Location:listsoal.php?Id=$id");
}

function TambahSoalEssay($data){
    $conn = koneksi();

    $id = $_GET['Id'];
    $soal = $_POST['editor'];
    $query = "INSERT INTO soal_essay VALUES ('', '$id','$soal');";
    mysqli_query($conn, $query);

    header("Location:listsoal.php?Id=$id");
}

function nicetime($timestamp){
    $time_ago = strtotime($timestamp);  
      $current_time = time();  
      $time_difference = $current_time - $time_ago;  
      $seconds = $time_difference;  
      $minutes      = round($seconds / 60 );        // value 60 is seconds  
      $hours        = round($seconds / 3600);       //value 3600 is 60 minutes * 60 sec  
      $days         = round($seconds / 86400);      //86400 = 24 * 60 * 60;  
      $weeks        = round($seconds / 604800);     // 7*24*60*60;  
      $months       = round($seconds / 2629440);    //((365+365+365+365+366)/5/12)*24*60*60  
      $years        = round($seconds / 31553280);   //(365+365+365+365+366)/5 * 24 * 60 * 60  
      if($seconds <= 60) {  
       return "Just Now";  
      } else if($minutes <=60) {  
       if($minutes==1){  
         return "one minute ago";  
       }else {  
         return "$minutes minutes ago";  
       }  
      } else if($hours <=24) {  
       if($hours==1) {  
         return "an hour ago";  
       } else {  
         return "$hours hrs ago";  
       }  
      }else if($days <= 7) {  
       if($days==1) {  
         return "yesterday";  
       }else {  
         return "$days days ago";  
       }  
      }else if($weeks <= 4.3) {  //4.3 == 52/12
       if($weeks==1){  
         return "a week ago";  
       }else {  
         return "$weeks weeks ago";  
       }  
      } else if($months <=12){  
       if($months==1){  
         return "a month ago";  
       }else{  
         return "$months months ago";  
       }  
      }else {  
       if($years==1){  
         return "one year ago";  
       }else {  
         return "$years years ago";  
       }  
      }  
}

function EditProfil($data){
    $conn = koneksi();

    $id = $_GET["Id"];
    $username = htmlspecialchars($data['username']);
    $nama = htmlspecialchars($data['namaLengkap']);
    $tempat = htmlspecialchars($data['tempat']);
    $tanggal = $_POST['tanggal'];
    $email = $_POST['email'];
    $alamat = htmlspecialchars($data['alamat']);
    $direktori = "img/";
    $lampiran = $_FILES['file']['name'];
    move_uploaded_file($_FILES['file']['tmp_name'], $direktori . $lampiran);

    $query = "UPDATE user_siswa SET 
                Nama = '$nama',
                Username = '$username',
                Tempat = '$tempat',
                Tanggal = '$tanggal',
                Alamat = '$alamat',
                Profil = '$lampiran',
                Email = '$email'
            WHERE Id = '$id'";
    mysqli_query($conn, $query);
    
    header("Location:profil.php");
}

function EditProfil1($data)
{
    $conn = koneksi();

    $id = $_GET["Id"];
    $username = htmlspecialchars($data['username']);
    $nama = htmlspecialchars($data['namaLengkap']);
    $tempat = htmlspecialchars($data['tempat']);
    $tanggal = $_POST['tanggal'];
    $email = $_POST['email'];
    $alamat = htmlspecialchars($data['alamat']);
    $direktori = "img/";
    $lampiran = $_FILES['file']['name'];
    move_uploaded_file($_FILES['file']['tmp_name'], $direktori . $lampiran);

    $query = "UPDATE user_guru SET 
                Nama = '$nama',
                Username = '$username',
                Tempat = '$tempat',
                Tanggal = '$tanggal',
                Alamat = '$alamat',
                Profil = '$lampiran',
                Email = '$email'
            WHERE Id = '$id'";
    mysqli_query($conn, $query);

    header("Location:profil_guru.php");
}

function EditProfil2($data)
{
    $conn = koneksi();

    $id = $_GET["Id"];
    $username = htmlspecialchars($data['username']);
    $nama = htmlspecialchars($data['namaLengkap']);
    $tempat = htmlspecialchars($data['tempat']);
    $tanggal = $_POST['tanggal'];
    $email = $_POST['email'];
    $alamat = htmlspecialchars($data['alamat']);
    $profil = upload1();
    if (!$profil) {
        return false;
    }

    $query = "UPDATE user_admin SET 
                Nama = '$nama',
                Username = '$username',
                Tempat = '$tempat',
                Tanggal = '$tanggal',
                Alamat = '$alamat',
                Profil = '$profil',
                Email = '$email'
            WHERE Id = '$id'";
    mysqli_query($conn, $query);

    header("Location:profil_admin.php?Id=$id");
}

function TambahSiswa($data){
    $conn = koneksi();

    $username = htmlspecialchars($data['username']);
    $password = htmlspecialchars($data['password']);
    $kelas = $_POST['kelas'];
    $nama = htmlspecialchars($data['nama']);
    $nis = htmlspecialchars($data['nis']);
    $tempat = htmlspecialchars($data['tempat']);
    $tanggal = $_POST['tanggal'];
    $email = $_POST['email'];
    $alamat = htmlspecialchars($data['alamat']);
    $profil = upload1();
    if(!$profil){
       return false;
    }

    $data = "INSERT INTO user_siswa VALUES ('','$nama', '$nis', '$kelas','$tempat', '$tanggal',
               '$email','$alamat', '$username', '$password','$profil', CURRENT_TIMESTAMP(), 0)";
    mysqli_query($conn, $data);

    header("Location:tabelsiswa.php");
}

function EditSiswa($data){
    $conn = koneksi();
    $Id = $_GET["Id"];
    $username = htmlspecialchars($data['username']);
    $password = htmlspecialchars($data['password']);
    $kelas = $_POST['kelas'];
    $nama = htmlspecialchars($data['nama']);
    $nis = htmlspecialchars($data['nis']);
    $tempat = htmlspecialchars($data['tempat']);
    $tanggal = $_POST['tanggal'];
    $email = $_POST['email'];
    $alamat = htmlspecialchars($data['alamat']);
    $profil = upload1();
    if(!$profil){
       return false;
    }

    $data = "UPDATE user_siswa SET 
                Nama = '$nama',
                Nis = '$nis',
                Kelas = '$kelas',
                Tempat = '$tempat',
                Tanggal = '$tanggal',
                Email = '$email',
                Alamat = '$alamat',
                Username = '$username',
                Password = '$password',
                Profil = '$profil'
            WHERE Id = '$Id'";

    mysqli_query($conn, $data);
    header("Location:tabelsiswa.php");
}

function TambahGuru($data)
{
    $conn = koneksi();

    $username = htmlspecialchars($data['username']);
    $password = htmlspecialchars($data['password']);
    $posisi = $_POST['posisi'];
    $nama = htmlspecialchars($data['nama']);
    $nip = htmlspecialchars($data['nip']);
    $tempat = htmlspecialchars($data['tempat']);
    $tanggal = $_POST['tanggal'];
    $email = $_POST['email'];
    $alamat = htmlspecialchars($data['alamat']);
    $profil = upload1();
    if (!$profil) {
        return false;
    }

    $data = "INSERT INTO user_guru VALUES ('','$nama', '$nip','$tempat', '$tanggal',
               '$email','$alamat','$posisi', '$username',  '$password','$profil', CURRENT_TIMESTAMP(), 0)";
    mysqli_query($conn, $data);
    header("Location:tabelguru.php");
}

function EditGuru($data)
{
    $conn = koneksi();
    $Id = $_GET["Id"];
    $username = htmlspecialchars($data['username']);
    $password = htmlspecialchars($data['password']);
    $posisi = $_POST['posisi'];
    $nama = htmlspecialchars($data['nama']);
    $nip = htmlspecialchars($data['nip']);
    $tempat = htmlspecialchars($data['tempat']);
    $tanggal = $_POST['tanggal'];
    $email = $_POST['email'];
    $alamat = htmlspecialchars($data['alamat']);
    $profil = upload1();
    if (!$profil) {
        return false;
    }

    $data = "UPDATE user_guru SET 
                Nama = '$nama',
                Nip = '$nip',
                Posisi = '$posisi',
                Tempat = '$tempat',
                Tanggal = '$tanggal',
                Email = '$email',
                Alamat = '$alamat',
                Username = '$username',
                Password = '$password',
                Profil = '$profil'
            WHERE Id = '$Id'";

    mysqli_query($conn, $data);
    header("Location:tabelguru.php");
}

function TambahAdmin($data)
{
    $conn = koneksi();

    $username = htmlspecialchars($data['username']);
    $password = htmlspecialchars($data['password']);
    $posisi = $_POST['posisi'];
    $nama = htmlspecialchars($data['nama']);
    $nip = htmlspecialchars($data['nip']);
    $tempat = htmlspecialchars($data['tempat']);
    $tanggal = $_POST['tanggal'];
    $email = $_POST['email'];
    $alamat = htmlspecialchars($data['alamat']);
    $profil = upload1();
    if (!$profil) {
        return false;
    }

    $data = "INSERT INTO user_admin VALUES ('','$nama', '$nip','$tempat', '$tanggal',
               '$email','$alamat','$posisi', '$username',  '$password','$profil')";
    mysqli_query($conn, $data);
    header("Location:tabeladmin.php");
}

function EditAdmin($data)
{
    $conn = koneksi();
    $Id = $_GET["Id"];
    $username = htmlspecialchars($data['username']);
    $password = htmlspecialchars($data['password']);
    $posisi = $_POST['posisi'];
    $nama = htmlspecialchars($data['nama']);
    $nip = htmlspecialchars($data['nip']);
    $tempat = htmlspecialchars($data['tempat']);
    $tanggal = $_POST['tanggal'];
    $email = $_POST['email'];
    $alamat = htmlspecialchars($data['alamat']);
    $profil = upload1();
    if (!$profil) {
        return false;
    }

    $data = "UPDATE user_admin SET 
                Nama = '$nama',
                Nip = '$nip',
                Posisi = '$posisi',
                Tempat = '$tempat',
                Tanggal = '$tanggal',
                Email = '$email',
                Alamat = '$alamat',
                Username = '$username',
                Password = '$password',
                Profil = '$profil'
            WHERE Id = '$Id'";

    mysqli_query($conn, $data);
    header("Location:tabeladmin.php");
}

function Jawaban($query){

    $conn = koneksi();

    
    $id = $_GET['Id'];

    $u = query("SELECT * FROM soal_pg INNER JOIN soal_essay ON 
                soal_pg.id_ujian = soal_essay.id_ujian WHERE soal_pg.id_ujian = $id");

    $nama = $_SESSION["Nama"];
    foreach ($_REQUEST['answer'] as $key => $jawab){
        $jawab = $jawab['correct'];
        $query = "INSERT INTO jawaban_ujian VALUES ('', '$id','$nama','$key','$jawab',0)";
        mysqli_query($conn, $query);
    }

    header("Location:finishujian.php?Id=$id");
}

function EditPassword($data){
    $conn = koneksi();
    $Id = $_GET["Id"];
    $pass = htmlspecialchars($data['old-password']);
    $password1 = mysqli_real_escape_string($conn, $data['new-password']);
    $password2 = mysqli_real_escape_string($conn, $data['confirm-new-password']);

    //jika ada field yang kosong
    if(empty($pass) || empty($password1) || empty($password2)){
        echo "<script> 
                alert ('Password tidak boleh kosong');
                document.location.href = 'registrasi.php';
            </script>";
        return false;
    }

    //jika password sudah ada
    $pas = query("SELECT * FROM user_siswa WHERE Id = '$Id'");
    $pas1 = $pas['Password'];
    if($pass !== $pas1){
        echo "<script> 
                alert ('Password Lama Tidak Sesuai');
                document.location.href = 'password.php?Id=$Id';
            </script>";
        return false;
    }

    //jika konfirmasi tidak sesuai
    if($password1 !== $password2){
        echo "<script> 
                alert ('Konfirmasi Password tidak sesuai');
                document.location.href = 'password.php?Id=$Id';
            </script>";
        return false;
    }

    //jika password kurang dari 6 digit
    if(strlen($password1) < 6){
        echo "<script> 
                alert ('Password Harus Minimal 8 Karakter');
                document.location.href = 'password.php?Id=$Id';
            </script>";
        return false;
    }

    //jika kondisi sudah sesuai
    $password_baru = password_hash($password1, PASSWORD_DEFAULT);

    $query = "UPDATE user_siswa SET Password = $password_baru WHERE Id = '$Id'";

    mysqli_query($conn, $query) or die (mysqli_error($conn));
    return mysqli_affected_rows($conn);

}
function EditPassword2($data)
{
    $conn = koneksi();
    $Id = $_GET["Id"];
    $pass = htmlspecialchars($data['old-password']);
    $password1 = htmlspecialchars($data['new-password']);
    $password2 = htmlspecialchars($data['confirm-new-password']);

    //jika ada field yang kosong
    if (empty($pass) || empty($password1) || empty($password2)) {
        echo "<script> 
                alert ('Password tidak boleh kosong');
                document.location.href = 'password_admin?Id=$Id.php';
            </script>";
        return false;
    }

    //jika password sudah ada
    $pas = querys("SELECT Password FROM user_admin WHERE Id = '$Id'");
    if ($pass !== $pas) {
        echo "<script> 
                alert ('Password Lama Tidak Sesuai');
                document.location.href = 'password_admin.php?Id=$Id';
            </script>";
        return false;
    }

    //jika konfirmasi tidak sesuai
    if ($password1 !== $password2) {
        echo "<script> 
                alert ('Konfirmasi Password tidak sesuai');
                document.location.href = 'password_admin.php?Id=$Id';
            </script>";
        return false;
    }

    //jika password kurang dari 6 digit
    if (strlen($password1) < 6) {
        echo "<script> 
                alert ('Password Harus Minimal 8 Karakter');
                document.location.href = 'password_admin.php?Id=$Id';
            </script>";
        return false;
    }

    //jika kondisi sudah sesuai
    $password_baru = $password1;

    $query = "UPDATE user_admin SET Password = $password_baru WHERE Id = '$Id'";

    mysqli_query($conn, $query) or die(mysqli_error($conn));
    return mysqli_affected_rows($conn);
}

function EditPassword1($Id)
{
    $conn = koneksi();
    $Id = $_GET["Id"];
    $pass = md5($_POST['old-password']);
    $pass1 = md5($_POST['new-password']);
    $pass2 = md5($_POST['confirm-new-password']);

    //jika ada field yang kosong
    if (empty($pass) || empty($pass1) || empty($pass2)) {
        echo "<script> 
                alert ('Password tidak boleh kosong');
                document.location.href = 'registrasi.php';
            </script>";
        return false;
    }
    
    
    //jika konfirmasi tidak sesuai
    if ($pass1 !== $pass2) {
        echo "<script> 
                alert ('Konfirmasi Password tidak sesuai');
                document.location.href = 'password_guru.php?Id=$Id';
            </script>";
        return false;
    }

    //jika password kurang dari 6 digit
    if (strlen($pass1) < 6) {
        echo "<script> 
                alert ('Password Harus Minimal 8 Karakter');
                document.location.href = 'password_guru.php?Id=$Id';
            </script>";
        return false;
    }


    //jika kondisi sudah sesuai
    $password_baru = password_hash($pass1, PASSWORD_DEFAULT);

    $query = "UPDATE user_guru SET Password = $password_baru WHERE Id = '$Id'";

    mysqli_query($conn, $query) or die(mysqli_error($conn));
    return mysqli_affected_rows($conn);
}

function editslide($data){
    $conn = koneksi();
    $id = $_GET['Id'];
    $judul1 = htmlspecialchars($data['judul1']);
    $deskripsi1 = htmlspecialchars($data['deskripsi1']);
    $direktori = "img_homepage/";
    $lampiran1 = $_FILES['NamaFile1']['name'];
    move_uploaded_file($_FILES['NamaFile1']['tmp_name'], $direktori . $lampiran1);
    
    $query = "UPDATE slide SET 
                judul = '$judul1',
                deskripsi = '$deskripsi1',
                image = '$lampiran1' WHERE id_slide = $id";
    mysqli_query($conn, $query);

    header('Location: homepage_admin.php');
}

function editannoun($data)
{
    $conn = koneksi();
    $id = $_GET['Id'];
    $judul1 = htmlspecialchars($data['judul1']);
    $deskripsi1 = htmlspecialchars($data['deskripsi1']);
    $direktori = "img_homepage/";
    $lampiran1 = $_FILES['NamaFile1']['name'];
    move_uploaded_file($_FILES['NamaFile1']['tmp_name'], $direktori . $lampiran1);

    $query = "UPDATE announcement SET 
                judul = '$judul1',
                deskripsi = '$deskripsi1' WHERE id_announ = $id";
    mysqli_query($conn, $query);

    $query2 = "UPDATE announcement SET deskripsi = '$deskripsi1' WHERE id_announ = $id";
    mysqli_query($conn, $query2);
    header('Location: announcement_admin.php');
}

function HapusAnnoun($Id){
    $conn = koneksi();

    $Id = $_GET['Id'];
    $docs = query("SELECT * FROM announcement WHERE id_announ = $Id");

    unlink('img_homepage/' . $docs['image']);

    mysqli_query($conn, "DELETE FROM announcement WHERE id_announ = $Id") or die(mysqli_error($conn));
    return mysqli_affected_rows($conn);
}
function cari_tugas($keyword)
{
    $conn = koneksi();
    $id = $_GET["Id"];
    $query = "SELECT * FROM tugas WHERE 
                judul_tugas LIKE '%$keyword%' AND Id_Mapel = '$id' OR
                dl_tugas LIKE '%$keyword%' AND Id_Mapel = '$id' OR
                jam_dl LIKE '%$keyword%' AND Id_Mapel = '$id' OR
                lampiran LIKE '%$keyword%' AND Id_Mapel = '$id' OR
                deskripsi_tugas LIKE '%$keyword%' AND Id_Mapel = '$id'";

    $result = mysqli_query($conn, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }

    return $rows;
}

function cari_cat($keyword)
{
    $conn = koneksi();
    $Id = $_GET['Id'];
    $query = "SELECT * FROM forum_cat WHERE 
                Judul LIKE '%$keyword%' AND Id_Forum = '$Id' OR
                Deskripsi LIKE '%$keyword%' AND Id_Forum = '$Id' OR
                Nama LIKE '%$keyword%' AND Id_Forum = '$Id'";

    $result = mysqli_query($conn, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }

    return $rows;
}

function cari_thread($keyword)
{
    $conn = koneksi();
    $Id = $_GET['Id'];
    $query = "SELECT * FROM forum_thread WHERE 
                Judul LIKE '%$keyword%' AND Id_ForumCat = '$Id' OR
                Deskripsi LIKE '%$keyword%' AND Id_ForumCat = '$Id' OR
                Nama LIKE '%$keyword%' AND Id_ForumCat = '$Id'";

    $result = mysqli_query($conn, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }

    return $rows;
}

function cari_ujian($keyword)
{
    $conn = koneksi();
    $Id = $_GET['Id'];
    $query = "SELECT * FROM ujian WHERE 
                judul_ujian LIKE '%$keyword%' AND Id_Mapel = '$Id'";

    $result = mysqli_query($conn, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }

    return $rows;
}

function cari_docs($keyword)
{
    $conn = koneksi();
    $Id = $_GET['Id'];
    $query = "SELECT * FROM docs WHERE 
                Materi LIKE '%$keyword%' AND Id_Mapel = '$Id' OR
                Judul LIKE '%$keyword%' AND Id_Mapel = '$Id'";

    $result = mysqli_query($conn, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }

    return $rows;
}
function cari_siswa($keyword)
{
    $conn = koneksi();
    $Id = $_GET['Id'];
    $query = "SELECT * FROM siswa_terdaftar WHERE 
                Nama LIKE '%$keyword%' AND Id_Kelas = '$Id' OR
                Nis LIKE '%$keyword%' AND Id_Kelas = '$Id'";

    $result = mysqli_query($conn, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }

    return $rows;
}
function cari_siswa1($keyword)
{
    $conn = koneksi();
    $query = "SELECT * FROM user_siswa WHERE 
                Nama LIKE '%$keyword%' OR
                Nis LIKE '%$keyword%' OR
                Kelas LIKE '%$keyword%' OR
                Tempat LIKE '%$keyword%' OR
                Tanggal LIKE '%$keyword%' OR
                Alamat LIKE '%$keyword%' OR
                Email LIKE '%$keyword%' OR
                Username LIKE '%$keyword%'";

    $result = mysqli_query($conn, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }

    return $rows;
}
function cari_siswa2($keyword)
{
    $conn = koneksi();
    $query = "SELECT * FROM user_siswa WHERE 
                Nama LIKE '%$keyword%'";

    $result = mysqli_query($conn, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }

    return $rows;
}


function cari_guru($keyword)
{
    $conn = koneksi();
    $query = "SELECT * FROM user_guru WHERE 
                Nama LIKE '%$keyword%' OR
                Nip LIKE '%$keyword%' OR
                Posisi LIKE '%$keyword%' OR
                Tempat LIKE '%$keyword%' OR
                Tanggal LIKE '%$keyword%' OR
                Alamat LIKE '%$keyword%' OR
                Username LIKE '%$keyword%'";

    $result = mysqli_query($conn, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }

    return $rows;
}

function cari_admin($keyword)
{
    $conn = koneksi();
    $query = "SELECT * FROM user_admin WHERE 
                Nama LIKE '%$keyword%' OR
                Nip LIKE '%$keyword%' OR
                Posisi LIKE '%$keyword%' OR
                Tempat LIKE '%$keyword%' OR
                Tanggal LIKE '%$keyword%' OR
                Alamat LIKE '%$keyword%' OR
                Username LIKE '%$keyword%'";

    $result = mysqli_query($conn, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }

    return $rows;
}

function EditMapel($data){
    $conn = koneksi();

    $Kelas = htmlspecialchars($data['Kelas']);
    $Tipe = htmlspecialchars($data['Tipe']);
    $Nama_Kelas = htmlspecialchars($data['Nama_Kelas']);
    $Hari = htmlspecialchars($data['Hari']);
    $Waktu = htmlspecialchars($data['Waktu']);
    $Semester = htmlspecialchars($data['Semester']);
    $Deskripsi = htmlspecialchars($data['Deskripsi']);
    $Kajian = htmlspecialchars($data['Kajian']);
    $Capaian = htmlspecialchars($data['Capaian']);
    $Bahan_Ajar = htmlspecialchars($data['Bahan_Ajar']);
    $id_kelas = $_GET['Id'];
    //upload gambar
    $Sampul = upload();
    if (!$Sampul) {
        return false;
    }

    $query = "UPDATE tambah_kelas SET
                Kelas = '$Kelas',
                Nama_Kelas = '$Nama_Kelas',
                Hari = '$Hari',
                Waktu = '$Waktu',
                Semester = '$Semester',
                Deskripsi = '$Deskripsi',
                Kajian = '$Kajian',
                Capaian = '$Capaian',
                Bahan_Ajar = '$Bahan_Ajar',
                Sampul = '$Sampul' WHERE Id_TambahKls = '$id_kelas'";
    mysqli_query($conn, $query);
    header('Location: kelola_mapel.php');
}

function cari_mapel($keyword)
{
    $conn = koneksi();
    $query = "SELECT * FROM tambah_kelas WHERE 
                Nama_Kelas LIKE '%$keyword%' OR
                Id_TambahKls LIKE '%$keyword%' OR
                Semester LIKE '%$keyword%' OR
                Nama_Guru LIKE '%$keyword%'";

    $result = mysqli_query($conn, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }

    return $rows;
}



function cari_pengumuman($keyword)
{
    $conn = koneksi();
    $Id = $_GET['Id'];
    $query = "SELECT * FROM pengumuman WHERE 
                Judul LIKE '%$keyword%' AND Id_Mapel = '$Id' OR
                Deskripsi LIKE '%$keyword%' AND Id_Mapel = '$Id'";

    $result = mysqli_query($conn, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }

    return $rows;
}

function cari_tautan($keyword)
{
    $conn = koneksi();
    $Id = $_GET['Id'];
    $query = "SELECT * FROM tautan WHERE 
                Judul LIKE '%$keyword%' AND Id_Mapel = '$Id'";

    $result = mysqli_query($conn, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }

    return $rows;
}

function cari_leader($keyword)
{
    $conn = koneksi();
    $query = "SELECT * FROM leaderboard WHERE 
                nama LIKE '%$keyword%' OR
                nis LIKE '%$keyword%' OR
                total LIKE '%$keyword%'";

    $result = mysqli_query($conn, $query);
    $rows = [];
    while ($row = mysqli_fetch_assoc($result)) {
        $rows[] = $row;
    }

    return $rows;
}

function nilaiujian($data){
    $conn = koneksi();
    $Id = $_GET["Id"];

    $user = query("SELECT * FROM siswa_terdaftar WHERE Id_Anggota = $Id");
    $user_nama = $user["Nama"];

    $ujian = query("SELECT * FROM jawaban_ujian WHERE nama = '$user_nama' LIMIT 1");
    $u = $ujian["id_ujian"];

    $skor = htmlspecialchars($data['skorr']);

    $nilai = "UPDATE jawaban_ujian SET skor = '$skor' WHERE nama = '$user_nama' AND id_ujian = '$u'";
    mysqli_query($conn, $nilai);
    
    $mapel = query("SELECT * FROM ujian WHERE Id_Ujian = $u");
    $idm = $mapel["Id_Mapel"];
    header("Location: detailkerjasiswa.php?Id=$idm");
}

?>

