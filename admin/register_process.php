<?php
include('includes/db_connect.php');

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $email = $_POST['email'];
    $password = password_hash($_POST['password'], PASSWORD_DEFAULT); // Hash password for security

    // Check if email already exists
    $check_query = "SELECT * FROM admin_users WHERE email='$email'";
    $check_result = $conn->query($check_query);

    if ($check_result->num_rows > 0) {
        echo "<p>Email already registered. Please use a different email.</p>";
    } else {
        // Insert new admin user
        $insert_query = "INSERT INTO admin_users (email, password) VALUES ('$email', '$password')";
        
        if ($conn->query($insert_query) === TRUE) {
            echo "<p>Registration successful. <a href='login.php'>Login here</a>.</p>";
        } else {
            echo "Error: " . $insert_query . "<br>" . $conn->error;
        }
    }

    $conn->close();
}
?>
