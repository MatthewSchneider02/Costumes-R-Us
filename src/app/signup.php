<?php
// Connect to the database
$conn = mysqli_connect("localhost", "username", "password", "database_name");

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["signup-submit"])) {
    // Retrieve the form data
    $name = mysqli_real_escape_string($conn, $_POST["signup-name"]);
    $email = mysqli_real_escape_string($conn, $_POST["signup-email"]);
    $password = mysqli_real_escape_string($conn, $_POST["signup-password"]);

    // Check if the email already exists in the database
    $sql = "SELECT * FROM users WHERE email='$email'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        // Email already exists, display error message
        $error_message = "Email already exists";
    } else {
        // Insert the user into the database
        $sql = "INSERT INTO users (name, email, password) VALUES ('$name', '$email', '$password')";
        if (mysqli_query($conn, $sql)) {
            // Sign up successful, redirect to login page
            header("Location: login.php");
            exit();
        } else {
            // Database error, display error message
            $error_message = "Database error: " . mysqli_error($conn);
        }
    }
}
?>
