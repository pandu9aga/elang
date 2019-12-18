<?php
session_start();
include "config.php";
if(isset($_POST["submitlogpl"])) {
        $namapl   = $_POST["nama_pelelang"];
        $ipasspl   = $_POST["password_pelelang"];
}
$sql_login  = mysqli_query($mysqli, "SELECT * FROM pelelang WHERE nama_pelelang = '$namapl' AND password_pelelang = '$ipasspl'");
if(mysqli_num_rows($sql_login)>0) {
            $row = mysqli_fetch_array($sql_login);
            $_SESSION['id_pelelang'] = $row['id_pelelang'];
            header('location:homepl.php');
          }
else{
          echo "<center><br><br><br><br><br><br><b>LOGIN GAGAL! </b><br>
          Nama Pengguna atau Password Anda tidak benar.<br>";
          echo "<br>";
          echo "<input class='btn btn-blue' type=button value='ULANGI LAGI' onclick=location.href='loginpl.php'></a></center>";
          }


?>
