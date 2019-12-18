<?php
session_start();
include "config.php";
if(isset($_POST['submittawaran'])) {
    $id_ikan = $_POST['ikan'];
    $id_penawar = $_POST['penawar'];
    $tawaran = $_POST['tawaran'];
    $result = mysqli_query($mysqli, "INSERT INTO tawaran (jumlah_tawaran,id_penawar,id_ikan) VALUES('$tawaran','$id_penawar','$id_ikan')");
    header("location:infoproduk.php?id_ikan=$id_ikan");
}
?>
