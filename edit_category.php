<?php
// Include database connection
include_once "db_connection.php";

// Check if category ID is provided in the URL
if(isset($_GET['id'])) {
    // Sanitize the input
    $category_id = mysqli_real_escape_string($conn, $_GET['id']);
    
    // Retrieve the category details from the database
    $sql = "SELECT * FROM ItemCategories WHERE CategoryID = '$category_id'";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        // Output data of the category
        $category = $result->fetch_assoc();
    } else {
        echo "Category not found.";
        exit();
    }
} else {
    echo "Category ID not provided.";
    exit();
}

// Handle form submission for updating the category
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate and sanitize input data
    $category_name = mysqli_real_escape_string($conn, $_POST['category_name']);
    $description = mysqli_real_escape_string($conn, $_POST['description']);

    // Update the category in the database
    $sql = "UPDATE ItemCategories SET CategoryName = '$category_name', Description = '$description' WHERE CategoryID = '$category_id'";
    if ($conn->query($sql) === TRUE) {
        echo "Category updated successfully.";
    } else {
        echo "Error updating category: " . $conn->error;
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
    <title>Edit Category</title>
</head>
<body>
<div class="container">
    <h1>Edit Category</h1>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"] . '?id=' . $category['CategoryID']); ?>">
        <label for="category_name">Category Name:</label>
        <input type="text" id="category_name" name="category_name" value="<?php echo $category['CategoryName']; ?>" required><br>
        <br>
		<label for="description">Description:</label>
        <textarea id="description" name="description"><?php echo $category['Description']; ?></textarea><br>
        <br>
		<button type="submit">Update Category</button>
    </form>
	<br>
	<a href="modify_categories.php">Back to Categories Page</a>
</body>
</html>
