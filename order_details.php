<?php
// Include the database connection file
include('server/connection.php');

// Fetch data from the order_items table
$orderItemsQuery = "SELECT * FROM order_items";
$orderItemsResult = mysqli_query($conn, $orderItemsQuery);

// Close the database connection
mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Order Details</title>
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }

        th, td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        th {
            background-color: #f2f2f2;
        }
    </style>
</head>

<body>
    <h2>Order Items</h2>
    <table>
        <thead>
            <tr>
                <th>Item ID</th>
                <th>Order ID</th>
                <th>Product ID</th>
                <th>Product Name</th>
                <th>Product Image</th>
                <th>User ID</th>
                <th>Order Date</th>
            </tr>
        </thead>
        <tbody>
            <?php
            // Loop through order items data and display in table rows
            while ($row = mysqli_fetch_assoc($orderItemsResult)) {
                echo "<tr>";
                echo "<td>" . $row['item_id'] . "</td>";
                echo "<td>" . $row['order_id'] . "</td>";
                echo "<td>" . $row['product_id'] . "</td>";
                echo "<td>" . $row['product_name'] . "</td>";
                echo "<td>" . $row['product_image'] . "</td>";
                echo "<td>" . $row['user_id'] . "</td>";
                echo "<td>" . $row['order_date'] . "</td>";
                echo "</tr>";
            }
            ?>
        </tbody>
    </table>
</body>

</html>
