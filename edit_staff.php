<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Staff Member</title>
    <link rel="stylesheet" href="admin.css">
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
    <div class="container">
        <h2>Edit Staff Member</h2>

        <?php
        if (isset($_GET['staff_id'])) {
            $staff_id = $_GET['staff_id'];

            // Connect to the database
            $con = mysqli_connect("localhost", "root", "", "watch_store");

            if (!$con) {
                die("DB not connected: " . mysqli_connect_error());
            }

            // Fetch current staff information
            $staff_sql = "SELECT staff.name, staff.email, login.password 
                          FROM staff 
                          JOIN login ON staff.email = login.email 
                          WHERE staff.id = $staff_id";
            $result = mysqli_query($con, $staff_sql);

            if ($result && mysqli_num_rows($result) > 0) {
                $staff = mysqli_fetch_assoc($result);
            } else {
                echo "<p style='color:red;'>Staff member not found.</p>";
                exit();
            }

            // Update staff information upon form submission
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                $name = $_POST['name'];
                $email = $_POST['email'];
                $password = $_POST['password'];

                // Update staff details
                $update_staff_sql = "UPDATE staff SET name = '$name', email = '$email' WHERE id = $staff_id";
                $update_login_sql = "UPDATE login SET email = '$email', password = '$password' WHERE email = '{$staff['email']}'";

                $staff_result = mysqli_query($con, $update_staff_sql);
                $login_result = mysqli_query($con, $update_login_sql);

                if ($staff_result && $login_result) {
                    echo "<p style='color:green;'>Staff member updated successfully!</p>";
                } else {
                    echo "<p style='color:red;'>Error updating staff member: " . mysqli_error($con) . "</p>";
                }

                // Refresh the staff data to show updated values
                $result = mysqli_query($con, $staff_sql);
                $staff = mysqli_fetch_assoc($result);
            }

            mysqli_close($con);
        } else {
            echo "<p style='color:red;'>No staff member specified.</p>";
            exit();
        }
        ?>

        <form method="POST" action="">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($staff['name']); ?>" required>

            <label for="email">Email:</label>
            <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($staff['email']); ?>" required>

            <label for="password">Password:</label>
            <input type="password" id="password" name="password" value="<?php echo htmlspecialchars($staff['password']); ?>" required>

            <button type="submit" class="btn">Update Staff Member</button>
        </form>
    </div>
</body>
</html>
