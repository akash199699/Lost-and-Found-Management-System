<?php
// Start session
session_start();

// If user is logged in, destroy session and redirect to login page
if (isset($_SESSION['username'])) {
    // Unset all session variables
    session_unset();

    // Destroy the session
    session_destroy();

    // Redirect to login page
    header("Location: login.php");
    exit(); // Stop further execution
} else {
    // If user is not logged in, redirect to login page
    header("Location: login.php");
    exit(); // Stop further execution
}
?>
