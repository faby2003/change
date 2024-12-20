<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Your Orders</title>
    <link rel="stylesheet" href="cart.css">
    <style>
        body { font-family: Arial, sans-serif; margin: 0; padding: 0; background-color: #f9f9f9; }
        header { background-color: #333; color: white; padding: 10px; text-align: center; }
        .orders-container { padding: 20px; }
        .order-card { background-color: white; border: 1px solid #ddd; padding: 10px; margin: 10px 0; text-align: center; }
        .order-card p { margin: 5px 0; }
        .invoice-button {
            display: block;
            margin: 20px auto;
            padding: 10px 20px;
            background-color: #007bff;
            color: white;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            text-decoration: none;
            text-align: center;
        }
        .invoice-button:hover {
            background-color: #0056b3;
        }
    </style>
</head>
<body>
    <?php
    session_start();

    if (isset($_SESSION['userid'])) {
        $user_id = $_SESSION['userid'];

        $con = mysqli_connect("localhost", "root", "", "watch_store");

        if (!$con) {
            die("DB not connected: " . mysqli_connect_error());
        }

        $sql = "SELECT orders.order_id, products.model, products.price, orders.order_date, orders.address, orders.status
                FROM orders
                JOIN products ON orders.product_id = products.productid
                WHERE orders.user_id = $user_id";
        $result = mysqli_query($con, $sql);

        mysqli_close($con);
    } else {
        echo "<p>Please log in to view your orders.</p>";
        exit();
    }
    ?>

    <header>
    <nav class="navbar">
            <div class="logo">
                <h1>Watch Store</h1>
            </div>
            <ul class="nav-links">
                <li><a href="userhome.html">Home</a></li>
                <li><a href="cart.php">Cart</a></li>
                <li><a href="orders.php">Orders</a></li>
                <li><a href="profile.php">Profile</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </nav>
    </header>

    <div class="orders-container">
        <h2>Your Orders</h2>
        <?php
        if (isset($result) && mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
                echo "<div class='order-card'>
                        <p>Order ID: " . htmlspecialchars($row['order_id']) . "</p>
                        <p>Model: " . htmlspecialchars($row['model']) . "</p>
                        <p>Price: ₹" . number_format(htmlspecialchars($row['price']), 2) . "</p>
                        <p>Order Date: " . htmlspecialchars($row['order_date']) . "</p>
                        <p>Address: " . htmlspecialchars($row['address']) . "</p>
                        <p>Status: " . htmlspecialchars($row['status']) . "</p>
                        <a href='generate_invoice.php?order_id=" . htmlspecialchars($row['order_id']) . "' class='invoice-button'>Download Invoice</a>
                      </div>";
            }
        } else {
            echo "<p>You have no orders.</p>";
        }
        ?>
    </div>
</body>
</html>
