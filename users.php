<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Customer List</title>
    <link rel="stylesheet" href="style1.css"> <!-- Link to your CSS stylesheet -->
</head>

<body>
    <header class="side menu">
        <h1>Admin</h1>
        <nav>
            <ul>
                <li><a href="admin_dashboard.php">Home</a></li>
                <li><a href="products.php">Products</a></li>
                <li><a href="#">Orders</a></li>
                <li><a href="users.php">users</a></li>
                <li><a href="#">Settings</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </nav>
    </header>


    <main>
        <h1>Users List</h1>
        <div class="users-container">
            <table id="users">
                <thead>
                    <tr>
                        <th>User ID</th>
                        <th>Username</th>
                        <th>Email</th>
                    </tr>
                </thead>
                <tbody>
                    <?php
                    // Include the database connection file
                    include('server/connection.php');

                    // Fetch users whose usertype is 'user'
                    $userQuery = "SELECT * FROM users WHERE user_type = 'user'";
                    $result = $conn->query($userQuery);

                    // Check if there are any users
                    if ($result->num_rows > 0) {
                        // Output data of each user
                        while ($row = $result->fetch_assoc()) {
                            echo "<tr>";
                            echo "<td>" . $row["user_id"] . "</td>";
                            echo "<td>" . $row["user_name"] . "</td>";
                            echo "<td>" . $row["user_email"] . "</td>";
                            echo "</tr>";
                        }
                    } else {
                        echo "<tr><td colspan='3'>No users found.</td></tr>";
                    }

                    // Close the database connection
                    $conn->close();
                    ?>
                </tbody>
            </table>
        </div>
    </main>

    
</body>

</html>
