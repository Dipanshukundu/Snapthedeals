<?php
include 'server/connection.php'; // Include the connection file to establish a database connection

// Process form submission
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if the email is set and not empty
    if (isset($_POST["email"]) && !empty($_POST["email"])) {
        // Get the email address from the form and sanitize it
        $email = mysqli_real_escape_string($conn, $_POST["email"]);

        // Prepare and execute SQL query to insert the email into the subscription table
        $sql = "INSERT INTO subscription_table (user_email) VALUES ('$email')";
        if ($conn->query($sql) === TRUE) {
            echo "Thank you for subscribing!";
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo "Email address is required.";
    }
} else {
    echo "Invalid request.";
}

// Close the database connection
$conn->close();
?>
