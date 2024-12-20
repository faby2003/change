<?php
session_start();
$user_id = $_SESSION['userid']; 

// Database connection
$conn = mysqli_connect('localhost', 'root', '', 'watch_store');

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

$sql = "SELECT * FROM users WHERE UserID = $user_id";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    $user = mysqli_fetch_assoc($result);
} else {
    echo "No user found.";
}

// Close connection
mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Profile - Watch Store</title>
    <link rel="stylesheet" href="profile.css">
    <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@400;500;700&display=swap" rel="stylesheet">
</head>

<body>
<nav class="navbar">
            <div class="logo">
                <h1>Watch Store</h1>
            </div>
            <ul class="nav-links">
                <li><a href="userhome.html">Home</a></li>
                <li><a href="cart.php">Cart</a></li>
                <li><a href="orders.php">Orders</a></li>
                <li><a href="profile.php">Profile</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </nav>
   
    <section class="profile-section">
        <div class="profile-container">
            <h2>User Profile</h2>
            <div class="profile-details">
                <!-- Remove Profile Picture -->
                <div class="user-info">
                    <p><strong>Name:</strong> <?php echo $user['Name']; ?></p>
                    <p><strong>Email:</strong> <?php echo $user['Email']; ?></p>
                    <p><strong>Phone:</strong> <?php echo $user['Number']; ?></p>
                    <p><strong>Address:</strong> <?php echo $user['Address']; ?></p>
                    <p><strong>Password:</strong> <?php echo "[ Hidden for Security ]"; ?></p>
                </div>
            </div>

            <div class="profile-actions">
                <a href="edit-profile.php" class="btn">Edit Profile</a>
                <a href="orders.php" class="btn">Order History</a>
            </div>
        </div>
    </section>

    <footer>
        <p>&copy; 2024 Watch Store. All rights reserved.</p>
        <div class="footer-links">
            <a href="privacy.php">Privacy Policy</a>
            <a href="terms.php">Terms of Service</a>
            <a href="support.php">Support</a>
        </div>
    </footer>

</body>

</html>
