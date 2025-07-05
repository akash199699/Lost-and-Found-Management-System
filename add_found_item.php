<?php
// Start session
session_start();

// Include database connection
include_once "db_connection.php";

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Check if user is logged in
    if (!isset($_SESSION['user_id'])) {
        // Redirect to login page if not logged in
        header("Location: login.php");
        exit();
    }

    // Fetch user ID from session
    $user_id = $_SESSION['user_id'];

    // Retrieve form data
    $item_name = $_POST['item_name'];
    $description = $_POST['description'];
    $date_found = $_POST['date_found'];
    $location_found = $_POST['location_found'];

    // Sanitize input data to prevent SQL injection
    $item_name = mysqli_real_escape_string($conn, $item_name);
    $description = mysqli_real_escape_string($conn, $description);
    $date_found = mysqli_real_escape_string($conn, $date_found);
    $location_found = mysqli_real_escape_string($conn, $location_found);

    // Insert new found item into database
    $sql = "INSERT INTO FoundItems (UserID, ItemName, Description, DateFound, LocationFound) 
            VALUES ('$user_id', '$item_name', '$description', '$date_found', '$location_found')";

    if ($conn->query($sql) === TRUE) {
        echo "Found item added successfully";
        // Redirect back to the found page
        header("Location: found.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Add Found Item</title>
	<link rel="stylesheet" type="text/css" href="sty.css">
</head>
<body>
	<div class="container">
    <h2>Add Found Item</h2>
    <form action="add_found_item.php" method="post">
        Item Name : <input type="text" name="item_name"><br><br>
        Description : <input type="text" name="description"><br><br>
        Date Found : <input type="date" name="date_found"><br><br>
        Location Found : <input type="text" name="location_found"><br><br>
        <input type="submit" value="Add Found Item">
    </form>
	<br>
	<br>
	<a href="found.php">Return to Found Items Page</a>

</body>
</html>
