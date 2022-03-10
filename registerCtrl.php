<?php
//    include './util/config.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Load Composer's autoloader
require 'vendor/autoload.php';

$connect = mysqli_connect("localhost", "root", "");
$db = mysqli_select_db($connect, "vux_test");
$msg = '';

if (isset($_POST['btn_register'])) {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $password = $_POST['password'];
    $cfpassword = $_POST['cfpassword'];
    $code = md5(rand());

    if (mysqli_num_rows(mysqli_query($connect, "select * from user where email = '$email'")) > 0) {
            echo "this email address has been already existed";
    } else {
        if ($cfpassword === $password) {
            $sql = "insert into user (`name`,`email`,`password`,`code`) values ('$name','$email','$password','$code')";
            $result = mysqli_query($connect, $sql);
            if ($result) {
                echo "<div style='display: none;'>";
                $mail = new PHPMailer(true);

                try {
                    //Server settings
                    $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
                    $mail->isSMTP();                                            //Send using SMTP
                    $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
                    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
                    $mail->Username   = 'tranvuanh2k@gmail.com';                     //SMTP username
                    $mail->Password   = '0905520245';                               //SMTP password
                    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
                    $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

                    //Recipients
                    $mail->setFrom('tranvuanh2k@gmail.com');
                    $mail->addAddress($email);

                    //Content
                    $mail->isHTML(true);                                  //Set email format to HTML
                    $mail->Subject = 'Here is the subject';
                    $mail->Body    = 'Here is the verification link <b><a href="http://localhost:63342/crud_2/login.php?verification='.$code.'">http://localhost:63342/crud_2/login.php?verification='.$code.'</a></b>';


                    $mail->send();
                    echo 'Message has been sent';
                } catch (Exception $e) {
                    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                }
                echo "</div>";

                header('location:login.php?msgsuccess=We have send a verification link on your email address. ');

            } else {
                echo '<script>alert("Data not saved");</script>';
            }
        } else {
            echo '<script>alert("Password is not match");</script>';
        }
    }
}
?>

