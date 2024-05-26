<?php
session_start();

// Include the connection file
include('server/connection.php');

// Function to retrieve user ID from the database
function getUserIdFromDatabase($email) {
    global $conn; // Assuming $conn is your database connection variable
    $stmt = $conn->prepare("SELECT user_id FROM users WHERE user_email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    $user = $result->fetch_assoc();
    return $user['user_id'];
}

// Check if the form is submitted
if(isset($_POST['login'])){
    // Retrieve user input from the form
    $email = $_POST['email'];
    $password = md5($_POST['password']); // Hash the password

    // Prepare SQL statement to retrieve user details based on email
    $stmt = $conn->prepare("SELECT * FROM users WHERE user_email = ?");
    $stmt->bind_param("s", $email);
    $stmt->execute();
    $result = $stmt->get_result();
    
    // Check if user exists
    if($result->num_rows == 1) {
        // User found, fetch user details
        $user = $result->fetch_assoc();
        $user_id = $user['user_id']; // Retrieve user ID
        
        // Verify the password
        if ($user['user_password'] == $password) {
            // Set session variables
            $_SESSION['user_id'] = $user_id;
            $_SESSION['user_name'] = $user['user_name'];
            $_SESSION['user_email'] = $user['user_email'];
            $_SESSION['logged_in'] = true;

            // Redirect user based on user type
            if ($user['user_type'] === 'admin') {
                header('Location: admin_dashboard.php');
                exit();
            } else {
                header('Location: user_dashboard.php');
                exit();
            }
        } else {
            // Incorrect password, redirect back to login page with error message
            header('Location: login.php?error=Invalid Password');
            exit();
        }
    } else {
        // User not found, redirect back to login page with error message
        header('Location: login.php?error=User not found');
        exit();
    }
    
    // Close statement
    $stmt->close();
}

// Close connection
$conn->close();
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <section id="header">
        <a href="#"><video src="logo.mp4"  class="logo"></a>
        <div>
            <ul id="navbar">
                <li><a  href="index.php">Home</a></li>
                <li><a href="shop.php">Shop</a></li>
                <li><a  href="blog.html">Blog</a></li>
                <li><a href="about.html">About</a></li>
                <li><a href="contact.php">Contact</a></li>
                <li><a  href="cart.html"><i class="fa-solid fa-bag-shopping"></i></a></li>
                <li><a class="active" href="login.php"><i class="fa-solid fa-user"></i></a></li>
            </ul>
        
        <script src="https://kit.fontawesome.com/0754380843.js" crossorigin="anonymous"></script>
    </section>

    <div class="container">
        <h2>Login</h2>
        <form action="login.php" method="POST">
            <label for="email">Email:</label>
            <input type="email" id="email" name="email" required><br><br>
            
            <label for="password">Password:</label>
            <input type="password" id="password" name="password" required><br><br>
        
            
            <h5>Don't have an account? <a href="register.php">Click Here</a></h5>
            
            <button type="submit" name="login">Login</button>
        </form>

        <p class="error-message"><?php echo isset($_GET['error']) ? $_GET['error'] : ''; ?></p>
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
