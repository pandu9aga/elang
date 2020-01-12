<?php
session_start();
include "config.php";
if(isset($_POST['upload'])) {
    $idtranspl = $_POST['idtranspl'];
    $folder = "buktitrans/";
    $upload_image = $_FILES['gambar']['name'];
    $width_size = 480;
    $height_size = 280;
    $filesave = $folder . $upload_image;
    move_uploaded_file($_FILES['gambar']['tmp_name'], $filesave);
    $resize_image = $folder . "resize_" . uniqid(rand()) . ".jpg";
    list( $width, $height ) = getimagesize($filesave);
    $w = $width / $width_size;
    $h = $height / $height_size;
    $newwidth = $width / $w;
    $newheight = $height / $h;
    $thumb = imagecreatetruecolor($newwidth, $newheight);
    $source = imagecreatefromjpeg($filesave);
    imagecopyresized($thumb, $source, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
    imagejpeg($thumb, $resize_image);
    imagedestroy($thumb);
    imagedestroy($source);
    imagedestroy($filesave);
    imagedestroy($upload_image);
    $result = mysqli_query($mysqli, "UPDATE transfer_pelelang SET bukti_transpelelang='$resize_image',status_transpelelang='kirim' WHERE id_transfer_pelelang='$idtranspl'");
    header("location:uploadtransadm.php?idtranspl=".$idtranspl);
}
?>
