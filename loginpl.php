<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Login Pelelang</title>
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
                        <h2 class="form-title">Login Pelelang</h2>
                          <?php
                        	if(isset($_GET['pesan'])){
                        		if($_GET['pesan'] == "logout"){
                        			echo "Anda telah berhasil logout";
                            } else {
                              echo "Anda gagal logout";
                            }
                        	}
                          if (isset($_GET['regis'])) {
                            echo "Registrasi berhasil";
                          }
                        	?>
                        <form class="register-form" id="login-form"action="prosesloginpl.php" method="post" name="formlogpl">
                            <div class="form-group">
                                <label for="your_name"><i class="zmdi zmdi-account material-icons-name"></i></label>
                                <input type="text" name="nama_pelelang" placeholder="Nama Pengguna" required oninvalid="this.setCustomValidity('nama tidak boleh kosong')" oninput="setCustomValidity('')"/>
                            </div>
                            <div class="form-group">
                                <label for="your_pass"><i class="zmdi zmdi-lock"></i></label>
                                <input type="password" name="password_pelelang" placeholder="Password" required oninvalid="this.setCustomValidity('password tidak boleh kosong')" oninput="setCustomValidity('')"/>
                            </div>
                            <div class="form-group">
                                <input type="checkbox" name="remember-me" id="remember-me" class="agree-term" />
                                <label for="remember-me" class="label-agree-term"><span><span></span></span>Ingat saya</label>
                            </div>
                            <div class="form-group form-button">
                                <input type="submit" name="submitlogpl" value="Masuk" id="signin" class="form-submit"/>
                            </div>
                        </form>
                        <a href="forgot-passwordpl.php">lupa password</a>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="js/main.js"></script>
</body>
</html>
