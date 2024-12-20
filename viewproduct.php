<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Home - Watch Store</title>
    <link rel="stylesheet" href="adminhome.css">
    <link rel="stylesheet" href="viewproduct.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
    <style>
        .card {
            margin-bottom: 20px;
            border: none; /* Remove border for a cleaner look */
            border-radius: 8px; /* Rounded corners */
            overflow: hidden; /* Ensure rounded corners work */
        }

        .card-img-top {
            height: 150px; /* Set a standard height */
            object-fit: contain; /* Maintain aspect ratio */
        }

        .card-body {
            background-color: rgba(0, 0, 0, 0.8); /* Dark background for text contrast */
            color: white; /* White text for better readability */
        }

        .nav-links {
            list-style: none; /* Remove bullet points */
            padding: 0; /* Remove padding */
        }

        .nav-links li {
            display: inline; /* Horizontal layout */
            margin-left: 20px; /* Space between links */
        }

        header {
            background-color: #333; /* Dark background for header */
            padding: 10px 0; /* Vertical padding */
        }

        .logo h1 {
            color: white; /* White text for logo */
            margin: 0; /* Remove default margin */
            font-size: 1.5rem; /* Larger font for logo */
        }
    </style>
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
<div class="main">]
<div class="container">
    <div class="row">
    <?php
$con = mysqli_connect("localhost", "root", "", "watch_store");

if (!$con) {
    die("DB not connected: " . mysqli_connect_error());
}

// Check if a delete request has been made
if ($_SERVER['REQUEST_METHOD'] == 'POST' && isset($_POST['deluser'])) {
    $productId = intval($_POST['deluser']); // Get the product ID and ensure it's an integer
    $deleteSql = "DELETE FROM `products` WHERE `productid` = $productId";

    if (mysqli_query($con, $deleteSql)) {
        echo "<script>
                alert('Product deleted successfully.');
                window.location.href = 'viewproduct.php';
              </script>";
                } else {
        echo "<div class='alert alert-danger'>Error deleting product: " . mysqli_error($con) . "</div>";
    }
}

$sql = "SELECT * FROM `products`";
$data = mysqli_query($con, $sql);

if ($data) {
    if (mysqli_num_rows($data) > 0) {
        while ($value = mysqli_fetch_assoc($data)) {
            $id = $value['productid'];
            $img = $value['image'];
            $description = htmlspecialchars($value['pdiscription']);
            // Truncate the description for display
            $truncated_description = strlen($description) > 100 ? substr($description, 0, 100) . '...' : $description;

            echo "<div class='col-md-4'>";
            echo "<div class='card'>";
            echo "<img class='card-img-top' src='./images/$img' alt='Product Image'>";
            echo "<div class='card-body'>";
            echo "<h5 class='card-title'>" . htmlspecialchars($value['model']) . "</h5>";
            echo "<p class='card-text'>Price: ₹" . htmlspecialchars($value['price']) . "</p>";
            echo "<p class='card-text'>Quantity: " . htmlspecialchars($value['quantity']) . "</p>";
            echo "<p class='card-text' id='description-$id'>$truncated_description <a href='#' onclick='showFullDescription($id, \"$description\")'>Read More</a></p>";
            echo "<form method='post' style='display:inline;'><button class='btn btn-danger' value='{$id}' name='deluser' type='submit'>DELETE</button></form>";
            echo "</div></div></div>";
        }
    } else {
        echo "<div class='col-12'>No products found.</div>";
    }
} else {
    echo "<div class='col-12'>Error: " . mysqli_error($con) . "</div>";
}
?>

        ?>
    </div>
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

<script src="https://code.jquery.com/jquery-3.2.1.slim.min.js" integrity="sha384-KJ3oAiT1cJ3I0TY2T3Hp3L7bX5p5cYy5k4p+SStm0yDq7frZhlrM6yVf1jB1Hh4M" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.11.0/umd/popper.min.js" integrity="sha384-IpY6H1AiIt1T/o6jX8CkW6S5J/10qPlV1z5YV8zPVN/rI4uF9h1Z1EU0y0s7A5g2" crossorigin="anonymous"></script>
<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8j3GfZLJj6hshlY5T12qF19Zl9zi+l0G5Ne+CrAiU4ZnE4hmJ" crossorigin="anonymous"></script>
</body>

</html>
