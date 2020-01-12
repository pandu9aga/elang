<?php
session_start();
include "config.php";
$id_penawar = $_SESSION['id_penawar'];
$sql = "SELECT * FROM penawar WHERE id_penawar = '$id_penawar'";
$result = mysqli_query($mysqli, $sql);
while($datapn = mysqli_fetch_array($result))
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
				<h4><span>Bid Cart</span></h4>
			</section>
			<section class="main-content">
				<div class="row">
					<div class="span12">
						<h4 class="title"><span class="text"><strong>Daftar</strong> Tawaran</span></h4>
						<table class="table table-striped">
							<tbody>
                <?php
  						  $halaman = 5;
  						  $page = isset($_GET["halaman"]) ? (int)$_GET["halaman"] : 1;
  						  $mulai = ($page>1) ? ($page * $halaman) - $halaman : 0;
  						  $result = mysqli_query($mysqli,"SELECT * FROM tawaran WHERE id_penawar = '$id_penawar'");
  						  $total = mysqli_num_rows($result);
  						  $pages = ceil($total/$halaman);
  						  $query = mysqli_query($mysqli,"SELECT * FROM tawaran t inner join ikan i on t.id_ikan=i.id_ikan  WHERE id_penawar =  '$id_penawar' LIMIT $mulai, $halaman")or die(mysql_error);
  						  $no =$mulai+1;
  						  while ($data = mysqli_fetch_assoc($query)) {
  						    ?>
                  <tr>
                    <th><h4><?php echo $data['jenis_ikan']; ?></h4></th>
  									<th><h5>Ukuran</h5></th>
  									<th><h5>Tawaran Anda</h5></th>
  									<th><h5>Tawaran Tertinggi</h5></th>
                    <th><h5>Batas Waktu</h5></th>
                    <th><h5>Status</h5></th>
  								</tr>
                  <tr>
  									<td><a href="infoprodukpn.php?id_ikan=<?php echo $data['id_ikan'];?>"><img alt="" width="108px" height="63" src="<?php echo $data['gambar_ikan']; ?>"></a></td>
                    <?php
                    $id_ikan = $data['id_ikan'];
                    $waktulelang = $data['waktu_lelang'];
                     ?>
  									<td><input type="text" readonly value="<?php echo $data['ukuran']; ?> kg" class="input-mini"></td>
  									<td>Rp. <?php echo rupiah($data['jumlah_tawaran']); ?></td>
                    <?php
                    $sqltw = "SELECT MAX(jumlah_tawaran) AS max FROM tawaran WHERE id_ikan = '$id_ikan'";
                    $resulttw = mysqli_query($mysqli, $sqltw);
                    $datatw = mysqli_fetch_array($resulttw);
                    $tawaran_tertinggi = $datatw['max'];
                    ?>
  									<td>Rp. <?php echo rupiah($tawaran_tertinggi); ?></td>
                    <td><?php echo $waktulelang; ?></td>
                    <?php
                    if ($data['status_lelang']=='berlangsung') { ?>
                      <td>Berlangsung</td>
                    <?php
                    } else {
                      if ($data['jumlah_tawaran']==$tawaran_tertinggi) {
                        if ($data['status_kirim']=='kirim') { ?>
                          <td>Win!! Produk sedang dikirim<a href="kirim.php?terima=terima&id_ikan=<?php echo $id_ikan; ?>"><button type="button" name="konfirmterima">Telah diterima</button></a></td>
                        <?php
                        } elseif ($data['status_kirim']=='terima') { ?>
                          <td>Win!! Pelelangan Selesai</td>
                        <?php
                        } else { ?>
                        <td>Win!! Tunggu pelelang mengirim produknya</td>
                        <?php
                        }?>
                      <?php
                      } else { ?>
                        <td>Maaf anda kalah pelelangan</td>
                        <?php
                      }
                    }
                    ?>
  								</tr>
                  <?php
                  }
                  ?>
						</table>
            <div class="pagination pagination-small pagination-centered">
							<ul>
                <li>
								  <?php for ($i=1; $i<=$pages ; $i++){ ?>
								  <a href="?halaman=<?php echo $i;?>"><?php echo $i; ?></a>
								  <?php } ?>
                </li>
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
