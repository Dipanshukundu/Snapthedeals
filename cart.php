<?php
session_start(); // Start the session

// Include the file containing database connection details
include('server/connection.php');

// Initialize variables to store subtotal and total
$subtotal = 0;

// Query to fetch cart items from the database
$sql = "SELECT oi.*, p.product_price FROM order_items oi 
    INNER JOIN products p ON oi.product_id = p.product_id";
$result = mysqli_query($conn, $sql);

// Check if there are any cart items returned
if (mysqli_num_rows($result) > 0) {
    // Loop through each cart item and calculate the subtotal
    while ($row = mysqli_fetch_assoc($result)) {
        // Calculate the subtotal by adding the price of each item
        $subtotal += $row['product_price'] * $row['quantity'];
    }
}

// Store subtotal in session
$_SESSION['cart_subtotal'] = $subtotal;

// Close the database connection
mysqli_close($conn);
?>


<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cart</title>
    <script>
        function updateSubtotal(input, price) {
            // Get the quantity value
            var quantity = input.value;

            // Calculate the new subtotal
            var subtotal = price * quantity;

            // Update the subtotal display
            var productId = input.getAttribute('data-product-id');
            document.getElementById('subtotal_' + productId).innerText = '$' + subtotal.toFixed(2);

            // Calculate and update the total
            var total = 0;
            var subtotals = document.querySelectorAll('[id^="subtotal_"]');
            subtotals.forEach(function (subtotalElement) {
                total += parseFloat(subtotalElement.innerText.replace('$', ''));
            });
            document.getElementById('cart-subtotal').innerText = '$' + total.toFixed(2);
            document.getElementById('cart-total').innerText = '$' + total.toFixed(2);
        }

        function removeItem(productId) {
            // Send an AJAX request to remove_item.php
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "remove_item.php", true);
            xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhr.onreadystatechange = function() {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    // Check if the removal was successful
                    if (xhr.responseText.trim() === "Item removed successfully") {
                        // Reload the current page to reflect the changes
                        window.location.reload();
                    } else {
                        // Handle errors if any
                        console.error("Error: " + xhr.responseText);
                    }
                }
            };
            // Send the product_id as a parameter
            xhr.send("product_id=" + productId);
        }

        function applyCoupon() {
            // Get the coupon code from the input field
            var couponCode = document.getElementById("couponCode").value;

            // Send an AJAX request to apply_coupon.php
            var xhr = new XMLHttpRequest();
            xhr.open("POST", "apply_coupon.php", true);
            xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
            xhr.onreadystatechange = function() {
                if (xhr.readyState == 4 && xhr.status == 200) {
                    // Update the cart total if coupon applied successfully
                    updateTotal();
                }
            };
            // Send the coupon code as a parameter
            xhr.send("coupon_code=" + couponCode);
        }

        function proceedToCheckout() {
            // Redirect the user to the page where they can enter delivery details
            windows.location.href = "store_delivery_details.php";
        }


        function updateTotal() {
            // Calculate the total after applying the coupon
            // Fetch the current subtotal
            var subtotal = parseFloat(document.getElementById("cart-subtotal").innerText.replace('$', ''));
            // Get the discount amount from the server if applicable
            var discountAmount = 0; // You need to implement this in apply_coupon.php
            // Calculate the total
            var total = subtotal - discountAmount;

            // Update the total display
            document.getElementById("cart-total").innerText = "$" + total.toFixed(2);
        }
    </script>

    <link rel="stylesheet" href="https://pro.fontawesome.com/releases/v5.10.0/css/all.css" />
    <link rel="stylesheet" href="style.css">

</head>

<body>
    <section id="header">
        <a href="#"><video src="logo.mp4" class="logo"></video></a>
        <div>
            <ul id="navbar">
                <li><a href="index.php">Home</a></li>
                <li><a href="shop.php">Shop</a></li>
                <li><a href="blog.html">Blog</a></li>
                <li><a href="about.html">About</a></li>
                <li><a href="contact.php">Contact</a></li>
                <li><a class="active" href="cart.html"><i class="fa-solid fa-bag-shopping"></i></a></li>
                <li><a href="login.php"><i class="fa-solid fa-user"></i></a></li>
            </ul>

            <script src="https://kit.fontawesome.com/0754380843.js" crossorigin="anonymous"></script>
        </div>
    </section>

    <section id="cart" class="section-p1">
        <table width="100%">
            <thead>
                <tr>
                    <th>Remove</th>
                    <th>Image</th>
                    <th>Product</th>
                    <th>Price</th>
                    <th>Quantity</th>
                    <th>Subtotal</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Include the file containing database connection details
                include('server/connection.php');

                // Initialize variables to store subtotal and total
                $subtotal = 0;

                // Query to fetch cart items from the database
                $sql = "SELECT oi.*, p.product_price FROM order_items oi 
                    INNER JOIN products p ON oi.product_id = p.product_id";
                $result = mysqli_query($conn, $sql);

                // Check if there are any cart items returned
                if (mysqli_num_rows($result) > 0) {
                    // Loop through each cart item and calculate the subtotal
                    while ($row = mysqli_fetch_assoc($result)) {
                        // Calculate the subtotal by adding the price of each item
                        $subtotal += $row['product_price'] * $row['quantity'];

                        // Display the cart items in the table rows
                        echo "<tr id='row_" . $row['product_id'] . "'>";
                        echo "<td><a href='#' onclick='removeItem(" . $row['product_id'] . ")'><i class='far fa-times-circle'></i></a></td>";
                        echo "<td><img src='" . $row['product_image'] . "' alt=''></td>";
                        echo "<td>" . $row['product_name'] . "</td>";
                        echo "<td>$" . $row['product_price'] . "</td>"; // Display the price
                        echo "<td><input type='number' min='1' value='" . $row['quantity'] . "' data-product-id='" . $row['product_id'] . "' oninput='updateSubtotal(this, " . $row['product_price'] . ")'></td>";
                        echo "<td id='subtotal_" . $row['product_id'] . "'>$" . ($row['product_price'] * $row['quantity']) . "</td>";
                        echo "</tr>";
                    }
                } else {
                    // If no cart items found, display a message
                    echo "<tr><td colspan='6'>No items in the cart</td></tr>";
                }

                // Close the database connection
                mysqli_close($conn);
                ?>
            </tbody>
        </table>
    </section>

    <section id="cart-add" class="section-p1">
    <!-- Coupon input and apply button -->
    <div id="coupon">
        <h3>Apply coupon</h3>
        <div>
            <input type="text" id="couponCode" placeholder="Enter your coupon">
            <button class="normal" onclick="applyCoupon()">Apply</button> <!-- Link the button to the applyCoupon() function -->
        </div>
    </div>
    <!-- Cart total table -->
    <div id="subtotal">
        <h3>Cart total</h3>
        <table>
            <tr>
                <td>Cart subtotal</td>
                <td id="cart-subtotal">$<?php echo isset($_SESSION['cart_subtotal']) ? $_SESSION['cart_subtotal'] : ''; ?></td> <!-- Display the original subtotal here -->
            </tr>
            <tr>
                <td>Discount</td>
                <td id="cart-discount">$<?php echo isset($discountAmount) ? $discountAmount : ''; ?></td> <!-- Display the discount amount here -->
            </tr>
            <tr>
                <td><strong>Total</strong></td>
                <td><strong id="cart-total">$<?php echo isset($_SESSION['cart_total']) ? $_SESSION['cart_total'] : ''; ?></strong></td> <!-- Display the discounted total here -->
            </tr>
        </table>
        <!-- Proceed to Checkout button with updated price -->
        <button class="normal" onclick="proceedToCheckout()">Proceed to checkout ($<?php echo isset($_SESSION['cart_total']) ? $_SESSION['cart_total'] : ''; ?>)</button>
    </div>
</section>

<script>
    function applyCoupon() {
        // Get the coupon code from the input field
        var couponCode = document.getElementById("couponCode").value;

        // Send an AJAX request to apply_coupon.php
        var xhr = new XMLHttpRequest();
        xhr.open("POST", "apply_coupon.php", true);
        xhr.setRequestHeader("Content-type", "application/x-www-form-urlencoded");
        xhr.onreadystatechange = function() {
            if (xhr.readyState == 4 && xhr.status == 200) {
                // Update the discount and total amounts on the page
                document.getElementById("cart-discount").innerText = "$" + xhr.responseText;
                updateTotal();
            }
        };
        // Send the coupon code as a parameter
        xhr.send("coupon_code=" + couponCode);
    }

    function updateTotal() {
        // Fetch the current subtotal and discount amounts
        var subtotal = parseFloat(document.getElementById("cart-subtotal").innerText.replace('$', ''));
        var discountAmount = parseFloat(document.getElementById("cart-discount").innerText.replace('$', ''));

        // Calculate the total
        var total = subtotal - discountAmount;

        // Update the total display
        document.getElementById("cart-total").innerText = "$" + total.toFixed(2);
    }

    function proceedToCheckout() {
        // Implement the logic to proceed to checkout
        // Redirect the user to the checkout page or perform any other necessary actions
        window.location.href = "checkout.php";
    }
</script>




    <footer id="footer" class="section-p1">
        <div class="col">
            <a href="#"><video src="logo.mp4" class="logo"></video></a>
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
