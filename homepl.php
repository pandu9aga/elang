<?php
session_start();
include "config.php";
$id_pelelang = $_SESSION['id_pelelang'];
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>Home Pelelang</title>
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
					<a href="homepl.php" class="logo-left"><img width="115px" height="115px" src="elanghome.png" class="site_logo" alt=""></a>
				</div>
				<div class="span8">
					<div class="account pull-right">
						<ul class="user-menu">
							<li><a href="profilpl.php">Profil</a></li>
							<li><a href="uploadproduk.php">+ Produk</a></li>
							<li><a href="lelangselesai.php">Pelelangan Selesai</a></li>
							<li><a href="logoutpl.php">Logout</a></li>
						</ul>
					</div>
				</div>
			</div>
		</div>
		<div id="wrapper" class="container">
			<section class="header_text sub">
			<img class="pageBanner" src="themes/images/promo.png" alt="New products" >
				<div class="navbar-inner main-menu">
				<h4><span>Produk Yang Anda Lelang</span></h4>
				</div>
		    </section>
			<section class="main-content">
				<a href="lelangselesai.php"><button class="btn btn-inverse" type="submit">Pelelangan Selesai</button></a>
        <?php
				if (isset($_GET['hapus'])) {
					echo "Hapus Produk Berhasil";
				}
        if (isset($_GET['jenis'])) {
          $getjen = $_GET['jenis'];
          echo "<h5>".$getjen." :</h5>";
        } else {
          echo "<h5>Semua Jenis :</h5>";
        }?>
				<div class="row">
					<div class="span9">
					  <div class="coteng">
						<ul class="thumbnails listing-products">
              <?php
							function rupiah($angka){
								$hasil_rupiah = number_format($angka,0,',','.');
								return $hasil_rupiah;
							}
						  $halaman = 6;
						  $page = isset($_GET["halaman"]) ? (int)$_GET["halaman"] : 1;
						  $mulai = ($page>1) ? ($page * $halaman) - $halaman : 0;
						  $result = mysqli_query($mysqli,"SELECT * FROM ikan WHERE id_pelelang = '$id_pelelang'");
						  $total = mysqli_num_rows($result);
						  $pages = ceil($total/$halaman);
              if (isset($_GET['jenis'])) {
                $getjenis = $_GET['jenis'];
                $query = mysqli_query($mysqli,"SELECT * FROM ikan WHERE id_pelelang = '$id_pelelang' and jenis_ikan = '$getjenis' LIMIT $mulai, $halaman")or die(mysql_error);
  						  $no =$mulai+1;
  						  while ($data = mysqli_fetch_assoc($query)) {
  						    ?>
  								<li class="span3">
									<a href="infoprodukpl.php?id_ikan=<?php echo $data['id_ikan'];?>">
  									<div class="product-box">
  										<a href="infoprodukpl.php?id_ikan=<?php echo $data['id_ikan'];?>">
  										<a href="infoprodukpl.php?id_ikan=<?php echo $data['id_ikan'];?>"><span class="sale_tag"></span></a>
  										<a href="infoprodukpl.php?id_ikan=<?php echo $data['id_ikan'];?>"><img alt="" src="<?php echo $data['gambar_ikan']; ?>"></a><br/>
  										<a href="infoprodukpl.php?id_ikan=<?php echo $data['id_ikan'];?>" class="title"><?php echo $data['jenis_ikan']; ?>
  										</a><br/>
  										<a href="infoprodukpl.php?id_ikan=<?php echo $data['id_ikan'];?>" class="ket"><?php echo $data['ukuran']; ?> Kg</a>
  										<br/>
  										<a href="infoprodukpl.php?id_ikan=<?php echo $data['id_ikan'];?>" class="category"><?php echo $data['waktu_lelang']; ?></a>
  										<a href="infoprodukpl.php?id_ikan=<?php echo $data['id_ikan'];?>"><p class="price">Rp. <?php echo rupiah($data['harga_ikan']); ?></p></a>
  										</a>
  									</div>
										</a>
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
            }else {
              $query = mysqli_query($mysqli,"SELECT * FROM ikan WHERE id_pelelang = '$id_pelelang' LIMIT $mulai, $halaman")or die(mysql_error);
						  $no =$mulai+1;
						  while ($data = mysqli_fetch_assoc($query)) {
						    ?>
								<li class="span3">
									<div class="product-box">
										<a href="infoprodukpl.php?id_ikan=<?php echo $data['id_ikan'];?>">
										<span class="sale_tag"></span>
										<a href="infoprodukpl.php?id_ikan=<?php echo $data['id_ikan'];?>"><img alt="" src="<?php echo $data['gambar_ikan']; ?>"></a><br/>
										<a href="infoprodukpl.php?id_ikan=<?php echo $data['id_ikan'];?>" class="title"><?php echo $data['jenis_ikan']; ?>
										</a><br/>
										<a href="infoprodukpl.php?id_ikan=<?php echo $data['id_ikan'];?>" class="ket"><?php echo $data['ukuran']; ?> Kg</a>
										<br/>
										<a href="infoprodukpl.php?id_ikan=<?php echo $data['id_ikan'];?>" class="category"><?php echo $data['waktu_lelang']; ?></a>
										<p class="price">Rp. <?php echo rupiah($data['harga_ikan']); ?></p>
										</a>
									</div>
								</li>
						    <?php } ?>
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
          <?php } ?>
					</div>
        </div>
					<div class="span3 col">
						<div class="block">
							<ul class="nav nav-list">
								<a><img width="115px" height="115px" src="Elang.png" class="site_logo" alt=""></a>
								<li class="nav-header">JENIS IKAN</li>
                <li><a href="homepl.php">Semua Jenis</a></li>
                <?php
                $queryjenis = mysqli_query($mysqli,"SELECT * FROM ikan WHERE id_pelelang = '$id_pelelang' group by jenis_ikan");
  						  while ($jenis = mysqli_fetch_assoc($queryjenis)) {
                  echo '<li><a href="homepl.php?jenis='.$jenis['jenis_ikan'].'">'.$jenis['jenis_ikan'].'</a></li>';
                }
  						    ?>
							</ul>
							<br/>
						</div>
					</div>
				</div>
			</section>
			<section id="footer-bar">
				<div class="row">
					<div class="span3">
						<h4>Navigasi</h4>
						<ul class="nav">
							<li><a href="homepl.php">Homepage</a></li>
							<li><a href="logoutpl.php">Logout</a></li>
						</ul>
					</div>
					<div class="span4">
						<h4>Akun Saya</h4>
						<ul class="nav">
							<li><a href="profilpl.php">Profil</a></li>
							<li><a href="lelangselesai.php">Pelelangan Selesai</a></li>
						</ul>
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
