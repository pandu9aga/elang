<?php
session_start();
include "config.php";
$id_pelelang = $_SESSION['id_pelelang'];
$sql = "SELECT * FROM pelelang WHERE id_pelelang = '$id_pelelang'";
$result = mysqli_query($mysqli, $sql);
while($datapl = mysqli_fetch_array($result))
{
    $namapl = $datapl['nama_pelelang'];
    $alamatpl = $datapl['alamat_pelelang'];
    $norekpl = $datapl['rek_pelelang'];
    $notelppl = $datapl['notelp_pelelang'];
    $emailpl = $datapl['email_pelelang'];
    $passpl = $datapl['password_pelelang'];
    $pppl = $datapl['pp_pelelang'];
    $cttpl = $datapl['catatan_pelelang'];
}
if(isset($_POST['update']))
{
    $uid_pelelang = $_POST['id_pelelang'];
    $unamapl = $_POST['namapl'];
    $ualamatpl = $_POST['alamatpl'];
    $unorekpl = $_POST['norekpl'];
    $unotelppl = $_POST['notelppl'];
    $uemailpl = $_POST['emailpl'];
    $upasspl = $_POST['passpl'];
    $ucttpl = $_POST['cttpl'];
    $ceknama = mysqli_query($mysqli, "SELECT * FROM pelelang WHERE nama_pelelang='$unamapl'");
    $hasilnama = mysqli_fetch_array($ceknama);
    if ($hasilnama['id_pelelang']>0) {
      if ($hasilnama['nama_pelelang']==$namapl) {
        $cekemail = mysqli_query($mysqli, "SELECT * FROM pelelang WHERE email_pelelang='$uemailpl'");
        $hasilemail = mysqli_fetch_array($cekemail);
        if ($hasilemail['id_pelelang']>0) {
          if ($hasilemail['email_pelelang']==$emailpl) {
            $result = mysqli_query($mysqli, "UPDATE pelelang SET nama_pelelang='$unamapl',alamat_pelelang='$ualamatpl',rek_pelelang='$unorekpl',notelp_pelelang='$unotelppl',email_pelelang='$uemailpl',password_pelelang='$upasspl',catatan_pelelang='$ucttpl' WHERE id_pelelang=$uid_pelelang");
            header("location: profilpl.php");
          }else {
            header("location: editprofilpl.php?sudah=email");
          }
        }else {
          $result = mysqli_query($mysqli, "UPDATE pelelang SET nama_pelelang='$unamapl',alamat_pelelang='$ualamatpl',rek_pelelang='$unorekpl',notelp_pelelang='$unotelppl',email_pelelang='$uemailpl',password_pelelang='$upasspl',catatan_pelelang='$ucttpl' WHERE id_pelelang=$uid_pelelang");
          header("location: profilpl.php");
        }
      }else {
        header("location: editprofilpl.php?sudah=nama");
      }
    }else {
      $cekemail = mysqli_query($mysqli, "SELECT * FROM pelelang WHERE email_pelelang='$uemailpl'");
      $hasilemail = mysqli_fetch_array($cekemail);
      if ($hasilemail['id_pelelang']>0) {
        if ($hasilemail['email_pelelang']==$emailpl) {
          $result = mysqli_query($mysqli, "UPDATE pelelang SET nama_pelelang='$unamapl',alamat_pelelang='$ualamatpl',rek_pelelang='$unorekpl',notelp_pelelang='$unotelppl',email_pelelang='$uemailpl',password_pelelang='$upasspl',catatan_pelelang='$ucttpl' WHERE id_pelelang=$uid_pelelang");
          header("location: profilpl.php");
        }else {
          header("location: editprofilpl.php?sudah=email");
        }
      }else {
        $result = mysqli_query($mysqli, "UPDATE pelelang SET nama_pelelang='$unamapl',alamat_pelelang='$ualamatpl',rek_pelelang='$unorekpl',notelp_pelelang='$unotelppl',email_pelelang='$uemailpl',password_pelelang='$upasspl',catatan_pelelang='$ucttpl' WHERE id_pelelang=$uid_pelelang");
        header("location: profilpl.php");
      }
    }
}
if(isset($_POST['updatepppl'])) {
    $uid_pelelang = $_POST['id_pelelang'];
    $folder = "pppl/";
    $upload_image = $_FILES['gambarpl']['name'];
    $jenis_gambar = $_FILES['gambarpl']['type'];
    $ukuran_gambar = $_FILES['gambarpl']['size'];
    $maks_ukuran = 10000000;
    if ($jenis_gambar=="image/jpeg" || $jenis_gambar=="image/jpg") {
      if ($ukuran_gambar <= $maks_ukuran) {
        $width_size = 480;
        $height_size = 480;
        $filesave = $folder . $upload_image;
        move_uploaded_file($_FILES['gambarpl']['tmp_name'], $filesave);
        if ($jenis_gambar=="image/jpeg") {
          $resize_image = $folder . "resize_" . uniqid(rand()) . ".jpeg";
        }else {
          $resize_image = $folder . "resize_" . uniqid(rand()) . ".jpg";
        }
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
        $result = mysqli_query($mysqli, "UPDATE pelelang SET pp_pelelang='$resize_image' WHERE id_pelelang=$uid_pelelang");
        header("location:profilpl.php");
      }else {
        header("location:editprofilpl.php?ukuran=lebih");
      }
    }else {
      header("location:editprofilpl.php?tipe=salah");
    }
}
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>Edit Profil Pelelang</title>
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
      <div class="navbar-inner main-menu center">
      <h4>Edit Profil</h4>
      </div>
			<section class="navbar main-menu">
				<div class="row">
					<div class="span9">
						<div class="row">
							<div class="span4">
								<div class="avatar"> <img src="<?php echo $pppl; ?>">
									 <form method="post" enctype="multipart/form-data" name="pppl" action="editprofilpl.php">
										<div class="btn btn-inverse">
											<h9> Upload Foto Profil</h9><br>
    										<input class="buttonprof" type="file" name="gambarpl"><br><br>
                        <input type="hidden" name="id_pelelang" value="<?php echo $id_pelelang; ?>">
                        <input type="submit" name="updatepppl" value="Upload"><br><br>
                        <?php
                        if (isset($_GET['ukuran'])) {
                          echo "---Ukuran gambar tidak boleh lebih dari 10 MB!!---";
                        }
                        if (isset($_GET['tipe'])) {
                          echo "---Tipe gambar harus jpg & jpeg!!---";
                        }
                         ?>
										</div>
  									</form>
								</div>
							</div>
							<div class="span5">
                <?php
                if (isset($_GET['sudah'])) {
                  if ($_GET['sudah']=="nama") {
                    echo "Nama Pelelang Sudah Ada";
                  }else {
                    echo "Email Pelelang Sudah Ada";
                  }
                }
                 ?>
                <form name="update_pl" method="post" action="editprofilpl.php">
								<address>
									<h4><strong>Nama Pelelang:</strong></h4>
									<input type="text" class="span5" name="namapl" value="<?php echo $namapl; ?>" required oninvalid="this.setCustomValidity('nama tidak boleh kosong')" oninput="setCustomValidity('')">
									<h4><strong>Alamat:</strong></h4>
									<input type="text" class="span8" name="alamatpl" value="<?php echo $alamatpl; ?>" required oninvalid="this.setCustomValidity('alamat tidak boleh kosong')" oninput="setCustomValidity('')">
									<h4><strong>Nomor Rekening:</strong></h4>
									<input type="number" class="span8" name="norekpl" value="<?php echo $norekpl; ?>" required oninvalid="this.setCustomValidity('harus diisi dalam bentuk nomor')" oninput="setCustomValidity('')">
                  <h4><strong>Nomor Telepon:</strong></h4>
									<input type="number" class="span8" name="notelppl" value="<?php echo $notelppl; ?>" required oninvalid="this.setCustomValidity('harus diisi dalam bentuk nomor')" oninput="setCustomValidity('')">
                  <h4><strong>Email:</strong></h4>
									<input type="email" class="span8" name="emailpl" value="<?php echo $emailpl; ?>" required oninvalid="this.setCustomValidity('harus diisi dalam bentuk email')" oninput="setCustomValidity('')">
                  <h4><strong>Password:</strong></h4>
									<input type="text" class="span8" name="passpl" value="<?php echo $passpl; ?>" required oninvalid="this.setCustomValidity('password tidak boleh kosong')" oninput="setCustomValidity('')">
								</address>
								<h4><strong>catatan: </strong></h4>
								<input type="text" class="span8" name="cttpl" value="<?php echo $cttpl; ?>">
                <input type="hidden" name="id_pelelang" value="<?php echo $id_pelelang; ?>">
								<button class="btn btn-inverse" type="submit" name="update">Simpan</button>
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
    </body>
</html>
