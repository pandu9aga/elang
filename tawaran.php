<?php
session_start();
include "config.php";
if(isset($_POST['submittawaran'])) {
    $id_ikan = $_POST['ikan'];
    $id_penawar = $_POST['penawar'];
    $tawaran = $_POST['tawaran'];
    $sql = "SELECT * FROM tawaran WHERE id_ikan = '$id_ikan' and id_penawar = '$id_penawar'";
    $data = mysqli_query($mysqli,$sql);
    $datatw = mysqli_fetch_array($data);
    $tawaran_tertinggipn = $datatw['jumlah_tawaran'];
    if ($datatw['jumlah_tawaran']>0) {
    $result = mysqli_query($mysqli, "UPDATE tawaran SET jumlah_tawaran='$tawaran',id_penawar='$id_penawar' WHERE id_penawar = $id_penawar and id_ikan = $id_ikan");
    header("location:infoprodukpn.php?id_ikan=$id_ikan");
  }else {
    $result = mysqli_query($mysqli, "INSERT INTO tawaran (jumlah_tawaran,id_penawar,id_ikan) VALUES('$tawaran','$id_penawar','$id_ikan')");
    header("location:infoprodukpn.php?id_ikan=$id_ikan");
  }
}
?>
