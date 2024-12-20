<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Staff Member</title>
    <link rel="stylesheet" href="adminhome.css">
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            padding: 20px;
        }

        .container {
            max-width: 600px;
            margin: auto;
            padding: 20px;
            background-color: white;
            border-radius: 8px;
            box-shadow: 0px 0px 10px rgba(0, 0, 0, 0.1);
        }

        h2 {
            text-align: center;
            color: #333;
        }

        label {
            display: block;
            margin-top: 15px;
            font-weight: bold;
        }

        input[type="text"],
        input[type="email"],
        input[type="password"] {
            width: 100%;
            padding: 10px;
            margin-top: 5px;
            border: 1px solid #ddd;
            border-radius: 4px;
        }

        .btn {
            display: inline-block;
            padding: 10px 20px;
            margin-top: 20px;
            background-color: #333;
            color: white;
            text-align: center;
            border: none;
            border-radius: 4px;
            cursor: pointer;
            width: 100%;
        }

        .btn:hover {
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
        <h2>Add New Staff Member</h2>
        <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            // Database connection
            $con = mysqli_connect("localhost", "root", "", "watch_store");

            if (!$con) {
                die("DB not connected: " . mysqli_connect_error());
            }

            // Collect form data
            $name = $_POST['name'];
            $email = $_POST['email'];
            $password = $_POST['password'];

            // Insert staff details into the `staff` table
            $staff_sql = "INSERT INTO staff (name, email) VALUES ('$name', '$email')";
            $staff_result = mysqli_query($con, $staff_sql);

            if ($staff_result) {
                // Insert login details into the `login` table with usertype = 2
                $login_sql = "INSERT INTO login (email, password, usertype) VALUES ('$email', '$password', 2)";
                $login_result = mysqli_query($con, $login_sql);

                if ($login_result) {
                    echo "<p style='color:green;'>Staff member added successfully!</p>";
                } else {
                    echo "<p style='color:red;'>Error adding login details: " . mysqli_error($con) . "</p>";
                }
            } else {
                echo "<p style='color:red;'>Error adding staff member: " . mysqli_error($con) . "</p>";
            }

            mysqli_close($con);
        }
        ?>

        <form method="POST" action="">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required>

            <button type="submit" class="btn">Add Staff Member</button>
        </form>
    </div>
</body>
</html>
