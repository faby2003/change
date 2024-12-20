<?php
$connection = mysqli_connect("localhost", "root", "", "watch_store");

if ($connection) {
    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        $name = $_POST['name'];
        $number = $_POST['MobileNo'];
        $email = $_POST['email'];
        $address = $_POST['address'];
        $password = $_POST['password'];

        $errors = [];

        // Basic validations
        if (!preg_match("/^[a-zA-Z\s]+$/", $name)) {
            $errors[] = "Invalid name.";
        }
        if (!preg_match("/^(\+91)?[789]\d{9}$/", $number)) {
            $errors[] = "Invalid mobile number.";
        }
        if (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
            $errors[] = "Invalid email.";
        }

        // Password validation
        if (strlen($password) < 8) {
            $errors[] = "Password must be at least 8 characters.";
        }
        if (!preg_match("/[A-Z]/", $password)) {
            $errors[] = "Password must contain at least one uppercase letter.";
        }
        if (!preg_match("/[a-z]/", $password)) {
            $errors[] = "Password must contain at least one lowercase letter.";
        }
        if (!preg_match("/[0-9]/", $password)) {
            $errors[] = "Password must contain at least one number.";
        }
        if (!preg_match("/[\W_]/", $password)) {
            $errors[] = "Password must contain at least one special character.";
        }

        if (empty($errors)) {
            $insert = "INSERT INTO `users` (`Name`, `Number`, `Email`, `Address`, `Password`) VALUES ('$name', '$number', '$email', '$address', '$password')";
            $insertlog = "INSERT INTO `login` (`password`, `usertype`, `email`) VALUES ('$password', '1', '$email')";

            $sql = mysqli_query($connection, $insert);
            $sqll = mysqli_query($connection, $insertlog);
            if ($sql && $sqll) {
                header('Location: login.php');
                exit();
            } else {
                $errors[] = "Registration failed.";
            }
        }
    }
} else {
    echo "Database connection failed.";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Register | Watch Store</title>
    <link rel="stylesheet" href="register.css">
    <link rel="stylesheet" href="home.css">
</head>
<body>
<nav>
        <h2>Watch Store</h2>
        <div class="nav-div">
            <a href="home.html">Home</a>
           
        </div>
    </nav>
    <main class="register-main">
        <div class="register-container">
            <div class="register-header">
                <a href="./login.html">
                </a>
                <h1>Create Your Account</h1>
            </div>
            <form class="register-form" action="register.php" method="post">
                <div class="input-group">
                    <input class="register-input" type="text" name="name" placeholder="Enter Your Name" required>
                </div>
                <div class="input-group">
                    <input class="register-input" type="number" name="MobileNo" placeholder="Enter Your Number" required>
                </div>
                <div class="input-group">
                    <input class="register-input" type="email" name="email" placeholder="Enter Your Email" required>
                </div>
                <div class="input-group">
                    <input class="register-input" type="text" name="address" placeholder="Enter Your Address" required>
                </div>
                <div class="input-group">
                    <input class="register-input" type="password" name="password" placeholder="Enter Password" required>
                </div>
                <input class="register-button" type="submit" name="submit" value="Register">  
            </form>
        </div>
    </main>

    <footer>
        <p>&copy; 2024 Watch Store. All rights reserved.</p>
    </footer>
</body>
</html>
