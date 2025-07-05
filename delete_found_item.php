<?php
// Include database connection
include_once "db_connection.php";

// Check if found item ID is provided in the URL
if(isset($_GET['id'])) {
    // Sanitize the input
    $founditem_id = mysqli_real_escape_string($conn, $_GET['id']);
    
    // If confirmation is received, delete the found item from the database
    if (isset($_GET['confirm']) && $_GET['confirm'] === 'true') {
        $sql = "DELETE FROM Founditems WHERE FounditemID = '$founditem_id'";
        if ($conn->query($sql) === TRUE) {
            echo "Found item deleted successfully.";
        } else {
            echo "Error deleting found item: " . $conn->error;
        }
    } else {
        // If confirmation is not received, show the confirmation message
        echo "<br>";
        echo "Are you sure you want to delete this item?";
        echo "<ul>";
        echo "<li><a href='delete_found_item.php?id=$founditem_id&confirm=true'>Yes</a></li>";
        echo "<li><a href='modify_found_items.php'>No</a></li>";
        echo "</ul>";
    }
} else {
    echo "Found item ID not provided.";
    exit();
}

// Close database connection
$conn->close();
?>
