<?php
// Include the database connection file
include('server/connection.php');

// Function to sanitize user inputs
function sanitizeInput($input) {
    // Remove leading and trailing whitespace
    $input = trim($input);
    // Remove backslashes
    $input = stripslashes($input);
    // Convert special characters to HTML entities
    $input = htmlspecialchars($input);
    return $input;
}

// Initialize variables to store form data and error messages
$address = $contact_name = $contact_email = $contact_phone = "";
$error = "";

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Sanitize and validate form inputs
    $address = sanitizeInput($_POST['address']);
    $contact_name = sanitizeInput($_POST['contact_name']);
    $contact_email = sanitizeInput($_POST['contact_email']);
    $contact_phone = sanitizeInput($_POST['contact_phone']);

    // Validate email format
    if (!filter_var($contact_email, FILTER_VALIDATE_EMAIL)) {
        $error = "Invalid email format.";
    } else {
        // Prepare SQL query with prepared statement
        $sql = "INSERT INTO delivery_details (address, contact_name, contact_email, contact_phone) 
                VALUES (?, ?, ?, ?)";

        // Prepare the statement
        $stmt = mysqli_prepare($conn, $sql);

        // Bind parameters to the statement
        mysqli_stmt_bind_param($stmt, "ssss", $address, $contact_name, $contact_email, $contact_phone);

        // Execute the statement
        if (mysqli_stmt_execute($stmt)) {
            echo "Delivery details stored successfully.";
            // Reset form inputs after successful submission
            $address = $contact_name = $contact_email = $contact_phone = "";
        } else {
            $error = "Error: " . $sql . "<br>" . mysqli_error($conn);
        }

        // Close the statement
        mysqli_stmt_close($stmt);
    }
}

// Close the database connection
mysqli_close($conn);
?>

<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Delivery Details</title>
    <link rel="stylesheet" href="style1.css">
</head>

<body>
    <div class="delivery_form">
        <h2>Delivery Details</h2>
        <form action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>" method="POST">
            <label for="address">Delivery Address:</label><br>
            <textarea id="address" name="address" rows="4" cols="50" required><?php echo $address; ?></textarea><br><br>

            <label for="contact_name">Contact Name:</label><br>
            <input type="text" id="contact_name" name="contact_name" value="<?php echo $contact_name; ?>" required><br><br>

            <label for="contact_email">Contact Email:</label><br>
            <input type="email" id="contact_email" name="contact_email" value="<?php echo $contact_email; ?>" required><br><br>

            <label for="contact_phone">Contact Phone:</label><br>
            <input type="tel" id="contact_phone" name="contact_phone" pattern="[0-9]{10}" value="<?php echo $contact_phone; ?>" required><br><br>

            <input type="submit" value="Proceed">
        </form>
    </div>

    <!-- Display error message if any -->
    <?php if (!empty($error)) { ?>
        <p>Error: <?php echo $error; ?></p>
    <?php } ?>
</body>

</html>
