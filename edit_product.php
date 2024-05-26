<?php
// Include the database connection file
include('server/connection.php');

// Initialize a variable to store the message
$message = "";

// Check if form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if all required fields are set
    if (
        isset($_POST['product_id']) && !empty($_POST['product_id']) &&
        isset($_POST['product_name']) && !empty($_POST['product_name']) &&
        isset($_POST['product_category']) && !empty($_POST['product_category']) &&
        isset($_POST['product_description']) && !empty($_POST['product_description']) &&
        isset($_POST['product_image']) && !empty($_POST['product_image']) &&
        isset($_POST['product_price']) && !empty($_POST['product_price']) &&
        isset($_POST['product_special_offer']) && !empty($_POST['product_special_offer']) &&
        isset($_POST['product_color']) && !empty($_POST['product_color'])
    ) {
        // Sanitize input data
        $productId = $_POST['product_id'];
        $productName = $_POST['product_name'];
        $productCategory = $_POST['product_category'];
        $productDescription = $_POST['product_description'];
        $productImage = $_POST['product_image'];
        $productPrice = $_POST['product_price'];
        $productSpecialOffer = $_POST['product_special_offer'];
        $productColor = $_POST['product_color'];

        // Prepare and execute SQL query to update product details
        $updateQuery = "UPDATE products SET product_name=?, product_category=?, product_description=?, product_image=?, product_price=?, product_special_offer=?, product_color=? WHERE product_id=?";
        $stmt = $conn->prepare($updateQuery);
        $stmt->bind_param("ssssdisi", $productName, $productCategory, $productDescription, $productImage, $productPrice, $productSpecialOffer, $productColor, $productId);
        $stmt->execute();

        // Check if the update was successful
        if ($stmt->affected_rows > 0) {
            $message = "Product details updated successfully.";
        } else {
            $message = "Error updating product details.";
        }

        // Close statement
        $stmt->close();
    } else {
        $message = "Missing or empty fields in the form.";
    }
}

// Fetch product details from the database
if (isset($_GET['id']) && !empty($_GET['id'])) {
    $productId = $_GET['id'];

    // Fetch product details from the database
    $productQuery = "SELECT * FROM products WHERE product_id = ?";
    $stmt = $conn->prepare($productQuery);
    $stmt->bind_param("i", $productId);
    $stmt->execute();
    $result = $stmt->get_result();

    // Check if the product exists
    if ($result->num_rows === 1) {
        $row = $result->fetch_assoc();
    } else {
        $message = "No product found with the provided ID.";
    }

    // Close statement
    $stmt->close();
} else {
    $message = "Product ID is missing.";
}

// Close the database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Product</title>
    <link rel="stylesheet" href="style1.css">
</head>

<body>
    <header class="side menu">
        <h1>Admin</h1>
        <nav>
            <ul>
                <li><a href="admin_dashboard.php">Home</a></li>
                <li><a href="products.php">Products</a></li>
                <li><a href="#">Orders</a></li>
                <li><a href="customers.php">Customers</a></li>
                <li><a href="#">Settings</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <div class="container">
            <h1>Edit Product Details</h1>
            <?php if (!empty($message)) : ?>
                <p><?php echo $message; ?></p>
            <?php else : ?>
                <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
                    <input type="hidden" name="product_id" value="<?php echo $row['product_id']; ?>">

                    <label for="product_name">Product Name</label>
                    <input type="text" name="product_name" value="<?php echo $row['product_name']; ?>" required>

                    <label for="product_category">Category</label>
                    <input type="text" name="product_category" value="<?php echo $row['product_category']; ?>" required>

                    <label for="product_description">Description</label>
                    <textarea name="product_description" rows="4" required><?php echo $row['product_description']; ?></textarea>

                    <label for="product_image">Image</label>
                    <input type="text" name="product_image" value="<?php echo $row['product_image']; ?>" required>

                    <label for="product_price">Price</label>
                    <input type="number" name="product_price" value="<?php echo $row['product_price']; ?>" required>

                    <label for="product_special_offer">Special Offer</label>
                    <select name="product_special_offer" required>
                        <option value="0" <?php if ($row['product_special_offer'] == 0) echo "selected"; ?>>No</option>
                        <option value="1" <?php if ($row['product_special_offer'] == 1) echo "selected"; ?>>Yes</option>
                    </select>

                    <label for="product_color">Color</label>
                    <input type="text" name="product_color" value="<?php echo $row['product_color']; ?>" required>

                    <input type="submit" value="Update Product">
                </form>
            <?php endif; ?>
        </div>
    </main>
</body>

</html>
