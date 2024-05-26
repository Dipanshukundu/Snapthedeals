<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['add_to_cart'])) {
    // Include the file containing database connection details
    include('server/connection.php');

    // Get product ID from the form
    $product_id = $_POST['product_id'];

    // Retrieve product details from the database based on the product ID
    $query = "SELECT * FROM products WHERE product_id = '$product_id'";
    $result = mysqli_query($conn, $query);

    if ($result) {
        // Fetch product details
        $row = mysqli_fetch_assoc($result);

        // Insert product details into the order_items table
        $insert_query = "INSERT INTO order_items (product_id, product_name, product_image) 
                        VALUES ('{$row['product_id']}', '{$row['product_name']}', '{$row['product_image']}')";

        if (mysqli_query($conn, $insert_query)) {
            echo "Product added to cart successfully";
        } else {
            echo "Error: " . $insert_query . "<br>" . mysqli_error($conn);
        }
    } else {
        echo "Error: " . $query . "<br>" . mysqli_error($conn);
    }

    // Close the database connection
    mysqli_close($conn);
}
?>




<!DOCTYPE html>
<html lang="en">
<head>
    <title>Snap The Deals</title>
    <link rel="stylesheet" href="path/to/font-awesome/css/font-awesome.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <section id="header">
        <a href="#"><video src="logo.mp4"  class="logo"></video></a>
        <div>
            <ul id="navbar">
                <li><a href="index.php">Home</a></li>
                <li><a class="active" href="shop.php">Shop</a></li>
                <li><a href="blog.html">Blog</a></li>
                <li><a href="about.html">About</a></li>
                <li><a href="contact.php">Contact</a></li>
                <li><a href="cart.php"><i class="fa fa-shopping-bag"></i></a></li>
                <li><a href="login.php"><i class="fa fa-user"></i></a></li>
            </ul>
        </div>
        <div id="mobile">
            <ul>
                <li><a href="cart.html"><i class="fa fa-shopping-cart"></i></a></li> 
            </ul>
            <i id="bar" class="fa fa-outdent"></i>
        </div>
        <script src="https://kit.fontawesome.com/0754380843.js" crossorigin="anonymous"></script>
    </section>

    <section id="page-header">
        <h2>Super-value deals</h2>
        <p>Save More with Coupons & upto 70% off! </p>
    </section>

    <section id="product1" class="section-p1">
        <div class="pro-container">
            
                <?php
                // Include the file containing database connection details
                include('server/connection.php');

                // Start the session to store cart items
                session_start();

                // Function to add a product to the cart
                function addToCart($product_id) {
                    // Check if the product is already in the cart
                    if (isset($_SESSION['cart'][$product_id])) {
                        // Increment the quantity if the product is already in the cart
                        $_SESSION['cart'][$product_id]['quantity']++;
                    } else {
                        // Add the product to the cart with quantity 1
                        $_SESSION['cart'][$product_id] = array('quantity' => 1);
                    }
                }

                // Check if the cart button is clicked
                if (isset($_POST['add_to_cart'])) {
                    // Get the product ID from the clicked button
                    $product_id = $_POST['product_id'];

                    // Call the addToCart function with the product ID
                    addToCart($product_id);
                }

                // Query to fetch products from the database
                $sql = "SELECT * FROM products";
                $result = mysqli_query($conn, $sql);

                // Check if there are any products returned
                if (mysqli_num_rows($result) > 0) {
                    // Fetch all rows into an array
                    $products = [];
                    while ($row = mysqli_fetch_assoc($result)) {
                        $products[] = $row;
                    }

                    // Shuffle the array of products
                    shuffle($products);

                    // Output data of each row
                    foreach ($products as $row) {
                        ?>
                        
                        <div class="pro">
                            <a href="sproduct.php?id=<?php echo $row['product_id']; ?>">
                                <img src="<?php echo $row['product_image']; ?>" alt="<?php echo $row['product_name']; ?>">
                                <div class="des">
                                    <span><?php echo $row['product_color']; ?></span>
                                    <h5><?php echo $row['product_name']; ?></h5>
                                    <!-- Add other product details here -->
                                    <h4>$<?php echo $row['product_price']; ?></h4>
                                </div>
                            </a>
                            <!-- Form to submit product ID when cart button is clicked -->
                            <form method="POST">
                                <input type="hidden" name="product_id" value="<?php echo $row['product_id']; ?>">
                                <button type="submit" name="add_to_cart"><i class="fa fa-shopping-cart" aria-hidden="true"></i></button>
                            </form>
                        </div>

                        <?php
                    }
                } else {
                    echo "No products found";
                }

                // Close the database connection
                mysqli_close($conn);
                ?>
            </div>

    </section>

    <section id="pagination">
        <a href="#">1</a>
        <a href="#">2</a>
        <a href="#"><i class="fa fa-arrow-right"></i></a>
    </section>

    <section id="newsletter" class="section-p1 section-m1">
        <div class="newstext">
            <h4>Sign Up For Newsletter</h4>
            <p>Get E-mail updates about our latest shop and <span>special offers.</span></p>
        </div>
        <div class="form">
            <form action="subscribe.php" method="POST">
                <input type="email" name="user_email" placeholder="Your email address">
                <button type="submit" class="normal">Sign up</button>
            </form>
        </div>
    </section>


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

