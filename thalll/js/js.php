
  <!-- Bootstrap core JavaScript-->
  <script src="../vendor/jquery/jquery.min.js"></script>
  <script src="../vendor/bootstrap/js/bootstrap.bundle.min.js"></script>

  <!-- Core plugin JavaScript-->
  <script src="../vendor/jquery-easing/jquery.easing.min.js"></script>

  <!-- Custom scripts for all pages-->
  <script src="../js/sb-admin-2.min.js"></script>

  <!-- Page level plugins -->
  <script src="../vendor/chart.js/Chart.min.js"></script>

  <!-- Page level custom scripts -->
  <script src="../js/demo/chart-area-demo.js"></script>
  <script src="../js/demo/chart-pie-demo.js"></script>


  <script type="text/javascript">
  $(document).ready(function(){
      $('.pilih').click(function(){              //sebuah action dari class klik
          var menu = $(this).attr('id');       //ketika klik, membuat variabel  dengan menggambil nama id dari class klik
          if(menu == "satu"){                  //jika id berupa satu, maka akan tampil table dari file praktikum2bagian1
              $('.data').load('daftar.php');
          } else if(menu=="edit") {
              $('.data').load('edit.php?id=<?php echo $data['id_siswa'];?>');
          }
      });

  });
  </script>
