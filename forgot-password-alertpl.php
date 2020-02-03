<?php
  include "config.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Link Ganti Password</title>
    <link rel="stylesheet" href="fonts/material-icon/css/material-design-iconic-font.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="main">
        <section class="sign-in">
            <div class="container">
                <div class="signin-content">
                    <div class="signin-image">
                        <figure><a href="index.php" class="signup-image-link"><img src="elang.PNG" alt="sing up image"></figure></a>
                        <a href="regispl.php" class="signup-image-link">Buat akun</a>
                    </div>
                    <div class="signin-form">
                        <h2 class="form-title">Link Telah Dikirim</h2>
                        <form class="user" id="login-form"action="send-password-emailpl.php" method="post">
                            <div class="form-group">
                              <p class="mb-4">Link untuk mereset password anda telah kami kirim ke email anda. Silahkan cek kotak masuk email anda. Klik link untuk mereset password, dan lakukan pembuatan password baru untuk akun anda.</p>
                            </div>
                            <div class="text-center">
                              <a class="small" href="loginpl.php">Sudah memiliki akun?</a>
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="js/main.js"></script>
</body>
</html>
