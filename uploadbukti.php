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
				<h4><span>Check Out</span></h4>
			</section>
			<section class="main-content">
				<div class="row">
					<div class="span12">
						<div class="accordion" id="accordion2">
							<div class="accordion-group">
								<div class="accordion-heading">
									<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseOne">Akun &amp; Detail Pembayaran</a>
								</div>
								<div id="collapseOne" class="accordion-body in collapse">
									<div class="accordion-inner">
										<div class="row-fluid">
											<div class="span6">
												<h4>UPLOAD BUKTI TRANSFER</h4>
												<div class="control-group">
                          <?php
                          if (isset($_GET['id_transfer'])) {
                            $id_transfer = $_GET['id_transfer'];
                            $sqltrans = "SELECT * FROM transfer t inner join bank_admin b on t.id_bank=b.id_bank WHERE id_transfer = '$id_transfer'";
                            $resulttrans = mysqli_query($mysqli, $sqltrans);
                            while($datatrans = mysqli_fetch_array($resulttrans))
                            {
                                $nama_bank = $datatrans['nama_bank'];
                                $no_rek = $datatrans['no_rek'];
                                $nama_rek = $datatrans['nama_rek'];
                                $nominal = $datatrans['nominal'];
                                $bukti = $datatrans['bukti_transfer'];
                                $status =$datatrans['status_transfer'];
                            }
                          } ?>
                          <p><h5>Transfer ke rek :</h5><?php echo $nama_bank;?>  (<?php echo $no_rek; ?>)</p>
                          <p><h5>Nama pengirim :</h5><?php echo $nama_rek; ?></p>
                          <p><h5>Nominal :</h5>Rp. <?php echo rupiah($nominal); ?></p>
                          <?php
                          if ($bukti == "") { ?>
                            <form method="post" enctype="multipart/form-data" action="prosesuploadbukti.php">
      												<input class="btn btn-inverse" type="file" name="gambar">
                              <input type="hidden" name="id_transfer" value="<?php echo $id_transfer; ?>">
                              <input type="submit" name="upload" class="btn btn-inverse pull-bottom" value="Upload">
  													</form>
                            <h5> Bukti Transfer	:</h5>Segera lakukan pembayaran dan upload bukti transfer
                          <?php } else if ($status=="belum") { ?>
                            <h5> Bukti Transfer	:</h5>
                            <a href="<?php echo $bukti; ?>" class="thumbnail" data-fancybox-group="group1" title="Bukti Transfer"><img alt="" width="240px" height="140px" src="<?php echo $bukti; ?>"></a>
                            <br><br><p>Bukti telah terupload</p><p>Menunggu konfirmasi dari admin</p>
                          <?php } else if ($status=="gagal") { ?>
                            <h5> Bukti Transfer	:</h5>
                            <a href="<?php echo $bukti; ?>" class="thumbnail" data-fancybox-group="group1" title="Bukti Transfer"><img alt="" width="240px" height="140px" src="<?php echo $bukti; ?>"></a>
                            <br><br><p>Topup Gagal</p><p>Hubungi Admin 081234567890</p>
                          <?php } else { ?>
                            <h5> Bukti Transfer	:</h5>
                            <a href="<?php echo $bukti; ?>" class="thumbnail" data-fancybox-group="group1" title="Bukti Transfer"><img alt="" width="240px" height="140px" src="<?php echo $bukti; ?>"></a>
                            <br><br><p>Topup Berhasil</p><p>Saldo Ditambahkan Sebanyak Rp. <?php echo rupiah($nominal); ?></p>
                          <?php } ?>
												</div>
											</div>
										</div>
									</div>
								</div>
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

							<li><a href="./contact.html">Contac Us</a></li>
							<li><a href="./cart.html">Your Cart</a></li>
							<li><a href="./register.html">Login</a></li>
						</ul>
					</div>
					<div class="span4">
						<h4>My Account</h4>
						<ul class="nav">
							<li><a href="#">My Account</a></li>
							<li><a href="#">Topup History</a></li>
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