<?php
//    include 'config.php';
session_start();
$msg ="";
$connect = mysqli_connect("localhost", "root");
$db = mysqli_select_db($connect, "vux_test");

    if (isset($_GET['verification'])) {
    if (mysqli_num_rows(mysqli_query($connect, "SELECT * FROM user WHERE code='{$_GET['verification']}'")) > 0) {
        $query = mysqli_query($connect, "UPDATE user SET code='' WHERE code='{$_GET['verification']}'");

        if ($query) {
            $msg = "<div class='alert alert-success'>Account verification has been successfully completed.</div>";
        }
    } else {
        header("Location: index.php");
    }
    }

    if(isset($_POST['btn_login'])){
        $email = $_POST['email'];
        $password = $_POST['password'];

        $sql = "select * from  user where email ='$email' and password = '$password'";
        $result = mysqli_query($connect,$sql);

        if(mysqli_num_rows($result) ===1){
            $row = mysqli_fetch_assoc($result);
            if(empty($row['code'])){
                $_SESSION['name'] = $row['name'];
                header('location:welcome.php');
            }else{
                $msg = "<div class='alert alert-info'>First verify your account and try again</div>";
            }
        }else{
            $msg = "<div class='alert alert-danger'>Email or password does not match</div>";
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
<div class="container">
    <div class="row">
        <div class="col-md-5 mx-auto">


            <div id="first">
                <div class="myform form ">
                    <div class="logo mb-3">
                        <div class="col-md-12 text-center">
                            <h1>Login</h1>
                        </div>
                    </div>
                    <?php if(isset($_GET['msgsuccess'])){ ?>
                        <div class='alert alert-success'><?php echo $_GET['msgsuccess'] ?></div>;
                    <?php } ?>
                    <?php echo $msg ?>
                    <form action="" method="post" name="login">
                        <div class="form-group">
                            <label for="email">Email address</label>
                            <input type="email" name="email"  class="form-control" id="email" aria-describedby="emailHelp" placeholder="Enter email">
                        </div>
                        <div class="form-group">
                            <label for="password">Password</label>
                            <input type="password" name="password" id="password"  class="form-control" aria-describedby="emailHelp" placeholder="Enter Password">
                        </div>
                        <div class="col-md-12 text-center ">
                            <button  name="btn_login" type="submit" class=" btn btn-block mybtn btn-primary tx-tfm">Login</button>
                        </div>
                        <div class="form-group">
                            <p class="text-center">Don't have account? <a href="#" id="signup">Sign up here</a></p>
                        </div>
                        <div class="form-group">
                            <p class="text-center"><a href="http://localhost:63342/crud_2/forgotpassword.php" id="signup">Forgot Password</a></p>
                        </div>
                    </form>

                </div>
            </div>



            <div id="second">
                <div class="myform form ">
                    <div class="logo mb-3">
                        <div class="col-md-12 text-center">
                            <h1 >Signup</h1>
                        </div>
                    </div>
                    <form action="registerCtrl.php" name="registration" method="post">
                        <div class="form-group">
                            <label for="name"> Name</label>
                            <input type="text"  name="name" class="form-control" id="name" aria-describedby="emailHelp" placeholder="Enter Name">
                        </div>
                        <div class="form-group">
                            <label for="email_for">Email address</label>
                            <input type="email" name="email"  class="form-control" id="email_for" aria-describedby="emailHelp" placeholder="Enter email">
                        </div>
                        <div class="form-group">
                            <label for="password_for">Password</label>
                            <input type="password" name="password" id="password_for"  class="form-control" aria-describedby="emailHelp" placeholder="Enter Password">
                        </div>
                        <div class="form-group">
                            <label for="c_password_for">Confirm Password</label>
                            <input type="password" name="cfpassword" id="c_password_for"  class="form-control" aria-describedby="emailHelp" placeholder="Enter Password">
                        </div>
                        <div class="col-md-12 text-center mb-3">
                            <button name="btn_register" type="submit" class=" btn btn-block mybtn btn-primary tx-tfm">Get Started For Free</button>
                        </div>
                        <div class="col-md-12 ">
                            <div class="form-group">
                                <p class="text-center"><a href="#" id="signin">Already have an account?</a></p>
                            </div>
                        </div>
                    </form>
                </div>

            </div>

        </div>
    </div>
</div>

<!-- java script fade in/out-->
<script>
    $("#signup").click(function() {
        $("#first").fadeOut("fast", function() {
            $("#second").fadeIn("fast");
        });
    });

    $("#signin").click(function() {
        $("#second").fadeOut("fast", function() {
            $("#first").fadeIn("fast");
        });
    });

<!-- javascript Login -->
    $(function() {
        $("form[name='login']").validate({
            rules: {

                email: {
                    required: true,
                    email: true
                },
                password: {
                    required: true,

                }

            },
            messages: {
                email: "Please enter a valid email address",

                password: {
                    required: "Please enter password",

                }
            },
            submitHandler: function(form) {
                form.submit();
            }
        });
    });


<!-- javascipt register -->
    $(function() {
        $("form[name='registration']").validate({
            rules: {
               name: "required",
                email: {
                    required: true,
                    email: true
                },
                password: {
                    required: true,
                    minlength: 5
                }
                // ,
                // confirmpassword:{
                //     required: true,
                //     equalTo: "#password_for"
                // }
            },
            messages: {
                name: "Please enter your name",
                password: {
                    required: "Please provide a password",
                    minlength: "Your password must be at least 5 characters long"
                }
                // ,
                // email: "Please enter a valid email address",
                // confirmpassword: {
                //     required: "Please confirm a password",
                //     equalTo: "password is not match"
                // }
            },
            submitHandler: function(form) {
                form.submit();
            }
        });
    });
</script>

<script src="https://cdn.jsdelivr.net/jquery.validation/1.15.1/jquery.validate.min.js"></script>
<link href="https://fonts.googleapis.com/css?family=Kaushan+Script" rel="stylesheet">
<link href="https://stackpath.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css" rel="stylesheet"
      integrity="sha384-wvfXpqpZZVQGK6TAh5PVlGOfQNHSoD2xbE+QkPxCAFlNEevoEH3Sl0sibVcOQVnN" crossorigin="anonymous">
</body>
</html>
