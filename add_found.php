<?php
// Include database connection
include_once "db_connection.php";

// Handle form submission for adding a new found item
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate and sanitize input data
    $item_name = mysqli_real_escape_string($conn, $_POST['item_name']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $date_found = $_POST['date_found']; // You might need to format the date based on your database schema
    $location_found = mysqli_real_escape_string($conn, $_POST['location_found']);

    // Perform database operations (add found item)
    $sql = "INSERT INTO FoundItems (UserID, ItemName, Description, DateFound, LocationFound) VALUES (?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("issss", $_SESSION['user_id'], $item_name, $description, $date_found, $location_found);
    $stmt->execute();
    $stmt->close();

    // Redirect to prevent form resubmission on page refresh
    header("Location: modify_found_items.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<link rel="stylesheet" type="text/css" href="sty.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Found Item</title>
</head>
<body>
<div class="container">
    <h1>Add Found Item</h1>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for="item_name">Item Name:</label>
        <input type="text" id="item_name" name="item_name" required><br>
        <br>
		<label for="description">Description:</label>
        <textarea id="description" name="description"></textarea><br>
        <br>
		<label for="date_found">Date Found:</label>
        <input type="date" id="date_found" name="date_found" required><br>
        <br>
		<label for="location_found">Location Found:</label>
        <input type="text" id="location_found" name="location_found" required><br>
        <br>
		<button type="submit">Add Found Item</button>
    </form>
    <br>
    <a href="modify_found_items.php">Back to Modify Found Items</a>
</body>
</html>
