<?php
//    include './util/config.php';
$connect = mysqli_connect("localhost", "root", "");
$db = mysqli_select_db($connect, "vux_test");

if (isset($_POST['btn_update'])) {

    $id = $_POST['update_id'];
    $name = $_POST['name'];
    $price = $_POST['price'];
    $des = $_POST['description'];

    $sql = "update product set name = '$name', price = '$price', description = '$des' where id ='$id'";
    $result = mysqli_query($connect, $sql);

    if ($result) {
        header('Location:index.php');
    } else {
        echo '<script>alert("Data not saved");</script>';
    }
}

?>

