<?php
session_start();
include "config.php";
$id_penawar = $_GET['id_penawar'];
$id_ikan = $_GET['id_ikan'];
$cekquery = mysqli_query($mysqli, "SELECT MAX(jumlah_tawaran) AS max FROM tawaran WHERE id_ikan = '$id_ikan'");
$sqlcek=mysqli_fetch_array($cekquery);
$twmax = $sqlcek['max'];
$cektw = mysqli_query($mysqli, "SELECT * FROM tawaran WHERE id_ikan = '$id_ikan' and id_penawar='$id_penawar'");
$sqlcektw=mysqli_fetch_array($cektw);
$twpn = $sqlcektw['jumlah_tawaran'];
if (isset($_GET['hapus'])) {
  $hapus = $_GET['hapus'];
  if ($twpn == $twmax) {
    $hapustawaran = mysqli_query($mysqli,"DELETE FROM tawaran WHERE id_ikan = '$hapus' and id_penawar='$id_penawar'");
    $cekpn = mysqli_query($mysqli, "SELECT * FROM penawar WHERE id_penawar='$id_penawar'");
    $sqlpn=mysqli_fetch_array($cekpn);
    $saldopn = $sqlpn['saldo'];
    $saldoback = $saldopn + $twpn;
    $plussaldo = mysqli_query($mysqli, "UPDATE penawar SET saldo='$saldoback' WHERE id_penawar='$id_penawar'");
    $newcekquery = mysqli_query($mysqli, "SELECT MAX(jumlah_tawaran) AS max FROM tawaran WHERE id_ikan = '$id_ikan'");
    $newsqlcek=mysqli_fetch_array($newcekquery);
    $newtwmax = $newsqlcek['max'];
    $cekpnmax = mysqli_query($mysqli, "SELECT * FROM tawaran WHERE id_ikan = '$id_ikan' and jumlah_tawaran='$newtwmax'");
    $sqlceknewtwmax=mysqli_fetch_array($cekpnmax);
    $newtwpn = $sqlceknewtwmax['jumlah_tawaran'];
    $idpn = $sqlceknewtwmax['id_penawar'];
    $cekpnmaxnew = mysqli_query($mysqli, "SELECT * FROM penawar WHERE id_penawar = '$idpn'");
    $sqlceknewpn=mysqli_fetch_array($cekpnmaxnew);
    $saldopnmax = $sqlceknewpn['saldo'];
    $saldomin = $saldopnmax - $newtwpn;
    $minsaldo = mysqli_query($mysqli, "UPDATE penawar SET saldo='$saldomin' WHERE id_penawar='$idpn'");
    if ($hapustawaran) {
      header("location: infoprodukpn.php?id_ikan=".$id_ikan."&hapus='berhasil'");
    } else {
      echo "Hapus gagal. <a href='infoprodukpn.php?id_ikan=".$id_ikan."'>Kembali ke info produk</a>";
    }
  } else {
    $hapustawaran = mysqli_query($mysqli,"DELETE FROM tawaran WHERE id_ikan = '$hapus' and id_penawar='$id_penawar'");
    if ($hapustawaran) {
      header("location: infoprodukpn.php?id_ikan=".$id_ikan."&hapus='berhasil'");
    } else {
      echo "Hapus gagal. <a href='infoprodukpn.php?id_ikan=".$id_ikan."'>Kembali ke info produk</a>";
    }
  }
}
echo "<center><br><br><br><br><br><br><b>Hapus Tawaran ?</b><br>";
echo "<br>";
echo "<input class='btn btn-blue' type='button' value='Kembali' onclick=location.href='infoprodukpn.php?id_ikan=".$id_ikan."'></a>";
echo "<input class='btn btn-blue' type='button' value='Hapus' onclick=location.href='hapustawaran.php?hapus=".$id_ikan."&id_ikan=".$id_ikan."&id_penawar=".$id_penawar."'></a></center>";
?>
