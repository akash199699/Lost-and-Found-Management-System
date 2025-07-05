<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modify Categories</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            color: #333;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 800px;
            margin: 20px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }

        h1 {
            text-align: center;
            margin-bottom: 20px;
        }

        .category {
            margin-bottom: 10px;
            border-bottom: 1px solid #ccc;
            padding: 10px;
        }

        .category:last-child {
            border-bottom: none;
        }

        a {
            text-decoration: none;
            color: #007bff;
            transition: color 0.3s ease;
        }

        a:hover {
            color: #0056b3;
        }

        .add-new {
            text-align: center;
            margin-top: 20px;
        }

        .back {
            display: block;
            text-align: center;
            margin-top: 20px;
            color: #777;
        }

        .back:hover {
            color: #333;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1>Modify Categories</h1>
        <div class="categories">
            <?php
            // Include database connection
            include_once "db_connection.php";

            // Retrieve and display categories from the database
            $sql = "SELECT * FROM ItemCategories";
            $result = $conn->query($sql);

            if ($result->num_rows > 0) {
                // Output data of each row
                while($row = $result->fetch_assoc()) {
                    echo "<div class='category'>";
                    echo "<span>CategoryID: " . $row["CategoryID"]. "</span><br>";
                    echo "<span>CategoryName: " . $row["CategoryName"]. "</span><br>";
                    echo "<span>Description: " . $row["Description"] . "</span><br>";
                    // Add edit and delete links
                    echo "<a href='edit_category.php?id=" . $row["CategoryID"] . "'>Edit</a> | ";
                    echo "<a href='delete_category.php?id=" . $row["CategoryID"] . "' onclick='return confirm(\"Are you sure you want to delete this category?\")'>Delete</a>";
                    echo "</div>";
                }
            } else {
                echo "<p>No categories found.</p>";
            }
            $conn->close();
            ?>
        </div>
        <div class="add-new">
            <a href="add_category.php">Add New Category</a>
        </div>
        <a class="back" href="admin_dashboard.php">Back to Dashboard</a>
    </div>
</body>
</html>
