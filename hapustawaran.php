<?php
session_start();
include "config.php";
$id_penawar = $_GET['id_penawar'];
$id_ikan = $_GET['id_ikan'];
if (isset($_GET['hapus'])) {
  $hapus = $_GET['hapus'];
  $hapustawaran = mysqli_query($mysqli,"DELETE FROM tawaran WHERE id_ikan = '$hapus'");
  if ($hapustawaran) {
    header("location: infoprodukpn.php?id_ikan=".$id_ikan."&hapus='berhasil'");
  } else {
    echo "Hapus gagal. <a href='infoprodukpn.php?id_ikan=".$id_ikan."'>Kembali ke info produk</a>";
  }
}
echo "<center><br><br><br><br><br><br><b>Hapus Tawaran ?</b><br>";
echo "<br>";
echo "<input class='btn btn-blue' type='button' value='Kembali' onclick=location.href='infoprodukpn.php?id_ikan=".$id_ikan."'></a>";
echo "<input class='btn btn-blue' type='button' value='Hapus' onclick=location.href='hapustawaran.php?hapus=".$id_ikan."&id_ikan=".$id_ikan."&id_penawar=".$id_penawar."'></a></center>";
?>
