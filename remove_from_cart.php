<?php
session_start();

if (!isset($_SESSION['userid'])) {
    header("Location: login.php");
    exit();
}

$con = mysqli_connect("localhost", "root", "", "watch_store");
if (!$con) {
    die("DB not Connected: " . mysqli_connect_error());
}

if (isset($_POST['cid'])) {
    $cid = $_POST['cid'];
    $sql = "DELETE FROM cart WHERE cid = $cid";
    if (mysqli_query($con, $sql)) {
        header("Location: cart.php");
        exit();
    } else {
        echo "<script>alert('Error removing item from cart')</script>";
    }
}

mysqli_close($con);
?>
