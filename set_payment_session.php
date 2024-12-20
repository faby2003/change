<?php
session_start();

if (isset($_POST['product_id'])) {
    $_SESSION['product_id'] = intval($_POST['product_id']);
    header("Location: confirmation.php"); 
    exit();
} else {
    echo "Product ID not set.";
}
?>
