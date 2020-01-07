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
				<h4><span>Check Out</span></h4>
			</section>
			<section class="main-content">
				<div class="row">
					<div class="span12">
						<div class="accordion" id="accordion2">
							<div class="accordion-group">
								<div class="accordion-heading">
									<a class="accordion-toggle" data-toggle="collapse" data-parent="#accordion2" href="#collapseOne">Pembayaran</a>
								</div>
								<div id="collapseOne" class="accordion-body in collapse">
									<div class="accordion-inner">
										<div class="row-fluid">
											<div class="span6">
												<h4>PEMBAYARAN</h4>
												<p>Silahkan Lakukan Pembayaran dengan Cara Transfer ke Rekening Berikut :</p>
													<form method="post" action="prosescheckouttopup.php" enctype="multipart/form-data">
													<fieldset>
                            <?php
                            $querybank = "SELECT * FROM bank_admin";
                            $sqlbank = mysqli_query($mysqli,$querybank);
                            while ($bank = mysqli_fetch_assoc($sqlbank)) {
                              $id_bank = $bank['id_bank'];
                              $nama_bank = $bank['nama_bank'];
                              $no_rek = $bank['no_rek'];
                              ?>
                              <label class="radio" >
  															<input type="radio" name="bank" value="<?php echo $id_bank; ?>" checked="checked"><?php echo $nama_bank; ?>
  															<p><?php echo $no_rek; ?></p>
  														</label>
                            <?php } ?>
														<br>
													</fieldset>
											 </div>
											 <div class="span6">
												<h4>IDENTITAS</h4>
												<p></p>
													<fieldset>
														<div class="control-group">
															<label class="control-label">Nama Kepemilikan Rekening</label>
															<div class="controls">
																<input type="text" placeholder="Masukan nama rekening anda" id="username" name="nama_rek" class="input-xlarge">
															</div>
														</div>
														<div class="control-group">
															<label class="control-label">Jumlah Nominal Topup</label>
															<?php
															if (isset($_GET['nominal'])) {
																$nominal = $_GET['nominal'];
															} ?>
															<h4>Rp. <?php echo rupiah($nominal); ?></h4>
															<input type="hidden" name="nominal" value="<?php echo $nominal; ?>">
															<input type="hidden" name="id_penawar" value="<?php echo $id_penawar; ?>">
                              <input type="hidden" name="status" value="<?php echo "belum"; ?>">
														</div>
														<input type="submit" name="upload" class="btn btn-inverse pull-bottom" value="Continue">
													</fieldset>
												</form>
											</div>
										</div>
									</div>
								</div>
							</div>
              <a href="topup.php"><input type="submit" name="upload" class="btn btn-inverse pull-bottom" value="Kembali Ke Pilihan Nominal"></a>
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
    </body>
</html>