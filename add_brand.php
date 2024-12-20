<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Brand</title>
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
            padding: 10px 0;
            margin-bottom: 20px;
        }
        .navbar {
            display: flex;
            justify-content: space-between;
            align-items: center;
            max-width: 1200px;
            margin: auto;
            padding: 0 20px;
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
            padding: 5px 10px;
            border-radius: 4px;
        }
        .nav-links a:hover {
            background-color: #555;
        }
        .container {
            width: 80%;
            max-width: 600px;
            margin: 20px auto;
            padding: 20px;
            background-color: white;
            border: 1px solid #ddd;
            border-radius: 8px;
        }
        h1 {
            text-align: center;
        }
        form {
            display: flex;
            flex-direction: column;
        }
        label {
            margin-bottom: 10px;
        }
        input[type="text"] {
            padding: 10px;
            margin-bottom: 20px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }
        button {
            background-color: #333;
            color: white;
            border: none;
            padding: 10px;
            cursor: pointer;
            border-radius: 4px;
        }
        button:hover {
            background-color: #555;
        }
    </style>
</head>
<body>

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

<div class="container">
    <h1>Add Brand</h1>
    <form method="post" action="">
        <label for="brandname">Brand Name:</label>
        <input type="text" id="brandname" name="brandname" required>
        <button type="submit" name="addbrand">Add Brand</button>
    </form>

    <?php
    if (isset($_POST['addbrand'])) {
        $brandname = $_POST['brandname'];

        $con = mysqli_connect("localhost", "root", "", "watch_store");

        if (!$con) {
            die("DB not connected: " . mysqli_connect_error());
        }

        $sql = "INSERT INTO brand (brandname) VALUES ('$brandname')";

        if (mysqli_query($con, $sql)) {
            echo "<p>Brand added successfully!</p>";
        } else {
            echo "<p>Error: " . mysqli_error($con) . "</p>";
        }

        mysqli_close($con);
    }
    ?>
</div>

</body>
</html>
