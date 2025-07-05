<?php
// Include database connection
include_once "db_connection.php";

// Check if category ID is provided in the URL
if(isset($_GET['id'])) {
    // Sanitize the input
    $category_id = mysqli_real_escape_string($conn, $_GET['id']);
    
    // If confirmation is received, delete the category from the database
    if (isset($_GET['confirm']) && $_GET['confirm'] === 'true') {
        $sql = "DELETE FROM ItemCategories WHERE CategoryID = '$category_id'";
        if ($conn->query($sql) === TRUE) {
            echo "Category deleted successfully.";
        } else {
            echo "Error deleting category: " . $conn->error;
        }
    } else {
        // If confirmation is not received, show the confirmation message
        echo"<br>";
		echo "<ul>Are you sure you want to delete this category?</ul>";
        echo "";
        echo "<ul><li><a href='delete_category.php?id=$category_id&confirm=true'>Yes</a></li></ul>";
        echo "<ul><li><a href='modify_categories.php'>No</a></li></ul>";
    }
} else {
    echo "Category ID not provided.";
    exit();
}

// Close database connection
$conn->close();
?>