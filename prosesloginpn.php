<?php
session_start();
include "config.php";
if(isset($_POST["submitlogpn"])) {
        $namapn   = $_POST["nama_penawar"];
        $ipasspn   = $_POST["password_penawar"];
}
$sql_login  = mysqli_query($mysqli, "SELECT * FROM penawar WHERE nama_penawar = '$namapn' AND password_penawar = '$ipasspn'");
if(mysqli_num_rows($sql_login)>0) {
            $row = mysqli_fetch_array($sql_login);
            $_SESSION['id_penawar'] = $row['id_penawar'];
            header('location:homepn.php');
          }
else{
          echo "<center><br><br><br><br><br><br><b>LOGIN GAGAL! </b><br>
          Nama Pengguna atau Password Anda tidak benar.<br>";
          echo "<br>";
          echo "<input class='btn btn-blue' type=button value='ULANGI LAGI' onclick=location.href='loginpn.php'></a></center>";
          }


?>
