<?php
// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Include the file containing database connection details
    include('server/connection.php');

    // Get form data
    $user_name = $_POST['user_name'];
    $user_email = $_POST['user_email'];
    $subject = $_POST['user_subject'];
    $user_message = $_POST['user_message'];

    // SQL query to insert data into the database table
    $sql = "INSERT INTO user_feedback (user_name, user_email, user_subject, user_message) VALUES ('$user_name', '$user_email', '$subject', '$user_message')";

    // Execute the query
    if (mysqli_query($conn, $sql)) {
        echo "Feedback submitted successfully";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }

    // Close the database connection
    mysqli_close($conn);
}
?>
