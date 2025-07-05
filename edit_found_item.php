<?php
// Include database connection
include_once "db_connection.php";

// Retrieve and display the form to edit the found item
if(isset($_GET['id'])) {
    // Sanitize the input
    $item_id = mysqli_real_escape_string($conn, $_GET['id']);
    
    // Retrieve the found item details from the database
    $sql = "SELECT * FROM FoundItems WHERE FoundItemID = '$item_id'";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        // Output data of the retrieved item
        $row = $result->fetch_assoc();
        // Display the form with pre-populated fields
    } else {
        echo "Item not found.";
        exit();
    }
} else {
    echo "Item ID not provided.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<link rel="stylesheet" type="text/css" href="sty.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit Found Item</title>
</head>
<body>
<div class="container">
    <h1>Edit Found Item</h1>
    <form method="post" action="update_found_item.php">
        <input type="hidden" name="item_id" value="<?php echo $row['FoundItemID']; ?>">
        <br>
		<label for="item_name">Item Name:</label>
        <input type="text" id="item_name" name="item_name" value="<?php echo $row['ItemName']; ?>" required><br>
        <br>
		<label for="description">Description:</label>
        <textarea id="description" name="description"><?php echo $row['Description']; ?></textarea><br>
        <br>
		<label for="date_found">Date Found:</label>
        <input type="date" id="date_found" name="date_found" value="<?php echo $row['DateFound']; ?>" required><br>
        <br>
		<label for="location_found">Location Found:</label>
        <input type="text" id="location_found" name="location_found" value="<?php echo $row['LocationFound']; ?>" required><br>
        <br>
		<button type="submit">Update Found Item</button>
    </form>
    <br>
    <a href="modify_found_items.php">Back to Modify Found Items</a>
</body>
</html>
