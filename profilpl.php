<?php
include "config.php";
$sql = "SELECT * FROM pelelang";
$result = mysqli_query($mysqli, $sql);
?>
<html>
<head>
</head>
<body>
  <h1>Profil</h1>
  <table>
    <?php
    while($datapl = mysqli_fetch_array($result)) {
    echo "<tr>
          <td>Nama</td>
          <td>:</td>
          <td>".$datapl[nama_pelelang]."</td>
          </tr>";
    echo "<tr>
          <td>Alamat</td>
          <td>:</td>
          <td>".$datapl[nama_pelelang]."</td>
          </tr>";
    echo "<tr>
          <td>Nomor Rekening</td>
          <td>:</td>
          <td>".$datapl[rek_pelelang]."</td>
          </tr>";
    echo "<tr>
          <td>Nomor Telepon</td>
          <td>:</td>
          <td>".$datapl[notelp_pelelang]."</td>
          </tr>";
    echo "<tr>
          <td>Email</td>
          <td>:</td>
          <td>".$datapl[email_pelelang]."</td>
          </tr>";
    echo "<tr>
          <td>Password</td>
          <td>:</td>
          <td>".$datapl[password_pelelang]."</td>
          </tr>";
    ?>
  </table>
</body>
</html>
