
<!DOCTYPE html>
<html>
<head>
<meta charset="utf-8">
    <title>kiblatwebsite.blogspot.co.id</title>
</head>
<body>
 <h1>Upload Gambar</h1>
    <form action="" method="POST" enctype="multipart/form-data">
    <input type="file" name="gambar" required><p>
      <input type="submit" name="submit" value="UPLOAD">
    </form>


<?php
if(isset($_POST['submit'])){
$nama   = $_FILES['gambar']['name'];
$size   = $_FILES['gambar']['size'];
$asal   = $_FILES['gambar']['tmp_name'];
$format = pathinfo($nama, PATHINFO_EXTENSION);

if ($format=="jpg" OR $format=="jpeg") {
move_uploaded_file($asal, "pppl/".$nama);
$asli ="pppl/".$nama;
$gambar_asli                         = imagecreatefromjpeg ($asli);
$lebar_asli                          = imageSX($gambar_asli);
$tinggi_asli                         = imageSY($gambar_asli);
$lebar_baru = $lebar_asli/2;
$tinggi_baru = $tinggi_asli/2;

$img = imagecreatetruecolor($lebar_baru, $tinggi_baru);
imagecopyresampled($img, $gambar_asli, 0, 0, 0, 0, $lebar_baru, $tinggi_baru, $lebar_asli, $tinggi_asli);
imagejpeg($img, $asli . $nama);
imagedestroy($gambar_asli);
imagedestroy($img);
$hapus= unlink("$asli");

} else if ($format=="png") {
    move_uploaded_file($asal, "pppl/".$nama);
$asli ="pppl/".$nama;
$gambar_asli                         = imagecreatefrompng ($asli);
$lebar_asli                          = imageSX($gambar_asli);
$tinggi_asli                         = imageSY($gambar_asli);
$lebar_baru = $lebar_asli/2;
$tinggi_baru = $tinggi_asli/2;

$img = imagecreatetruecolor($lebar_baru, $tinggi_baru);
imagecopyresampled($img, $gambar_asli, 0, 0, 0, 0, $lebar_baru, $tinggi_baru, $lebar_asli, $tinggi_asli);
imagejpeg($img, $asli . $nama);
imagedestroy($gambar_asli);
imagedestroy($img);
$hapus= unlink("$asli");

}
 else if ($format=="gif") {
    move_uploaded_file($asal, "pppl/".$nama);
$asli ="pppl/".$nama;
$gambar_asli                         = imagecreatefromgif ($asli);
$lebar_asli                          = imageSX($gambar_asli);
$tinggi_asli                         = imageSY($gambar_asli);
$lebar_baru = $lebar_asli/2;
$tinggi_baru = $tinggi_asli/2;

$img = imagecreatetruecolor($lebar_baru, $tinggi_baru);
imagecopyresampled($img, $gambar_asli, 0, 0, 0, 0, $lebar_baru, $tinggi_baru, $lebar_asli, $tinggi_asli);
imagejpeg($img, $asli . $nama);
imagedestroy($gambar_asli);
imagedestroy($img);
$hapus= unlink("$asli");

      } else
             {
             echo "Upload Gagal";
             }

  }
 ?>
</body>

</html>
