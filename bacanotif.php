<?php
session_start();
include "config.php";
if(isset($_GET['id_transfer']))
{
    $id_transfer = $_GET['id_transfer'];
    $result = mysqli_query($mysqli, "UPDATE notif SET baca='sudah' WHERE id_transfer='$id_transfer'");
    header("location: uploadbukti.php?id_transfer=".$id_transfer);
}
if(isset($_GET['id_tawaran']))
{
    $id_tawaran = $_GET['id_tawaran'];
    $id_ikan = $_GET['id_ikan'];
    $result = mysqli_query($mysqli, "UPDATE notif SET baca='sudah' WHERE id_tawaran='$id_tawaran'");
    header("location: infoprodukpn.php?id_ikan=".$id_ikan);
}
?>
