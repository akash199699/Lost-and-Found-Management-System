<?php
// Include database connection
include_once "db_connection.php";

// Check if item ID is provided in the form submission
if(isset($_POST['item_id'])) {
    // Sanitize the input
    $item_id = mysqli_real_escape_string($conn, $_POST['item_id']);
    $item_name = mysqli_real_escape_string($conn, $_POST['item_name']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $date_found = $_POST['date_found']; // You might need to format the date based on your database schema
    $location_found = mysqli_real_escape_string($conn, $_POST['location_found']);

    // Update the found item in the database
    $sql = "UPDATE FoundItems SET ItemName = '$item_name', Description = '$description', DateFound = '$date_found', LocationFound = '$location_found' WHERE FoundItemID = '$item_id'";
    if ($conn->query($sql) === TRUE) {
        // Success message
        echo "Found item updated successfully.";
    } else {
        echo "Error updating found item: " . $conn->error;
    }
    // Redirect to prevent form resubmission on page refresh
    header("Location: modify_found_items.php");
    exit();
} else {
    echo "Item ID not provided.";
    exit();
}
?>
