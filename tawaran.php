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
    if ($saldo >= $tawaran) { //cek saldo kalo saldo lebih besar dari tawaran
      $sql = "SELECT * FROM tawaran WHERE id_ikan = '$id_ikan' and id_penawar = '$id_penawar'";
      $data = mysqli_query($mysqli,$sql);
      $datatw = mysqli_fetch_array($data);
      $tawaran_tertinggipn = $datatw['jumlah_tawaran'];
      if ($datatw['jumlah_tawaran']>0) { //cek pernah nawar
        if ($tawaran_tertinggipn == $twmax) { //jika tawarannya sudah tertinggi (hanya mengurangi sebanyak tambahan tawaran yang baru)
          $plustawaran = $tawaran - $tawaran_tertinggipn;
          $operation = $saldo - $plustawaran;
          $minsaldo = mysqli_query($mysqli, "UPDATE penawar SET saldo='$operation' WHERE id_penawar='$id_penawar'");
          $result = mysqli_query($mysqli, "UPDATE tawaran SET jumlah_tawaran='$tawaran' WHERE id_penawar = '$id_penawar' and id_ikan = '$id_ikan'");
        } else { //jika tawarannya tidak tertinggi
          $operation = $saldo - $tawaran;
          $minsaldo = mysqli_query($mysqli, "UPDATE penawar SET saldo='$operation' WHERE id_penawar='$id_penawar'");
          $result = mysqli_query($mysqli, "UPDATE tawaran SET jumlah_tawaran='$tawaran' WHERE id_penawar = '$id_penawar' and id_ikan = '$id_ikan'");
          $querygetidtw = mysqli_query($mysqli, "SELECT * FROM tawaran WHERE id_penawar = '$id_penawar' and id_ikan = '$id_ikan'");
          $getidtw = mysqli_fetch_array($querygetidtw);
          $idselftw = $getidtw['id_tawaran'];
          $lowquery = mysqli_query($mysqli, "SELECT * FROM tawaran WHERE id_ikan='$id_ikan' and jumlah_tawaran='$twmax'");
          while ($datalow=mysqli_fetch_array($lowquery)) {
            $idpn = $datalow['id_penawar'];
            $idtwmax = $datalow['id_tawaran'];
            $lowtawaran = $datalow['jumlah_tawaran'];
            $querylowpn = mysqli_query($mysqli, "SELECT * FROM penawar WHERE id_penawar='$idpn'");
            while ($datalowpn=mysqli_fetch_array($querylowpn)) {
              $saldolow = $datalowpn['saldo'];
              $saldoback = $saldolow + $lowtawaran;
              $plussaldo = mysqli_query($mysqli, "UPDATE penawar SET saldo='$saldoback' WHERE id_penawar='$idpn'");
              $querynotif = mysqli_query($mysqli, "SELECT * FROM notif WHERE id_tawaran='$idtwmax'");
              $datanotif = mysqli_fetch_array($querynotif);
              $idtwnot = $datanotif['id_tawaran'];
              if ($idtwnot==0) {
                $insertnotif = mysqli_query($mysqli, "INSERT INTO notif (id_penawar,id_tawaran,baca) VALUES('$idpn','$idtwmax','belum')");
              }else {
                $updatenotif = mysqli_query($mysqli, "UPDATE notif SET baca='belum' WHERE id_tawaran='$idtwmax'");
              }
              $upnotself = mysqli_query($mysqli, "UPDATE notif SET baca='sudah' WHERE id_tawaran='$idselftw'");
            }
          }
        }
        header("location:infoprodukpn.php?id_ikan=$id_ikan");
      }else { //tawaran baru/belum pernah nawar
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
          $querynotif = mysqli_query($mysqli, "SELECT * FROM notif WHERE id_tawaran='$idtwmax'");
          $datanotif = mysqli_fetch_array($querynotif);
          $idtwnot = $datanotif['id_tawaran'];
          if ($idtwnot=="") {
            $insertnotif = mysqli_query($mysqli, "INSERT INTO notif (id_penawar,id_tawaran,baca) VALUES('$idpn','$idtwmax','belum')");
          }else {
            $updatenotif = mysqli_query($mysqli, "UPDATE notif SET baca='belum' WHERE id_tawaran='$idtwmax'");
          }
        }
        header("location:infoprodukpn.php?id_ikan=$id_ikan");
      }
    }else { //saldo lebih kecil dari tawarannya
      $sql = "SELECT * FROM tawaran WHERE id_ikan = '$id_ikan' and id_penawar = '$id_penawar'";
      $data = mysqli_query($mysqli,$sql);
      $datatw = mysqli_fetch_array($data);
      $tawaran_tertinggipn = $datatw['jumlah_tawaran'];
      if ($tawaran_tertinggipn == $twmax) { //jika tawarannya tertinggi tapi saldo cukup untuk menambah tawaran
        $plustawaran = $tawaran - $tawaran_tertinggipn;
        if ($saldo >= $plustawaran) { //hanya mengurangi sebanyak tambahan tawaran yang baru
          $operation = $saldo - $plustawaran;
          $minsaldo = mysqli_query($mysqli, "UPDATE penawar SET saldo='$operation' WHERE id_penawar='$id_penawar'");
          $result = mysqli_query($mysqli, "UPDATE tawaran SET jumlah_tawaran='$tawaran' WHERE id_penawar = '$id_penawar' and id_ikan = '$id_ikan'");
          header("location:infoprodukpn.php?id_ikan=$id_ikan");
        }else { //saldo gk cukup
          header("location:infoprodukpn.php?saldo='kurang'&id_ikan=$id_ikan");
        }
      }else { //salo gk cukup
        header("location:infoprodukpn.php?saldo='kurang'&id_ikan=$id_ikan");
      }
    }
}
?>
