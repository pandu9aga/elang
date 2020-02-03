<?php
session_start();
include "config.php";
if(isset($_POST['upload'])) {
    $id_transfer = $_POST['id_transfer'];
    $folder = "buktitopup/";
    $upload_image = $_FILES['gambar']['name'];
    $jenis_gambar = $_FILES['gambar']['type'];
    $ukuran_gambar = $_FILES['gambar']['size'];
    $maks_ukuran = 10000000;
    if ($jenis_gambar=="image/jpeg" || $jenis_gambar=="image/jpg") {
      if ($ukuran_gambar <= $maks_ukuran) {
        $width_size = 480;
        $height_size = 280;
        $filesave = $folder . $upload_image;
        move_uploaded_file($_FILES['gambar']['tmp_name'], $filesave);
        if ($jenis_gambar=="image/jpeg") {
          $resize_image = $folder . "resize_" . uniqid(rand()) . ".jpeg";
        }else {
          $resize_image = $folder . "resize_" . uniqid(rand()) . ".jpg";
        }
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
        $result = mysqli_query($mysqli, "UPDATE transfer SET bukti_transfer='$resize_image' WHERE id_transfer='$id_transfer'");
        $changenot = mysqli_query($mysqli, "UPDATE notif SET baca='sudah' WHERE id_transfer='$id_transfer'");
        header("location:uploadbukti.php?id_transfer=".$id_transfer);
      }else {
        header("location:uploadbukti.php?ukuran=lebih&id_transfer=".$id_transfer);
      }
    }else {
      header("location:uploadbukti.php?tipe=salah&id_transfer=".$id_transfer);
    }
}
?>
