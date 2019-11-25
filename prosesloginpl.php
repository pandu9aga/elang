<?php
include "config.php";
$namapl = $_POST['nama_pelelang'];
$ipasspl = $_POST['password_pelelang'];
$login = mysqli_query($mysqli, "SELECT * FROM pelelang WHERE nama_pelelang = '$namapl' AND password_pelelang='$ipasspl'");
$row=mysqli_fetch_array($login);
if ($row['nama_pelelang'] == $namapl AND $row['password_pelelang'] == $ipasspl)
{
session_start();
$_SESSION['nama_pelelang'] = $row['nama_pelelang'];
$_SESSION['password_pelelang'] = $row['password_pelelang'];
header('location:homepl.php');
}
else
{
echo "<center><br><br><br><br><br><br><b>LOGIN GAGAL! </b><br>
   Nama Pengguna atau Password Anda tidak benar.<br>";
echo "<br>";
echo "<input class='btn btn-blue' type=button value='ULANGI LAGI' onclick=location.href='loginpl.php'></a></center>";

}
?>
