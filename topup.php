<?php
session_start();
include "config.php";
$id_penawar = $_SESSION['id_penawar'];
$sqlpn = "SELECT * FROM penawar WHERE id_penawar = '$id_penawar'";
$resultpn = mysqli_query($mysqli, $sqlpn);
while($datapn = mysqli_fetch_array($resultpn))
{
    $namapn = $datapn['nama_penawar'];
    $saldopn = $datapn['saldo'];
}
function rupiah($angka){
	$hasil_rupiah = number_format($angka,0,',','.');
	return $hasil_rupiah;
}
?>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>Bootstrap E-commerce Templates</title>
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
					<a href="homepn.php" class="logo pull-left"><img width="115px" height="115px" src="elanghome.png" class="site_logo" alt=""></a>
				</div>
				<div class="span8">
					<div class="account pull-right">
						<ul class="user-menu">
							<li><a href="profilpn.php">Profil</a></li>
							<li><a href="cart.php">Your Cart</a></li>
							<li><a href="topup.php">Topup</a></li>
							<li><a href="logoutpn.php">Logout</a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
		<div id="wrapper" class="container">
      <section class="navbar main-menu">
				<div class="navbar-inner main-menu">
					<nav id="menu" class="pull-right">
						<ul>
							<li><a href="topup.php">saldo Anda : Rp. <?php echo rupiah($saldopn); ?></a></li>
						</ul>
					</nav>
				</div>
			</section>
			<section class="header_text sub">
			<img class="pageBanner" src="themes/images/promo.png" alt="New products" >
				<h4><span>Topup Segera Saldo Anda</span></h4>
			</section>
			<section class="main-content">

				<div class="row">
					<div class="span9">
					  <div class="coteng">
						<ul class="thumbnails listing-products">
							<li class="span3">
								<div class="product-box">
									<span class="sale_tag"></span>
									<a href="checkouttopup.php?nominal=20000"><img alt="" height="200px" width="135px" src="cash.png"></a><br/>
									<br/>
									<p class="price">Rp. 20.000</p>
									<a href="checkouttopup.php?nominal=20000" class="category">Bayar 20.000</a>
								</div>
							</li>
							<li class="span3">
								<div class="product-box">
									<span class="sale_tag"></span>
									<a href="checkouttopup.php?nominal=30000"><img alt="" height="200px" width="135px" src="cash.png"></a><br/>
									<br/>
									<p class="price">Rp. 30.000</p>
									<a href="checkouttopup.php?nominal=30000" class="category">Bayar 30.000</a>
								</div>
							</li>
							<li class="span3">
								<div class="product-box">
									<span class="sale_tag"></span>
									<a href="checkouttopup.php?nominal=50000"><img alt="" height="200px" width="135px" src="cash.png"></a><br/>
									<br/>
									<p class="price">Rp. 50.000</p>
									<a href="checkouttopup.php?nominal=50000" class="category">Bayar 50.000</a>
								</div>
							</li>
							<li class="span3">
								<div class="product-box">
									<span class="sale_tag"></span>
									<a href="checkouttopup.php?nominal=100000"><img alt="" height="200px" width="135px" src="cash.png"></a><br/>
									<br/>
									<p class="price">Rp. 100.000</p>
									<a href="checkouttopup.php?nominal=100000" class="category">Bayar 100.000</a>
								</div>
							</li>
							<li class="span3">
								<div class="product-box">
									<span class="sale_tag"></span>
									<a href="checkouttopup.php?nominal=150000"><img alt="" height="200px" width="135px" src="cash.png"></a><br/>
									<br/>
									<p class="price">Rp. 150.000</p>
									<a href="checkouttopup.php?nominal=150000" class="category">Bayar 150.000</a>
								</div>
							</li>
							<li class="span3">
								<div class="product-box">
									<span class="sale_tag"></span>
									<a href="checkouttopup.php?nominal=200000"><img alt="" height="200px" width="135px" src="cash.png"></a><br/>
									<br/>
									<p class="price">Rp. 200.000</p>
									<a href="checkouttopup.php?nominal=200000" class="category">Bayar 200.000</a>
								</div>
							</li>
							<li class="span3">
								<div class="product-box">
									<span class="sale_tag"></span>
									<a href="checkouttopup.php?nominal=300000"><img alt="" height="200px" width="135px" src="cash.png"></a><br/>
									<br/>
									<p class="price">Rp. 300.000</p>
									<a href="checkouttopup.php?nominal=300000" class="category">Bayar 300.000</a>
								</div>
							</li>
							<li class="span3">
								<div class="product-box">
									<span class="sale_tag"></span>
									<a href="checkouttopup.php?nominal=500000"><img alt="" height="200px" width="135px" src="cash.png"></a><br/>
									<br/>
									<p class="price">Rp. 500.000</p>
									<a href="checkouttopup.php?nominal=500000" class="category">Bayar 500.000</a>
								</div>
							</li>
							<li class="span3">
								<div class="product-box">
									<span class="sale_tag"></span>
									<a href="checkouttopup.php?nominal=1000000"><img alt="" height="200px" width="135px" src="cash.png"></a><br/>
									<br/>
									<p class="price">Rp. 1.000.000</p>
									<a href="checkouttopup.php?nominal=1000000" class="category">Bayar 1.000.000</a>
								</div>
							</li>
						</ul>
					</div>
						<hr>
						<div class="pagination pagination-small pagination-centered">
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
						</ul>
					</div>
					<div class="span5">
						<a><img width="115px" height="115px" src="Elang.png" class="site_logo" alt=""></a>
						<p>Web penyedia pelelangan ikan pertama di indonesia</p>
						<br/>
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
