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
			<script src="themes/js/respond.min.js"></script>
		<![endif]-->
	</head>
    <body>
		<div id="top-bar" class="container">
			<div class="row">
				<div class="span4">
					<a href="index.html" class="logo pull-left"><img width="115px" height="115px" src="Elang.png" class="site_logo" alt=""></a>
				</div>
				<div class="span8">

					<div class="account pull-right">
						<ul class="user-menu">
							<li><a href="#">My Account</a></li>
							<li><a href="cart.html">Your Cart</a></li>
							<li><a href="checkout.html">Checkout</a></li>
							<li><a href="register.html">Login</a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
		<div id="wrapper" class="container">
			<section class="header_text sub">
			<img class="pageBanner" src="themes/images/promo.png" alt="New products" >
				<h4><span>Bid Cart</span></h4>
			</section>
			<section class="main-content">
				<div class="row">
					<div class="span9">
						<h4 class="title"><span class="text"><strong>Daftar</strong> Tawaran</span></h4>
						<table class="table table-striped">
							<tbody>
                <?php
                $id_penawar = $_SESSION['id_penawar'];
  						  $halaman = 5;
  						  $page = isset($_GET["halaman"]) ? (int)$_GET["halaman"] : 1;
  						  $mulai = ($page>1) ? ($page * $halaman) - $halaman : 0;
  						  $result = mysqli_query($mysqli,"SELECT * FROM tawaran");
  						  $total = mysqli_num_rows($result);
  						  $pages = ceil($total/$halaman);
  						  $query = mysqli_query($mysqli,"SELECT * FROM tawaran t inner join ikan i on t.id_ikan=i.id_ikan  WHERE id_penawar =  '$id_penawar' LIMIT $mulai, $halaman")or die(mysql_error);
  						  $no =$mulai+1;
  						  while ($data = mysqli_fetch_assoc($query)) {
  						    ?>
                  <tr>
                    <th><?php echo $data['jenis_ikan']; ?></th>
  									<th>Lokasi</th>
  									<th>Ukuran</th>
  									<th>Tawaran Anda</th>
  									<th>Tawaran Tertinggi</th>
  								</tr>
                  <tr>
  									<td><a href="infoproduk.php?id_ikan=<?php echo $data['id_ikan'];?>"><img alt="" src="<?php echo $data['gambar_ikan']; ?>"></a></td>
                    <?php
                    $id_ikan = $data['id_ikan'];
                    $datapl = mysqli_query($mysqli,"SELECT * FROM ikan i inner join pelelang p on i.id_pelelang=p.id_pelelang WHERE id_ikan = '$id_ikan'");
                    $isidatapl = mysqli_fetch_assoc($datapl);
                    $alamatpl = $isidatapl['alamat_pelelang'];
                     ?>
  									<td><?php echo $alamatpl; ?></td>
  									<td><input type="text" readonly value="<?php echo $data['ukuran']; ?> kg" class="input-mini"></td>
  									<td>Rp. <?php echo $data['jumlah_tawaran']; ?></td>
                    <?php
                    $sqltw = "SELECT MAX(jumlah_tawaran) AS max FROM tawaran WHERE id_ikan = '$id_ikan'";
                    $resulttw = mysqli_query($mysqli, $sqltw);
                    $datatw = mysqli_fetch_array($resulttw);
                    $tawaran_tertinggi = $datatw['max'];
                    ?>
  									<td>Rp. <?php echo $tawaran_tertinggi; ?></td>
  								</tr>
                  <?php
                  }
                  ?>
						</table>
						<p class="buttons center">
							<button class="btn" type="button">Update</button>
							<button class="btn" type="button">Continue</button>
							<button class="btn btn-inverse" type="submit" id="checkout">Checkout</button>
						</p>
					</div>
				</div>
			</section>
			<section id="footer-bar">
				<div class="row">
					<div class="span3">
						<h4>Navigation</h4>
						<ul class="nav">
							<li><a href="./index.html">Homepage</a></li>
							<li><a href="./about.html">About Us</a></li>
							<li><a href="./contact.html">Contac Us</a></li>
							<li><a href="./cart.html">Your Cart</a></li>
							<li><a href="./register.html">Login</a></li>
						</ul>
					</div>
					<div class="span4">
						<h4>My Account</h4>
						<ul class="nav">
							<li><a href="#">My Account</a></li>
							<li><a href="#">Order History</a></li>
							<li><a href="#">Wish List</a></li>
							<li><a href="#">Newsletter</a></li>
						</ul>
					</div>
				</div>
			</section>
			<section id="copyright">
				<span>Copyright 2019 Elang Corp</span>
			</section>
		</div>
		<script src="themes/js/common.js"></script>
		<script>
			$(document).ready(function() {
				$('#checkout').click(function (e) {
					document.location.href = "checkout.html";
				})
			});
		</script>
    </body>
</html>
