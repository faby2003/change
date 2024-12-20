<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Product - Watch Store</title>
    <link rel="stylesheet" href="adminhome.css">
    <link rel="stylesheet" href="addproduct.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
</head>
<body>
    <header>
        <nav class="navbar">
            <div class="logo">
                <h1>WatchStore Admin</h1>
            </div>
            <ul class="nav-links">
                <li><a href="adminhome.html">Dashboard</a></li>
                <li><a href="home.html">Logout</a></li>
            </ul>
        </nav>
    </header>

    <div class="main">
        <form action="" method="post" enctype="multipart/form-data">
            <h2>ADD PRODUCT</h2>
            <input class="inp1" type="text" placeholder="Enter Watch Model" name="model" required>
            <input class="inp1" type="text" placeholder="Enter Watch Price" name="price" required>
            <input class="inp1" type="text" placeholder="Enter Watch Quantity" name="qnty" required>
            <label for="brand">Select Brand:</label>
            <select class="inp1" name="brand" id="brand" required>
                <?php
                $connection = mysqli_connect("localhost", "root", "", "watch_store");

                if (!$connection) {
                    die("Database connection failed: " . mysqli_connect_error());
                }

                $brand_query = "SELECT * FROM brand";
                $brand_result = mysqli_query($connection, $brand_query);

                if ($brand_result && mysqli_num_rows($brand_result) > 0) {
                    while ($brand = mysqli_fetch_assoc($brand_result)) {
                        echo "<option value='" . $brand['brandname'] . "'>" . htmlspecialchars($brand['brandname']) . "</option>";
                    }
                } else {
                    echo "<option value=''>No Brands Available</option>";
                }

                mysqli_close($connection);
                ?>
            </select>
            <select class="inp1" name="category" id="brand" required>
                <?php
                $connection = mysqli_connect("localhost", "root", "", "watch_store");

                if (!$connection) {
                    die("Database connection failed: " . mysqli_connect_error());
                }

                $brand_query = "SELECT * FROM category";
                $brand_result = mysqli_query($connection, $brand_query);

                if ($brand_result && mysqli_num_rows($brand_result) > 0) {
                    while ($brand = mysqli_fetch_assoc($brand_result)) {
                        echo "<option value='" . $brand['title'] . "'>" . htmlspecialchars($brand['title']) . "</option>";
                    }
                } else {
                    echo "<option value=''>No Brands Available</option>";
                }

                mysqli_close($connection);
                ?>
            </select>
            <label for="image">Insert Watch Image:</label>
            <input class="inp1" type="file" name="image" required>
            <input class="inp1" type="text" placeholder="Enter Watch Details" name="detail" required>
            <input class="inp2" type="submit" value="Add Watch" name="addwatch">
        </form>
    </div>

    <?php
    if (isset($_POST['addwatch'])) {
        $model = $_POST['model'];
        $price = $_POST['price'];
        $qnty = $_POST['qnty'];
        $brand_id = $_POST['brand'];
        $category = $_POST['category'];
        $detail = $_POST['detail'];

        // Handling file upload
        $image = $_FILES['image']['name'];
        $target = "images/" . basename($image);
        if (move_uploaded_file($_FILES['image']['tmp_name'], $target)) {
            $connection = mysqli_connect("localhost", "root", "", "watch_store");

            if (!$connection) {
                die("Database connection failed: " . mysqli_connect_error());
            }

            $insert = "INSERT INTO products (model, price, quantity, image, pdiscription, brand, category) VALUES ('$model', '$price', '$qnty', '$image', '$detail', '$brand_id', '$category')";

            if (mysqli_query($connection, $insert)) {
                echo "<script>alert('Product added successfully!')</script>";
            } else {
                echo "<p>Error: " . mysqli_error($connection) . "</p>";
            }

            mysqli_close($connection);
        } else {
            echo "<p>Failed to upload image.</p>";
        }
    }
    ?>
</body>
</html>
