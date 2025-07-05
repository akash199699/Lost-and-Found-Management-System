<?php
// Include database connection
include_once "db_connection.php";

// Check if lost item ID is provided in the URL
if(isset($_GET['id'])) {
    // Sanitize the input
    $lostitem_id = mysqli_real_escape_string($conn, $_GET['id']);
    
    // If confirmation is received, delete the lost item from the database
    if (isset($_GET['confirm']) && $_GET['confirm'] === 'true') {
        $sql = "DELETE FROM Lostitems WHERE LostitemID = '$lostitem_id'";
        if ($conn->query($sql) === TRUE) {
            echo "Lost item deleted successfully.";
        } else {
            echo "Error deleting lost item: " . $conn->error;
        }
        // Close database connection
        $conn->close();
        exit(); // Exit script after deletion
    } else {
        // If confirmation is not received, show the confirmation message
        echo "<br>";
        echo "Are you sure you want to delete this item?";
        echo "<ul>";
        echo "<li><a href='delete_lost_item.php?id=$lostitem_id&confirm=true'>Yes</a></li>";
        echo "<li><a href='modify_lost_items.php'>No</a></li>";
        echo "</ul>";
    }
} else {
    echo "Lost item ID not provided.";
    exit();
}

// Close database connection
$conn->close();
?>
