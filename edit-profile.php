<?php
// Start session to get logged-in user's ID
session_start();
$user_id = $_SESSION['userid']; // Assuming user_id is stored in session after login

// Database connection
$conn = mysqli_connect('localhost', 'root', '', 'watch_store');

// Check connection
if (!$conn) {
    die("Connection failed: " . mysqli_connect_error());
}

// Fetch current user details
$sql = "SELECT * FROM users WHERE UserID = $user_id";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    $user = mysqli_fetch_assoc($result);
} else {
    echo "No user found.";
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $phone = $_POST['phone'];
    $address = $_POST['address'];
    $password = $_POST['Password'];

    $update_sql = "UPDATE users SET Name='$name', Email='$email', Number='$phone', Address='$address' WHERE UserID=$user_id";

    if (mysqli_query($conn, $update_sql)) {
        echo "Profile updated successfully!";
        header("Location: profile.php"); // Redirect to profile page after update
    } else {
        echo "Error updating profile: " . mysqli_error($conn);
    }
}

// Close connection
mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Profile - Watch Store</title>
    <link rel="stylesheet" href="profile.css">
    <link rel="stylesheet" href="edit-profile.css">
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
            <h2>Edit Profile</h2>
            <form action="edit-profile.php" method="POST">
                <label for="name">Name:</label>
                <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($user['Name']); ?>" required>

                <label for="email">Email:</label>
                <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($user['Email']); ?>" required>

                <label for="phone">Phone:</label>
                <input type="text" id="phone" name="phone" value="<?php echo htmlspecialchars($user['Number']); ?>" required>

                <label for="address">Address:</label>
                <input type="text" id="address" name="address" value="<?php echo htmlspecialchars($user['Address']); ?>" required>

                <label for="address">Password:</label>
                <input type="text" id="address" name="password" value="<?php echo htmlspecialchars($user['Password']); ?>" required>

                <button type="submit" class="btn">Update Profile</button>
            </form>
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
