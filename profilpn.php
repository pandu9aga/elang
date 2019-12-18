<?php
session_start();
include "config.php";
if(isset($_POST['update']))
{
    $id_penawar = $_POST['id_penawar'];
    $namapn = $_POST['namapn'];
    $alamatpn = $_POST['alamatpn'];
    $norekpn = $_POST['norekpn'];
    $notelppn = $_POST['notelppn'];
    $emailpn = $_POST['emailpn'];
    $passpn = $_POST['passpn'];
    $result = mysqli_query($mysqli, "UPDATE penawar SET nama_penawar='$namapn',alamat_penawar='$alamatpn',rek_penawar='$norekpn',notelp_penawar='$notelppn',email_penawar='$emailpn',password_penawar='$passpn' WHERE id_penawar=$id_penawar");

    header("Location: profilpn.php");
}
$id_penawar = $_SESSION['id_penawar'];
$sql = "SELECT * FROM penawar WHERE id_penawar = '$id_penawar'";
$result = mysqli_query($mysqli, $sql);
while($datapn = mysqli_fetch_array($result))
{
    $namapn = $datapn['nama_penawar'];
    $alamatpn = $datapn['alamat_penawar'];
    $norekpn = $datapn['rek_penawar'];
    $notelppn = $datapn['notelp_penawar'];
    $emailpn = $datapn['email_penawar'];
    $passpn = $datapn['password_penawar'];
}
?>
<!DOCTYPE html>
<html>
<head>
</head>
<body>
  <h1>Profil</h1>
  <table>
    <form name="update_pn" method="post" action="profilpn.php">
            <tr>
                <td>Nama</td>
                <td><input type="text" size="100" name="namapn" value=<?php echo $namapn;?>></td>
            </tr>
            <tr>
                <td>Alamat</td>
                <td><input type="text" size="100" name="alamatpn" value=<?php echo $alamatpn;?>></td>
            </tr>
            <tr>
                <td>No. Rekening</td>
                <td><input type="text" size="100" name="norekpn" value=<?php echo $norekpn;?>></td>
            </tr>
            <tr>
                <td>No. Telpon</td>
                <td><input type="text" size="100" name="notelppn" value=<?php echo $notelppn;?>></td>
            </tr>
            <tr>
                <td>Email</td>
                <td><input type="text" size="100" name="emailpn" value=<?php echo $emailpn;?>></td>
            </tr>
            <tr>
                <td>Password</td>
                <td><input type="password" size="100" name="passpn" value=<?php echo $passpn;?>></td>
            </tr>
            <td><input type="hidden" name="id_penawar" value=<?php echo $id_penawar;?>></td>
            <td><input type="submit" class="btn btn-secondary" name="update" value="Update"></td>
    </form>
  </table>
  <a href="homepn.php"><input type="button" value="Home"></a>
</body>
</html>
