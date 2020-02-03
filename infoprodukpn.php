<?php
session_start();
include "config.php";
$id_penawar = $_SESSION['id_penawar'];
$id_ikan = $_GET['id_ikan'];
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
    $status = $dataikan['status_lelang'];
    $sttkirim = $dataikan['status_kirim'];
}
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>Info Produk</title>
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
				<h4><span>Product Detail</span></h4>
			</section>
			<section class="main-content">
      <?php
      if (isset($_GET['saldo'])) {
        echo "<span class='color-text--red'>Maaf saldo anda tidak cukup, lakukan topup untuk menambah saldo....!!</span>";
      }
       ?>
       <?php
       if (isset($_GET['hapus'])) {
         echo "Hapus tawaran berhasil....!!";
       }
        ?>
				<div class="row">
					<div class="span12">
						<div class="row">
							<div class="span4">
								<a href="<?php echo $gambar; ?>" class="thumbnail" data-fancybox-group="group1" title="Info Produk"><img alt="" src="<?php echo $gambar; ?>"></a>
							</div>
							<div class="span5">
								<address>
									<strong>Jenis Ikan:</strong> <span><?php echo $jenis; ?></span><br>
									<strong>Waktu Pelelangan:</strong> <span><?php echo $waktulelang; ?></span><br>
                  <strong>Harga Awal:</strong> <span>Rp. <?php echo rupiah($harga); ?></span><br>
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
								<h4><strong>Tawaran Tertinggi :</strong> Rp. <?php echo rupiah($tawaran_tertinggi); ?></h4>
                <h4><strong>Tawaran Anda :</strong> Rp. <?php echo rupiah($tawaran_tertinggipn);?></h5>
                <?php
                if ($tawaran_tertinggipn > 0) {
                  if ($tawaran_tertinggi == $tawaran_tertinggipn) {
                    echo "Tawaran anda yang tertinggi...!!<br>";
                  } else {
                    echo "Tawaran anda bukan yang tertinggi...!!<br>";
                  }
                }
                if ($status == 'berlangsung') { ?>
                  <br><a href="hapustawaran.php?id_penawar=<?php echo $id_penawar;?>&id_ikan=<?php echo $id_ikan;?>"><button class="btn btn-inverse"name="delete">Hapus Tawaran</button></a>
                <?php
                  $mintawaran = $tawaran_tertinggi + 1;
                  ?>
                  <div class="span5">
    								<form class="form-inline" method="post" action="tawaran.php">
    									<p>&nbsp;</p>
    									<label>Masukkan Tawaran : Rp.</label>
    									<input type="number" min="<?php echo $mintawaran; ?>"class="span2" name="tawaran" placeholder="masukan harga" required oninvalid="this.setCustomValidity('tawaran harus lebih tinggi dari <?php echo $tawaran_tertinggi; ?>')">
                      <input type="hidden" name="penawar" value="<?php echo $id_penawar; ?>">
                      <input type="hidden" name="ikan" value="<?php echo $id_ikan; ?>">
    									<button class="btn btn-inverse" type="submit" name="submittawaran">+</button>
    								</form>
    							</div>
                <?php
                }
                ?>
							</div>
              <?php
              if ($status == 'selesai') { ?>
                <div class="span5">
                  <h3>Pelelangan Selesai</h3>
                  <?php
                  if ($tawaran_tertinggipn==$tawaran_tertinggi) {
                    if ($sttkirim=='kirim') { ?>
                      <p>Produk sedang dikirim ke alamat anda</p>
                      <p>Konfirmasi produk telah diterima : <a href="kirim.php?terima=terima&id_ikan=<?php echo $id_ikan; ?>"><button type="button" name="konfirmterima">Konfirmasi</button></a></p>
                    <?php
                    } elseif ($sttkirim=='terima') { ?>
                      <p>Produk telah diterima oleh anda...transaksi pelelang sukses</p>
                    <?php
                    } else {
                      echo "Anda memenangkan pelelangan ini...!! ";
                      echo "Menunggu pelelang mengirim produk ini";
                    }
                  } else {
                    echo "Anda tidak memenangkan pelelangan ini";
                  }
                   ?>
  							</div>
              <?php
              }
               ?>
						</div>
						<div class="row">
							<div class="span12">
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
                          <td>Rp. <?php echo rupiah($harga); ?></td>
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
													<td><?php echo "<a href='viewprofilpl.php?id_pelelang=".$idpl."'>".$namapl."</a>"; ?></td>
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
							<div class="span12">
								<br>
								<h4 class="title">
									<span class="pull-left"><span class="text"><strong>Info</strong> Produk</span></span>
									<span class="pull-right"></span>
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
    <!--><script type="text/javascript">
		var rupiah = document.getElementById('rupiah');
		rupiah.addEventListener('keyup', function(e){
			// tambahkan 'Rp.' pada saat form di ketik
			// gunakan fungsi formatRupiah() untuk mengubah angka yang di ketik menjadi format angka
			rupiah.value = formatRupiah(this.value, 'Rp. ');
		});
		/* Fungsi formatRupiah */
		function formatRupiah(angka, prefix){
			var number_string = angka.replace(/[^,\d]/g, '').toString(),
			split   		= number_string.split(','),
			sisa     		= split[0].length % 3,
			rupiah     		= split[0].substr(0, sisa),
			ribuan     		= split[0].substr(sisa).match(/\d{3}/gi);
			// tambahkan titik jika yang di input sudah menjadi angka ribuan
			if(ribuan){
				separator = sisa ? '.' : '';
				rupiah += separator + ribuan.join('.');
			}
			rupiah = split[1] != undefined ? rupiah + ',' + split[1] : rupiah;
			return prefix == undefined ? rupiah : (rupiah ? 'Rp. ' + rupiah : '');
		}
  </script><-->
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

				$('#myCarousel-1').carousel({
                    interval: 2500
                });
			});
		</script>
    </body>
</html>
