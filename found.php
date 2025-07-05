<!DOCTYPE html>
<html>
<head>
    <title>Found Items</title>
    <link rel="stylesheet" type="text/css" href="style.css">
</head>
<body class="lost-found-bg">
    <div class="container">
        <h2>Found Items</h2>

        <?php
        // Include database connection
        include_once "db_connection.php";

        // Check if a lost item has been added
        if (isset($_SESSION['lost_item_added']) && $_SESSION['lost_item_added']) {
            // Retrieve details of the last added lost item
            $sql_lost = "SELECT * FROM LostItems ORDER BY LostItemID DESC LIMIT 1";
            $result_lost = $conn->query($sql_lost);

            if ($result_lost->num_rows > 0) {
                $lost_item = $result_lost->fetch_assoc();

                // Query database for found items with similar details
                $sql_found = "SELECT * FROM FoundItems WHERE ItemName = '{$lost_item['ItemName']}' AND Description = '{$lost_item['Description']}'";
                $result_found = $conn->query($sql_found);

                if ($result_found->num_rows > 0) {
                    echo "<h3>Found Items with Similar Details</h3>";
                    echo "<ul>";
                    while ($row_found = $result_found->fetch_assoc()) {
                        echo "<li>Item Name: " . $row_found['ItemName'] . ", Description: " . $row_found['Description'] . "</li>";
                        // Display other details as needed
                    }
                    echo "</ul>";
                } else {
                    echo "No found items with similar details.";
                }
            } else {
                echo "No lost items found.";
            }

            // Reset the session variable
            $_SESSION['lost_item_added'] = false;
        } else {
            // Show options to view found items and add a new found item
            echo "<div class='options'>";
            echo "<a href='view_found_items.php' class='button'>View Found Items</a>";
            echo "<a href='add_found_item.php' class='button'>Add Found Item</a>";
            echo "</div>";
        }
        ?>

        <p><a href="home.php" class="return-link">Return to Home Page</a></p>
    </div>
</body>
</html>
