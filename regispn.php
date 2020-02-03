<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Registrasi Penawar</title>
    <link rel="stylesheet" href="fonts/material-icon/css/material-design-iconic-font.min.css">
    <link rel="stylesheet" href="css/style.css">
</head>
<body>
    <div class="main">
        <section class="signup">
            <div class="container">
                <div class="signup-content">
                    <div class="signup-form">
                        <h2 class="form-title">REGISTRASI PENAWAR</h2>
                        <?php
                        include "config.php";
                        if(isset($_POST['submitregpn'])) {
                            $namapn = $_POST['namapn'];
                            $emailpn = $_POST['emailpn'];
                            $notlppn = $_POST['notlppn'];
                            $alamatpn = $_POST['alamatpn'];
                            $norekpn = $_POST['norekpn'];
                            $ipasspn = $_POST['ipasspn'];
                            $ceknama = mysqli_query($mysqli, "SELECT * FROM penawar WHERE nama_penawar='$namapn'");
                            $hasilnama = mysqli_fetch_array($ceknama);
                            if ($hasilnama['id_penawar']>0) {
                              echo "Nama Penawar Sudah Ada";
                            }else {
                              $cekemail = mysqli_query($mysqli, "SELECT * FROM penawar WHERE email_penawar='$emailpn'");
                              $hasilemail = mysqli_fetch_array($cekemail);
                              if ($hasilemail['id_penawar']>0) {
                                echo "Email Penawar Sudah Ada";
                              }else {
                                $result = mysqli_query($mysqli, "INSERT INTO penawar (nama_penawar,email_penawar,notelp_penawar,alamat_penawar,rek_penawar,password_penawar) VALUES('$namapn','$emailpn','$notlppn','$alamatpn','$norekpn','$ipasspn')");
                                header('Location:loginpn.php?regis=sukses');
                              }
                            }
                        }
                        ?>
                        <form class="register-form" id="register-form" action="regispn.php" method="post" name="formregpn">
                            <div class="form-group">
                                <label for="name"><i class="zmdi zmdi-account material-icons-name"></i></label>
                                <input type="text" name="namapn" placeholder="Nama Pengguna" required oninvalid="this.setCustomValidity('nama tidak boleh kosong')" oninput="setCustomValidity('')"/>
                            </div>
                            <div class="form-group">
                                <label for="email"><i class="zmdi zmdi-email"></i></label>
                                <input type="email" name="emailpn" placeholder="E-mail" required oninvalid="this.setCustomValidity('harus diisi dalam bentuk email')" oninput="setCustomValidity('')"/>
                            </div>
                            <div class="form-group">
                                <label for="phone"><i class="zmdi zmdi-phone"></i></label>
                                <input type="number" name="notlppn" placeholder="No Telpon" required oninvalid="this.setCustomValidity('harus diisi dalam bentuk nomor')" oninput="setCustomValidity('')"/>
                            </div>
                            <div class="form-group">
                                <label for="home"><i class="zmdi zmdi-home"></i></label>
                                <input type="text" name="alamatpn" placeholder="Alamat" required oninvalid="this.setCustomValidity('alamat tidak boleh kosong')" oninput="setCustomValidity('')"/>
                            </div>
                            <div class="form-group">
                                <label for="wallet"><i class="zmdi zmdi-balance-wallet"></i></label>
                                <input type="number" name="norekpn" placeholder="No Rekening" required oninvalid="this.setCustomValidity('harus diisi dalam bentuk nomor')" oninput="setCustomValidity('')"/>
                            </div>
                            <div class="form-group">
                                <label for="pass"><i class="zmdi zmdi-lock"></i></label>
                                <input type="password" name="ipasspn" id="txtPassword" placeholder="Password" required oninvalid="this.setCustomValidity('password tidak boleh kosong')" oninput="setCustomValidity('')"/>
                            </div>
                            <div class="form-group">
                                <label for="re-pass"><i class="zmdi zmdi-lock-outline"></i></label>
                                <input type="password" name="rpasspn" id="txtConfirmPassword" placeholder="Konfirmasi Password" required oninvalid="this.setCustomValidity('ulangi password yang benar')" oninput="setCustomValidity('')"/>
                            </div>
                            <div class="form-group">
                                <input type="checkbox" name="agree-term" id="agree-term" class="agree-term" required/>
                                <label for="agree-term" class="label-agree-term"><span><span></span></span>Saya setuju dengan semua kebijakan yang ada  <a href="tos.php" class="term-service">Terms of service</a></label>
                            </div>
                            <div class="form-group form-button">
                                <input type="submit" id="signup" class="form-submit" value="Register" name="submitregpn" value="Buat akun"/>
                            </div>
                        </form>
                    </div>
                    <div class="signup-image">
                        <figure><a href="loginpn.php" class="signup-image-link"><img src="elang.png" alt="sing up image"></figure></a>
                        <a href="loginpn.php" class="signup-image-link">Sudah punya akun</a>
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
