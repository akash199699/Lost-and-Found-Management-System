<html>
<head>
<link rel="stylesheet" type="text/css" href="styl.css">
</head>
<?php
// Include database connection
include_once "db_connection.php";

// Retrieve login form data
$username = $_POST['username_login'];
$password = $_POST['password_login'];

// Prepare and execute query with prepared statement
$stmt = $conn->prepare("SELECT UserID, username FROM users WHERE username = ? AND password = ?");
$stmt->bind_param("ss", $username, $password);
$stmt->execute();

// Get result
$result = $stmt->get_result();

// Check if user exists
if ($result->num_rows > 0) {
    // Fetch user data
    $user = $result->fetch_assoc();

    // Start session
    session_start();

    // Set session variables
    $_SESSION['user_id'] = $user['UserID'];
    $_SESSION['username'] = $user['username'];

    // Close statement
    $stmt->close();

    // Check if return URL is set and properly sanitize it
    $return_to = isset($_POST['return_to']) ? htmlspecialchars($_POST['return_to']) : 'home.php';

    // Redirect to the return URL
    if ($_SESSION['user_id'] == 1) {
        // If the user is an admin, redirect to admin dashboard
        header("Location: admin_dashboard.php");
    } else {
        // If not an admin, redirect to the return URL
        // Print login successful message and return link to previous page
        echo "<p>Login successful!</p>";
        echo "<p><a href='$return_to'>Back</a></p>";
    }
    exit();
} else {
    // Close statement
    $stmt->close();
    
    // User not found, redirect to login page with error message
    header("Location: login.php?error=1");
    exit();
}

// Close connection
$conn->close();
?>
</html>