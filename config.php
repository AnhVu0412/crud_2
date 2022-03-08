<?php
$connect = mysqli_connect("localhost", "root");
$db = mysqli_select_db($connect, "vux_test");

if ($db) {
    echo "connect successfully";
} else {
    echo "connect fail";
}