<?php
// Include the file containing database connection details
include('server/connection.php');

// Perform any necessary database queries to fetch data for the dashboard

// For example, fetching total products count
$totalProductsQuery = "SELECT COUNT(*) AS total FROM products";
$totalProductsResult = mysqli_query($conn, $totalProductsQuery);
$totalProductsRow = mysqli_fetch_assoc($totalProductsResult);
$totalProducts = $totalProductsRow['total'];

// Similarly, fetch total orders count
$totalOrdersQuery = "SELECT COUNT(*) AS total FROM orders";
$totalOrdersResult = mysqli_query($conn, $totalOrdersQuery);
$totalOrdersRow = mysqli_fetch_assoc($totalOrdersResult);
$totalOrders = $totalOrdersRow['total'];

// Fetch total users count
$totalUsersQuery = "SELECT COUNT(*) AS total FROM users";
$totalUsersResult = mysqli_query($conn, $totalUsersQuery);
$totalUsersRow = mysqli_fetch_assoc($totalUsersResult);
$totalUsers = $totalUsersRow['total'];

// Fetch total subscribers count
$totalSubscribersQuery = "SELECT COUNT(*) AS total FROM subscription_table";
$totalSubscribersResult = mysqli_query($conn, $totalSubscribersQuery);
$totalSubscribersRow = mysqli_fetch_assoc($totalSubscribersResult);
$totalSubscribers = $totalSubscribersRow['total'];

// Close the database connection
mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <link rel="stylesheet" href="styles.css">
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
        <section class="s">
            <h2>Statistics</h2>
            <div class="stat-cards">
                <div class="stat-card">
                    <h3>Total Products</h3>
                    <p><?php echo $totalProducts; ?></p>
                </div>
                <div class="stat-card">
                    <h3>Total Orders</h3>
                    <p><?php echo $totalOrders; ?></p>
                </div>
                <div class="stat-card">
                    <h3>Total Users</h3>
                    <p><?php echo $totalUsers; ?></p>
                </div>
                <div class="stat-card">
                    <h3>Total Subscribers</h3>
                    <p><?php echo $totalSubscribers; ?></p>
                </div>
            </div>
        </section>

        <!-- Add other sections and content here -->
    </main>
</body>

</html>
