<?php
// Include database connection
include_once "db_connection.php";

// Retrieve and display the form to edit the lost item
if(isset($_GET['id'])) {
    // Sanitize the input
    $item_id = mysqli_real_escape_string($conn, $_GET['id']);
    
    // Retrieve the lost item details from the database
    $sql = "SELECT * FROM LostItems WHERE LostItemID = '$item_id'";
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
    <title>Edit Lost Item</title>
</head>
<body>
<div class="container">
    <h1>Edit Lost Item</h1>
    <form method="post" action="update_lost_item.php">
        <input type="hidden" name="item_id" value="<?php echo $row['LostItemID']; ?>">
        <br>
		<label for="item_name">Item Name:</label>
        <input type="text" id="item_name" name="item_name" value="<?php echo $row['ItemName']; ?>" required><br>
        <br>
		<label for="description">Description:</label>
        <textarea id="description" name="description"><?php echo $row['Description']; ?></textarea><br>
        <br>
		<label for="date_lost">Date Lost:</label>
        <input type="date" id="date_lost" name="date_lost" value="<?php echo $row['DateLost']; ?>" required><br>
        <br>
		<label for="location_lost">Location Lost:</label>
        <input type="text" id="location_lost" name="location_lost" value="<?php echo $row['LocationLost']; ?>" required><br>
        <br>
		<label for="status">Status:</label>
        <select id="status" name="status" required>
            <option value="Found" <?php if($row['Status'] == 'Found') echo 'selected'; ?>>Found</option>
            <option value="Pending" <?php if($row['Status'] == 'Pending') echo 'selected'; ?>>Pending</option>
            <option value="Lost" <?php if($row['Status'] == 'Lost') echo 'selected'; ?>>Lost</option>
        </select><br>
        <br>
		<br>
		<button type="submit">Save Changes</button>
    </form>
</body>
</html>
