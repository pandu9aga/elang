<?php
session_start();
include "config.php";
$id_pelelang = $_SESSION['id_pelelang'];
$sql = "SELECT * FROM pelelang WHERE id_pelelang = '$id_pelelang'";
$result = mysqli_query($mysqli, $sql);
while($datapl = mysqli_fetch_array($result))
{
    $namapl = $datapl['nama_pelelang'];
    $alamatpl = $datapl['alamat_pelelang'];
    $norekpl = $datapl['rek_pelelang'];
    $notelppl = $datapl['notelp_pelelang'];
    $emailpl = $datapl['email_pelelang'];
    $passpl = $datapl['password_pelelang'];
}
?>
<!DOCTYPE html>
<html>
<head>
</head>
<body>
  <h1>Profil</h1>
  <table>
    <form name="update_pl" method="post" action="profilpl.php">
            <tr>
                <td>Nama</td>
                <td><input type="text" size="100" name="namapl" value=<?php echo $namapl;?>></td>
            </tr>
            <tr>
                <td>Alamat</td>
                <td><input type="text" size="100" name="alamatpl" value=<?php echo $alamatpl;?>></td>
            </tr>
            <tr>
                <td>No. Rekening</td>
                <td><input type="text" size="100" name="norekpl" value=<?php echo $norekpl;?>></td>
            </tr>
            <tr>
                <td>No. Telpon</td>
                <td><input type="text" size="100" name="notelppl" value=<?php echo $notelppl;?>></td>
            </tr>
            <tr>
                <td>Email</td>
                <td><input type="text" size="100" name="emailpl" value=<?php echo $emailpl;?>></td>
            </tr>
            <tr>
                <td>Password</td>
                <td><input type="password" size="100" name="passpl" value=<?php echo $passpl;?>></td>
            </tr>
            <tr>
              <td>Foto</td>
              <td><input type="file" name="pppl"></td>
            </tr>
            <tr>
              <td>
                <a href="editprofilpl.php"><input type="button" value="Edit Profil"></a>
              </td>
            </tr>
    </form>
  </table>
  <a href="homepl.php"><input type="button" value="Home"></a>
</body>
</html>
