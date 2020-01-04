<?php
session_start();
include "config.php";
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
}
?>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>Profil Penawar</title>
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
					<a href="homepn.php" class="logo-left"><img width="115px" height="115px" src="elanghome.png" class="site_logo" alt=""></a>
				</div>
				<div class="span8">
					<div class="account pull-right">
						<ul class="user-menu">
							<li><a href="profilpn.php">Profil</a></li>
							<li><a href="cart.php">Your Cart</a></li>
							<li><a href="checkout.html">Checkout</a></li>
							<li><a href="logoutpn.php">Logout</a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
		<div id="wrapper" class="container">
				<div class="navbar-inner main-menu center">
				<h4>Profil</h4>
				</div>
			<section class="navbar main-menu">
				<div class="row">
					<div class="span9">
						<div class="row">
							<div class="span4">
								<div class="avatar"> <img src="<?php echo $pppn; ?>"></div>
							</div>
							<div class="span5">
								<address>
									<h4><strong>Nama Penawar:</strong></h4> <span><?php echo $namapn; ?></span><br>
									<h4><strong>Alamat:</strong></h4> <span><?php echo $alamatpn; ?></span><br>
									<h4><strong>Nomor Rekening:</strong></h4> <span><?php echo $norekpn; ?></span><br>
                  <h4><strong>Nomor Telepon:</strong></h4> <span><?php echo $notelppn; ?></span><br>
                  <h4><strong>Email:</strong></h4> <span><?php echo $emailpn; ?></span><br>
                  <h4><strong>Password:</h4> <span><input type="text" readonly placeholder="<?php echo $passpn; ?>"></span><br>
								</address>
                <a href="editprofilpn.php"><button class="btn btn-inverse">Edit Profil</button></a>
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
