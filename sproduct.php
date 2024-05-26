<?php
// Include the file containing database connection details
include('server/connection.php');

// Check if product ID is provided in the URL
if(isset($_GET['id'])) {
    $product_id = $_GET['id'];
    
    // Query to fetch product details from the database based on product ID
    $sql = "SELECT * FROM products WHERE product_id = $product_id";
    $result = mysqli_query($conn, $sql);
    
    // Check if the product exists
    if(mysqli_num_rows($result) > 0) {
        $product = mysqli_fetch_assoc($result);
    } else {
        echo "Product not found";
    }
} else {
    echo "Product ID not provided";
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <link rel="stylesheet" href="style.css">
    <title><?php echo $product['product_name']; ?></title>
    <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
</head>
<body>
    <section id="header">
        <a href="#"><video src="logo.mp4"  class="logo"></video></a>
        <div>
            <ul id="navbar">
                <li><a href="index.html">Home</a></li>
                <li><a class="active" href="shop.html">Shop</a></li>
                <li><a href="blog.html">Blog</a></li>
                <li><a href="about.html">About</a></li>
                <li><a href="contact.html">Contact</a></li>
                <li><a href="cart.html"><i class="fa-solid fa-bag-shopping"></i></a></li>
                <li><a href="login.php"><i class="fa-solid fa-user"></i></a></li>
            </ul>
        </div>
        <div id="mobile">
            <li><a href="cart.html"><i class="fa-solid fa-bag-shopping"></i></a></li> 
            <i id="bar" class="fa-solid fa-outdent"></i>
        </div>
        <script src="https://kit.fontawesome.com/0754380843.js" crossorigin="anonymous"></script>
    </section>

    <section id="prodetails" class="section-p1">
        <div class="single-pro-image">
            <img src="<?php echo $product['product_image']; ?>" width=100% id="main-img">
            <div class="small-img-group">
                <div class="small-img-col">
                    <img src="<?php echo $product['product_image']; ?>" width=100% class="small-img">
                </div>
                <div class="small-img-col">
                    <img src="<?php echo $product['product_image2']; ?>" width=100% class="small-img">
                </div>
                <div class="small-img-col">
                    <img src="<?php echo $product['product_image3']; ?>" width=100% class="small-img">
                </div>
                <div class="small-img-col">
                    <img src="<?php echo $product['product_image4']; ?>" width=100% class="small-img">
                </div>
            </div>
        </div>

        <div class="single-pro-details">
            <h6>Home / <?php echo $product['product_category']; ?></h6>
            <h4><?php echo $product['product_name']; ?></h4>
            <h2>$<?php echo $product['product_price']; ?></h2>
            <select>
                <option>Select size</option>
                <option>S</option>
                <option>M</option>
                <option>L</option>
                <option>XL</option>
                <option>XXL</option>
            </select>
            <input type="number" value="1">
            <button class="normal">Add to Cart</button>
            <h4>Product Details</h4>
            <span><?php echo $product['product_description']; ?></span>
        </div>
    </section>

    <section id="newsletter" class="section-p1 section-m1">
        <div class="newstext">
            <h4>Sign Up For Newsletter</h4>
            <p>Get E-mail updates about our latest shop and <span>special offers.</span></p>
        </div>
        <div class="form">
            <input type="text" placeholder="Your email address">
            <button class="normal">Sign up</button>
        </div>
    </section>

    <footer class="section-p1">
        <div class="col">
            <a href="#"><video src="logo.mp4"  class="logo"></video></a>
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
            <a href="#">Delivery Information</a>
            <a href="#">Privacy Policy</a>
            <a href="#">Terms & Conditions</a>
            <a href="#">Contact Us</a>
        </div>
        <div class="col">
            <h4>My Account</h4>
            <a href="#">Sign In</a>
            <a href="#">View Cart</a>
            <a href="#">My Wishlist</a>
            <a href="#">Track My Order</a>
            <a href="#">Help</a>
        </div>

        <div class="col install">
            <h4>Install App</h4>
            <p>From App Store or Google Play</p>
            <div class="row">
                <img src="img/pay/app.jpg" alt="">
                <img src="img/pay/play.jpg" alt="">
            </div>
            <p>Secured Payment Gateway</p>
            <img src="img/pay/pay.png" alt="">
        </div>
        <div class="copyright">
            &copy; <?php echo date("Y"); ?> Snap The Deals. All rights reserved.
        </div>
    </footer>
    <script>
        var MainImg = document.getElementById("main-img");
        var smallimg = document.getElementsByClassName("small-img");

        smallimg[0].onclick = function(){
            MainImg.src = smallimg[0].src;
        }

        smallimg[1].onclick = function(){
            MainImg.src = smallimg[1].src;
        }

        smallimg[2].onclick = function(){
            MainImg.src = smallimg[2].src;
        }

        smallimg[3].onclick = function(){
            MainImg.src = smallimg[3].src;
        }
    </script>

    <script src="script.js"></script>

    <script>
       
