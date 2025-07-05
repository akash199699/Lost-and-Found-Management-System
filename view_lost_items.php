<!DOCTYPE html>
<html>
<head>
    <title>View Lost Items</title>
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
    <h2>View Lost Items</h2>

    <form method="GET" action="">
        <label for="search_query">Search for items:</label>
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

        // Query to search for items in LostItems table
        $sql = "SELECT * FROM LostItems WHERE ItemName LIKE '%$search_query%' OR Description LIKE '%$search_query%'";
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
        // Retrieve all lost items from the database
        $sql = "SELECT * FROM LostItems";
        $result = $conn->query($sql);

        if ($result->num_rows > 0) {
            // Display lost items in a table
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
            // No lost items found
            echo "No lost items uploaded.";
        }
    }
    ?>

    <ul><p><a href="lost.php">Return to Lost Items Page</a></p></ul>
</body>
</html>
