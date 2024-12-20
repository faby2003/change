<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Manage Brands</title>
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
            max-width: 1200px;
            margin: 20px auto;
            padding: 20px;
            background-color: white;
            border: 1px solid #ddd;
            border-radius: 8px;
        }
        h1 {
            text-align: center;
        }
        table {
            width: 100%;
            border-collapse: collapse;
            margin: 20px 0;
        }
        table, th, td {
            border: 1px solid #ddd;
        }
        th, td {
            padding: 10px;
            text-align: left;
        }
        th {
            background-color: #f4f4f4;
        }
        button {
            background-color: #333;
            color: white;
            border: none;
            padding: 5px 10px;
            cursor: pointer;
            border-radius: 4px;
        }
        button:hover {
            background-color: #555;
        }
        .update-form {
            margin: 20px 0;
        }
        .update-form input[type="text"] {
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            margin-right: 10px;
        }
        .name{
            font-family:Verdana, Geneva, Tahoma, sans-serif;
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
    <h1>Manage Brands</h1>
    
    <?php
    $con = mysqli_connect("localhost", "root", "", "watch_store");

    if (!$con) {
        die("DB not connected: " . mysqli_connect_error());
    }

    if (isset($_POST['delete'])) {
        $id = $_POST['delete'];
        $sql = "DELETE FROM brand WHERE brandid = $id";
        if (mysqli_query($con, $sql)) {
            echo "<p>Brand deleted successfully!</p>";
        } else {
            echo "<p>Error: " . mysqli_error($con) . "</p>";
        }
    }

    if (isset($_POST['update'])) {
        $id = $_POST['id'];
        $brandname = $_POST['brandname'];
        $sql = "UPDATE brand SET brandname = '$brandname' WHERE brandid = $id";
        if (mysqli_query($con, $sql)) {
            echo "<p>Brand updated successfully!</p>";
        } else {
            echo "<p>Error: " . mysqli_error($con) . "</p>";
        }
    }

    $sql = "SELECT * FROM brand";
    $result = mysqli_query($con, $sql);

    if ($result && mysqli_num_rows($result) > 0) {
        echo "<table>";
        echo "<tr>
                <th>ID</th>
                <th>Brand Name</th>
                <th>Actions</th>
              </tr>";

        while ($row = mysqli_fetch_assoc($result)) {
            echo "<tr>";
            echo "<td>" . htmlspecialchars($row['brandid']) . "</td>";
            echo "<td class='name'>" . htmlspecialchars($row['brandname']) . "</td>";
            echo "<td>
                    <form method='post' style='display:inline;'>
                        <input type='hidden' name='delete' value='" . htmlspecialchars($row['brandid']) . "'>
                        <button type='submit'>Delete</button>
                    </form>
                    <form method='post' style='display:inline;'>
                        <input type='hidden' name='id' value='" . htmlspecialchars($row['brandid']) . "'>
                        <input type='text' name='brandname' value='" . htmlspecialchars($row['brandname']) . "' required>
                        <button type='submit' name='update'>Update</button>
                    </form>
                  </td>";
            echo "</tr>";
        }

        echo "</table>";
    } else {
        echo "<p>No brands found.</p>";
    }

    mysqli_close($con);
    ?>
</div>

</body>
</html>
