<?php
session_start();
include "config.php";
$id_ikan = $_GET['id_ikan'];
if (isset($_GET['hapus'])) {
  $hapus = $_GET['hapus'];
  $hapustawaran = mysqli_query($mysqli,"DELETE FROM tawaran WHERE id_ikan = '$hapus'");
  $hapusikan = mysqli_query($mysqli,"DELETE FROM ikan WHERE id_ikan = '$hapus'");
  if ($hapusikan) {
    header("location: homepl.php?hapus='berhasil'");
  } else {
    echo "Hapus gagal. <a href='infoprodukpl.php?id_ikan=".$id_ikan."'>Kembali ke info produk</a>";
  }
}
echo "<center><br><br><br><br><br><br><b>Hapus Produk ?</b><br>";
echo "<br>";
echo "<input class='btn btn-blue' type='button' value='Kembali' onclick=location.href='infoprodukpl.php?id_ikan=".$id_ikan."'></a>";
echo "<input class='btn btn-blue' type='button' value='Hapus' onclick=location.href='hapusproduk.php?hapus=".$id_ikan."&id_ikan=".$id_ikan."'></a></center>";
?>
