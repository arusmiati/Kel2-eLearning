<?php

$nama = $_SESSION["Nis"];
$user = query("SELECT * FROM user_siswa WHERE Nis = '$nama'");

?>
<nav class="navbar navbar-expand-lg navbar-light fixed-top">
  <div class="navbar-header">
    <img src="img/logo.png" alt="">
  </div>
  <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNav" aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
    <span class="navbar-toggler-icon"></span>
  </button>
  <div class="collapse navbar-collapse" id="navbarNav">
    <ul class="navbar-nav ml-auto">
      <li class="name nav-item">
        <a href="homepage.php" class="btn" aria-hidden="true">Homepage</a>
      </li>
      <li class="mapel nav-item">
        <a href="matapelajaran.php" class="btn" aria-hidden="true">Mata Pelajaran</a>
      </li>
      <li class="search-mapel nav-item">
        <a href="pencarian_siswa.php" class="btn" aria-hidden="true">Pencarian Mata Pelajaran </a>
      </li>
      <li class="leader nav-item">
        <a href="leaderboards.php" class="btn active" aria-hidden="true">Leaderboards</a>
      </li>
    </ul>
    <div class="profil nav-item dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
      <img alt="your image" src="img/<?php echo $user["Profil"]; ?>" title="<?php echo  $user["Profil"];  ?>" style="border-radius: 50%;">
      <div class="dropdown-menu dropdown-menu-right">
        <center>
          <div class="name">
            <img class="bg" src="img/bg.png" alt=""><br>
            <img class="profil-img" alt="your image" src="img/<?php echo $user["Profil"]; ?>" style="border-radius: 50%;">
            <h3><?= $_SESSION['Nama']; ?></h3>
            <p><?= $_SESSION['Nis']; ?></p>
          </div>

          <button class="dropdown-item" type="button" onclick="window.location.href='profil.php'">Profil</button>
          <button class="dropdown-item" type="button" onclick="window.location.href='progress.php'">Progress</button>
          <button class="dropdown-item" type="button" onclick="window.location.href='bantuan.php'">Bantuan</button>
          <button onclick="LogConfirm()" class="log-out dropdown-item" type="button">Logout</button>
      </div>
      </center>
    </div>
  </div>
</nav>