<?php
session_start();
include "config.php";
$id_penawar = $_SESSION['id_penawar'];
$id_ikan = $_GET['id_ikan'];
$sql = "SELECT * FROM ikan WHERE id_ikan = '$id_ikan'";
$result = mysqli_query($mysqli, $sql);
while($dataikan = mysqli_fetch_array($result))
{
    $ukuran = $dataikan['ukuran'];
    $spesifikasi = $dataikan['spesifikasi'];
    $waktulelang = $dataikan['waktu_lelang'];
    $harga = $dataikan['harga_ikan'];
    $gambar = $dataikan['gambar_ikan'];
    $jenis = $dataikan['jenis_ikan'];
    $idpl = $dataikan['id_pelelang'];
}
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
		<link href="themes/css/main.css" rel="stylesheet"/>
		<link href="themes/css/jquery.fancybox.css" rel="stylesheet"/>

		<!-- scripts -->
		<script src="themes/js/jquery-1.7.2.min.js"></script>
		<script src="bootstrap/js/bootstrap.min.js"></script>
		<script src="themes/js/superfish.js"></script>
		<script src="themes/js/jquery.scrolltotop.js"></script>
		<script src="themes/js/jquery.fancybox.js"></script>
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
							<li><a href="#">My Account</a></li>
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
				<h4><span>Product Detail</span></h4>
			</section>
			<section class="main-content">
				<div class="row">
					<div class="span9">
						<div class="row">
							<div class="span4">
								<a href="<?php echo $gambar; ?>" class="thumbnail" data-fancybox-group="group1" title="Description 1"><img alt="" src="<?php echo $gambar; ?>"></a>
							</div>
							<div class="span5">
								<address>
									<strong>Jenis Ikan:</strong> <span><?php echo $jenis; ?></span><br>
									<strong>Waktu Pelelangan:</strong> <span><?php echo $waktulelang; ?></span><br>
                  <strong>Harga Awal:</strong> <span>Rp. <?php echo $harga; ?></span><br>
								</address>
                <?php
                $sqltw = "SELECT MAX(jumlah_tawaran) AS max FROM tawaran WHERE id_ikan = '$id_ikan'";
                $resulttw = mysqli_query($mysqli,$sqltw);
                $datatw = mysqli_fetch_array($resulttw);
                $tawaran_tertinggi = $datatw['max'];
                $sqltwpn = "SELECT MAX(jumlah_tawaran) AS maxpn FROM tawaran WHERE id_penawar = '$id_penawar' and id_ikan = '$id_ikan'";
                $resulttwpn = mysqli_query($mysqli,$sqltwpn);
                $datatwpn = mysqli_fetch_array($resulttwpn);
                $tawaran_tertinggipn = $datatwpn['maxpn'];
                ?>
								<h4><strong>Tawaran Tertinggi : Rp. <?php echo $tawaran_tertinggi; ?></strong></h4>
                <h5><strong>Tawaran Tertinggi Anda : Rp. <?php echo $tawaran_tertinggipn; ?></strong></h5>
							</div>
							<div class="span5">
								<form class="form-inline" method="post" action="tawaran.php">
									<p>&nbsp;</p>
									<label>Masukan Tawaran:Rp.</label>
									<input type="number" min="<?php echo $tawaran_tertinggi; ?>"class="span2" name="tawaran" placeholder="masukan harga">
                  <input type="hidden" name="penawar" value="<?php echo $id_penawar; ?>">
                  <input type="hidden" name="ikan" value="<?php echo $id_ikan; ?>">
									<button class="btn btn-inverse" type="submit" name="submittawaran">+</button>
								</form>
							</div>
						</div>
						<div class="row">
							<div class="span9">
								<ul class="nav nav-tabs" id="myTab">
									<li class="active"><a href="#home">Deskripsi</a></li>
									<li class=""><a href="#profile">Info Lainnya</a></li>
								</ul>
								<div class="tab-content">
									<div class="tab-pane active" id="home"><?php echo $spesifikasi; ?></div>
									<div class="tab-pane" id="profile">
										<table class="table table-striped shop_attributes">
											<tbody>
												<tr class="">
													<th>Ukuran</th>
													<td><?php echo $ukuran; ?> kg</td>
												</tr>
                        <tr class="">
                          <th>Harga Awal</th>
                          <td>Rp. <?php echo $harga; ?></td>
                        </tr>
                        <tr class="alt">
													<th>Pelelang</th>
                          <?php
                          $sqlpl = "SELECT * FROM pelelang WHERE id_pelelang = '$idpl'";
                          $resultpl = mysqli_query($mysqli, $sqlpl);
                          while($datapl = mysqli_fetch_array($resultpl))
                          {
                              $namapl = $datapl['nama_pelelang'];
                              $notelp = $datapl['notelp_pelelang'];
                              $alamat = $datapl['alamat_pelelang'];
                          }
                          ?>
													<td><?php echo $namapl; ?></td>
												</tr>
                        <tr class="alt">
                          <th>Nomor Telepon</th>
                          <td><?php echo $notelp; ?></td>
                        </tr>
                        <tr class="alt">
                          <th>Lokasi</th>
                          <td><?php echo $alamat; ?></td>
                        </tr>
											</tbody>
										</table>
									</div>
								</div>
							</div>
							<div class="span9">
								<br>
								<h4 class="title">
									<span class="pull-left"><span class="text"><strong>Produk</strong> Lainnya</span></span>
									<span class="pull-right">
										<a class="left button" href="#myCarousel-1" data-slide="prev"></a><a class="right button" href="#myCarousel-1" data-slide="next"></a>
									</span>
								</h4>

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
							<li><a href="./index.html">Homepage</a></li>
							<li><a href="./about.html">About Us</a></li>
							<li><a href="./contact.html">Contac Us</a></li>
							<li><a href="cart.php">Your Cart</a></li>
							<li><a href="logoutpn.php">Logout</a></li>
						</ul>
					</div>
					<div class="span4">
						<h4>My Account</h4>
						<ul class="nav">
							<li><a href="#">My Account</a></li>
							<li><a href="#">Order History</a></li>
						</ul>
					</div>
				</div>
			</section>
			<section id="copyright">
				<span>Copyright 2013 bootstrappage template  All right reserved.</span>
			</section>
		</div>
		<script src="themes/js/common.js"></script>
		<script>
			$(function () {
				$('#myTab a:first').tab('show');
				$('#myTab a').click(function (e) {
					e.preventDefault();
					$(this).tab('show');
				})
			})
			$(document).ready(function() {
				$('.thumbnail').fancybox({
					openEffect  : 'none',
					closeEffect : 'none'
				});

				$('#myCarousel-2').carousel({
                    interval: 2500
                });
			});
		</script>
    </body>
</html>
