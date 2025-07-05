<?php
// Include database connection
include_once "db_connection.php";

// Retrieve sign-up form data
$username = $_POST['username_signup'];
$password = $_POST['password_signup'];
$email = $_POST['email_signup'];
$other_info = $_POST['other_info_signup'];

// Insert new user into database
$sql = "INSERT INTO users (username, password, email, otherinfo) VALUES ('$username', '$password', '$email', '$other_info')";

if ($conn->query($sql) === TRUE) {
    echo "New user created successfully";
    header("Location: login.php");
    exit();
} else {
    echo "Error: " . $sql . "<br>" . $conn->error;
}

$conn->close();
?>
