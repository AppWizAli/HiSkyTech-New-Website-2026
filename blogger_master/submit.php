<?php
include("config.php");

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Get the submitted email
    $email = $conn->real_escape_string($_POST['email']);

    // Check if email is valid
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        // Prepare an SQL statement to insert the email into the database
        $sql = "INSERT INTO mails(email) VALUES ('$email')";

        // Execute the query
        if ($conn->query($sql) === TRUE) {
            echo "Email successfully submitted!";
            header("Location: index.php");
        } else {
            echo "Error: " . $sql . "<br>" . $conn->error;
        }
    } else {
        echo "Invalid email format.";
    }
}

// Close the connection
$conn->close();
?>
