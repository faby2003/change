<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Watch Store - Available Watches</title>
    <link rel="stylesheet" href="usersproduct.css">
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

        .product-grid {
            display: flex;
            flex-wrap: wrap;
            gap: 20px;
        }

        .product-card {
            background-color: white;
            border: 1px solid #ddd;
            padding: 10px;
            text-align: center;
            width: 200px;
            border-radius: 8px;
            box-shadow: 0 0 5px rgba(0, 0, 0, 0.1);
        }

        .product-card img {
            max-width: 100px;
            height: auto;
            margin-bottom: 10px;
        }

        .product-card button {
            background-color: #333;
            color: white;
            border: none;
            padding: 5px 10px;
            cursor: pointer;
            border-radius: 4px;
        }

        .product-card button:hover {
            background-color: #555;
        }

        .out-of-stock {
            color: red;
            font-weight: bold;
        }

        .product-card button:disabled {
            background-color: #ccc;
            cursor: not-allowed;
        }

        form {
            margin-bottom: 20px;
        }

        input[type="text"], select, button {
            padding: 10px;
            margin-right: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        button {
            background-color: #333;
            color: white;
            border: none;
            cursor: pointer;
        }

        button:hover {
            background-color: #555;
        }

        select {
            width: auto;
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

    <div class="main">
        <h2>Available Watches</h2>
        <form method="GET" action="">
            <input type="text" name="search" placeholder="Search products..." value="<?php echo isset($_GET['search']) ? htmlspecialchars($_GET['search']) : ''; ?>">
            
            <select name="brand">
                <option value="">Select Brand</option>
                <?php
                // Fetch brands from the database
                $con = mysqli_connect("localhost", "root", "", "watch_store");
                if (!$con) {
                    die("DB not connected: " . mysqli_connect_error());
                }

                $sql_brands = "SELECT * FROM brand";
                $result_brands = mysqli_query($con, $sql_brands);
                
                while ($brand = mysqli_fetch_assoc($result_brands)) {
                    $selected = (isset($_GET['brand']) && $_GET['brand'] == $brand['brandid']) ? 'selected' : '';
                    echo "<option value='" . htmlspecialchars($brand['brandid']) . "' $selected>" . htmlspecialchars($brand['brandname']) . "</option>";
                }

                mysqli_close($con);
                ?>
            </select>

            <select name="sort">
                <option value="">Sort by</option>
                <option value="asc" <?php echo (isset($_GET['sort']) && $_GET['sort'] == 'asc') ? 'selected' : ''; ?>>Price Low to High</option>
                <option value="desc" <?php echo (isset($_GET['sort']) && $_GET['sort'] == 'desc') ? 'selected' : ''; ?>>Price High to Low</option>
            </select>

            <button type="submit">Apply</button>
        </form>

        <div class="product-grid">
    <?php
    $con = mysqli_connect("localhost", "root", "", "watch_store");

    if (!$con) {
        die("DB not connected: " . mysqli_connect_error());
    }

    $search = isset($_GET['search']) ? mysqli_real_escape_string($con, $_GET['search']) : '';
    $brand = isset($_GET['brand']) ? intval($_GET['brand']) : '';
    $sort = isset($_GET['sort']) ? $_GET['sort'] : '';

    $sql = "SELECT * FROM products WHERE model LIKE '%$search%' AND category='limited edition'";

    if ($brand) {
        $sql .= " AND `brand` = $brand";
    }

    if ($sort) {
        $sql .= " ORDER BY price " . ($sort === 'asc' ? 'ASC' : 'DESC');
    }

    $result = mysqli_query($con, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        while ($row = mysqli_fetch_assoc($result)) {
            $id = $row['productid'];
            $img = $row['image'];
            $price_inr = htmlspecialchars($row['price']);
            $description = htmlspecialchars($row['pdiscription']);
            // Truncate description for display
            $truncated_description = strlen($description) > 100 ? substr($description, 0, 100) . '...' : $description;

            echo "<div class='product-card'>";
            echo "<img src='./images/$img' alt='" . htmlspecialchars($row['model']) . "'>";
            echo "<h3>" . htmlspecialchars($row['model']) . "</h3>";
            echo "<p>₹" . number_format($price_inr, 2) . "</p>";
            echo "<a href='product_details.php?productid=$id'><button>Details</button></a>"; // Link to details page
            echo "</div>";
        }
    } else {
        echo "<p>No products available.</p>";
    }

    mysqli_close($con);
    ?>
</div>

    </div>

    <script>
        function showFullDescription(id, description) {
            const descriptionElement = document.getElementById(`description-${id}`);
            descriptionElement.innerHTML = `${description} <a href="#" onclick="hideDescription(${id})">Read Less</a>`;
        }

        function hideDescription(id) {
            const descriptionElement = document.getElementById(`description-${id}`);
            const truncatedDescription = descriptionElement.innerText.substring(0, 100) + '...';
            descriptionElement.innerHTML = `${truncatedDescription} <a href="#" onclick="showFullDescription(${id}, '${descriptionElement.innerText}')">Read More</a>`;
        }
    </script>
</body>
</html>
