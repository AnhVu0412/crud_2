<?php
    session_start();
    if (!isset($_SESSION['name'])) {
    header("Location: login.php");
    die();
    }

    echo "welcome" .$_SESSION['name'] ;
    echo "<a href='logout.php'>Logout</a>"

?>

