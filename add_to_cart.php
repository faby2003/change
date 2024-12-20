<?php
session_start();

if (!isset($_SESSION['userid'])) {
    die("You must be logged in to add products to your cart.");
}

$user_id = $_SESSION['userid'];
$product_id = $_POST['product_id'];

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "watch_store";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "INSERT INTO cart (user_id, product_id) VALUES ('$user_id', '$product_id')";

if ($conn->query($sql) === TRUE) {
    echo "<script>
            alert('Item added to cart!');
            window.location.href = 'usersproduct.php';
          </script>";
} else {
    echo "<script>
            alert('Error: " . $conn->error . "');
            window.location.href = 'usersproduct.php';
          </script>";
}

$conn->close();
?>
