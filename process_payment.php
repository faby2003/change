<?php
session_start();

if (!isset($_SESSION['userid'])) {
    header('Location: index.php');
    exit();
}

$user_id = $_SESSION['userid'];
$product_id = $_POST['product_id'];
$payment_method = $_POST['payment_method'];
$address = $_POST['address'];
$status = $payment_method === 'Card' ? 'Paid' : 'COD';

$con = mysqli_connect("localhost", "root", "", "watch_store");

if (!$con) {
    die("DB not connected: " . mysqli_connect_error());
}

$sql_order = "INSERT INTO orders (user_id, product_id, quantity, order_date, total_price, status, address)
              SELECT $user_id, products.productid, 1, NOW(), products.price, '$status', '$address'
              FROM products
              WHERE products.productid = $product_id";

if (mysqli_query($con, $sql_order)) {
    $sql_update_quantity = "UPDATE products SET quantity = quantity - 1 WHERE productid = $product_id";
    mysqli_query($con, $sql_update_quantity);

    $sql_delete_cart = "DELETE FROM cart WHERE user_id = $user_id AND product_id = $product_id";
    mysqli_query($con, $sql_delete_cart);

    header('Location: confirmation.php');
    exit();
} else {
    echo "Error: " . mysqli_error($con);
}

mysqli_close($con);
?>
