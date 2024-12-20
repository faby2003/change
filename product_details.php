

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Details</title>
    <link rel="stylesheet" href="productdetail.css"> <!-- Link to your CSS file -->
</head>
<body>

    <!-- Header Section -->
    <header>
     <h1><a style="text-decoration: none; color:white;" href="usersproduct.php">Product Details</a></h1>
    </header>

    <!-- Main Container for Product Details -->
    <div class="container">

        <h2>Watch Collection</h2>

        <div class="product-details">

            <!-- Product Information Section -->
            <div class="product-info">
            <?php
$con = mysqli_connect("localhost", "root", "", "watch_store");

if (!$con) {
    die("DB not connected: " . mysqli_connect_error());
}

$productid = isset($_GET['productid']) ? intval($_GET['productid']) : 0;

if ($productid) {
    $sql = "SELECT * FROM products WHERE productid = $productid";
    $result = mysqli_query($con, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $img = $row['image'];
        $price_inr = htmlspecialchars($row['price']);
        $description = htmlspecialchars($row['pdiscription']);
        $quantity = htmlspecialchars($row['quantity']);
        $is_out_of_stock = $quantity == 0;

        echo "<h2>" . htmlspecialchars($row['model']) . "</h2>";
        echo "<img src='./images/$img' alt='" . htmlspecialchars($row['model']) . "' width='200' height='200'>";
        echo "<p>Price: ₹" . number_format($price_inr, 2) . "</p>";
        echo "<p>Description: $description</p>";
        echo "<p>Quantity: " . ($is_out_of_stock ? "<span style='color:red;'>Out of Stock</span>" : $quantity) . "</p>";

        // Add to Cart Form
        if ($is_out_of_stock) {
            echo "<button disabled>Out of Stock</button>";
        } else {
            echo "<form method='POST' action='add_to_cart.php'>
                    <input type='hidden' name='product_id' value='$productid'>
                    <button type='submit'>Add to Cart</button>
                </form>";
        }
    } else {
        echo "<p>Product not found.</p>";
    }
} else {
    echo "<p>Invalid product ID.</p>";
}

mysqli_close($con);
?>
            </div>

        </div>
    </div>

</body>
</html>

