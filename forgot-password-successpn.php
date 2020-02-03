<?php
  include "config.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Ganti Password Sukses</title>
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
                        <a href="regispn.php" class="signup-image-link">Buat akun</a>
                    </div>
                    <div class="signin-form">
                        <h2 class="form-title">Password Anda Berhasil Diubah</h2>
                        <form class="user" id="login-form"action="loginpn.php" method="post">
                            <div class="form-group">
                              <p class="mb-4">Silahkan klik tombol dibawah untuk kembali ke halaman login. Harap gunakan password
                                baru anda.</p>
                            </div>
                            <div class="button">
                              <a href="loginpl.php">
                                <input type="submit" name="submitpn" value="Masuk Sekarang" class="form-submit">
                              </a>
                            </div>
                            <div class="text-center">
                              <a class="small" href="loginpn.php">Sudah memiliki akun?</a>
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
