<?php
session_start();

// Check if user is logged in
if (!isset($_SESSION['logged_in']) || $_SESSION['logged_in'] !== true) {
    // Redirect user to login page if not logged in
    header('Location: login.php');
    exit;
}

// Display user's information
$user_id = $_SESSION['user_id'];
$user_name = $_SESSION['user_name'];
$user_email = $_SESSION['user_email'];
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>My Account</title>
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <header>
        <h1>Welcome, <?php echo $user_name; ?>!</h1>
    </header>

    <main>
        <section>
            <h2>User Information</h2>
            <p>User ID: <?php echo $user_id; ?></p>
            <p>Email: <?php echo $user_email; ?></p>
        </section>

        <!-- Add more sections or functionalities as needed -->
    </main>

    <footer>
        <p>Footer content here</p>
    </footer>
</body>
</html>
