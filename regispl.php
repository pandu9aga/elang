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
                        <?php
                        include "config.php";
                        if(isset($_POST['submitregpl'])) {
                            $namapl = $_POST['namapl'];
                            $emailpl = $_POST['emailpl'];
                            $notlppl = $_POST['notlppl'];
                            $alamatpl = $_POST['alamatpl'];
                            $norekpl = $_POST['norekpl'];
                            $ipasspl = $_POST['ipasspl'];
                            $ceknama = mysqli_query($mysqli, "SELECT * FROM pelelang WHERE nama_pelelang='$namapl'");
                            $hasilnama = mysqli_fetch_array($ceknama);
                            if ($hasilnama['id_pelelang']>0) {
                              echo "Nama Pelelang Sudah Ada";
                            }else {
                              $cekemail = mysqli_query($mysqli, "SELECT * FROM pelelang WHERE email_pelelang='$emailpl'");
                              $hasilemail = mysqli_fetch_array($cekemail);
                              if ($hasilemail['id_pelelang']>0) {
                                echo "Email Pelelang Sudah Ada";
                              }else {
                                $result = mysqli_query($mysqli, "INSERT INTO pelelang (nama_pelelang,email_pelelang,notelp_pelelang,alamat_pelelang,rek_pelelang,password_pelelang) VALUES('$namapl','$emailpl','$notlppl','$alamatpl','$norekpl','$ipasspl')");
                                header('Location:loginpl.php?regis=sukses');
                              }
                            }
                        }
                        ?>
                        <form class="register-form" id="register-form" action="regispl.php" method="post" name="formregpl">
                            <div class="form-group">
                                <label for="name"><i class="zmdi zmdi-account material-icons-name"></i></label>
                                <input type="text" name="namapl" placeholder="Nama Pengguna" required oninvalid="this.setCustomValidity('nama tidak boleh kosong')" oninput="setCustomValidity('')"/>
                            </div>
                            <div class="form-group">
                                <label for="email"><i class="zmdi zmdi-email"></i></label>
                                <input type="email" name="emailpl" placeholder="E-mail" required oninvalid="this.setCustomValidity('harus diisi dalam bentuk email')" oninput="setCustomValidity('')"/>
                            </div>
                            <div class="form-group">
                                <label for="no.telpon"><i class="zmdi zmdi-phone"></i></label>
                                <input type="number" name="notlppl" placeholder="No Telpon" required oninvalid="this.setCustomValidity('harus diisi dalam bentuk nomor')" oninput="setCustomValidity('')"/>
                            </div>
                            <div class="form-group">
                                <label for="home"><i class="zmdi zmdi-home"></i></label>
                                <input type="text" name="alamatpl" placeholder="Alamat" required oninvalid="this.setCustomValidity('alamat tidak boleh kosong')" oninput="setCustomValidity('')"/>
                            </div>
                            <div class="form-group">
                                <label for="wallet"><i class="zmdi zmdi-balance-wallet"></i></label>
                                <input type="number" name="norekpl" placeholder="No Rekening" required oninvalid="this.setCustomValidity('harus diisi dalam bentuk nomor')" oninput="setCustomValidity('')"/>
                            </div>
                            <div class="form-group">
                                <label for="pass"><i class="zmdi zmdi-lock"></i></label>
                                <input type="password" name="ipasspl" id="txtPassword" placeholder="Password" required oninvalid="this.setCustomValidity('password tidak boleh kosong')" oninput="setCustomValidity('')"/>
                            </div>
                            <div class="form-group">
                                <label for="re-pass"><i class="zmdi zmdi-lock-outline"></i></label>
                                <input type="password" name="rpasspl" id="txtConfirmPassword" placeholder="Konfirmasi Password" required oninvalid="this.setCustomValidity('ulangi password yang benar')" oninput="setCustomValidity('')"/>
                            </div>
                            <div class="form-group">
                                <input type="checkbox" name="agree-term" id="agree-term" class="agree-term" required/>
                                <label for="agree-term" class="label-agree-term"><span><span></span></span>Saya setuju dengan semua kebijakan yang ada  <a href="tos.php" class="term-service">Terms of service</a></label>
                            </div>
                            <div class="form-group form-button">
                                <input type="submit" id="signup" class="form-submit" value="Register" name="submitregpl" value="Buat akun"/>
                            </div>
                        </form>
                    </div>
                    <div class="signup-image">
                        <figure><a href="loginpl.php" class="signup-image-link"><img src="elang.png" alt="sing up image"></figure></a>
                        <a href="loginpl.php" class="signup-image-link">Sudah punya akun</a>
                    </div>
                </div>
            </div>
        </section>
    </div>
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
    <script type="text/javascript">
        $(function () {
            $("#signup").click(function () {
                var password = $("#txtPassword").val();
                var confirmPassword = $("#txtConfirmPassword").val();
                if (password != confirmPassword) {
                    alert("Password tidak sama, ulangi..");
                    return false;
                }
                return true;
            });
        });
    </script>
    <script src="vendor/jquery/jquery.min.js"></script>
    <script src="js/main.js"></script>
</body>
</html>
