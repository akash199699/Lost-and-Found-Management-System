<?php
// Include database connection
include_once "db_connection.php";

// Handle form submission for adding a new lost item
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate and sanitize input data
    $item_name = mysqli_real_escape_string($conn, $_POST['item_name']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $date_lost = $_POST['date_lost']; // You might need to format the date based on your database schema
    $location_lost = mysqli_real_escape_string($conn, $_POST['location_lost']);
    $status = mysqli_real_escape_string($conn, $_POST['status']);

    // Perform database operations (add lost item)
    $sql = "INSERT INTO LostItems (UserID, ItemName, Description, DateLost, LocationLost, Status) VALUES (?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("isssss", $_SESSION['user_id'], $item_name, $description, $date_lost, $location_lost, $status);
    $stmt->execute();
    $stmt->close();

    // Redirect to prevent form resubmission on page refresh
    header("Location: modify_lost_items.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<link rel="stylesheet" type="text/css" href="sty.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Lost Item</title>
</head>
<body>
<div class="container">
    <h1>Add Lost Item</h1>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for="item_name">Item Name:</label>
        <input type="text" id="item_name" name="item_name" required><br>
        <br>
		<label for="description">Description:</label>
        <textarea id="description" name="description"></textarea><br>
        <br>
		<label for="date_lost">Date Lost:</label>
        <input type="date" id="date_lost" name="date_lost" required><br>
        <br>
		<label for="location_lost">Location Lost:</label>
        <input type="text" id="location_lost" name="location_lost" required><br>
        <br>
		<label for="status">Status:</label>
        <input type="text" id="status" name="status"><br>
        <br>
		<button type="submit">Add Lost Item</button>
    </form>
    <br>
    <a href="modify_lost_items.php">Back to Modify Lost Items</a>
</body>
</html>
