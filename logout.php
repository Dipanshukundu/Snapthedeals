<?php
// Start the session
session_start();

// Include the connection file
include('server/connection.php');

// Delete the user's entry from the active_user table if logged in
if(isset($_SESSION['user_id'])) {
    $userId = $_SESSION['user_id'];
    $deleteQuery = "DELETE FROM active_user WHERE user_id = ?";
    $stmt = $conn->prepare($deleteQuery);
    $stmt->bind_param("i", $userId);
    $stmt->execute();
    $stmt->close();
}

// Unset all of the session variables
$_SESSION = array();

// Destroy the session
session_destroy();

// Close the database connection
$conn->close();

// Redirect the user to the login page
header("Location: login.php");
exit;
?>
