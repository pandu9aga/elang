<?php

include "config.php";

if(isset($_POST["new_pass"])){
    session_start();

    $email = $_POST["email"];
    $pass = $_POST["password"];
    $pass_repeat = $_POST["password_repeat"];
    $pass_repeat_hashed = password_hash($pass_repeat, PASSWORD_DEFAULT);
    $kode = $_SESSION['code'];

    $query = mysqli_query($mysqli, "UPDATE penawar SET password_penawar = '$pass_repeat_hashed' WHERE email_penawar = '$email'");

    if($query){

                mysqli_query($mysqli, "DELETE FROM lupa_password WHERE code_lupas = '$kode'");
                unset($_SESSION["code"]);
    }


    header("location:forgot-password-successpn.php");
    // echo "Password Berhasil Di Update";

}

 ?>
