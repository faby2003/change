<?php
session_start();

if (isset($_SESSION['userid']) && isset($_POST['product_id'])) {
    $user_id = $_SESSION['userid'];
    $product_id = $_POST['product_id'];

    $_SESSION['product_id'] = $product_id;

    header("Location: payment.php");
    exit();
} else {
    echo "<p>Invalid request.</p>";
}
?>
