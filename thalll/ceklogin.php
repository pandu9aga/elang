<?php
session_start();

include "koneksi.php";

$error = '';
    
if (isset($_POST['submit'])) {
 
       if (empty($_POST['username']) || empty($_POST['password'])) {

            $error = 'Username and Password Invalid!';
        } 

		else {

            $username = $_POST['username'];

            $password = $_POST['password'];

            $username = stripslashes($username);
 
           $password = stripslashes($password);

            $username = mysqli_real_escape_string($koneksi, $username);

            $password = mysqli_real_escape_string($koneksi, $password);

 
           $sql = "select * from tb_login where username='$username' and password='$password'";

            $query = mysqli_query($koneksi, $sql);

            $count= mysqli_num_rows($query);

            if ($count==1) {

                $cek = mysqli_fetch_array($query);
 
               $_SESSION['USERNAME'] = $cek['username'];

                header("location: home.php");

			}

             else{

                    die("error");

                }

	}

	}

	else {

                ?>

                <script language="JavaScript">

                        alert('Username atau Password Salah !');

                        setTimeout(function() {window.location.href='login.php'},10);

                    </script>

                <?php
            
}


 ?>
