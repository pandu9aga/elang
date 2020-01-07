<?php
session_start();
include "config.php";
if(isset($_POST['upload']))
{
    $id_penawar = $_POST['id_penawar'];
    $nominal = $_POST['nominal'];
    $rek_admin = $_POST['bank'];
    $nama_rek = $_POST['nama_rek'];
    $status = $_POST['status'];
    $result = mysqli_query($mysqli, "INSERT INTO transfer (id_penawar,nominal,id_bank,nama_rek,status_transfer,waktu) VALUES ('$id_penawar','$nominal','$rek_admin','$nama_rek','$status',NOW())");
    $show = mysqli_query($mysqli,"SELECT * FROM transfer WHERE id_penawar = '$id_penawar' and waktu = NOW()");
    $data = mysqli_fetch_array($show);
    $id_transfer = $data['id_transfer'];
    header("location: uploadbukti.php?id_transfer=".$id_transfer);
}
?>
