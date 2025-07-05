<?php
// Include database connection
include_once "db_connection.php";

// Retrieve existing category IDs
$category_ids = [];
$sql = "SELECT CategoryID FROM ItemCategories";
$result = $conn->query($sql);
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        $category_ids[] = $row["CategoryID"];
    }
}

// Handle form submission for adding a new category
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate and sanitize input data
    $category_name = mysqli_real_escape_string($conn, $_POST['category_name']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);
    $category_id = mysqli_real_escape_string($conn, $_POST['category_id']);

    // Check if the provided category ID is not in the existing list
    if (!in_array($category_id, $category_ids)) {
        // Insert the new category into the database
        $sql = "INSERT INTO ItemCategories (CategoryID, CategoryName, Description) VALUES ('$category_id', '$category_name', '$description')";
        if ($conn->query($sql) === TRUE) {
            echo "New category added successfully. Category ID: " . $category_id;
        } else {
            echo "Error adding category: " . $conn->error;
        }
    } else {
        echo "Category ID already exists. Please choose a different ID.";
    }
}

// Close database connection
$conn->close();
?>

<!DOCTYPE html>
<html lang="en">
<head>
<link rel="stylesheet" type="text/css" href="sty.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add Category</title>
</head>
<body>
<div class="container">
    <h1>Add Category</h1>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for="category_name">Category Name:</label>
        <input type="text" id="category_name" name="category_name" required><br>
        <br>
		<label for="description">Description:</label>
        <textarea id="description" name="description"></textarea><br>
        <!-- Display category ID -->
        <br>
		<label for="category_id">Category ID:</label>
        <select id="category_id" name="category_id" required>
            <?php
            // Dynamically generate available category IDs
            for ($i = 1; $i <= 1000; $i++) {
                if (!in_array($i, $category_ids)) {
                    echo "<option value='$i'>$i</option>";
                }
            }
            ?>
        </select><br>
        <br><br><button type="submit">Add Category</button>
    </form>
	<br><a href="modify_categories.php">Back to Categories Page</a>
</body>
</html>
