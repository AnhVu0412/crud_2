<?php

$msg ="";
$connect = mysqli_connect("localhost", "root");
$db = mysqli_select_db($connect, "vux_test");
if (isset($_GET['reset'])) {
    if (mysqli_num_rows(mysqli_query($connect, "SELECT * FROM user WHERE code='{$_GET['reset']}'")) > 0) {
        if (isset($_POST['btn_rs'])) {
            $password =  $_POST['password'];
            $confirm_password = $_POST['confirm_password'];

            if ($password === $confirm_password) {
                $query = mysqli_query($connect, "UPDATE user SET password='{$password}', code='' WHERE code='{$_GET['reset']}'");

                if ($query) {
                    header("Location: login.php");
                }
            } else {
                $msg = "<div class='alert alert-danger'>Password and Confirm Password do not match.</div>";
            }
        }
    } else {
        $msg = "<div class='alert alert-danger'>Reset Link do not match.</div>";
    }
} else {
    header("Location: forgotpassword.php");
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
                        <h1>Reset Password</h1>
                    </div>
                </div>
                <form action="" method="post" name="forgot_password">

                    <div class="form-group">
                        <label for="email">New Password</label>
                        <input type="text" name="password"  class="form-control" id="email" aria-describedby="emailHelp" placeholder="Enter new password">
                    </div>
                    <div class="form-group">
                        <label for="email">Confirm Password</label>
                        <input type="text" name="confirm_password"  class="form-control" id="email" aria-describedby="emailHelp" placeholder="Confirm new password">
                    </div>

                    <div class="col-md-12 text-center ">
                        <button  name="btn_rs" type="submit" class=" btn btn-block mybtn btn-primary tx-tfm"> Reset Password</button>
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