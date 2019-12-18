<?php
session_start();
include "config.php";
if(isset($_POST['update']))
{
    $id_pelelang = $_POST['id_pelelang'];
    $namapl = $_POST['namapl'];
    $alamatpl = $_POST['alamatpl'];
    $norekpl = $_POST['norekpl'];
    $notelppl = $_POST['notelppl'];
    $emailpl = $_POST['emailpl'];
    $passpl = $_POST['passpl'];
    $result = mysqli_query($mysqli, "UPDATE pelelang SET nama_pelelang='$namapl',alamat_pelelang='$alamatpl',rek_pelelang='$norekpl',notelp_pelelang='$notelppl',email_pelelang='$emailpl',password_pelelang='$passpl' WHERE id_pelelang=$id_pelelang");
    header("location: profilpl.php");
}
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
    <form name="update_pl" method="post" action="editprofilpl.php">
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
            <td><input type="hidden" name="id_pelelang" value=<?php echo $id_pelelang;?>></td>
            <td><input type="submit" class="btn btn-secondary" name="update" value="Update"></td>
    </form>
  </table>
  <a href="homepl.php"><input type="button" value="Home"></a>
</body>
</html>
