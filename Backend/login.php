<?php

session_start();

if(isset($_SESSION['$login_siswa'])){
    header("Location: homepage.php");
    exit;
}else if(isset($_SESSION['$login_guru'])){
    header("Location: homepage_guru.php");
    exit;
}else if(isset($_SESSION['$login_admin'])){
    header("Location: homepage_admin.php");
    exit;
}

require 'functions.php';

if(isset($_POST['login'])){
    $login_siswa = Login($_POST);
    $login_guru = Login($_POST);
    $login_admin = Login($_POST);
}

?>

<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <link rel="stylesheet" href="style.css?<?php echo time()?>">
    <title>Login</title>
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Poppins:wght@100;300;500;700;800&display=swap" rel="stylesheet">

</head>

<body>
    <section class="main">
        <div class="navigation">
            <div class="brand">
                <img src="img/logo.png" alt="" srcset="">
            </div>
        </div>


        <div class="login-container">
            <div class="photo">
                <img src="img/homepage.png">
            </div>

            <div class="form-cont">
                <div class="inner-form">
                    <div class="social-login">
                        <center>
                            <h1>WELCOME!</h1>
                        </center>
                        <p>Login Your Account</p>
                    </div>

                    <div class="login-form">
                        <form action="" method="post">
                            <div>
                                <label>Username</label>
                                <input type="text" name="username" class="form-control" id="inputUser" aria-describedby="namelHelp" autofocus autocomplete="off" required>
                            </div>
                            <div class="login-form">
                                <label>Password</label>
                                <input name="password" type="password" class="form-control password-field" id="password-field" required>
                                <span id="hide" toggle="#password-field" class="fa fa-fw fa-eye field-icon toggle-password-icon"></span>
                            </div>
                            <?php if(isset($login_guru['error'])):?>
                                <p class="error" style="color: red;"><?= $login_guru['pesan']; ?></p>
                            <?php endif ?>
                            <button type="submit" name="login" class="button btn btn-primary">Login
                            </button>
                            <center><a href="help.html">Help and Support</a></center>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <script src="script.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-MrcW6ZMFYlzcLA8Nl+NtUVF0sA7MsXsP1UyJoMp4YLEuNSfAP+JcXn/tWtIaxVXM" crossorigin="anonymous"></script>

</body>

</html>