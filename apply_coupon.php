<?php
// Start the session
session_start();

// Check if the cart subtotal is set in the session
if(isset($_SESSION['cart_subtotal'])) {
    // Retrieve the coupon code from the POST request
    $couponCode = $_POST['coupon_code'];

    // Fetch the coupon details from the database and calculate the discount amount
    // Your code to fetch coupon details and calculate discount amount goes here

    // For demonstration, let's assume the discount amount is calculated and stored in $discountAmount variable
    $discountAmount = 10; // Example discount amount

    // Update the session with the discount amount
    $_SESSION['discount_amount'] = $discountAmount;

    // Return the discount amount to the client-side JavaScript for updating the total
    echo $discountAmount;
} else {
    // If cart subtotal is not set in the session, return an error message
    echo "Error: Cart subtotal is not set";
}
?>
