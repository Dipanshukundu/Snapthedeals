<?php
// Start the session
session_start();

// Check if the user is logged in, if not redirect to login page
if (!isset($_SESSION["user_id"]) || empty($_SESSION["user_id"])) {
    header("Location: login.php");
    exit;
}

// Include the database connection file
include('server/connection.php');

// Fetch user details based on user_id from the session
$user_id = $_SESSION["user_id"];
$userQuery = "SELECT * FROM users WHERE user_id = ?";
$stmt = $conn->prepare($userQuery);
$stmt->bind_param("i", $user_id);
$stmt->execute();
$result = $stmt->get_result();

// Fetch user details
if ($result->num_rows === 1) {
    $user = $result->fetch_assoc();
} else {
    // If user not found, redirect to login page
    header("Location: login.php");
    exit;
}

// Close statement
$stmt->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>User Dashboard</title>
    <link rel="stylesheet" href="style1.css">
    <style>
        header h1{
            textwrao
        }
    </style>
</head>

<body>
    <header class="side menu" id="user_menu">
        <h1>Welcome, <?php echo $user['user_name']; ?></h1>
        <nav>
            <ul>
                <li><a href="user_dashboard.php">Dashboard</a></li>
                <li><a href="shop.php">Shop</a></li>
                <li><a href="profile.php">Profile</a></li>
                <li><a href="logout.php">Logout</a></li>
            </ul>
        </nav>
    </header>

    <main>
        <section id="Dash_user">
            <h2>Dashboard Overview</h2>
            <div>
                <a href="">Orders</a>
                <a href="">Settings</a>
                <a href="">Change Password</a>

            </div>
        </section>
    </main>
</body>

</html>
