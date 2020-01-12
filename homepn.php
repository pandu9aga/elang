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
		<link href="themes/css/sucsessbox.css" rel="stylesheet"/>
		<link href="themes/css/animnotif.css" rel="stylesheet"/>
		<link href="bootstrap/css/font-awesome.min.css" rel="stylesheet"/>
		<link href="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
		<link rel="stylesheet" href="font-awesome/css/font-awesome.min.css" />
		<script src="js/material.min.js"></script>
		<link href="themes/css/material-icon.css" rel="stylesheet">
		<link rel="stylesheet" href="themes/css/application.min.css">
		

		<!-- scripts -->
		<script src="themes/js/jquery-1.7.2.min.js"></script>
		<script src="bootstrap/js/bootstrap.min.js"></script>				
		<script src="themes/js/superfish.js"></script>	
		<script src="themes/js/jquery.scrolltotop.js"></script>
		<script src="//maxcdn.bootstrapcdn.com/bootstrap/4.1.1/js/bootstrap.min.js"></script>
		<script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
		<!--[if lt IE 9]>
			<script src="http://html5shim.googlecode.com/svn/trunk/html5.js"></script>
			<script src="js/respond.min.js"></script>
		<![endif]-->
	</head>
    <body>
		<div id="top-bar" class="container">
			<div class="row">
				<div class="span4">
					<a href="index.html" class="logo pull-left"><img width="200px" height="115px" src="Elang.png" class="site_logo" alt=""></a>
				</div>
				<nav id="menu" class="pull-right">
						<ul><li><a><div class="caption" ><center>CASH</center></div>
							<span class="mdl-chip mdl-chip--contact">
                                   <span class="mdl-chip__contact color--orange">RP</span>
                                   <span class="mdl-chip__text">512.000.000</span>
                               </span>
							</a>
							</li>
							<li>
							<a><div class="material-icons mdl-badge mdl-badge--overlap "
                 				data-badge="3">
                				notifications_none
           				 	   </div>
							<div class="caption" >notifikasi</div></a>
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
								<a href="./products.html"><i class="material-icons">account_box</i>
									<div class="caption" >PROFILE</div></a>
							</li>															
							<li>
								<a href="./products.html"><i class="material-icons">add_shopping_cart</i>
									<div class="caption" >CART</div></a>
							</li>		
							<li><a><i class="material-icons">account_balance_wallet</i>
								<div class="caption" >TOPUP</div></a>
								<ul>
									<li>
										<a href="./products.html"><img width="27px" height="20px" src="dollar.png" class="site_logo" alt="">Topup</a>
									</li>
									<li>
										<a href="./products.html"><img width="25px" height="20px" src="clock.png" class="site_logo" alt="">Cart Topup</a>
									</li>
								</ul>
							</li>							
							<li>
								<a href="./products.html"><i class="material-icons">exit_to_app</i>
									<div class="caption" >LOGOUT</div></a>
							</li>
							
						</ul>
					</nav>
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
				<h4><span>Ikan Segar Untuk Anda</span></h4>
			</section>
			<section class="main-content">
				<div class="row">
					<div class="span9">
						<ul class="thumbnails listing-products">
							<?php
						  $halaman = 9;
						  $page = isset($_GET["halaman"]) ? (int)$_GET["halaman"] : 1;
						  $mulai = ($page>1) ? ($page * $halaman) - $halaman : 0;
						  $result = mysqli_query($mysqli,"SELECT * FROM ikan");
						  $total = mysqli_num_rows($result);
						  $pages = ceil($total/$halaman);
						  $query = mysqli_query($mysqli,"SELECT * FROM ikan WHERE status_lelang = 'berlangsung' LIMIT $mulai, $halaman")or die(mysql_error);
						  $no =$mulai+1;
							if (isset($_GET['jenis'])) {
								$getjenis = $_GET['jenis'];
                $query = mysqli_query($mysqli,"SELECT * FROM ikan WHERE jenis_ikan = '$getjenis' and status_lelang = 'berlangsung' LIMIT $mulai, $halaman")or die(mysql_error);
  						  $no =$mulai+1;
  						  while ($data = mysqli_fetch_assoc($query)) {
  						    ?>
  								<li class="span3">
  									<div class="product-box">
  										<a href="infoproduk.php?id_ikan=<?php echo $data['id_ikan'];?>">
  										<span class="sale_tag"></span>
  										<a href="infoprodukpn.php?id_ikan=<?php echo $data['id_ikan'];?>"><img alt="" src="<?php echo $data['gambar_ikan']; ?>"></a><br/>
  										<a href="infoprodukpn.php?id_ikan=<?php echo $data['id_ikan'];?>" class="title"><?php echo $data['jenis_ikan']; ?>
  										</a><br/>
  										<a href="infoprodukpn.php?id_ikan=<?php echo $data['id_ikan'];?>" class="ket"><?php echo $data['ukuran']; ?> Kg</a>
  										<br/>
  										<a href="infoprodukpn.php?id_ikan=<?php echo $data['id_ikan'];?>" class="category"><?php echo $data['waktu_lelang']; ?></a>
  										<p class="price">Rp. <?php echo rupiah($data['harga_ikan']); ?></p>
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
  								<li>
  								  <?php for ($i=1; $i<=$pages ; $i++){ ?>
  								  <a href="?halaman=<?php echo $i;?>"><?php echo $i; ?></a>
  								  <?php } ?>
  								</li>
  							</ul>
  						</div>
              <?php
						} else {
							while ($data = mysqli_fetch_assoc($query)) {
						    ?>
								<li class="span3">
									<div class="product-box">
										<a href="infoprodukpn.php?id_ikan=<?php echo $data['id_ikan'];?>">
										<span class="sale_tag"></span>
										<a href="infoprodukpn.php?id_ikan=<?php echo $data['id_ikan'];?>"><img alt="" src="<?php echo $data['gambar_ikan']; ?>"></a><br/>
										<a href="infoprodukpn.php?id_ikan=<?php echo $data['id_ikan'];?>" class="title"><?php echo $data['jenis_ikan']; ?>
										</a><br/>
										<a href="infoprodukpn.php?id_ikan=<?php echo $data['id_ikan'];?>" class="ket"><?php echo $data['ukuran']; ?> Kg</a>
										<br/>
										<a href="infoprodukpn.php?id_ikan=<?php echo $data['id_ikan'];?>" class="category"><?php echo $data['waktu_lelang']; ?></a>
										<p class="price">Rp. <?php echo rupiah($data['harga_ikan']); ?></p>
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
								<li>
								  <?php for ($i=1; $i<=$pages ; $i++){ ?>
								  <a href="?halaman=<?php echo $i;?>"><?php echo $i; ?></a>
								  <?php } ?>
								</li>
							</ul>
						</div>
					<?php  } ?>
					</div>
					<div class="span3 col">
						<div class="block">
							<ul class="nav nav-list">
								<a><img width="115px" height="115px" src="Elang.png" class="site_logo" alt=""></a>
								<li class="nav-header">JENIS IKAN</li>
                <li><a href="homepn.php">Semua Jenis</a></li>
                <?php
                $queryjenis = mysqli_query($mysqli,"SELECT * FROM ikan group by jenis_ikan");
  						  while ($jenis = mysqli_fetch_assoc($queryjenis)) {
                  echo '<li><a href="homepn.php?jenis='.$jenis['jenis_ikan'].'">'.$jenis['jenis_ikan'].'</a></li>';
                }
  						    ?>
							</ul>
							<br/>
							<ul class="nav nav-list below">
								<li class="nav-header">WAKTU HABIS</li>
								<li><a href="products.html">16.00 20/12/2019</a></li>
								<li><a href="products.html">05.00 21/12/2019</a></li>
								<li><a href="products.html">10.00 21/12/2019</a></li>
								<li><a href="products.html">14.00 21/12/2019</a></li>
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
