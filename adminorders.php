<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - View Orders</title>
    <link rel="stylesheet" href="admin.css">
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

        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            max-width: 1200px;
            margin: auto;
        }

        .logo h1 {
            margin: 0;
        }

        .nav-links {
            list-style-type: none;
            margin: 0;
            padding: 0;
            display: flex;
        }

        .nav-links li {
            margin-left: 20px;
        }

        .nav-links a {
            color: white;
            text-decoration: none;
        }

        .main {
            padding: 20px;
            max-width: 1200px;
            margin: auto;
        }

        table {
            width: 100%;
            border-collapse: collapse;
            margin-bottom: 20px;
        }

        th, td {
            border: 1px solid #ddd;
            padding: 10px;
            text-align: left;
        }

        th {
            background-color: #f4f4f4;
        }

        .btn {
            background-color: #333;
            color: white;
            border: none;
            padding: 5px 10px;
            cursor: pointer;
            border-radius: 4px;
            text-decoration: none;
        }

        .btn:hover {
            background-color: #555;
        }
    </style>
</head>
<body>
    <?php
    session_start();


    // Connect to the database
    $con = mysqli_connect("localhost", "root", "", "watch_store");

    if (!$con) {
        die("DB not connected: " . mysqli_connect_error());
    }

    // Fetch orders
    $sql = "SELECT orders.order_id, orders.user_id, orders.product_id, orders.quantity, orders.order_date, orders.total_price, orders.status, products.model
            FROM orders
            JOIN products ON orders.product_id = products.productid";
    $result = mysqli_query($con, $sql);

    if (!$result) {
        die("Error fetching orders: " . mysqli_error($con));
    }

    mysqli_close($con);
    ?>

    <header>
        <nav class="navbar">
            <div class="logo">
                <h1>Watch Store - Admin</h1>
            </div>
            <ul class="nav-links">
                <li><a href="adminhome.html">Dashboard</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </nav>
    </header>

    <div class="main">
        <h2>All Orders</h2>
        <table>
            <thead>
                <tr>
                    <th>Order ID</th>
                    <th>User ID</th>
                    <th>Product Model</th>
                    <th>Quantity</th>
                    <th>Order Date</th>
                    <th>Total Price</th>
                    <th>Status</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>
                                <td>" . htmlspecialchars($row['order_id']) . "</td>
                                <td>" . htmlspecialchars($row['user_id']) . "</td>
                                <td>" . htmlspecialchars($row['model']) . "</td>
                                <td>" . htmlspecialchars($row['quantity']) . "</td>
                                <td>" . htmlspecialchars($row['order_date']) . "</td>
                                <td>₹" . number_format(htmlspecialchars($row['total_price']), 2) . "</td>
                                <td>" . htmlspecialchars($row['status']) . "</td>
                              </tr>";
                    }
                } else {
                    echo "<tr><td colspan='7'>No orders found.</td></tr>";
                }
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
