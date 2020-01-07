<?php
session_start();
include "config.php";
if(isset($_POST["submitlogadm"])) {
        $namaadm   = $_POST["nama_admin"];
        $ipassadm   = $_POST["password_admin"];
}
$sql_login  = mysqli_query($mysqli, "SELECT * FROM admin WHERE nama_admin = '$namaadm' AND password_admin = '$ipassadm'");
if(mysqli_num_rows($sql_login)>0) {
            $row = mysqli_fetch_array($sql_login);
            $_SESSION['id_admin'] = $row['id_admin'];
            header('location:topupadmin.php');
          }
else{
          echo "<center><br><br><br><br><br><br><b>LOGIN GAGAL! </b><br>
          Nama Pengguna atau Password Anda tidak benar.<br>";
          echo "<br>";
          echo "<input class='btn btn-blue' type=button value='ULANGI LAGI' onclick=location.href='loginadmin.php'></a></center>";
          }


?>
