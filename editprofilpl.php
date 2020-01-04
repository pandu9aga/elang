<?php
session_start();
include "config.php";
if(isset($_POST['update']))
{
    $id_pelelang = $_POST['id_pelelang'];
    $namapl = $_POST['namapl'];
    $alamatpl = $_POST['alamatpl'];
    $norekpl = $_POST['norekpl'];
    $notelppl = $_POST['notelppl'];
    $emailpl = $_POST['emailpl'];
    $passpl = $_POST['passpl'];
    $cttpl = $_POST['cttpl'];
    $result = mysqli_query($mysqli, "UPDATE pelelang SET nama_pelelang='$namapl',alamat_pelelang='$alamatpl',rek_pelelang='$norekpl',notelp_pelelang='$notelppl',email_pelelang='$emailpl',password_pelelang='$passpl',catatan_pelelang='$cttpl' WHERE id_pelelang=$id_pelelang");
    header("location: profilpl.php");
}
if(isset($_POST['updatepppl'])) {
    $id_pelelang = $_POST['id_pelelang'];
    $folder = "pppl/";
    $upload_image = $_FILES['gambarpl']['name'];
    $width_size = 480;
    $height_size = 480;
    $filesave = $folder . $upload_image;
    move_uploaded_file($_FILES['gambarpl']['tmp_name'], $filesave);
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
    $result = mysqli_query($mysqli, "UPDATE pelelang SET pp_pelelang='$resize_image' WHERE id_pelelang=$id_pelelang");
    header("location:profilpl.php");
}
$id_pelelang = $_SESSION['id_pelelang'];
$sql = "SELECT * FROM pelelang WHERE id_pelelang = '$id_pelelang'";
$result = mysqli_query($mysqli, $sql);
while($datapl = mysqli_fetch_array($result))
{
    $namapl = $datapl['nama_pelelang'];
    $alamatpl = $datapl['alamat_pelelang'];
    $norekpl = $datapl['rek_pelelang'];
    $notelppl = $datapl['notelp_pelelang'];
    $emailpl = $datapl['email_pelelang'];
    $passpl = $datapl['password_pelelang'];
    $pppl = $datapl['pp_pelelang'];
    $cttpl = $datapl['catatan_pelelang'];
}
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title> Edit  Profil Pelelang</title>
		<meta name="viewport" content="width=device-width, initial-scale=1.0">
		<meta name="description" content="">
		<!--[if ie]><meta content='IE=8' http-equiv='X-UA-Compatible'/><![endif]-->
		<!-- bootstrap -->
		<link href="bootstrap/css/bootstrap.min.css" rel="stylesheet">
		<link href="bootstrap/css/bootstrap-responsive.min.css" rel="stylesheet">

		<link href="themes/css/bootstrappage.css" rel="stylesheet"/>

		<!-- global styles -->
		<link href="themes/css/flexslider.css" rel="stylesheet"/>
		<link href="themes/css/main.css" rel="stylesheet"/>

		<!-- scripts -->
		<script src="themes/js/jquery-1.7.2.min.js"></script>
		<script src="bootstrap/js/bootstrap.min.js"></script>
		<script src="themes/js/superfish.js"></script>
		<script src="themes/js/jquery.scrolltotop.js"></script>
		<!--[if lt IE 9]>
			<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
			<script src="js/respond.min.js"></script>
		<![endif]-->
	</head>
    <body>
		<div id="top-bar" class="container">
			<div class="row">
				<div class="span4">
					<a href="homepl.php" class="logo-left"><img width="115px" height="115px" src="elanghome.png" class="site_logo" alt=""></a>
				</div>
				<div class="span8">
					<div class="account pull-right">
						<ul class="user-menu">
							<li><a href="profilpl.php">Profil</a></li>
							<li><a href="uploadproduk.php">+ Produk</a></li>
							<li><a href="checkout.html">Checkout</a></li>
							<li><a href="logoutpl.php">Logout</a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
		<div id="wrapper" class="container">
			<section class="navbar main-menu">
				<div class="row">
					<div class="span9">
						<div class="row">
							<div class="span4">
								<div class="avatar"> <img src="<?php echo $pppl; ?>">
									 <form method="post" enctype="multipart/form-data" name="pppl" action="editprofilpl.php">
										<div class="btn btn-inverse">
											<h9> Upload Foto Profil</h9><br>
    										<input class="buttonprof" type="file" name="gambarpl"><br><br>
                        <input type="hidden" name="id_pelelang" value="<?php echo $id_pelelang; ?>">
                        <input type="submit" name="updatepppl" value="Upload">
										</div>
  									</form>
								</div>
							</div>
							<div class="span5">
                <form name="update_pl" method="post" action="editprofilpl.php">
								<address>
									<h4><strong>Nama Pelelang:</strong></h4>
									<input type="text" class="span5" name="namapl" value="<?php echo $namapl; ?>">
									<h4><strong>Alamat:</strong></h4>
									<input type="text" class="span8" name="alamatpl" value="<?php echo $alamatpl; ?>">
									<h4><strong>Nomor Rekening:</strong></h4>
									<input type="text" class="span8" name="norekpl" value="<?php echo $norekpl; ?>">
                  <h4><strong>Nomor Telepon:</strong></h4>
									<input type="text" class="span8" name="notelppl" value="<?php echo $notelppl; ?>">
                  <h4><strong>Email:</strong></h4>
									<input type="text" class="span8" name="emailpl" value="<?php echo $emailpl; ?>">
                  <h4><strong>Password:</strong></h4>
									<input type="text" class="span8" name="passpl" value="<?php echo $passpl; ?>">
								</address>
								<h4><strong>catatan: </strong></h4>
								<input type="text" class="span8" name="cttpl" value="<?php echo $cttpl; ?>">
                <input type="hidden" name="id_pelelang" value="<?php echo $id_pelelang; ?>">
								<button class="btn btn-inverse" type="submit" name="update">Simpan</button>
                </form>
							</div>
					</div>
				</div>
			</div>
			</section>
			<section id="footer-bar">
				<div class="row">
					<div class="span3">
						<h4>Navigation</h4>
						<ul class="nav">
							<li><a href="homepl.php">Homepage</a></li>
							<li><a href="./about.html">About Us</a></li>
							<li><a href="./contact.html">Contac Us</a></li>
							<li><a href="./cart.html">Your Cart</a></li>
							<li><a href="logoutpl.php">Logout</a></li>
						</ul>
					</div>
					<div class="span4">
						<h4>My Account</h4>
						<ul class="nav">
							<li><a href="profilpl.php">Profil</a></li>
							<li><a href="#">Order History</a></li>
							<li><a href="#">Wish List</a></li>
							<li><a href="#">Newsletter</a></li>
						</ul>
					</div>
				</div>
			</section>
			<section id="copyright">
				<span>Copyright 2019 E_LANG corporation</span>
			</section>
		</div>
		<script src="themes/js/common.js"></script>
    </body>
</html>
