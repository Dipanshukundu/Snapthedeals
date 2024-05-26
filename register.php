<?php
// Include the connection file
include('server/connection.php');

// Function to validate user input
function validateInput($data) {
    $data = trim($data);
    $data = stripslashes($data);
    $data = htmlspecialchars($data);
    return $data;
}

// Check if the form is submitted
if(isset($_POST['register'])){
    // Retrieve and validate user input from the form
    $name = validateInput($_POST['name']);
    $email = validateInput($_POST['email']);
    $password = md5($_POST['password']); // Hash the password
    
    // Prepare SQL statement to check if email already exists
    $stmt = $conn->prepare("SELECT * FROM users WHERE user_email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    
    // Check if email already exists
    if($result->num_rows > 0) {
        echo "Error: Email already exists.";
    } else {
        // Prepare SQL statement to insert user details
        $stmt = $conn->prepare("INSERT INTO users (user_name, user_email, user_password) VALUES (?, ?, ?)");
        
        // Bind parameters
        $stmt->bind_param("sss", $name, $email, $password);
        
        // Execute statement
        if ($stmt->execute()) {
            echo "Registration successful. You can now login.";
        } else {
            echo "Error: " . $stmt->error;
        }
    }
    
    // Close statement and connection
    $stmt->close();
    $conn->close();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registration</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    
    <div class="container">
        <h2>Registration Form</h2>
        <form action="register.php" method="POST">
            <label for="name">Name:</label>
            <input type="text" id="name" name="name" required><br><br>
            
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required><br><br>
            
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required><br><br>

            <h5>Already have an account?<a href="login.php">Login Here</a></h5>
            
            <button type="submit" name="register">Register</button>
        </form>
    </div>

    <footer class="section-p1">
        <div class="col">
            <a href="#"><video src="logo.mp4"  class="logo"></a>
            <h4>Contact</h4>
            <p><strong>Address :</strong></p>
            <p><strong>Phone :</strong></p>
            <p><strong>Hours :</strong></p>
            <div class="follow">
                <h4>Follow us</h4>
                <div class="icon">
                    <i class="fab fa-facebook-f"></i>
                    <i class="fab fa-twitter"></i>
                    <i class="fab fa-instagram"></i>
                    <i class="fab fa-pinterest-p"></i>
                    <i class="fab fa-youtube"></i>
                </div>
            </div>
        </div>
        <div class="col">
            <h4>About</h4>
            <a href="#">About Us</a>
            <a href="#">Ddelivery Information</a>
            <a href="#">Privacy Policy</a>
            <a href="#">Terms & Conditions</a>
            <a href="#">Contact Us</a>
        </div>
        <div class="col">
            <h4>My Account</h4>
            <a href="#">Sign In</a>
            <a href="#">View cart</a>
            <a href="#">My Wishlist</a>
            <a href="#">Track My Order</a>
            <a href="#">Help</a>
        </div>

        <div class="col install">
            <h4>Install App</h4>
            <p>From App Store or Google play</p>
            <div class="row">
                <img src="img/pay/app.jpg" alt="">
                <img src="img/pay/play.jpg" alt="">
            </div>
            <p>Secured Payment Gateway</p>
            <img src="img/pay/pay.png" alt="">
        </div>
        <div class="copyright">

        </div>
    </footer>
</body>
</html>
