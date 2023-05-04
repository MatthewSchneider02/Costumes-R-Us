<?php
// Connect to the database
$conn = mysqli_connect("localhost", "username", "password", "database_name");

// Check if the form was submitted
if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["login-submit"])) {
    // Retrieve the form data
    $email = mysqli_real_escape_string($conn, $_POST["login-email"]);
    $password = mysqli_real_escape_string($conn, $_POST["login-password"]);

    // Retrieve the user from the database
    $sql = "SELECT * FROM users WHERE email='$email' AND password='$password'";
    $result = mysqli_query($conn, $sql);

    if (mysqli_num_rows($result) > 0) {
        // Login successful, redirect to homepage
        header("Location: homepage.php");
        exit();
    } else {
        // Invalid email or password, display error message
        $error_message = "Invalid email or password";
    }
}
?>