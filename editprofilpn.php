<?php
session_start();
include "config.php";
if(isset($_POST['update']))
{
    $id_penawar = $_POST['id_penawar'];
    $namapn = $_POST['namapn'];
    $alamatpn = $_POST['alamatpn'];
    $norekpn = $_POST['norekpn'];
    $notelppn = $_POST['notelppn'];
    $emailpn = $_POST['emailpn'];
    $passpn = $_POST['passpn'];
    $result = mysqli_query($mysqli, "UPDATE penawar SET nama_penawar='$namapn',alamat_penawar='$alamatpn',rek_penawar='$norekpn',notelp_penawar='$notelppn',email_penawar='$emailpn',password_penawar='$passpn' WHERE id_penawar=$id_penawar");
    header("location: profilpn.php");
}
if(isset($_POST['updatepppn'])) {
    $id_penawar = $_POST['id_penawar'];
    $folder = "pppn/";
    $upload_image = $_FILES['gambarpn']['name'];
    $width_size = 480;
    $height_size = 480;
    $filesave = $folder . $upload_image;
    move_uploaded_file($_FILES['gambarpn']['tmp_name'], $filesave);
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
    $result = mysqli_query($mysqli, "UPDATE penawar SET pp_penawar='$resize_image' WHERE id_penawar=$id_penawar");
    header("location:profilpn.php");
}
$id_penawar = $_SESSION['id_penawar'];
$sql = "SELECT * FROM penawar WHERE id_penawar = '$id_penawar'";
$result = mysqli_query($mysqli, $sql);
while($datapn = mysqli_fetch_array($result))
{
    $namapn = $datapn['nama_penawar'];
    $alamatpn = $datapn['alamat_penawar'];
    $norekpn = $datapn['rek_penawar'];
    $notelppn = $datapn['notelp_penawar'];
    $emailpn = $datapn['email_penawar'];
    $passpn = $datapn['password_penawar'];
    $pppn = $datapn['pp_penawar'];
    $saldopn = $datapn['saldo'];
}
function rupiah($angka){
	$hasil_rupiah = number_format($angka,0,',','.');
	return $hasil_rupiah;
}
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title> Edit  Profil Penawar</title>
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
		<link href="themes/css/sucsessbox.css" rel="stylesheet"/>
		<link href="themes/css/animnotif.css" rel="stylesheet"/>
		<link href="bootstrap/css/font-awesome.min.css" rel="stylesheet"/>
		<link rel="stylesheet" href="font-awesome/css/font-awesome.min.css" />
		<script src="js/material.min.js"></script>
		<link href="themes/css/material-icon.css" rel="stylesheet">
		<link rel="stylesheet" href="themes/css/application.min.css">


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
  					<a href="homepn.php" class="logo pull-left"><img width="200px" height="115px" src="elanghome.png" class="site_logo" alt=""></a>
  				</div>
  				<nav id="menu" class="pull-right">
  						<ul>
                <li>
                  <a>
                    <div class="caption" >
                      <center>CASH</center>
                    </div>
  							     <span class="mdl-chip mdl-chip--contact">
                      <span class="mdl-chip__contact color--orange">RP</span>
                      <span class="mdl-chip__text"><?php echo rupiah($saldopn); ?></span>
                    </span>
  							  </a>
  							</li>
  							<li>
  							  <a>
                    <div class="material-icons mdl-badge mdl-badge--overlap" data-badge="3">notifications_none</div>
  							    <div class="caption" >notifikasi</div>
                  </a>
              					<!-- Notifications dropdown-->
              		<ul class="span3">
  									<li>
  										<a href="./products.html"><img width="27px" height="20px" src="succes.png" class="site_logo" alt="">Anda Menang Lelang Ikan Tuna 60 KG</a>
  									</li>
  									<li>
  										<a href="./products.html"><img width="25px" height="20px" src="error.png" class="site_logo" alt="">Anda Kalah Lelang Ikan Tongkol 30 KG</a>
  									</li>
  									<li>
  										<a href="./products.html"><img width="27px" height="20px" src="succes.png" class="site_logo" alt="">Anda Menang Lelang Ikan Kerapu 25 KG</a>
  									</li>
  							  </ul>
  							</li>
  							<li>
  								<a href="profilpn.php"><i class="material-icons">account_box</i>
  									<div class="caption" >PROFILE</div>
                  </a>
  							</li>
  							<li>
  								<a href="cart.php"><i class="material-icons">add_shopping_cart</i>
  									<div class="caption" >CART</div>
                  </a>
  							</li>
  							<li>
                  <a><i class="material-icons">account_balance_wallet</i>
  								  <div class="caption" >TOPUP</div>
                  </a>
  								<ul>
  									<li>
  										<a href="topup.php"><img width="27px" height="20px" src="dollar.png" class="site_logo" alt="">Topup</a>
  									</li>
  									<li>
  										<a href="carttopup.php"><img width="25px" height="20px" src="clock.png" class="site_logo" alt="">Cart Topup</a>
  									</li>
  								</ul>
  							</li>
  							<li>
  								<a href="logoutpn.php"><i class="material-icons">exit_to_app</i>
  									<div class="caption" >LOGOUT</div>
                  </a>
  							</li>
  						</ul>
  					</nav>
  			</div>
  		</div>
		<div id="wrapper" class="container">
      <section class="header_text sub">
        <h4>  Edit Profil</h4>
      </section>
			<section class="navbar main-menu">
				<div class="row">
					<div class="span9">
						<div class="row">
							<div class="span4">
								<div class="avatar"> <img src="<?php echo $pppn; ?>">
									 <form method="post" enctype="multipart/form-data" name="pppn" action="editprofilpn.php">
										<div class="btn btn-inverse">
											<h9> Upload Foto Profil</h9><br>
    										<input class="buttonprof" type="file" name="gambarpn"><br><br>
                        <input type="hidden" name="id_penawar" value="<?php echo $id_penawar; ?>">
                        <input type="submit" name="updatepppn" value="Upload">
										</div>
  									</form>
								</div>
							</div>
							<div class="span5">
                <form name="update_pn" method="post" action="editprofilpn.php">
								<address>
									<h4><strong>Nama Penawar:</strong></h4>
									<input type="text" class="span5" name="namapn" value="<?php echo $namapn; ?>">
									<h4><strong>Alamat:</strong></h4>
									<input type="text" class="span8" name="alamatpn" value="<?php echo $alamatpn; ?>">
									<h4><strong>Nomor Rekening:</strong></h4>
									<input type="text" class="span8" name="norekpn" value="<?php echo $norekpn; ?>">
                  <h4><strong>Nomor Telepon:</strong></h4>
									<input type="text" class="span8" name="notelppn" value="<?php echo $notelppn; ?>">
                  <h4><strong>Email:</strong></h4>
									<input type="text" class="span8" name="emailpn" value="<?php echo $emailpn; ?>">
                  <h4><strong>Password:</strong></h4>
									<input type="text" class="span8" name="passpn" value="<?php echo $passpn; ?>">
								</address>
                <input type="hidden" name="id_penawar" value="<?php echo $id_penawar; ?>">
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
							<li><a href="homepn.php">Homepage</a></li>
							<li><a href="./about.html">About Us</a></li>
							<li><a href="./contact.html">Contac Us</a></li>
							<li><a href="cart.php">Your Cart</a></li>
							<li><a href="logoutpn.php">Logout</a></li>
						</ul>
					</div>
					<div class="span4">
						<h4>My Account</h4>
						<ul class="nav">
							<li><a href="profilpn.php">Profil</a></li>
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
