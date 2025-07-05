<!DOCTYPE html>
<html>
<head>
    <title>Found Items</title>
</head>
<body>
    <h2>Found Items</h2>

    <?php
    // Include database connection
    include_once "db_connection.php";

    if (isset($_SESSION['lost_item_added']) && $_SESSION['lost_item_added']) {
        // A lost item has been added, search for similar found items
        $sql_lost = "SELECT * FROM LostItems ORDER BY LostItemID DESC LIMIT 1";
        $result_lost = $conn->query($sql_lost);

        if ($result_lost->num_rows > 0) {
            $lost_item = $result_lost->fetch_assoc();

            // Query database for items with similar dates and locations
            $sql_found = "SELECT * FROM FoundItems WHERE DateFound = '{$lost_item['DateLost']}' AND LocationFound = '{$lost_item['LocationLost']}'";
            $result_found = $conn->query($sql_found);

            if ($result_found->num_rows > 0) {
                echo "<h3>Found Items with Similar Dates and Locations</h3>";
                echo "<ul>";
                while ($row_found = $result_found->fetch_assoc()) {
                    echo "<li>Item Name: " . $row_found['ItemName'] . ", Description: " . $row_found['Description'] . "</li>";
                    // Display other details as needed
                }
                echo "</ul>";
            } else {
                echo "No found items with similar dates and locations.";
            }
        } else {
            echo "No lost items found. You can <a href='lost.php'>add a lost item</a> to see related found items.";
        }
        // Reset the session variable
        $_SESSION['lost_item_added'] = false;
    } else {
        // Show options to view found items and add a new found item
        echo "<p><a href='view_found_items.php'>View Found Items</a></p>";
        echo "<p><a href='add_found_item.php'>Add Found Item</a></p>";
    }
    ?>

    <p><a href="home.php">Return to Home Page</a></p>
</body>
</html>
