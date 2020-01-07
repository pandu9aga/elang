<?php

$databaseHost = 'localhost';
$databaseName = 'db_elang';
$databaseUsername = 'root';
$databasePassword = '';

$mysqli = mysqli_connect($databaseHost, $databaseUsername, $databasePassword, $databaseName) or die('koneksi gagal');

$insertnow = mysqli_query($mysqli, "INSERT INTO now (now,id_now) VALUES (NOW(),'1')");
$updatenow = mysqli_query($mysqli, "UPDATE now SET now=NOW()");
$querynow = mysqli_query($mysqli,"SELECT * FROM now");
while($datanow = mysqli_fetch_array($querynow)){$now = $datanow['now'];}
$sql = "SELECT * FROM ikan";
$result = mysqli_query($mysqli, $sql);
while($data = mysqli_fetch_array($result))
{
    $id_ikan = $data['id_ikan'];
    $waktulelang = $data['waktu_lelang'];
    if ($now > $waktulelang) {
      $change = mysqli_query($mysqli, "UPDATE ikan SET status_lelang='selesai' WHERE id_ikan='$id_ikan'");
    }
}
?>
