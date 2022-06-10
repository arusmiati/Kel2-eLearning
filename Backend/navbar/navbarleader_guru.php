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
                <a href="homepage_guru.php" class="btn" aria-hidden="true">Homepage</a>
            </li>
            <li class="mapel nav-item">
                <a href="kelas.php" class="btn" aria-hidden="true">Kelasku</a>
            </li>
            <li class="search-mapel nav-item">

                <a href="pencarian.php" class="btn" aria-hidden="true">Pencarian Kelas</a>
            </li>
            <li class="leader nav-item">
                <a href="leaderboards_guru.php" class="btn active" aria-hidden="true">Leaderboards</a>
            </li>
        </ul>
        <div class="profil nav-item dropdown-toggle" type="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
            <img class="icon-profil" src="img/profil.png" alt="" srcset="">
            <div class="dropdown-menu dropdown-menu-right">
                <center>
                    <div class="name">
                        <img class="bg" src="img/bg.png" alt=""><br>
                        <img class="profil-img" src="img/profil.png" alt="">

                        <h3><?php echo $_SESSION['Nama']; ?></h3>
                        <p><?php echo $_SESSION['Nip']; ?></p>
                    </div>
                    <button class="dropdown-item" type="button" onclick="window.location.href='profil_guru.php'">Profil</button>
                    <button class="dropdown-item" type="button" onclick="window.location.href='progress_guru.php'">Progress</button>
                    <button class="dropdown-item" type="button" onclick="window.location.href='bantuan_guru.php'">Bantuan</button>
                    <button onclick="LogConfirm()" class="log-out dropdown-item" type="button">Logout</button>
            </div>
            </center>
        </div>
    </div>
</nav>