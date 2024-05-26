<?php
// Start the session
session_start();

// Include the file containing database connection details
include('server/connection.php');

// Assuming you receive the coupon code via POST request
$couponCode = $_POST['coupon_code'];

// Query to check if the coupon code exists and get its details
$sql = "SELECT * FROM coupons WHERE coupon_code = '$couponCode'";
$result = mysqli_query($conn, $sql);

if (mysqli_num_rows($result) > 0) {
    // Coupon code found, fetch its details
    $coupon = mysqli_fetch_assoc($result);

    // Calculate the discount amount based on coupon rules
    // For example, let's say the discount is 10% off the cart subtotal
    $discountPercent = $coupon['discount_percent'] / 100;
    
    // Fetch the current subtotal from the cart, if it's already stored in session
    $subtotal = isset($_SESSION['cart_subtotal']) ? $_SESSION['cart_subtotal'] : 0;

    // Calculate the discount amount
    $discountAmount = $subtotal * $discountPercent;

    // Update the cart total in session by deducting the discount amount
    $_SESSION['cart_total'] = $subtotal - $discountAmount;

    // Return the discount amount to the client-side JavaScript for updating the total
    echo $discountAmount;
} else {
    // Coupon code not found or invalid, return error message to client-side JavaScript
    echo "Invalid coupon code";
}

// Close the database connection
mysqli_close($conn);
?>
