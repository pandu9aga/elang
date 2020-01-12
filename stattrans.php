<?php
session_start();
include "config.php";
$id_ikan = $_GET['id_ikan'];
if (isset($_GET['idtranspl'])) {
  $idtranspl = $_GET['idtranspl'];
  $result = mysqli_query($mysqli, "UPDATE transfer_pelelang SET status_transpelelang='konfirm' WHERE id_transfer_pelelang='$idtranspl'");
  header("location:infoprodukpl.php?id_ikan=$id_ikan");
}
?>
