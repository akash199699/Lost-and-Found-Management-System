<!DOCTYPE html>
<html>
<head>
    <title>Add Lost Item</title>
		<link rel="stylesheet" type="text/css" href="sty.css">

</head>
<body>
    <div class="container">
	<h2>Add Lost Item</h2>
    <form action="add_lost_item.php" method="post">
        Item Name : <input type="text" name="item_name"><br><br>
        Description : <input type="text" name="description"><br><br>
        Date Lost : <input type="date" name="date_lost"><br><br>
        Location Lost : <input type="text" name="location_lost"><br><br>
        Reward Offered : <input type="text" name="reward_offered"><br><br>
		<input type="submit" value="Add Lost Item"><br><br>
    </form>
	<a href="lost.php">Return to Lost Items Page</a>
</body>
</html>

<?php
// Include database connection
include_once "db_connection.php";

// Start session
session_start();

// Check if the form is submitted
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Retrieve form data
    $item_name = $_POST['item_name'];
    $description = $_POST['description'];
    $date_lost = $_POST['date_lost'];
    $location_lost = $_POST['location_lost'];
    $reward_offered = $_POST['reward_offered'];

    // Retrieve user ID from session
    $user_id = $_SESSION['user_id'];

    // Insert new lost item into database with user ID
    $sql = "INSERT INTO LostItems (UserID, ItemName, Description, DateLost, LocationLost, RewardOffered) 
            VALUES ('$user_id', '$item_name', '$description', '$date_lost', '$location_lost', '$reward_offered')";

    if ($conn->query($sql) === TRUE) {
        echo "Lost item added successfully";
        // Redirect back to the lost page
        header("Location: lost.php");
        exit();
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
}
?>
