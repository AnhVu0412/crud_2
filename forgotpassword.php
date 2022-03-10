<?php
    session_start();
    $msg ="";
    $connect = mysqli_connect("localhost", "root");
    $db = mysqli_select_db($connect, "vux_test");
    if (isset($_SESSION['name'])) {
    header("Location: welcome.php");
    die();
    }

    //Import PHPMailer classes into the global namespace
    //These must be at the top of your script, not inside a function
    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    //Load Composer's autoloader
    require 'vendor/autoload.php';

    if(isset($_POST['btn_fp'])){
        $email = $_POST['email'];
        $code = md5(rand());
        if(mysqli_num_rows(mysqli_query($connect,"select * from user where email = '$email'"))>0){
            $query = mysqli_query($connect,"update user set code = '$code' where email = '$email'");
            if($query) {
                echo "<div style='display: none;'>";
                $mail = new PHPMailer(true);

                try {
                    //Server settings
                    $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
                    $mail->isSMTP();                                            //Send using SMTP
                    $mail->Host = 'smtp.gmail.com';                     //Set the SMTP server to send through
                    $mail->SMTPAuth = true;                                   //Enable SMTP authentication
                    $mail->Username = 'tranvuanh2k@gmail.com';                     //SMTP username
                    $mail->Password = '0905520245';                               //SMTP password
                    $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
                    $mail->Port = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

                    //Recipients
                    $mail->setFrom('tranvuanh2k@gmail.com');
                    $mail->addAddress($email);

                    //Content
                    $mail->isHTML(true);                                  //Set email format to HTML
                    $mail->Subject = 'Here is the subject';
                    $mail->Body = 'Here is the verification link <b><a href="http://localhost:63342/crud_2/changepassword.php?reset=' . $code . '">http://localhost:63342/crud_2/changepassword.php?reset=' . $code . '</a></b>';


                    $mail->send();
                    echo 'Message has been sent';
                } catch (Exception $e) {
                    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
                }
                echo "</div>";
                $msg = "<div class='alert alert-info'> we have send reset link on your email address</div>";
            }

        }else{
            $msg = "<div class='alert alert-danger'>$email - this email address does not found</div>";
        }
    }
?>
<!doctype html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport"
          content="width=device-width, user-scalable=no, initial-scale=1.0, maximum-scale=1.0, minimum-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" rel="stylesheet" id="bootstrap-css">
    <script src="//maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js"></script>
    <script src="//cdnjs.cloudflare.com/ajax/libs/jquery/3.2.1/jquery.min.js"></script>
    <link rel="stylesheet" href="main.css">
    <title>Document</title>
</head>
<body>
<div class="row">
    <div class="col-md-5 mx-auto">


        <div id="first">
            <div class="myform form ">
                <div class="logo mb-3">
                    <div class="col-md-12 text-center">
                        <h1>Forgot Password</h1>
                    </div>
                </div>
                <form action="" method="post" name="forgot_password">
                    <?php echo $msg ?>
                    <div class="form-group">
                        <label for="email">Email address</label>
                        <input type="email" name="email"  class="form-control" id="email" aria-describedby="emailHelp" placeholder="Enter email">
                    </div>
                    <div class="col-md-12 text-center ">
                        <button  name="btn_fp" type="submit" class=" btn btn-block mybtn btn-primary tx-tfm">Send Reset Link</button>
                    </div>
                    <div class="form-group">
                        <p class="text-center">Back to<a href="login.php" id="signup">Login</a></p>
                    </div>
                </form>

            </div>
        </div>
    </div>
</div>
</body>
</html>
