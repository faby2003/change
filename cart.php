<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="cart.css">
    <title>Cart</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f9f9f9;
        }

        header {
            background-color: #333;
            color: white;
            padding: 10px;
            text-align: center;
        }

        .cart-container {
            padding: 20px;
        }

        .product-card {
            background-color: white;
            border: 1px solid #ddd;
            padding: 10px;
            margin: 10px 0;
            text-align: center;
        }

        .product-card img {
            max-width: 100px;
            height: auto;
        }

        .product-card button {
            background-color: #333;
            color: white;
            border: none;
            padding: 5px 10px;
            cursor: pointer;
        }

        .product-card button:hover {
            background-color: #555;
        }
    </style>
</head>

<body>
    <?php
    session_start();
    $cart_count = 0;

    if (isset($_SESSION['userid'])) {
        $user_id = $_SESSION['userid'];

        $con = mysqli_connect("localhost", "root", "", "watch_store");

        if (!$con) {
            die("DB not connected: " . mysqli_connect_error());
        }


        $sql_count = "SELECT COUNT(*) as count FROM cart WHERE user_id = $user_id";
        $result_count = mysqli_query($con, $sql_count);

        if ($result_count && mysqli_num_rows($result_count) > 0) {
            $row_count = mysqli_fetch_assoc($result_count);
            $cart_count = $row_count['count'];
        }

        mysqli_close($con);
    }
    ?>

    <header>
    <nav class="navbar">
            <div class="logo">
                <h1>Watch Store</h1>
            </div>
            <ul class="nav-links">
                <li><a href="userhome.html">Home</a></li>
                <li><a href="cart.php">Cart (<?php echo $cart_count; ?>)</a></li>
                <li><a href="orders.php">Orders</a></li>
                <li><a href="profile.php">Profile</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </nav>
    </header>

    <div class="cart-container">
        <h2>Your Cart</h2>
        <?php
        if (isset($_SESSION['userid'])) {
            $user_id = $_SESSION['userid'];

            $con = mysqli_connect("localhost", "root", "", "watch_store");

            if (!$con) {
                die("DB not connected: " . mysqli_connect_error());
            }

            echo "User ID for Cart Query: " . htmlspecialchars($user_id) . "<br>";

            $sql = "SELECT cart.cid, products.model, products.price, products.image, products.productid AS product_id
            FROM cart
            JOIN products ON cart.product_id = products.productid
            WHERE cart.user_id = $user_id";

            $data = mysqli_query($con, $sql);

            if ($data && mysqli_num_rows($data) > 0) {
                while ($row = mysqli_fetch_assoc($data)) {
                    $price_inr = htmlspecialchars($row['price']);
                    echo "<div class='product-card'>
                    <img src='./images/" . htmlspecialchars($row['image']) . "' alt='" . htmlspecialchars($row['model']) . "'>
                    <h3>" . htmlspecialchars($row['model']) . "</h3>
                    <p>₹" . number_format(htmlspecialchars($row['price']), 2) . "</p>
                    <form method='post' action='remove_from_cart.php'>
                        <input type='hidden' name='cid' value='" . htmlspecialchars($row['cid']) . "'>
                        <button type='submit'>Remove</button>
                    </form>
                    <br>
                   <form method='post' action='payment.php'>
    <input type='hidden' name='order_id' value='" . htmlspecialchars($row['product_id']) . "'>
    <button type='submit'>Buy Now</button>
</form>

                  </div>";
                }
            } else {
                echo "<p>Your cart is empty.</p>";
            }

            mysqli_close($con);
        } else {
            echo "<p>Please log in to view your cart.</p>";
        }
        ?>
    </div>
</body>

</html>