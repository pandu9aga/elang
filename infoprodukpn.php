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
          <img href="homepn.php" width="115px" height="115px" src="elanghome.png" class="site_logo" alt="">
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
			<a href="homepn.php"><img class="pageBanner" src="themes/images/promo.png" alt="New products" ></a>
				<h4><span>Product Detail</span></h4>
			</section>
			<section class="main-content">
      <?php
      if (isset($_GET['saldo'])) {
        echo "Maaf saldo anda tidak cukup, lakukan topup untuk menambah saldo....!!";
      }
       ?>
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
                $mintawaran = $tawaran_tertinggi + 1;
                ?>
                <br><a href="hapustawaran.php?id_penawar=<?php echo $id_penawar;?>&id_ikan=<?php echo $id_ikan;?>"><button class="btn btn-inverse"name="delete">Hapus Tawaran</button></a>
							</div>
							<div class="span5">
								<form class="form-inline" method="post" action="tawaran.php">
									<p>&nbsp;</p>
									<label>Masukkan Tawaran : Rp.</label>
									<input type="number" min="<?php echo $mintawaran; ?>"class="span2" name="tawaran" placeholder="masukan harga">
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
							<div class="span9">
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
				<span>Copyright 2013 bootstrappage template  All right reserved.</span>
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
