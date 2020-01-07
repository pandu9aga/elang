<?php
session_start();
include "config.php";
if(isset($_GET['id_transfer']))
{
  if (isset($_GET['batal'])) {
    $id_transfer = $_GET['id_transfer'];
    $batal = $_GET['batal'];
    $result = mysqli_query($mysqli, "UPDATE transfer SET status_transfer='gagal' WHERE id_transfer='$id_transfer'");
    header("location: topupadmin.php");
  }else {
  $id_transfer = $_GET['id_transfer'];
  $result = mysqli_query($mysqli, "UPDATE transfer SET status_transfer='konfirm' WHERE id_transfer='$id_transfer'");
  $querypn = mysqli_query($mysqli, "SELECT * FROM transfer WHERE id_transfer='$id_transfer'");
  while ($datapn = mysqli_fetch_array($querypn)) {
    $id_penawar = $datapn['id_penawar'];
    $nominal = $datapn['nominal'];
  }
  $topup = mysqli_query($mysqli, "UPDATE penawar SET saldo='$nominal' WHERE id_penawar='$id_penawar'");
  header("location: topupadmin.php");
  }
  }
 ?>
