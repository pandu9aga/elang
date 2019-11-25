<?php
include "config.php";
$namapn = $_POST['nama_penawar'];
$ipasspn = $_POST['password_penawar'];
$login = mysqli_query($mysqli, "SELECT * FROM penawar WHERE nama_penawar = '$namapn' AND password_penawar='$ipasspn'");
$row=mysqli_fetch_array($login);
if ($row['nama_penawar'] == $namapn AND $row['password_penawar'] == $ipasspn)
{
session_start();
$_SESSION['nama_penawar'] = $row['nama_penawar'];
$_SESSION['password_penawar'] = $row['password_penawar'];
header('location:homepn.php');
}
else
{
echo "<center><br><br><br><br><br><br><b>LOGIN GAGAL! </b><br>
   Nama Pengguna atau Password Anda tidak benar.<br>";
echo "<br>";
echo "<input class='btn btn-blue' type=button value='ULANGI LAGI' onclick=location.href='loginpn.php'></a></center>";

}
?>
