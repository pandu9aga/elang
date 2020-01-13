<?php
session_start();
include "config.php";
if(isset($_POST['submitproduk'])) {
    $jenis = $_POST['jenis_ikan'];
    $berat = $_POST['berat'];
    $waktu = $_POST['waktu'];
    $hargaawal = $_POST['harga_awal'];
    $deskripsi = $_POST['deskripsi'];
    $idpl = $_POST['id_pelelang'];
    $status = $_POST['status'];
    $folder = "ikan/";
    $upload_image = $_FILES['gambar']['name'];
    $width_size = 480;
    $height_size = 280;
    $filesave = $folder . $upload_image;
    move_uploaded_file($_FILES['gambar']['tmp_name'], $filesave);
    $resize_image = $folder . "resize_" . uniqid(rand()) . ".jpg";
    list( $width, $height ) = getimagesize($filesave);
    $w = $width / $width_size;
    $h = $height / $height_size;
    $newwidth = $width / $w;
    $newheight = $height / $h;
    $thumb = imagecreatetruecolor($newwidth, $newheight);
    $source = imagecreatefromjpeg($filesave);
    imagecopyresized($thumb, $source, 0, 0, 0, 0, $newwidth, $newheight, $width, $height);
    imagejpeg($thumb, $resize_image);
    imagedestroy($thumb);
    imagedestroy($source);
    imagedestroy($filesave);
    imagedestroy($upload_image);
    $result = mysqli_query($mysqli, "INSERT INTO ikan (jenis_ikan,ukuran,waktu_lelang,harga_ikan,spesifikasi,id_pelelang,status_lelang,gambar_ikan,status_kirim) VALUES('$jenis','$berat','$waktu','$hargaawal','$deskripsi','$idpl','$status','$resize_image','')");
    header("location:homepl.php");
}
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>Upload Produk</title>
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
      <section class="navbar main-menu">
				<div class="navbar-inner main-menu">
				</div>
			</section>
			<section class="header_text sub">
				<h4><span>Upload Produk</span></h4>
			</section>
			<section class="main-content">
				<div class="row">
					<div class="span9">
						<div class="row">
							<div class="span4">
								<form method="post" name="form_uploadproduk" action="uploadproduk.php" enctype="multipart/form-data">
                  <label>Masukkan Foto</label>
                  <input class="btn btn-inverse" type="file" name="gambar">
  								<label>Masukan Jenis Ikan</label>
                    <select name="jenis_ikan">
                      <?php
                      $res = mysqli_query($mysqli,"SELECT * FROM jenis_ikan ORDER BY nama_jenis");
                      while($row = mysqli_fetch_array($res)){
                        echo "<option>$row[nama_jenis]</option>";
                      }
                			?>
                    </select>
                  <label>Masukan Berat Ikan (kg)</label>
  								<input type="number" class="span4" name="berat" placeholder="Masukan Berat Ikan">
  								<label>Masukan Waktu Habis Lelang</label>
                  <div id="datetimepicker" class="input-append date">
                    <input type="text" name="waktu"></input>
                    <span class="add-on">
                      <i data-time-icon="icon-time" data-date-icon="icon-calendar"></i>
                    </span>
                  </div>
                  <script type="text/javascript"
                   src="http://cdnjs.cloudflare.com/ajax/libs/jquery/1.8.3/jquery.min.js">
                  </script>
                  <script type="text/javascript"
                   src="http://netdna.bootstrapcdn.com/twitter-bootstrap/2.2.2/js/bootstrap.min.js">
                  </script>
                  <script type="text/javascript"
                   src="http://tarruda.github.com/bootstrap-datetimepicker/assets/js/bootstrap-datetimepicker.min.js">
                  </script>
                  <script type="text/javascript"
                   src="http://tarruda.github.com/bootstrap-datetimepicker/assets/js/bootstrap-datetimepicker.pt-BR.js">
                  </script>
                  <script type="text/javascript">
                    $('#datetimepicker').datetimepicker({
                      format: 'yyyy-MM-dd hh:mm:ss',
                      language: 'en'
                    });
                  </script>
  								<label>Masukan Harga Awal</label>
                  Rp.
  								<input type="number" class="span4" name="harga_awal" placeholder="Masukan Harga awal">
  								<label>Masukan Deskripsi Ikan</label>
  								<input type="text" class="span9" name="deskripsi" placeholder="Masukan Deskripsi">
                  <?php
                  $id_pelelang = $_SESSION['id_pelelang'];
                  ?>
                  <input type="hidden" name="id_pelelang" value=<?php echo $id_pelelang;?>>
                  <input type="hidden" name="status" value="berlangsung">
  								<input class="form-submit" type="submit" name="submitproduk"value="Upload">
                </form>
						</div>
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
