<?php
session_start();
include "config.php";
$id_ikan = $_GET['id_ikan'];
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
function rupiah($angka){
  $hasil_rupiah = number_format($angka,0,',','.');
  return $hasil_rupiah;
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
		<link href="themes/css/main.css" rel="stylesheet"/>
		<link href="themes/css/jquery.fancybox.css" rel="stylesheet"/>
		<link href="themes/css/flexslider.css" rel="stylesheet"/>

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
      <div class="navbar-inner main-menu center">
      </div>
			<section class="header_text sub">
				<h4><span>Detail Produk</span></h4>
			</section>
			<section class="main-content">
				<div class="row">
					<div class="span9">
						<div class="row">
							<div class="span4">
								<a href="<?php echo $gambar; ?>" class="thumbnail" data-fancybox-group="group1" title="Gambar Produk"><img alt="" src="<?php echo $gambar; ?>"></a>
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
                $sqlpn = "SELECT * FROM tawaran t inner join penawar p on t.id_penawar=p.id_penawar WHERE id_ikan = '$id_ikan' and jumlah_tawaran = '$tawaran_tertinggi'";
                $resultpn = mysqli_query($mysqli,$sqlpn);
                $datapn = mysqli_fetch_array($resultpn);
                $idhightw = $datapn['id_tawaran'];
                $penawar_tertinggi = $datapn['nama_penawar'];
                $idpn_tertinggi = $datapn['id_penawar'];
                $alamatpn = $datapn['alamat_penawar'];
                ?>
								<h4><strong>Tawaran Tertinggi : Rp. <?php echo rupiah($tawaran_tertinggi); ?></strong> oleh <strong><?php echo "<a href='viewprofilpn.php?id_penawar=".$idpn_tertinggi."'>".$penawar_tertinggi."</a>";?></strong></h4>
                <?php
                if ($status=='berlangsung') {
                  echo "Pelelangan sedang berlangsung";
                }else {
                  echo "Pelelangan selesai";
                  if ($tawaran_tertinggi>0) {
                    if ($sttkirim=='kirim') { ?>
                      <p>Produk sedang dikirim, tunggu konfirmasi diterima oleh pemenang</p>
                    <?php
                    } elseif ($sttkirim=='terima'){
                      $cekwin = mysqli_query($mysqli, "SELECT * FROM pemenang WHERE id_tawaran='$idhightw'");
                      $datawin = mysqli_fetch_array($cekwin);
                      $idwin = $datawin['id_pemenang'];
                      $cektrans = mysqli_query($mysqli, "SELECT * FROM transfer_pelelang WHERE id_pemenang='$idwin'");
                      $datatrans = mysqli_fetch_array($cektrans);
                      $idtranspl = $datatrans['id_transfer_pelelang'];
                      $stattrans = $datatrans['status_transpelelang'];
                      $buktiimg = $datatrans['bukti_transpelelang'];
                      if ($stattrans=='kirim') { ?>
                        <p>Bukti Telah Diupload oleh Admin :</p>
                        <a  data-toggle="modal" data-target="#buktitransfer">
                          <img src="<?php echo $buktiimg; ?>" alt="" width="112" height="77">
                        </a><br>
                        <p>Konfirmasi transfer telah diterima : <a href="stattrans.php?idtranspl=<?php echo $idtranspl; ?>&id_ikan=<?php echo $id_ikan; ?>"><button class="btn btn-inverse" type="button"  name="konfirmtrans">Konfirmasi</button></a></p>
                      <?php
                      } elseif ($stattrans=='konfirm') { ?>
                        <br><br>
                        Bukti Transfer : <a  data-toggle="modal" data-target="#buktitransfer">
                          <img src="<?php echo $buktiimg; ?>" alt="" width="112" height="77">
                        </a><br><br>
                        <p>Anda Telah Menerima Transfer dari Admin</p>
                        <p>Transaksi Pelelangan Selesai</p>
                      <?php
                      } else { ?>
                        <p>Produk telah diterima, tunggu admin mengupload bukti transfer ke rekening anda</p>
                      <?php
                      }
                    } else { ?>
                      <p>Pelelangan dimenangkan oleh : <?php echo "<a href='viewprofilpn.php?id_penawar=".$idpn_tertinggi."'>".$penawar_tertinggi."</a>";?></p>
                      <p>Segera lakukan pengiriman ke alamat : <?php echo $alamatpn; ?></p>
                      <p>Konfirmasi produk telah dikirim : <a href="kirim.php?kirim=kirim&id_ikan=<?php echo $id_ikan; ?>"><button type="button" name="konfirmkirim">Konfirmasi</button></a></p>
                  <?php }
                } else {
                  echo "<br>Pelelangan gagal...tidak ada pemenang";
                }
                }
                 ?>
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
													<td><?php echo $namapl; ?></td>
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
              <?php
              if ($status=='berlangsung') { ?>
                <div class="span9">
  								<br>
  								<h4 class="title">
  									<span class="pull-left"><a href="hapusproduk.php?id_ikan=<?php echo $id_ikan; ?>"><button class="btn btn-inverse"name="delete">Hapus</button></a></span>
  								</h4>
  						</div>
              <?php
              } ?>
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
    <div class="modal fade" id="buktitransfer" tabindex="-1" role="dialog" aria-labelledby="buktiTransferLabel" aria-hidden="true">
      <div class="modal-dialog" role="document">
        <div class="modal-content">
          <div class="modal-header">
            <h5 class="modal-title" id="buktiTransferLabel">Bukti Transfer</h5>
          </div>
          <div class="modal-body">
            <img src="<?php echo $buktiimg; ?>" width="540" height="372">
          </div>
          <div class="modal-footer">
            <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
            <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
          </div>
        </div>
      </div>
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
