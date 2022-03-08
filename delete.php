<?php
$connect = mysqli_connect("localhost", "root", "");
$db = mysqli_select_db($connect, "vux_test");

if (isset($_POST['btn_delete'])) {

    $id = $_POST['delete_id'];


    $sql = "delete from product where id = '$id'";
    $result = mysqli_query($connect, $sql);

    if ($result) {
        header('Location:index.php');
    } else {
        echo '<script>alert("Data not saved");</script>';
    }
}
?>