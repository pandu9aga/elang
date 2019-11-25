<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Registrasi Pelelang</title>
    <link rel="stylesheet" href="fonts/material-icon/css/material-design-iconic-font.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="main">
        <section class="signup">
            <div class="container">
                <div class="signup-content">
                    <div class="signup-form">
                        <h2 class="form-title">REGISTRASI PELELANG</h2>
                        <form class="register-form" id="register-form" action="regispl.php" method="post" name="formregpl">
                            <div class="form-group">
                                <label for="name"><i class="zmdi zmdi-account material-icons-name"></i></label>
                                <input type="text" name="namapl" placeholder="Nama Pengguna"/>
                            </div>
                            <div class="form-group">
                                <label for="email"><i class="zmdi zmdi-email"></i></label>
                                <input type="email" name="emailpl" placeholder="E-mail"/>
                            </div>
                            <div class="form-group">
                                <label for="email"><i class="zmdi zmdi-phone"></i></label>
                                <input type="number" name="notlppl" placeholder="No. Telpon"/>
                            </div>
                            <div class="form-group">
                                <label for="pass"><i class="zmdi zmdi-lock"></i></label>
                                <input type="password" name="ipasspl" placeholder="Password"/>
                            </div>
                            <div class="form-group">
                                <label for="re-pass"><i class="zmdi zmdi-lock-outline"></i></label>
                                <input type="password" name="rpasspl" placeholder="Konfirmasi Password"/>
                            </div>
                            <div class="form-group">
                                <input type="checkbox" name="agree-term" id="agree-term" class="agree-term" />
                                <label for="agree-term" class="label-agree-term"><span><span></span></span>Saya setuju dengan semua kebijakan yang ada  <a href="#" class="term-service">Terms of service</a></label>
                            </div>
                            <div class="form-group form-button">
                                <input type="submit" id="signup" class="form-submit" value="Register" name="submitregpl" value="Buat akun"/>
                            </div>
                        </form>
                        <?php
                        if(isset($_POST['submitregpl'])) {
                            $namapl = $_POST['namapl'];
                            $emailpl = $_POST['emailpl'];
                            $notlppl = $_POST['notlppl'];
                            $ipasspl = $_POST['ipasspl'];
                            include "config.php";
                            $result = mysqli_query($mysqli, "INSERT INTO pelelang (nama_pelelang,email_pelelang,notelp_pelelang,password_pelelang) VALUES('$namapl','$emailpl','$notlppl','$ipasspl')");
                            echo "Registrasi berhasil. <a href='loginpl.php'>Login</a>";
                        }
                        ?>
                    </div>
                    <div class="signup-image">
                        <figure><img src="elang.png" alt="sing up image"></figure>
                        <a href="loginpl.php" class="signup-image-link">Sudah punya akun</a>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="js/main.js"></script>
</body>
</html>
