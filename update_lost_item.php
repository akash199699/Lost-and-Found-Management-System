<?php
// Include database connection
include_once "db_connection.php";

// Check if form is submitted with POST method
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate and sanitize input data
    $item_id = mysqli_real_escape_string($conn, $_POST['item_id']);
    $item_name = mysqli_real_escape_string($conn, $_POST['item_name']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $date_lost = mysqli_real_escape_string($conn, $_POST['date_lost']);
    $location_lost = mysqli_real_escape_string($conn, $_POST['location_lost']);
    $status = mysqli_real_escape_string($conn, $_POST['status']);

    // Update the lost item in the database
    $sql = "UPDATE LostItems SET ItemName = '$item_name', Description = '$description', DateLost = '$date_lost', LocationLost = '$location_lost', Status = '$status' WHERE LostItemID = '$item_id'";
    if ($conn->query($sql) === TRUE) {
        echo "Lost item updated successfully. <br>";
        echo "<a href='modify_lost_items.php'>Back to Lost Items Page</a>";
    } else {
        echo "Error updating lost item: " . $conn->error;
    }
} else {
    echo "Invalid request.";
}
?>
