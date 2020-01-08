<?php
session_start();
include "config.php";
if(isset($_POST['submittawaran'])) {
    $id_ikan = $_POST['ikan'];
    $id_penawar = $_POST['penawar'];
    $tawaran = $_POST['tawaran'];
    $cekquery = mysqli_query($mysqli, "SELECT MAX(jumlah_tawaran) AS max FROM tawaran WHERE id_ikan = '$id_ikan'");
    $sqlcek=mysqli_fetch_array($cekquery);
    $twmax = $sqlcek['max'];
    $sqlpn = "SELECT * FROM penawar WHERE id_penawar = '$id_penawar'";
    $datapn = mysqli_query($mysqli,$sqlpn);
    $querypn = mysqli_fetch_array($datapn);
    $saldo = $querypn['saldo'];
    if ($saldo >= $tawaran) {
      $sql = "SELECT * FROM tawaran WHERE id_ikan = '$id_ikan' and id_penawar = '$id_penawar'";
      $data = mysqli_query($mysqli,$sql);
      $datatw = mysqli_fetch_array($data);
      $tawaran_tertinggipn = $datatw['jumlah_tawaran'];
      if ($datatw['jumlah_tawaran']>0) {
        if ($tawaran_tertinggipn == $twmax) {
          $plustawaran = $tawaran - $tawaran_tertinggipn;
          $operation = $saldo - $plustawaran;
          $minsaldo = mysqli_query($mysqli, "UPDATE penawar SET saldo='$operation' WHERE id_penawar='$id_penawar'");
          $result = mysqli_query($mysqli, "UPDATE tawaran SET jumlah_tawaran='$tawaran' WHERE id_penawar = '$id_penawar' and id_ikan = '$id_ikan'");
        } else {
          $operation = $saldo - $tawaran;
          $minsaldo = mysqli_query($mysqli, "UPDATE penawar SET saldo='$operation' WHERE id_penawar='$id_penawar'");
          $result = mysqli_query($mysqli, "UPDATE tawaran SET jumlah_tawaran='$tawaran' WHERE id_penawar = '$id_penawar' and id_ikan = '$id_ikan'");
          $lowquery = mysqli_query($mysqli, "SELECT * FROM tawaran WHERE id_ikan='$id_ikan' and jumlah_tawaran='$twmax'");
          while ($datalow=mysqli_fetch_array($lowquery)) {
            $idpn = $datalow['id_penawar'];
            $lowtawaran = $datalow['jumlah_tawaran'];
            $querylowpn = mysqli_query($mysqli, "SELECT * FROM penawar WHERE id_penawar='$idpn'");
            while ($datalowpn=mysqli_fetch_array($querylowpn)) {
              $saldolow = $datalowpn['saldo'];
              $saldoback = $saldolow + $lowtawaran;
              $plussaldo = mysqli_query($mysqli, "UPDATE penawar SET saldo='$saldoback' WHERE id_penawar='$idpn'");
            }
          }
        }
        header("location:infoprodukpn.php?id_ikan=$id_ikan");
      }else {
        $operation = $saldo - $tawaran;
        $minsaldo = mysqli_query($mysqli, "UPDATE penawar SET saldo='$operation' WHERE id_penawar='$id_penawar'");
        $result = mysqli_query($mysqli, "INSERT INTO tawaran (jumlah_tawaran,id_penawar,id_ikan) VALUES('$tawaran','$id_penawar','$id_ikan')");
        $lowquery = mysqli_query($mysqli, "SELECT * FROM tawaran WHERE id_ikan='$id_ikan' and jumlah_tawaran='$twmax'");
        while ($datalow=mysqli_fetch_array($lowquery)) {
          $idpn = $datalow['id_penawar'];
          $lowtawaran = $datalow['jumlah_tawaran'];
          $querylowpn = mysqli_query($mysqli, "SELECT * FROM penawar WHERE id_penawar='$idpn'");
          while ($datalowpn=mysqli_fetch_array($querylowpn)) {
            $saldolow = $datalowpn['saldo'];
            $saldoback = $saldolow + $lowtawaran;
            $plussaldo = mysqli_query($mysqli, "UPDATE penawar SET saldo='$saldoback' WHERE id_penawar='$idpn'");
          }
        }
        header("location:infoprodukpn.php?id_ikan=$id_ikan");
      }
    }else {
      header("location:infoprodukpn.php?saldo='kurang'&id_ikan=$id_ikan");
    }

}
?>
