<?php
session_start();
include "config.php";
$id_admin = $_SESSION['id_admin'];
$sqladm = "SELECT * FROM admin WHERE id_admin = '$id_admin'";
$resultadm = mysqli_query($mysqli, $sqladm);
while($dataadm = mysqli_fetch_array($resultadm))
{
    $namaadm = $dataadm['nama_admin'];
}
if (isset($_POST['plusjen'])) {
  $jenis = $_POST['jenis'];
  $cek = mysqli_query($mysqli, "SELECT * FROM jenis_ikan WHERE nama_jenis='$jenis'");
  $hasil = mysqli_fetch_array($cek);
  if ($hasil['nama_jenis']=="") {
    $result = mysqli_query($mysqli, "INSERT INTO jenis_ikan (nama_jenis) VALUES ('$jenis')");
    header("location:plusjenadm.php?sukses=".$jenis);
  } else {
    header("location:plusjenadm.php?gagal=".$jenis);
  }
}
if (isset($_POST['minjen'])) {
  $jenis = $_POST['jenis'];
  $del = mysqli_query($mysqli, "DELETE FROM jenis_ikan WHERE nama_jenis='$jenis'");
  header("location:plusjenadm.php?delete=".$jenis);
}
?>
<html lang="en">

<head>

  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">

  <title>Tambah Jenis Ikan</title>

  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">

  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">
  <script src="js/material.min.js"></script>
  <link href="themes/css/material-icon.css" rel="stylesheet">
  <link rel="stylesheet" href="themes/css/application.min.css">
  <link rel="stylesheet" href="css/lib/getmdl-select.min.css">
  <link rel="stylesheet" href="css/lib/nv.d3.min.css">
</head>

<body id="page-top">

  <!-- Page Wrapper -->
  <div id="wrapper">

    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">

      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="topupadmin.php">
        <div class="sidebar-brand-icon rotate-n-15">

        </div>
        <div class="sidebar-brand-text mx-3">Elang<sup>Admin</sup></div>
      </a>

      <!-- Divider -->
      <hr class="sidebar-divider my-0">

      <!-- Nav Item - Dashboard -->
      <li class="nav-item">
        <a class="nav-link" href="topupadmin.php">
          <i class="fas fa-fw fa-tachometer-alt"></i>
          <span>Top-up Penawar</span></a>
      </li>
      <!-- Nav Item - Tables -->
      <li class="nav-item">
        <a class="nav-link" href="transferadmin.php">
          <i class="fas fa-fw fa-table"></i>
          <span>Transfer Pelelang</span></a>
      </li>
	    <li class="nav-item">
        <a class="nav-link" href="plusjenadm.php">
          <i class="fas fa-fw fa-fish"></i>
          <span>Tambah Jenis Ikan</span></a>
      </li>

      <!-- Divider -->
      <hr class="sidebar-divider d-none d-md-block">

      <!-- Sidebar Toggler (Sidebar) -->
      <div class="text-center d-none d-md-inline">
        <button class="rounded-circle border-0" id="sidebarToggle"></button>
      </div>

    </ul>
    <!-- End of Sidebar -->

    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">

      <!-- Main Content -->
      <div id="content">

        <!-- Topbar -->
        <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
			 <img width="200px" height="60px" src="elanghome.png" class="site_logo" alt="">
          <!-- Topbar Navbar -->
          <ul class="navbar-nav ml-auto">
            <!-- Nav Item - User Information -->
            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small"></span>
                <img class="img-profile rounded-circle" src="iconprofile.png">
              </a>
              <!-- Dropdown - User Information -->
              <div class="dropdown-menu dropdown-menu-right shadow animated--grow-in" aria-labelledby="userDropdown">
                <a class="dropdown-item" href="#" data-toggle="modal" data-target="#logoutModal">
                  <i class="fas fa-sign-out-alt fa-sm fa-fw mr-2 text-gray-400"></i>
                  Logout
                </a>
              </div>
            </li>
          </ul>
        </nav>
        <!-- End of Topbar -->

        <!-- Begin Page Content -->
        <div class="container-fluid">

          <!-- Page Heading -->
          <h1 class="h3 mb-4 text-gray-800">Penambahan Jenis ikan</h1>

          <?php
          if (isset($_GET['sukses'])) {
            $getjen = $_GET['sukses'];
            echo "Jenis Ikan ".$getjen." Berhasil Ditambahkan";
          }
          if (isset($_GET['gagal'])) {
            $getjen = $_GET['gagal'];
            echo "Jenis Ikan ".$getjen." Sudah Ada";
          }
          if (isset($_GET['delete'])) {
            $getjen = $_GET['delete'];
            echo "Jenis Ikan ".$getjen." Berhasil Dihapus";
          }
           ?>
          <!-- kotak -->
          <h5><strong>Daftar Nama Jenis Ikan </strong></h5><br/>
          <select name="jenis_ikan" class="form-control 10" size="10">
            <?php
            $res = mysqli_query($mysqli,"SELECT * FROM jenis_ikan ORDER BY nama_jenis");
            while($row = mysqli_fetch_array($res)){
              echo "<option>$row[nama_jenis]</option>";
            }
            ?>
          </select>
          <div class="row border-top border-left border-right border-bottom pt-2">
            <div class="col-md-3">
               <h5><strong>Masukan Nama Jenis Ikan </strong></h5><br/>
               <form class="" action="plusjenadm.php" method="post">
					       <input type="text" name="jenis" class="form-control form-control-user" id="exampleInputEmail" aria-describedby="userHelp" placeholder="Masukan nama ikan" required oninvalid="this.setCustomValidity('nama jenis tidak boleh kosong')" oninput="setCustomValidity('')">
						        <li class="mdl-list__item">
                      <button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect button--colored-teal" type="submit" name="plusjen" value="upload">
                          <i class="material-icons">add</i>
                            Tambah Jenis Ikan
                      </button>
                    </li>
                </form>
            </div>
            <div class="col-md-3">
               <h5><strong>Hapus Jenis Ikan </strong></h5><br/>
               <form class="" action="plusjenadm.php" method="post">
                 <select name="jenis" class="form-control " id="exampleInputEmail" aria-describedby="userHelp">
                   <?php
                   $res = mysqli_query($mysqli,"SELECT * FROM jenis_ikan ORDER BY nama_jenis");
                   while($row = mysqli_fetch_array($res)){
                     echo "<option>$row[nama_jenis]</option>";
                   }
                   ?>
                 </select>
						        <li class="mdl-list__item">
                      <button class="mdl-button mdl-js-button mdl-button--raised mdl-js-ripple-effect button--colored-teal" type="submit" name="minjen" value="upload">
                          <i class="material-icons">delete</i>
                            Hapus Jenis Ikan
                      </button>
                    </li>
                </form>
            </div>
		  </div>
		</div>
  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>

  <!-- Logout Modal-->
  <div class="modal fade" id="logoutModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="exampleModalLabel">Anda yakin akan keluar?</h5>
          <button class="close" type="button" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">×</span>
          </button>
        </div>
        <div class="modal-body">Klik "Logout" jika anda ingin logout</div>
        <div class="modal-footer">
          <button class="btn btn-secondary" type="button" data-dismiss="modal">Batal</button>
          <a class="btn btn-primary" href="logoutadmin.php">Logout</a>
        </div>
      </div>
    </div>
  </div>

  <!-- Bootstrap core JavaScript-->
  <script src="vendor/jquery/jquery.min.js"></script>
  <script src="vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="js/sb-admin-2.min.js"></script>

</body>

</html>
