<?php
//    include './util/config.php';
$connect = mysqli_connect("localhost", "root", "");
$db = mysqli_select_db($connect, "vux_test");

if (isset($_POST['btn_insert'])) {
    $name = $_POST['name'];
    $price = $_POST['price'];
    $des = $_POST['description'];

    $sql = "insert into product (`name`,`price`,`description`) values ('$name','$price','$des')";
    $result = mysqli_query($connect, $sql);

    if ($result) {
        header('location:index.php');
    } else {
        echo '<script>alert("Data not saved");</script>';
    }
}

?>
