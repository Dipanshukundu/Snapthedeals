<?php
// Include the file containing database connection details
include('server/connection.php');

// Check if the product_id is set in the POST request
if(isset($_POST['product_id'])) {
    // Sanitize the input to prevent SQL injection
    $productId = mysqli_real_escape_string($conn, $_POST['product_id']);

    // Query to remove the item from the order_items table
    $sql = "DELETE FROM order_items WHERE product_id = '$productId'";
    
    // Execute the query
    if(mysqli_query($conn, $sql)) {
        // Item removed successfully
        echo "Item removed successfully";
    } else {
        // Error handling if deletion fails
        echo "Error: " . mysqli_error($conn);
    }
} else {
    // If product_id is not set in the POST request
    echo "Product ID is not set";
}

// Close the database connection
mysqli_close($conn);
?>
