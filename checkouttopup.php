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
		<title>Checkout Top-Up</title>
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
                    <?php
                    $jum = 0;
                    $ceknotif = mysqli_query($mysqli, "SELECT * FROM notif WHERE id_penawar = '$id_penawar' and baca = 'belum'");
                    while ($cekjumnot = mysqli_fetch_array($ceknotif)) {
                      $jum++;
                    }
                    if ($jum==0) { ?>
                      <div class="material-icons">notifications_none</div>
                    <?php
                    }else { ?>
                      <div class="material-icons mdl-badge mdl-badge--overlap" data-badge="<?php echo $jum; ?>">notifications_none</div>
                    <?php
                    }
                     ?>
  							    <div class="caption" >notifikasi</div>
                  </a>
              					<!-- Notifications dropdown-->
              		<ul class="span3">
  									<?php
                    $querynotif = mysqli_query($mysqli, "SELECT * FROM notif WHERE id_penawar = '$id_penawar'");
                    while ($datanotif = mysqli_fetch_array($querynotif)) {
                      $idnottf = $datanotif['id_transfer'];
                      $idnottw = $datanotif['id_tawaran'];
                      $bacanot = $datanotif['baca'];
                      if ($idnottf!=0) {
                          $notquerytf = mysqli_query($mysqli, "SELECT * FROM transfer WHERE id_transfer = '$idnottf'");
                          $notdatatf = mysqli_fetch_array($notquerytf);
                          $notbuktitrans = $notdatatf['bukti_transfer'];
                          $notstttrans = $notdatatf['status_transfer'];
                          $notnominal = $notdatatf['nominal'];
                          if ($notbuktitrans=="") { ?>
                            <li>
                            <a href="uploadbukti.php?id_transfer=<?php echo $idnottf; ?>"><img width="25px" height="20px" src="error.png" class="site_logo" alt="">Upload Bukti Topup Rp. <?php echo rupiah($notnominal); ?></a>
                            </li>
                          <?php
                          }elseif ($notstttrans=="gagal") {
                            if ($bacanot=="belum") { ?>
                              <li>
                              <a href="bacanotif.php?id_transfer=<?php echo $idnottf; ?>"><img width="25px" height="20px" src="error.png" class="site_logo" alt="">Topup Sebanyak Rp. <?php echo rupiah($notnominal); ?> Gagal</a>
                              </li>
                          <?php
                            }
                          }elseif ($notstttrans=="konfirm") {
                            if ($bacanot=="belum") { ?>
                              <li>
                              <a href="bacanotif.php?id_transfer=<?php echo $idnottf; ?>"><img width="25px" height="20px" src="error.png" class="site_logo" alt="">Topup Sebanyak Rp. <?php echo rupiah($notnominal); ?> Berhasil</a>
                              </li>
                          <?php
                            }
                          }
                      }
                      else {
                        $notquerytw = mysqli_query($mysqli, "SELECT * FROM tawaran WHERE id_tawaran = '$idnottw'");
                        $notdatatw = mysqli_fetch_array($notquerytw);
                        $notjumtw = $notdatatw['jumlah_tawaran'];
                        $notidikan = $notdatatw['id_ikan'];
                        $notqueryik = mysqli_query($mysqli, "SELECT * FROM ikan WHERE id_ikan = '$notidikan'");
                        $notdataik = mysqli_fetch_array($notqueryik);
                        $jenikan = $notdataik['jenis_ikan'];
                        $notstatkirim = $notdataik['status_kirim'];
                        $notquerywin = mysqli_query($mysqli, "SELECT * FROM pemenang WHERE id_tawaran = '$idnottw'");
                        $notwin = mysqli_fetch_array($notquerywin);
                        $notidwin = $notwin['id_pemenang'];
                        if ($bacanot=="belum") {
                          if ($notidwin=="") { ?>
                            <li>
                            <a href="bacanotif.php?id_ikan=<?php echo $notidikan; ?>&id_tawaran=<?php echo $idnottw; ?>">
                              <img width="25px" height="20px" src="error.png" class="site_logo" alt="">Tawaran <?php echo $jenikan; ?> Rp. <?php echo rupiah($notjumtw); ?> Dilewati
                              <br> Saldo Anda Kembali
                            </a>
                            </li>
                          <?php
                          }else {
                            if ($notstatkirim=="") { ?>
                              <li>
                              <a href="bacanotif.php?id_ikan=<?php echo $notidikan; ?>&id_tawaran=<?php echo $idnottw; ?>">
                                <img width="25px" height="20px" src="succes.png" class="site_logo" alt="">Tawaran <?php echo $jenikan; ?> Rp. <?php echo rupiah($notjumtw); ?> Menang
                                <br> Pelelangan Selesai, Menunggu Dikirim Oleh Pelelang
                              </a>
                              </li>
                            <?php
                            }elseif ($notstatkirim=="kirim") { ?>
                              <li>
                              <a href="infoprodukpn.php?id_ikan=<?php echo $notidikan; ?>">
                                <img width="25px" height="20px" src="succes.png" class="site_logo" alt="">Tawaran <?php echo $jenikan; ?> Rp. <?php echo rupiah($notjumtw); ?> Menang
                                <br> Produk Telah Dikirim...Konfirmasi Penerimaan
                              </a>
                              </li>
                            <?php
                            }
                          }
                        }
                      }
                    }
                     ?>
                    <li>
                      <a href="pemberitahuan.php?id_penawar='<?php echo $id_penawar; ?>'">Lihat Semua Pemberitahuan</a>
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
    <div class="navbar-inner main-menu center">
    </div>
			<section class="header_text sub">
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
																<input type="text" placeholder="Masukan nama rekening anda" id="username" name="nama_rek" class="input-xlarge" required oninvalid="this.setCustomValidity('nama pemilik rekening tidak boleh kosong')" oninput="setCustomValidity('')">
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
 							<li><a href="homepn.php">Homepage</a></li>
 							<li><a href="pemberitahuan.php">Pemberitahuan</a></li>
 							<li><a href="logoutpn.php">Logout</a></li>
 						</ul>
 					</div>
 					<div class="span4">
 						<h4>My Account</h4>
 						<ul class="nav">
 							<li><a href="profilpn.php">Profil</a></li>
 							<li><a href="cart.php">Cart</a></li>
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
