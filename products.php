<?php
// Include the file containing database connection details
include('server/connection.php');

// Fetch all products from the products table
$productQuery = "SELECT * FROM products";
$productResult = mysqli_query($conn, $productQuery);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Product Management</title>
    <link rel="stylesheet" href="style1.css">
    <!-- Add any additional styling if needed -->
</head>

<body>
    <header class="side menu">
        <h1>Admin</h1>
        <nav>
            <ul>
                <li><a href="admin_dashboard.php">Home</a></li>
                <li><a href="products.php">Products</a></li>
                <li><a href="#">Orders</a></li>
                <li><a href="users.php">Users</a></li>
                <li><a href="#">Settings</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <h1 class="Products">Product Management</h1>

        <!-- Buttons for View Products and Add Products -->
        <div class="button-container">
            <button onclick="window.location.href = 'products.php';">View Products</button>
            <button onclick="window.location.href = 'server/add_products.php';">Add Product</button>
        </div>

        <!-- Table to display product information -->
        <table id="product-table">
            <thead>
                <tr>
                    <th>Product ID</th>
                    <th>Product Name</th>
                    <th>Category</th>
                    <th>Description</th>
                    <th>Image</th>
                    <th>Price</th>
                    <th>Special Offer</th>
                    <th>Color</th>
                    <th>Edit</th>
                    <th>Delete</th>
                </tr>
            </thead>
            <tbody>
                <?php
                // Loop through each row of the result set
                while ($row = mysqli_fetch_assoc($productResult)) {
                    echo "<tr>";
                    echo "<td>" . $row['product_id'] . "</td>";
                    echo "<td>" . $row['product_name'] . "</td>";
                    echo "<td>" . $row['product_category'] . "</td>";
                    echo "<td>" . $row['product_description'] . "</td>";
                    echo "<td><img src='" . $row['product_image'] . "' alt='Product Image' style='width: 100px;'></td>";
                    echo "<td>$" . $row['product_price'] . "</td>";
                    echo "<td>" . ($row['product_special_offer'] == 1 ? "Yes" : "No") . "</td>";
                    echo "<td>" . $row['product_color'] . "</td>";
                    echo "<td><a href='edit_product.php?id=" . $row['product_id'] . "'>Edit</a></td>";
                    echo "<td><a href='delete_product.php?id=" . $row['product_id'] . "' onclick='return confirm(\"Are you sure you want to delete this product?\")'>Delete</a></td>";
                    echo "</tr>";
                }
                ?>
            </tbody>
        </table>
    </main>

    <!-- Additional content and scripts -->
</body>

</html>

<?php
// Close the database connection
mysqli_close($conn);
?>
