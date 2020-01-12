<?php
session_start();
include "config.php";
$id_ikan = $_GET['id_ikan'];
if (isset($_GET['kirim'])) {
  $result = mysqli_query($mysqli, "UPDATE ikan SET status_kirim='kirim' WHERE id_ikan='$id_ikan'");
  header("location:infoprodukpl.php?id_ikan=$id_ikan");
}
if (isset($_GET['terima'])) {
  $result = mysqli_query($mysqli, "UPDATE ikan SET status_kirim='terima' WHERE id_ikan='$id_ikan'");
  header("location:infoprodukpn.php?id_ikan=$id_ikan");
}
?>
