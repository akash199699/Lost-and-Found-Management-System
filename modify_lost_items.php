<?php
// Include database connection
include_once "db_connection.php";

// Check if user is logged in and is an admin
session_start();
if (!isset($_SESSION['username']) || $_SESSION['user_id'] !== 1) {
    header("Location: login.php");
    exit();
}

// Fetch all lost items from the database
$sql = "SELECT * FROM LostItems";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
<link rel="stylesheet" href="admin_styles.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modify Lost Items</title>
</head>
<body>
<div class="container">
    <h1>Modify Lost Items</h1>
    <a href="add_lost.php">Add Lost Item</a>
    <br><br>
    <table>
        <tr>
            <th>Item Name</th>
            <th>Description</th>
            <th>Date Lost</th>
            <th>Location Lost</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
        <?php
        if ($result->num_rows > 0) {
            // Output data of each row
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["ItemName"] . "</td>";
                echo "<td>" . $row["Description"] . "</td>";
                echo "<td>" . $row["DateLost"] . "</td>";
                echo "<td>" . $row["LocationLost"] . "</td>";
                echo "<td>" . $row["Status"] . "</td>";
                echo "<td><a href='edit_lost_item.php?id=" . $row["LostItemID"] . "'>Edit</a> | <a href='delete_lost_item.php?id=" . $row["LostItemID"] . "'>Delete</a></td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='6'>No lost items found.</td></tr>";
        }
        ?>
    </table>
    <br>
    <a href="admin_dashboard.php">Back to Dashboard</a>
</body>
</html>
