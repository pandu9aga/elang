<?php
  include "config.php";
  if(!isset($_GET["reset_pass"])){
    exit("Can't find page");
  }
  $code = $_GET["reset_pass"];
  $query = mysqli_query($mysqli, "SELECT email_pengguna FROM lupa_password WHERE code_lupas = '$code' ");
  if(mysqli_num_rows($query)==0){
    exit("Can't find page");
  }
  $row = mysqli_fetch_array($query);
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Reset Password</title>
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
                        <h2 class="form-title">Ganti Password</h2>
                        <form class="user" id="login-form" action="new-passpn.php" method="POST" novalidate>

                                <div class="form-group">
                                    <label for="pass"><i class="zmdi zmdi-lock"></i></label>
                                    <input type="password" name="password" id="txtPassword" placeholder="Password" required oninvalid="this.setCustomValidity('password tidak boleh kosong')" oninput="setCustomValidity('')"/>
                                </div>
                                <div class="form-group">
                                    <label for="re-pass"><i class="zmdi zmdi-lock-outline"></i></label>
                                    <input type="password" name="password_repeat" id="txtConfirmPassword" placeholder="Konfirmasi Password" required oninvalid="this.setCustomValidity('ulangi password yang benar')" oninput="setCustomValidity('')"/>
                                </div>
                                <input type="hidden" value="<?php echo $row["email_pengguna"]?>" name="email">

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
    <script type="text/javascript" src="http://ajax.googleapis.com/ajax/libs/jquery/1.8.3/jquery.min.js"></script>
    <script type="text/javascript">
        $(function () {
            $("#signin").click(function () {
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
