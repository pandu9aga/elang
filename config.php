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
    $status = $data['status_lelang'];
    if ($now > $waktulelang) {
      if ($status=='berlangsung') {
        $change = mysqli_query($mysqli, "UPDATE ikan SET status_lelang='selesai' WHERE id_ikan='$id_ikan'");
        $cekquery = mysqli_query($mysqli, "SELECT MAX(jumlah_tawaran) AS max FROM tawaran WHERE id_ikan = '$id_ikan'");
        $sqlcek = mysqli_fetch_array($cekquery);
        $twmax = $sqlcek['max'];
        $cekwin = mysqli_query($mysqli,"SELECT * FROM tawaran WHERE id_ikan='$id_ikan' and jumlah_tawaran='$twmax'");
        $sqlcekwin = mysqli_fetch_array($cekwin);
        $id_wintw = $sqlcekwin['id_tawaran'];
        $setwin = mysqli_query($mysqli, "INSERT INTO pemenang (id_tawaran) VALUES ('$id_wintw')");
        $querywin = mysqli_query($mysqli,"SELECT * FROM pemenang WHERE id_tawaran='$id_wintw'");
        $datawin = mysqli_fetch_array($querywin);
        $id_winner = $datawin['id_pemenang'];
        $translelang = mysqli_query($mysqli, "INSERT INTO transfer_pelelang (id_pemenang,status_transpelelang) VALUES ('$id_winner','')");
      }
    }
}
?>
