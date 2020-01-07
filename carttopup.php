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
				<h4><span>Riwayat Topup</span></h4>
			</section>
			<section class="main-content">

				<div class="row">
          <div class="span9">
						<table class="table table-striped">
							<thead>
								<tr>
                  <th>Bukti Transfer</th>
									<th>Waktu Topup</th>
									<th>Jumlah Topup</th>
									<th>Status</th>
                  <th></th>
								</tr>
							</thead>
                <?php
                $halaman = 5;
                $page = isset($_GET["halaman"]) ? (int)$_GET["halaman"] : 1;
                $mulai = ($page>1) ? ($page * $halaman) - $halaman : 0;
                $result = mysqli_query($mysqli,"SELECT * FROM transfer WHERE id_penawar = '$id_penawar'");
                $total = mysqli_num_rows($result);
                $pages = ceil($total/$halaman);
                $query = mysqli_query($mysqli,"SELECT * FROM transfer WHERE id_penawar =  '$id_penawar' LIMIT $mulai, $halaman")or die(mysql_error);
                $no =$mulai+1;
                while ($data = mysqli_fetch_assoc($query)) {
                  ?>
							<tbody>
								<tr>
									<td><a href="uploadbukti.php?id_transfer=<?php echo $data['id_transfer']; ?>"><img alt="" height="200px" width="135px" src="<?php echo $data['bukti_transfer']; ?>"></a><br/></td>
									<td><?php echo $data['waktu']; ?></td>
									<td>Rp. <?php echo rupiah($data['nominal']); ?></td>
                  <td>
                      <div class="success-msg">
                        <?php if ($data['bukti_transfer']=="") {
                          echo "Anda Belum Upload Bukti";
                        }else if ($data['status_transfer']=="belum") {
                          echo "Menunggu Konfirmasi Dari Admin";
                        }else if ($data['status_transfer']=="gagal") {
                          echo "Topup Gagal...!!";
                        }else {
                          echo "Topup Sukses, Saldo Ditambahkan";
                        }?>
                      </div>
                  </td>
                  <td><a href="uploadbukti.php?id_transfer=<?php echo $data['id_transfer']; ?>"><button class="btn btn-inverse" type="submit">Lihat</button></a></td>
								</tr>
							</tbody>
              <?php
              }
              ?>
						</table>
						<hr/>
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