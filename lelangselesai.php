<?php
session_start();
include "config.php";
$id_pelelang = $_SESSION['id_pelelang'];
function rupiah($angka){
  $hasil_rupiah = number_format($angka,0,',','.');
  return $hasil_rupiah;
}
?>
<!DOCTYPE html>
<html lang="en">
	<head>
		<meta charset="utf-8">
		<title>Pelelangan Selesai</title>
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
		<link href="themes/css/sucsessbox.css" rel="stylesheet"/>
		<link href="themes/css/animnotif.css" rel="stylesheet"/>
		<link href="bootstrap/css/font-awesome.min.css" rel="stylesheet"/>
		<link rel="stylesheet" href="font-awesome/css/font-awesome.min.css" />
		<script src="js/material.min.js"></script>
		<link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
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
			<section class="main-content">
				<div class="row">
					<div class="span9">
					  <h4 class="title"><span class="text"><strong>Pelelangan Anda</strong> yang Telah Selesai</span></h4>
            <?php
            if (isset($_GET['jenis'])) {
              $getjen = $_GET['jenis'];
              echo "<h5>".$getjen." :</h5>";
            } else {
              echo "<h5>Semua Jenis :</h5>";
            }
             ?>
						<table class="table table-striped">
							<thead>
								<tr>
									<th></th>
									<th>Produk</th>
									<th>Nama </th>
								</tr>
							</thead>
              <?php
              $halaman = 10;
						  $page = isset($_GET["halaman"]) ? (int)$_GET["halaman"] : 1;
						  $mulai = ($page>1) ? ($page * $halaman) - $halaman : 0;
              $result = mysqli_query($mysqli,"SELECT * FROM ikan WHERE id_pelelang = '$id_pelelang' and status_lelang='selesai'");
						  $total = mysqli_num_rows($result);
              $pages = ceil($total/$halaman);
              if (isset($_GET['jenis'])) {
                $getjenis = $_GET['jenis'];
                $queryikan = mysqli_query($mysqli, "SELECT * FROM ikan WHERE id_pelelang='$id_pelelang' and status_lelang='selesai' and jenis_ikan = '$getjenis' LIMIT $mulai, $halaman");
                while ($dataikan=mysqli_fetch_array($queryikan)) {
                  $id_ikan = $dataikan['id_ikan'];
                  $berat = $dataikan['ukuran'];
                  $status = $dataikan['status_kirim'];
                  $gambar = $dataikan['gambar_ikan'];
                  $jenis = $dataikan['jenis_ikan'];
                  $waktu = $dataikan['waktu_lelang'];
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
                  if ($tawaran_tertinggi>0) {
                    if ($dataikan['status_kirim']=="") { ?>
                      <tbody>
        								<tr>
        									<td><h4> </h4></td>
        									<td><a href="infoprodukpl.php?id_ikan=<?php echo $id_ikan; ?>"><img alt="" height="200px" width="135px" src="<?php echo $gambar; ?>"></a><br/></td>
        									<td><div class="span7"><div class="konkir"><?php echo $jenis; ?> <?php echo $berat; ?> kg</div>
        										<div class="pricekonkir">Rp. <?php echo rupiah($tawaran_tertinggi); ?></div>
        										<h8>Waktu Habis :</h8><h8> <?php echo $waktu; ?></h8><br/>
        										<h8>Pemenang :</h8><h8><a href="viewprofilpn.php?id_penawar=<?php echo $idpn_tertinggi; ?>"> <?php echo $penawar_tertinggi; ?></a></h8>
        									<p class="buttons right">
                            <a href="infoprodukpl.php?id_ikan=<?php echo $id_ikan; ?>">
                              <button class="btn btn-inverse" type="submit" name="konfirmkirim">Konfirmasi Siap Kirim</button>
                            </a>
        									</p>
        									</div>
        									</td>
        								</tr>
        								</tbody>
                      <?php
                      }elseif ($dataikan['status_kirim']=="kirim") { ?>
                        <tbody>
                          <tr>
                            <td><h4> </h4></td>
                            <td><a href="infoprodukpl.php?id_ikan=<?php echo $id_ikan; ?>"><img alt="" height="200px" width="135px" src="<?php echo $gambar; ?>"></a><br/></td>
                            <td><div class="span7"><div class="konkir"><?php echo $jenis; ?> <?php echo $berat; ?> kg</div>
                              <div class="pricekonkir">Rp. <?php echo rupiah($tawaran_tertinggi); ?></div>
                              <h8>Waktu Habis :</h8><h8> <?php echo $waktu; ?></h8><br/>
                              <h8>Pemenang :</h8><h8><a href="viewprofilpn.php?id_penawar=<?php echo $idpn_tertinggi; ?>"> <?php echo $penawar_tertinggi; ?></a></h8>
                            <p class="buttons right">
                              <a href="infoprodukpl.php?id_ikan=<?php echo $id_ikan; ?>">
                                <button class="btn btn-inverse" type="submit" name="konfirmkirim">Sedang Dikirim</button>
                              </a>
                            </p>
                            </div>
                            </td>
                          </tr>
                          </tbody>
                        <?php
                        }elseif ($dataikan['status_kirim']=="terima") {
                          $cekwin = mysqli_query($mysqli, "SELECT * FROM pemenang WHERE id_tawaran='$idhightw'");
                          $datawin = mysqli_fetch_array($cekwin);
                          $idwin = $datawin['id_pemenang'];
                          $cektrans = mysqli_query($mysqli, "SELECT * FROM transfer_pelelang WHERE id_pemenang='$idwin'");
                          $datatrans = mysqli_fetch_array($cektrans);
                          $idtranspl = $datatrans['id_transfer_pelelang'];
                          $stattrans = $datatrans['status_transpelelang'];
                          $buktiimg = $datatrans['bukti_transpelelang'];
                          if ($stattrans=="") { ?>
                            <tbody>
                              <tr>
                                <td><h4> </h4></td>
                                <td><a href="infoprodukpl.php?id_ikan=<?php echo $id_ikan; ?>"><img alt="" height="200px" width="135px" src="<?php echo $gambar; ?>"></a><br/></td>
                                <td><div class="span7"><div class="konkir"><?php echo $jenis; ?> <?php echo $berat; ?> kg</div>
                                  <div class="pricekonkir">Rp. <?php echo rupiah($tawaran_tertinggi); ?></div>
                                  <h8>Waktu Habis :</h8><h8> <?php echo $waktu; ?></h8><br/>
                                  <h8>Pemenang :</h8><h8><a href="viewprofilpn.php?id_penawar=<?php echo $idpn_tertinggi; ?>"> <?php echo $penawar_tertinggi; ?></a></h8><br>
                                  <h8>Sudah Diterima Pemenang</h8>
                                <p class="buttons right">
                                  <a href="infoprodukpl.php?id_ikan=<?php echo $id_ikan; ?>">
                                    <button class="btn btn-inverse" type="submit" name="konfirmkirim">Menunggu Transfer</button>
                                  </a>
                                </p>
                                </div>
                                </td>
                              </tr>
                              </tbody>
                              <?php
                            } elseif ($stattrans=="kirim") { ?>
                              <tbody>
                                <tr>
                                  <td><h4> </h4></td>
                                  <td><a href="infoprodukpl.php?id_ikan=<?php echo $id_ikan; ?>"><img alt="" height="200px" width="135px" src="<?php echo $gambar; ?>"></a><br/></td>
                                  <td><div class="span7"><div class="konkir"><?php echo $jenis; ?> <?php echo $berat; ?> kg</div>
                                    <div class="pricekonkir">Rp. <?php echo rupiah($tawaran_tertinggi); ?></div>
                                    <h8>Waktu Habis :</h8><h8> <?php echo $waktu; ?></h8><br/>
                                    <h8>Pemenang :</h8><h8><a href="viewprofilpn.php?id_penawar=<?php echo $idpn_tertinggi; ?>"> <?php echo $penawar_tertinggi; ?></a></h8><br>
                                    <h8>Sudah Diterima Pemenang</h8><br>
                                    <h8>Bukti Transfer Sudah Dikirim</h8>
                                  <p class="buttons right">
                                    <a href="infoprodukpl.php?id_ikan=<?php echo $id_ikan; ?>">
                                      <button class="btn btn-inverse" type="submit" name="konfirmkirim">Konfirmasi Transfer</button>
                                    </a>
                                  </p>
                                  </div>
                                  </td>
                                </tr>
                                </tbody>
                            <?php
                            } else { ?>
                            <tbody>
                              <tr>
                                <td><h4> </h4></td>
                                <td><a href="infoprodukpl.php?id_ikan=<?php echo $id_ikan; ?>"><img alt="" height="200px" width="135px" src="<?php echo $gambar; ?>"></a><br/></td>
                                <td><div class="span7"><div class="konkir"><?php echo $jenis; ?> <?php echo $berat; ?> kg</div>
                                  <div class="pricekonkir">Rp. <?php echo rupiah($tawaran_tertinggi); ?></div>
                                  <h8>Waktu Habis :</h8><h8> <?php echo $waktu; ?></h8><br/>
                                  <h8>Pemenang :</h8><h8><a href="viewprofilpn.php?id_penawar=<?php echo $idpn_tertinggi; ?>"> <?php echo $penawar_tertinggi; ?></a></h8><br>
                                  <h8>Sudah Diterima Pemenang</h8><br>
                                  <h8>Bukti Transfer Sudah Dikonfirmasi</h8>
                                <p class="buttons right">
                                  <a href="infoprodukpl.php?id_ikan=<?php echo $id_ikan; ?>">
                                    <button class="btn btn-inverse" type="submit" name="konfirmkirim">Pelelangan Berhasil</button>
                                  </a>
                                </p>
                                </div>
                                </td>
                              </tr>
                              </tbody>
                          <?php
                          }
                        }
                      }else { ?>
                        <tbody>
                          <tr>
                            <td><h4> </h4></td>
                            <td><a href="infoprodukpl.php?id_ikan=<?php echo $id_ikan; ?>"><img alt="" height="200px" width="135px" src="<?php echo $gambar; ?>"></a><br/></td>
                            <td><div class="span7"><div class="konkir"><?php echo $jenis; ?> <?php echo $berat; ?> kg</div>
                              <div class="pricekonkir">Rp. <?php echo rupiah($tawaran_tertinggi); ?></div>
                              <h8>Waktu Habis :</h8><h8> <?php echo $waktu; ?></h8><br/>
                              <h8>Pemenang :</h8><h8>Tidak Ada Pemenang</h8>
                            <p class="buttons right">
                              <div class="error-msg">
                                <a href="infoprodukpl.php?id_ikan=<?php echo $id_ikan; ?>">
               										<div class="itemBox"><i class="material-icons">warning</i><br/>
              												<h7>Maaf Pelelangan Gagal</h7>
              										</div>
                                </a>
            									</div>
                            </p>
                            </div>
                            </td>
                          </tr>
                          </tbody>
                      <?php
                      }
                    }
              }else {
                $queryikan = mysqli_query($mysqli, "SELECT * FROM ikan WHERE id_pelelang='$id_pelelang' and status_lelang='selesai' LIMIT $mulai, $halaman");
                while ($dataikan=mysqli_fetch_array($queryikan)) {
                  $id_ikan = $dataikan['id_ikan'];
                  $berat = $dataikan['ukuran'];
                  $status = $dataikan['status_kirim'];
                  $gambar = $dataikan['gambar_ikan'];
                  $jenis = $dataikan['jenis_ikan'];
                  $waktu = $dataikan['waktu_lelang'];
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
                  if ($tawaran_tertinggi>0) {
                    if ($dataikan['status_kirim']=="") { ?>
                      <tbody>
        								<tr>
        									<td><h4> </h4></td>
        									<td><a href="infoprodukpl.php?id_ikan=<?php echo $id_ikan; ?>"><img alt="" height="200px" width="135px" src="<?php echo $gambar; ?>"></a><br/></td>
        									<td><div class="span7"><div class="konkir"><?php echo $jenis; ?> <?php echo $berat; ?> kg</div>
        										<div class="pricekonkir">Rp. <?php echo rupiah($tawaran_tertinggi); ?></div>
        										<h8>Waktu Habis :</h8><h8> <?php echo $waktu; ?></h8><br/>
        										<h8>Pemenang :</h8><h8><a href="viewprofilpn.php?id_penawar=<?php echo $idpn_tertinggi; ?>"> <?php echo $penawar_tertinggi; ?></a></h8>
        									<p class="buttons right">
                            <a href="infoprodukpl.php?id_ikan=<?php echo $id_ikan; ?>">
                              <button class="btn btn-inverse" type="submit" name="konfirmkirim">Konfirmasi Siap Kirim</button>
                            </a>
        									</p>
        									</div>
        									</td>
        								</tr>
        								</tbody>
                      <?php
                      }elseif ($dataikan['status_kirim']=="kirim") { ?>
                        <tbody>
                          <tr>
                            <td><h4> </h4></td>
                            <td><a href="infoprodukpl.php?id_ikan=<?php echo $id_ikan; ?>"><img alt="" height="200px" width="135px" src="<?php echo $gambar; ?>"></a><br/></td>
                            <td><div class="span7"><div class="konkir"><?php echo $jenis; ?> <?php echo $berat; ?> kg</div>
                              <div class="pricekonkir">Rp. <?php echo rupiah($tawaran_tertinggi); ?></div>
                              <h8>Waktu Habis :</h8><h8> <?php echo $waktu; ?></h8><br/>
                              <h8>Pemenang :</h8><h8><a href="viewprofilpn.php?id_penawar=<?php echo $idpn_tertinggi; ?>"> <?php echo $penawar_tertinggi; ?></a></h8>
                            <p class="buttons right">
                              <a href="infoprodukpl.php?id_ikan=<?php echo $id_ikan; ?>">
                                <button class="btn btn-inverse" type="submit" name="konfirmkirim">Sedang Dikirim</button>
                              </a>
                            </p>
                            </div>
                            </td>
                          </tr>
                          </tbody>
                        <?php
                        }elseif ($dataikan['status_kirim']=="terima") {
                          $cekwin = mysqli_query($mysqli, "SELECT * FROM pemenang WHERE id_tawaran='$idhightw'");
                          $datawin = mysqli_fetch_array($cekwin);
                          $idwin = $datawin['id_pemenang'];
                          $cektrans = mysqli_query($mysqli, "SELECT * FROM transfer_pelelang WHERE id_pemenang='$idwin'");
                          $datatrans = mysqli_fetch_array($cektrans);
                          $idtranspl = $datatrans['id_transfer_pelelang'];
                          $stattrans = $datatrans['status_transpelelang'];
                          $buktiimg = $datatrans['bukti_transpelelang'];
                          if ($stattrans=="") { ?>
                            <tbody>
                              <tr>
                                <td><h4> </h4></td>
                                <td><a href="infoprodukpl.php?id_ikan=<?php echo $id_ikan; ?>"><img alt="" height="200px" width="135px" src="<?php echo $gambar; ?>"></a><br/></td>
                                <td><div class="span7"><div class="konkir"><?php echo $jenis; ?> <?php echo $berat; ?> kg</div>
                                  <div class="pricekonkir">Rp. <?php echo rupiah($tawaran_tertinggi); ?></div>
                                  <h8>Waktu Habis :</h8><h8> <?php echo $waktu; ?></h8><br/>
                                  <h8>Pemenang :</h8><h8><a href="viewprofilpn.php?id_penawar=<?php echo $idpn_tertinggi; ?>"> <?php echo $penawar_tertinggi; ?></a></h8><br>
                                  <h8>Sudah Diterima Pemenang</h8>
                                <p class="buttons right">
                                  <a href="infoprodukpl.php?id_ikan=<?php echo $id_ikan; ?>">
                                    <button class="btn btn-inverse" type="submit" name="konfirmkirim">Menunggu Transfer</button>
                                  </a>
                                </p>
                                </div>
                                </td>
                              </tr>
                              </tbody>
                              <?php
                            } elseif ($stattrans=="kirim") { ?>
                              <tbody>
                                <tr>
                                  <td><h4> </h4></td>
                                  <td><a href="infoprodukpl.php?id_ikan=<?php echo $id_ikan; ?>"><img alt="" height="200px" width="135px" src="<?php echo $gambar; ?>"></a><br/></td>
                                  <td><div class="span7"><div class="konkir"><?php echo $jenis; ?> <?php echo $berat; ?> kg</div>
                                    <div class="pricekonkir">Rp. <?php echo rupiah($tawaran_tertinggi); ?></div>
                                    <h8>Waktu Habis :</h8><h8> <?php echo $waktu; ?></h8><br/>
                                    <h8>Pemenang :</h8><h8><a href="viewprofilpn.php?id_penawar=<?php echo $idpn_tertinggi; ?>"> <?php echo $penawar_tertinggi; ?></a></h8><br>
                                    <h8>Sudah Diterima Pemenang</h8><br>
                                    <h8>Bukti Transfer Sudah Dikirim</h8>
                                  <p class="buttons right">
                                    <a href="infoprodukpl.php?id_ikan=<?php echo $id_ikan; ?>">
                                      <button class="btn btn-inverse" type="submit" name="konfirmkirim">Konfirmasi Transfer</button>
                                    </a>
                                  </p>
                                  </div>
                                  </td>
                                </tr>
                                </tbody>
                            <?php
                            } else { ?>
                            <tbody>
                              <tr>
                                <td><h4> </h4></td>
                                <td><a href="infoprodukpl.php?id_ikan=<?php echo $id_ikan; ?>"><img alt="" height="200px" width="135px" src="<?php echo $gambar; ?>"></a><br/></td>
                                <td><div class="span7"><div class="konkir"><?php echo $jenis; ?> <?php echo $berat; ?> kg</div>
                                  <div class="pricekonkir">Rp. <?php echo rupiah($tawaran_tertinggi); ?></div>
                                  <h8>Waktu Habis :</h8><h8> <?php echo $waktu; ?></h8><br/>
                                  <h8>Pemenang :</h8><h8><a href="viewprofilpn.php?id_penawar=<?php echo $idpn_tertinggi; ?>"> <?php echo $penawar_tertinggi; ?></a></h8><br>
                                  <h8>Sudah Diterima Pemenang</h8><br>
                                  <h8>Bukti Transfer Sudah Dikonfirmasi</h8>
                                <p class="buttons right">
                                  <a href="infoprodukpl.php?id_ikan=<?php echo $id_ikan; ?>">
                                    <button class="btn btn-inverse" type="submit" name="konfirmkirim">Pelelangan Berhasil</button>
                                  </a>
                                </p>
                                </div>
                                </td>
                              </tr>
                              </tbody>
                          <?php
                          }
                        }
                      }else { ?>
                        <tbody>
                          <tr>
                            <td><h4> </h4></td>
                            <td><a href="infoprodukpl.php?id_ikan=<?php echo $id_ikan; ?>"><img alt="" height="200px" width="135px" src="<?php echo $gambar; ?>"></a><br/></td>
                            <td><div class="span7"><div class="konkir"><?php echo $jenis; ?> <?php echo $berat; ?> kg</div>
                              <div class="pricekonkir">Rp. <?php echo rupiah($tawaran_tertinggi); ?></div>
                              <h8>Waktu Habis :</h8><h8> <?php echo $waktu; ?></h8><br/>
                              <h8>Pemenang :</h8><h8>Tidak Ada Pemenang</h8>
                            <p class="buttons right">
                              <div class="error-msg">
                                <a href="infoprodukpl.php?id_ikan=<?php echo $id_ikan; ?>">
               										<div class="itemBox"><i class="material-icons">warning</i><br/>
              												<h7>Maaf Pelelangan Gagal</h7>
              										</div>
                                </a>
            									</div>
                            </p>
                            </div>
                            </td>
                          </tr>
                          </tbody>
                      <?php
                      }
                    }
              }
                 ?>
						</table>
            <div class="pagination pagination-medium pagination-centered">
							<ul>
								<li>
								  <?php for ($i=1; $i<=$pages ; $i++){ ?>
								  <a href="?halaman=<?php echo $i;?>"><?php echo $i; ?></a>
								  <?php } ?>
								</li>
							</ul>
						</div>
						<hr/>
					</div>
					<div class="span3 col">
						<div class="block">
              <ul class="nav nav-list">
								<a><img width="115px" height="115px" src="Elang.png" class="site_logo" alt=""></a>
								<li class="nav-header">JENIS IKAN</li>
                <li><a href="lelangselesai.php">Semua Jenis</a></li>
                <?php
                $queryjenis = mysqli_query($mysqli,"SELECT * FROM ikan WHERE id_pelelang = '$id_pelelang' and status_lelang='selesai' group by jenis_ikan");
  						  while ($jenis = mysqli_fetch_assoc($queryjenis)) {
                  echo '<li><a href="lelangselesai.php?jenis='.$jenis['jenis_ikan'].'">'.$jenis['jenis_ikan'].'</a></li>';
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
