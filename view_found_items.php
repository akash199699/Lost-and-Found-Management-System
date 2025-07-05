<!DOCTYPE html>
<html>
<head>
    <title>View Found Items</title>
	<link rel="stylesheet" type="text/css" href="styl.css">
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }
        th, td {
            border: 1px solid black;
            padding: 8px;
            text-align: left;
        }
        th {
            background-color: #f2f2f2;
        }
    </style>
</head>
<body>
	<div class="container">
    <h2>View Found Items</h2>

    <form method="GET" action="">
        <label for="search_query">Search for items :</label>
        <input type="text" id="search_query" name="search_query">
        <input type="submit" value="Search">
		<br>
		<br>
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
            // Display search results in a table
            echo "<table>";
            // Table header
            echo "<tr>";
            foreach ($result->fetch_assoc() as $key => $value) {
                echo "<th>" . ucfirst($key) . "</th>";
            }
            echo "</tr>";

            // Reset the result set pointer to the beginning
            mysqli_data_seek($result, 0);

            // Table rows
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                foreach ($row as $value) {
                    echo "<td>$value</td>";
                }
                echo "</tr>";
            }
            echo "</table>";
        } else {
            echo "No results found.";
        }
    } else {
        // Retrieve all found items from the database
        $sql = "SELECT * FROM FoundItems";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // Display found items in a table
            echo "<table>";
            // Table header
            echo "<tr>";
            foreach ($result->fetch_assoc() as $key => $value) {
                echo "<th>" . ucfirst($key) . "</th>";
            }
            echo "</tr>";

            // Reset the result set pointer to the beginning
            mysqli_data_seek($result, 0);

            // Table rows
            while ($row = $result->fetch_assoc()) {
                echo "<tr>";
                foreach ($row as $value) {
                    echo "<td>$value</td>";
                }
                echo "</tr>";
            }
            echo "</table>";
        } else {
            // No found items found
            echo "No found items uploaded. <a href='add_found_item.php'>Add a Found Item</a>";
        }
    }
    ?>

    <ul><p><a href="found.php">Return to Found Items Page</a></p></ul>
</body>
</html>
