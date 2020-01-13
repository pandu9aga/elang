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
function rupiah($angka){
	$hasil_rupiah = number_format($angka,0,',','.');
	return $hasil_rupiah;
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <title>Top-Up Penawar</title>
  <!-- Custom fonts for this template-->
  <link href="vendor/fontawesome-free/css/all.min.css" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
  <!-- Custom styles for this template-->
  <link href="css/sb-admin-2.min.css" rel="stylesheet">
</head>
<body id="page-top">
  <!-- Page Wrapper -->
  <div id="wrapper">
    <!-- Sidebar -->
    <ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
      <!-- Sidebar - Brand -->
      <a class="sidebar-brand d-flex align-items-center justify-content-center" href="topupadmin.php">
        <div class="sidebar-brand-icon rotate-n-15">
          <img width="45px" height="45px" src="elang.png" alt="">
        </div>
        <div class="sidebar-brand-text mx-3">Elang <sup>Admin</sup></div>
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
          <!-- Topbar Navbar -->
          <ul class="navbar-nav ml-auto">
            <!-- Nav Item - User Information -->
            <li class="nav-item dropdown no-arrow">
              <a class="nav-link dropdown-toggle" href="#" id="userDropdown" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                <span class="mr-2 d-none d-lg-inline text-gray-600 small"><?php echo $namaadm; ?></span>
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
          <h1 class="h3 mb-4 text-gray-800">Top-Up Admin</h1>
          <?php
          $halaman = 5;
          $page = isset($_GET["halaman"]) ? (int)$_GET["halaman"] : 1;
          $mulai = ($page>1) ? ($page * $halaman) - $halaman : 0;
          $result = mysqli_query($mysqli,"SELECT * FROM transfer");
          $total = mysqli_num_rows($result);
          $pages = ceil($total/$halaman);
          $query = mysqli_query($mysqli,"SELECT * FROM transfer t inner join penawar p on t.id_penawar=p.id_penawar LIMIT $mulai, $halaman")or die(mysql_error);
          $no =$mulai+1;
          while ($data = mysqli_fetch_assoc($query)) {
           ?>
          <!-- kotak -->
          <div class="row border-top border-left border-right border-bottom pt-2">
            <div class="col-md-3">
              <!-- Button trigger modal -->
              <a  data-toggle="modal" data-target="#buktitransfer<?php echo $data['id_transfer'];?>">
                <img src="<?php echo $data['bukti_transfer']; ?>" alt="bukti transfer" width="225" height="155">
              </a>
              <!-- Modal -->
              <div class="modal fade" id="buktitransfer<?php echo $data['id_transfer'];?>" tabindex="-1" role="dialog" aria-labelledby="buktiTransferLabel" aria-hidden="true">
                <div class="modal-dialog" role="document">
                  <div class="modal-content">
                    <div class="modal-header">
                      <h5 class="modal-title" id="buktiTransferLabel">Bukti Top Up</h5>
                      <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                      </button>
                    </div>
                    <div class="modal-body">
                      <img src="<?php echo $data['bukti_transfer']; ?>" width="450" height="310">
                    </div>
                    <div class="modal-footer">
                      <button type="button" class="btn btn-secondary" data-dismiss="modal">Tutup</button>
                      <!-- <button type="button" class="btn btn-primary">Save changes</button> -->
                    </div>
                  </div>
                </div>
              </div>
            </div>
            <div class="col-md-7">
              <p>Waktu top-up : <?php echo $data['waktu']; ?></p>
              <p>Nama akun : <?php echo $data['nama_penawar']; ?></p>
              <p>Nama rekening : <?php echo $data['nama_rek']; ?></p>
              <p>Nominal : Rp. <?php echo rupiah($data['nominal']); ?></p>
              <?php
              $id_bank = $data['id_bank'];
              $bank = mysqli_query($mysqli,"SELECT * FROM bank_admin WHERE id_bank='$id_bank'");
              while ($databank = mysqli_fetch_assoc($bank)) {
                $nama_bank = $databank['nama_bank'];
                $rek_bank = $databank['no_rek'];
              }
               ?>
              <p>Bank <?php echo $nama_bank; ?> (<?php echo $rek_bank; ?>)</p>
            </div>
            <?php
            if ($data['bukti_transfer']=="") { ?>
              <div class="col-md-2 pl-5">
                <br> <br>
                <p>Pengguna belum mengupload bukti transfer</p>
              </div> <?php
            } elseif ($data['status_transfer']=="belum") { ?>
              <div class="col-md-2 pl-5">
                <br> <br> <br>
                <a href="konfirmtopup.php?id_transfer=<?php echo $data['id_transfer']; ?>"><button type="button" class="btn btn-primary" name="button">Konfirmasi</button></a>
                <a href="konfirmtopup.php?batal='gagal'&id_transfer=<?php echo $data['id_transfer']; ?>"><button type="button" class="btn" name="button">Batalkan</button></a>
              </div> <?php
            } elseif ($data['status_transfer']=="gagal") { ?>
              <div class="col-md-2 pl-5">
                <br> <br> <br>
                <p>Topup Gagal</p>
              </div> <?php
            } else { ?>
              <div class="col-md-2 pl-5">
                <br> <br> <br>
                <p>Topup Berhasil</p>
              </div> <?php
            }
             ?>

          </div> <br>
          <!-- akhir kotak -->
          <?php
          }
          ?>
        </div>
        <!-- /.container-fluid -->
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
      <!-- End of Main Content -->
      <!-- Footer -->
      <footer class="sticky-footer bg-white">
        <div class="container my-auto">
          <div class="copyright text-center my-auto">
            <span>Copyright &copy; Elang 2019</span>
          </div>
        </div>
      </footer>
      <!-- End of Footer -->
    </div>
    <!-- End of Content Wrapper -->
  </div>
  <!-- End of Page Wrapper -->
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
