<?php
  include "config.php";
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Lupa Password</title>
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
                        <h2 class="form-title">Lupa Password</h2>
                        <form class="user" id="login-form"action="send-password-emailpn.php" method="post">
                            <div class="form-group">
                                <label for="your_name"><i class="zmdi zmdi-account material-icons-name"></i></label>
                                <input type="email" name="email_reset" class="form-control form-control-user" id="exampleInputEmail" aria-describedby="emailHelp" placeholder="Masukkan Email" required oninvalid="this.setCustomValidity('Email tidak boleh kosong')" oninput="setCustomValidity('')">
                            </div>
                            <?php
                            if (isset($_GET['email'])) {
                              echo "Email tidak terdaftar di akun manapun";
                            }
                             ?>
                            <div class="form-group form-button">
                                <input type="submit" name="reset_pass" value="Reset Password" id="signin" class="form-submit"/>
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
