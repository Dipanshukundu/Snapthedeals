<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Include the file containing database connection details
    include('server/connection.php');

    // Get form data
    $user_name = $_POST['user_name'];
    $user_email = $_POST['user_email'];
    $subject = $_POST['user_subject'];
    $user_message = $_POST['user_message'];

    // SQL query to insert data into the database table
    $sql = "INSERT INTO user_feedback (user_name, user_email, user_subject, user_message) VALUES ('$user_name', '$user_email', '$subject', '$user_message')";

    // Execute the query
    if (mysqli_query($conn, $sql)) {
        echo "Feedback submitted successfully";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }

    // Close the database connection
    mysqli_close($conn);
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Contact Us- SnapTheDeals</title>
    <link rel="stylesheet" href="style.css">
    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" />


</head>

<body>
    <section id="header">
        <a href="#"><video src="logo.mp4" class="logo"></a>
        <div>
            <ul id="navbar">
                <li><a href="index.php">Home</a></li>
                <li><a href="shop.php">Shop</a></li>
                <li><a href="blog.html">Blog</a></li>
                <li><a href="about.html">About</a></li>
                <li><a class="active" href="contact.php">Contact</a></li>
                <li><a href="cart.html"><i class="fa-solid fa-bag-shopping"></i></a></li>
                <li><a href="login.php"><i class="fa-solid fa-user"></i></a></li>
            </ul>
        </div>

        <script src="https://kit.fontawesome.com/0754380843.js" crossorigin="anonymous"></script>
    </section>

    <section id="page-header" class="about-header">
        <h2>#let's_talk</h2>
        <p>LEAVE A MESSAGE, We love to hear from you!</p>
    </section>

    <section id="contact-details" class="section-p1">
        <div class="details">
            <span>GET IN TOUCH</span>
            <h2>Visit one of our agency locations or contact us today</h2>
            <h3>Head Office</h3>
            <div>
                <li>
                    <i class="fal fa-map"></i>
                    <p>56 Glassford street glassglw G1</p>
                </li>
                <li>
                    <i class="far fa-envelope"></i>
                    <p>Contact@gmail.com</p>
                </li>
                <li>
                    <i class="fas fa-phone-alt"></i>
                    <p>+91-</p>
                </li>
                <li>
                    <i class="far fa-clock"></i>
                    <p>Monday to saturday 9:00am to 16:00pm</p>
                </li>
            </div>
        </div>

        <div class="map">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3428.8020967195293!2d76.7852623!3d30.752060049999997!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x390fed772dfa5023%3A0x11c327b9b839b694!2sDAV%20COLLEGE%2C%2010D%2C%20Sector%2010%2C%20Chandigarh%2C%20160011!5e0!3m2!1sen!2sin!4v1710506895964!5m2!1sen!2sin" width="600" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </div>
    </section>

    <section id="form-details">
        <form action="submit_feedback.php" method="POST">
            <span>LEAVE A MESSAGE</span>
            <h2>We love to hear from you </h2>
            <input type="text" name="user_name" placeholder="Your Name">
            <input type="text" name="user_email" placeholder="Email">
            <input type="text" name="user_subject" placeholder="Subject">
            <textarea name="user_message" id="" cols="30" rows="10" placeholder="Your Message"></textarea>
            <button class="normal" type="submit">Submit</button>
        </form>

        <div class="people">
            <div>
                <img src="img/people/1.png" alt="">
                <p><span>Dipanshu Kundu</span>Project Head  <br>Phone :+91-8572070013 <br>email:developer@gmail.com</p>
            </div>
            <div>
                <img src="img/people/1.png" alt="">
                <p><span>Akshay Verma</span>Report Creator <br>Phone : <br>email:</p>
            </div>
        </div>
    </section>

    <section id="newsletter" class="section-p1 section-m1">
        <div class="newstext">
            <h4>Sign Up For Newsletter</h4>
            <p>Get E-mail updates about our latest shop and <Span>special offers.</Span></p>
        </div>
        <div class="form">
            <input type="text" placeholder="Your email address">
            <button class="normal">Sign up</button>
        </div>
    </section>

    <footer class="section-p1">
        <div class="col">
            <a href="#"><video src="logo.mp4" class="logo"></a>
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

    <script src="script.js"></script>
</body>

</html>



