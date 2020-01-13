<?php
session_start();
include "config.php";
if(isset($_GET['id_transfer']))
{
    $id_transfer = $_GET['id_transfer'];
    $delnotif = mysqli_query($mysqli, "DELETE FROM notif WHERE id_transfer='$id_transfer'");
    $deltrans = mysqli_query($mysqli, "DELETE FROM transfer WHERE id_transfer='$id_transfer'");
    header("location: homepn.php?pesan=hapustopup");
}
?>
