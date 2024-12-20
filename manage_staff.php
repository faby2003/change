<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin - Manage Staff</title>
    <link rel="stylesheet" href="admin.css">
    <style>
        /* CSS for styling the page */
        body {
            font-family: Arial, sans-serif;
            background-color: #f9f9f9;
            margin: 0;
            padding: 0;
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
            display: flex;
            margin: 0;
            padding: 0;
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

        .actions a {
            margin-right: 10px;
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

    // Fetch staff data
    $sql = "SELECT id, name, email, status FROM staff";
    $result = mysqli_query($con, $sql);

    if (!$result) {
        die("Error fetching staff data: " . mysqli_error($con));
    }

    if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['staff_id'], $_POST['action'])) {
        $staff_id = intval($_POST['staff_id']);
        $action = $_POST['action'] === 'activate' ? 'active' : 'inactive';

        $update_sql = "UPDATE staff SET status = '$action' WHERE id = $staff_id";
        mysqli_query($con, $update_sql);
        header("Location: " . $_SERVER['PHP_SELF']);
        exit;
    }
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
        <h2>Staff Management</h2>
        <a href="add_staff.php" class="btn mb-3">Add New Staff</a>

        <table>
            <thead>
                <tr>
                    <th>Staff ID</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Status</th>
                    <th>Actions</th>
                </tr>
            </thead>
            <tbody>
                <?php
                if (mysqli_num_rows($result) > 0) {
                    while ($row = mysqli_fetch_assoc($result)) {
                        echo "<tr>
                                <td>" . htmlspecialchars($row['id']) . "</td>
                                <td>" . htmlspecialchars($row['name']) . "</td>
                                <td>" . htmlspecialchars($row['email']) . "</td>
                                <td>" . htmlspecialchars($row['status']) . "</td>
                                <td class='actions'>
                                    <form method='POST' style='display:inline;'>
                                        <input type='hidden' name='staff_id' value='" . htmlspecialchars($row['id']) . "'>
                                        <button type='submit' name='action' value='activate' class='btn' ". ($row['status'] === 'active' ? 'disabled' : '') .">Activate</button>
                                    </form>
                                    <form method='POST' style='display:inline;'>
                                        <input type='hidden' name='staff_id' value='" . htmlspecialchars($row['id']) . "'>
                                        <button type='submit' name='action' value='deactivate' class='btn' ". ($row['status'] === 'inactive' ? 'disabled' : '') .">Deactivate</button>
                                    </form>
                                </td>
                              </tr>";
                    }
                } else {
                    echo "<tr><td colspan='5'>No staff members found.</td></tr>";
                }

                // Close the database connection
                mysqli_close($con);
                ?>
            </tbody>
        </table>
    </div>
</body>
</html>
