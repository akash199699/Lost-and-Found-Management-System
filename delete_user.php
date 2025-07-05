<?php
// Include database connection
include_once "db_connection.php";

// Check if user ID is provided in the URL
if(isset($_GET['id'])) {
    // Sanitize the input
    $user_id = mysqli_real_escape_string($conn, $_GET['id']);

    // Check if user exists
    $sql_check = "SELECT * FROM Users WHERE UserID = '$user_id'";
    $result_check = $conn->query($sql_check);

    if ($result_check->num_rows > 0) {
        // If confirmation is received, delete the user from the database
        if (isset($_GET['confirm']) && $_GET['confirm'] === 'true') {
            $sql = "DELETE FROM Users WHERE UserID = '$user_id'";
            if ($conn->query($sql) === TRUE) {
                echo "User deleted successfully.";
            } else {
                echo "Error deleting user: " . $conn->error;
            }
            // Close database connection
            $conn->close();
            exit(); // Exit script after deletion
        } else {
            // Display confirmation message using JavaScript
            echo "<script>
                    var confirmDelete = confirm('Are you sure you want to delete this user?');
                    if (confirmDelete) {
                        window.location.href = 'delete_user.php?id=$user_id&confirm=true';
                    } else {
                        window.location.href = 'modify_users.php';
                    }
                  </script>";
        }
    } else {
        echo "User not found.";
    }
} else {
    echo "User ID not provided.";
    exit();
}
?>
