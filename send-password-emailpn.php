<?php
include "config.php";

use PHPMailer\PHPMailer\PHPMailer;

use PHPMailer\PHPMailer\Exception;

require 'PHPMailer/src/Exception.php';

require 'PHPMailer/src/PHPMailer.php';

require 'PHPMailer/src/SMTP.php';



if(isset($_POST["reset_pass"])){

    $emailTo = mysqli_real_escape_string($mysqli, $_POST["email_reset"]); //email kamu atau email penerima link reset
    $code = uniqid(true); //Untuk kode atau parameter acak

    session_start();
    $_SESSION["code"] = "$code";
    $cek = mysqli_query($mysqli, "SELECT * FROM penawar WHERE email_penawar = '$emailTo'");
    $hasil = mysqli_fetch_array($cek);
    $idpn = $hasil['id_penawar'];
    if ($idpn==0) {
      header("location:forgot-passwordpn.php?email=kosong");
    }
    $query = mysqli_query($mysqli, "INSERT INTO lupa_password (email_pengguna,code_lupas) VALUES ('$emailTo','$code')");

    if(!$query){ exit("Error");}

    $mail = new PHPMailer(true);                              // Passing `true` enables exceptions

    try {

        //Server settings

        $mail->SMTPDebug = 0;                                 // Enable verbose debug output

        $mail->isSMTP();                                      // Set mailer to use SMTP

        $mail->Host = 'smtp.gmail.com';                     // Specify main and backup SMTP servers

        $mail->SMTPAuth = true;                               // Enable SMTP authentication

        $mail->Username = "elang.decode@gmail.com";     // SMTP username

        $mail->Password = 'polijesip123';                         // SMTP password

        $mail->SMTPSecure = 'tls';                            // Enable TLS encryption, `ssl` also accepted

        $mail->Port = 587;                                    // TCP port to connect to

        //Recipients

        $mail->setFrom("elang.decode@gmail.com", "Decode"); //email pengirim

        $mail->addAddress($emailTo); // Email penerima

        $mail->addReplyTo("no-reply@gmail.com");

        //Content

        $url = "http://" . $_SERVER["HTTP_HOST"] .dirname($_SERVER["PHP_SELF"]). "/resetpn.php?reset_pass=$code"; //sesuaikan berdasarkan link server dan nama file

        $mail->isHTML(true);                                  // Set email format to HTML

        $mail->Subject = "Link reset password";

        $mail->Body    = "
        <!DOCTYPE html>
        <head>
        <style>
            a {
                margin: auto;
                font-size: 20px;
                padding: 10px;
                background-color: green;
                text-decoration: none;
                color: white;
                border-radius: 5px;
            }
        </style>
        </head>
        <body>
        <div class='container'>
            <h1 class='text-center'>Permintaan reset password</h1>
            <p> Klik Link di bawah untuk mereset password</p>
            <br>
            <a class'btn btn-success' href='$url'>Reset Password</a>
        </div>
        </body>
        </html>
        " ;

        $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

        $mail->send();

        echo "
            <script type='text/javascript'>
            window.location.href = 'forgot-password-alertpn.php';
            </script>
        ";

    } catch (Exception $e) {

        echo 'Message could not be sent.';

        echo 'Mailer Error: ' . $mail->ErrorInfo;

    }

    exit();

}

?>
