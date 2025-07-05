<?php
// Include database connection
include_once "db_connection.php";

// Check if user is logged in and is an admin
session_start();
if (!isset($_SESSION['username']) || $_SESSION['user_id'] !== 1) {
    header("Location: login.php");
    exit();
}

// Handle form submissions for modifying found items
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Handle form submission here
    // Example: $item_name = htmlspecialchars($_POST['item_name']);
}

// Fetch all found items from the database
$sql = "SELECT * FROM FoundItems";
$result = $conn->query($sql);
?>

<!DOCTYPE html>
<html lang="en">
<head>
<link rel="stylesheet" href="admin_styles.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modify Found Items</title>
</head>
<body>
<div class="container">
    <h1>Modify Found Items</h1>
    <a href="add_found.php">Add Found Item</a>
    <br><br>
    <table>
        <tr>
            <th>Item Name</th>
            <th>Description</th>
            <th>Date Found</th>
            <th>Location Found</th>
            <th>Action</th>
        </tr>
        <?php
        if ($result->num_rows > 0) {
            // Output data of each row
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                echo "<td>" . $row["ItemName"] . "</td>";
                echo "<td>" . $row["Description"] . "</td>";
                echo "<td>" . $row["DateFound"] . "</td>";
                echo "<td>" . $row["LocationFound"] . "</td>";
                echo "<td><a href='edit_found_item.php?id=" . $row["FoundItemID"] . "'>Edit</a> | <a href='delete_found_item.php?id=" . $row["FoundItemID"] . "'>Delete</a></td>";
                echo "</tr>";
            }
        } else {
            echo "<tr><td colspan='5'>No found items found.</td></tr>";
        }
        ?>
    </table>
    <br>
    <a href="admin_dashboard.php">Back to Dashboard</a>
</body>
</html>
