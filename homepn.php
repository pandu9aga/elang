<?php
session_start();
include "config.php";
?>
<!DOCTYPE html>
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
					<nav id="menu" class="pull-right">
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
			<section class="header_text sub">
			<img class="pageBanner" src="themes/images/promo.png" alt="New products" >
				<h4><span>Ikan Segar Untuk Anda</span></h4>
			</section>
			<section class="main-content">

				<div class="row">
					<div class="span9">
						<ul class="thumbnails listing-products">
							<?php
						  $halaman = 6;
						  $page = isset($_GET["halaman"]) ? (int)$_GET["halaman"] : 1;
						  $mulai = ($page>1) ? ($page * $halaman) - $halaman : 0;
						  $result = mysqli_query($mysqli,"SELECT * FROM ikan");
						  $total = mysqli_num_rows($result);
						  $pages = ceil($total/$halaman);
							include "config.php";
						  $query = mysqli_query($mysqli,"SELECT * FROM ikan LIMIT $mulai, $halaman")or die(mysql_error);
						  $no =$mulai+1;
						  while ($data = mysqli_fetch_assoc($query)) {
						    ?>
								<li class="span3">
									<div class="product-box">
										<a href="infoproduk.php?id_ikan=<?php echo $data['id_ikan'];?>">
										<span class="sale_tag"></span>
										<a href="infoproduk.php?id_ikan=<?php echo $data['id_ikan'];?>"><img alt="" src="<?php echo $data['gambar_ikan']; ?>"></a><br/>
										<a href="infoproduk.php?id_ikan=<?php echo $data['id_ikan'];?>" class="title"><?php echo $data['jenis_ikan']; ?>
										</a><br/>
										<a href="infoproduk.php?id_ikan=<?php echo $data['id_ikan'];?>" class="ket"><?php echo $data['ukuran']; ?> Kg</a>
										<br/>
										<a href="infoproduk.php?id_ikan=<?php echo $data['id_ikan'];?>" class="category"><?php echo $data['waktu_lelang']; ?></a>
										<p class="price">Rp. <?php echo $data['harga_ikan']; ?></p>
										</a>
									</div>
								</li>
						    <?php
						  }
						  ?>
						</table>
						</ul>
						<hr>
						<div class="pagination pagination-medium pagination-centered">
							<ul>
								  <?php for ($i=1; $i<=$pages ; $i++){ ?>
								  <a href="?halaman=<?php echo $i;?>"><?php echo $i; ?></a>
								  <?php } ?>
							</ul>
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
				</div>
			</section>
			<section id="copyright">
				<span>Copyright 2019 E-LANG by DECODE.</span>
			</section>
		</div>
		<script src="themes/js/common.js"></script>
    </body>
</html>
