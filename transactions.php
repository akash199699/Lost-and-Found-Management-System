<!DOCTYPE html>
<html>
<head>
    <title>View Lost and Found Items</title>
	 <link rel="stylesheet" type="text/css" href="styl.css">
    <style>
        table {
            border-collapse: collapse;
            width: 100%;
        }

        th, td {
            border: 1px solid #dddddd;
            text-align: left;
            padding: 8px;
        }

        th {
            background-color: #f2f2f2;
            cursor: pointer;
        }

        .sort-link {
            text-decoration: underline;
            color: blue;
        }
    </style>
</head>
<body>
<div class="container">
    <h2>View Lost and Found Items</h2>
    <label for="sort">Sort by:</label>
    <select id="sort">
        <option value="date">Date</option>
        <option value="reward">Reward</option>
        <option value="item_name">Item Name</option>
        <option value="description">Description</option>
        <option value="location">Location</option>
    </select>

    <?php
    // Start session
    session_start();

    // Include database connection
    include_once "db_connection.php";

    // Query database for all lost items
    $sql_lost = "SELECT * FROM LostItems";
    $result_lost = $conn->query($sql_lost);

    // Display lost items
    if ($result_lost->num_rows > 0) {
        echo "<h3>Lost Items</h3>";
        echo "<table id='lost-table'>";
        echo "<thead><tr><th onclick='sortTable(\"lost-table\", 0)'>User ID</th><th onclick='sortTable(\"lost-table\", 1)'>Item Name</th><th onclick='sortTable(\"lost-table\", 2)'>Description</th><th onclick='sortTable(\"lost-table\", 3)'>Date Lost</th><th onclick='sortTable(\"lost-table\", 4)'>Location Lost</th><th onclick='sortTable(\"lost-table\", 5)'>Reward Offered</th></tr></thead>";
        echo "<tbody>";
        while ($row_lost = $result_lost->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row_lost['UserID'] . "</td>";
            echo "<td>" . $row_lost['ItemName'] . "</td>";
            echo "<td>" . $row_lost['Description'] . "</td>";
            echo "<td>" . $row_lost['DateLost'] . "</td>";
            echo "<td>" . $row_lost['LocationLost'] . "</td>";
            echo "<td>" . $row_lost['RewardOffered'] . "</td>";
            echo "</tr>";
        }
        echo "</tbody>";
        echo "</table>";
    } else {
        echo "<p>No lost items found.</p>";
    }

    // Query database for all found items
    $sql_found = "SELECT * FROM FoundItems";
    $result_found = $conn->query($sql_found);

    // Display found items
    if ($result_found->num_rows > 0) {
        echo "<h3>Found Items</h3>";
        echo "<table id='found-table'>";
        echo "<thead><tr><th onclick='sortTable(\"found-table\", 0)'>User ID</th><th onclick='sortTable(\"found-table\", 1)'>Item Name</th><th onclick='sortTable(\"found-table\", 2)'>Description</th><th onclick='sortTable(\"found-table\", 3)'>Date Found</th><th onclick='sortTable(\"found-table\", 4)'>Location Found</th></tr></thead>";
        echo "<tbody>";
        while ($row_found = $result_found->fetch_assoc()) {
            echo "<tr>";
            echo "<td>" . $row_found['UserID'] . "</td>";
            echo "<td>" . $row_found['ItemName'] . "</td>";
            echo "<td>" . $row_found['Description'] . "</td>";
            echo "<td>" . $row_found['DateFound'] . "</td>";
            echo "<td>" . $row_found['LocationFound'] . "</td>";
            echo "</tr>";
        }
        echo "</tbody>";
        echo "</table>";
    } else {
        echo "<p>No found items found.</p>";
    }

    // Close connection
    $conn->close();
    ?>

    <script>
        // Function to sort table rows by selected column
        function sortTable(tableId, columnIdx) {
            let table, rows, switching, i, x, y, shouldSwitch;
            table = document.getElementById(tableId);
            switching = true;
            while (switching) {
                switching = false;
                rows = table.getElementsByTagName("tr");
                for (i = 1; i < (rows.length - 1); i++) {
                    shouldSwitch = false;
                    x = rows[i].getElementsByTagName("td")[columnIdx];
                    y = rows[i + 1].getElementsByTagName("td")[columnIdx];
                    if (x.innerHTML.toLowerCase() > y.innerHTML.toLowerCase()) {
                        shouldSwitch = true;
                        break;
                    }
                }
                if (shouldSwitch) {
                    rows[i].parentNode.insertBefore(rows[i + 1], rows[i]);
                    switching = true;
                }
            }
        }

        // Add event listener to sort select dropdown
        document.getElementById("sort").addEventListener("change", function () {
            let sortValue = this.value;
            if (sortValue === "date") {
                sortTable("lost-table", 3);
                sortTable("found-table", 3);
            } else if (sortValue === "reward") {
                sortTable("lost-table", 5);
            } else if (sortValue === "item_name") {
                sortTable("lost-table", 1);
                sortTable("found-table", 1);
            } else if (sortValue === "description") {
                sortTable("lost-table", 2);
                sortTable("found-table", 2);
            } else if (sortValue === "location") {
                sortTable("lost-table", 4);
                sortTable("found-table", 4);
            }
        });
    </script>
	<p><a href="home.php">Return to Home Page</a></p>
	
</body>
</html>
