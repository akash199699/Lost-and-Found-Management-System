<!DOCTYPE html>
<html>
<head>
    <title>Search Found Items</title>
</head>
<body>
    <h2>Search Found Items</h2>

    <form method="GET" action="">
        <label for="search_query">Search Query:</label>
        <input type="text" id="search_query" name="search_query">
        <input type="submit" value="Search">
    </form>

    <?php
    // Include database connection
    include_once "db_connection.php";

    // Check if search query is submitted
    if (isset($_GET['search_query'])) {
        // Sanitize search query to prevent SQL injection
        $search_query = mysqli_real_escape_string($conn, $_GET['search_query']);

        // Query to search for items in FoundItems table
        $sql = "SELECT * FROM FoundItems WHERE ItemName LIKE '%$search_query%' OR Description LIKE '%$search_query%'";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            echo "<h3>Search Results</h3>";
            echo "<ul>";
            while ($row = $result->fetch_assoc()) {
                echo "<li>Item Name: " . $row['ItemName'] . ", Description: " . $row['Description'] . "</li>";
                // Display other details as needed
            }
            echo "</ul>";
        } else {
            echo "No results found.";
        }
    }
    ?>

    <p><a href="found.php">Back to Found Items</a></p>
</body>
</html>
