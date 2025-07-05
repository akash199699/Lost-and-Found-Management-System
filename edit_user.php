<?php
// Include database connection
include_once "db_connection.php";

// Retrieve and display the form to edit the user
if(isset($_GET['id'])) {
    // Sanitize the input
    $user_id = mysqli_real_escape_string($conn, $_GET['id']);
    
    // Retrieve the user details from the database
    $sql = "SELECT * FROM Users WHERE UserID = '$user_id'";
    $result = $conn->query($sql);
    
    if ($result->num_rows > 0) {
        // Output data of the retrieved user
        $row = $result->fetch_assoc();
        // Display the form with pre-populated fields
    } else {
        echo "User not found.";
        exit();
    }
} else {
    echo "User ID not provided.";
    exit();
}

// Handle form submission for updating user details
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate and sanitize input data
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);
    $user_id = mysqli_real_escape_string($conn, $_POST['user_id']);

    // Update user details in the database
    $sql = "UPDATE Users SET Username = ?, Password = ?, Email = ? WHERE UserID = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssi", $username, $password, $email, $user_id);
    $stmt->execute();
    $stmt->close();

    // Redirect to prevent form resubmission on page refresh
    header("Location: modify_users.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
<link rel="stylesheet" type="text/css" href="sty.css">
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Edit User</title>
</head>
<body>
<div class="container">
    <h1>Edit User</h1>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <input type="hidden" name="user_id" value="<?php echo $row['UserID']; ?>">
        <br>
		<label for="username">Username:</label>
        <input type="text" id="username" name="username" value="<?php echo $row['Username']; ?>" required><br>
        <br>
		<label for="password">Password:</label>
        <input type="password" id="password" name="password" value="<?php echo $row['Password']; ?>" required><br>
        <br>
		<label for="email">Email:</label>
        <input type="email" id="email" name="email" value="<?php echo $row['Email']; ?>" required><br>
        <br>
		<br>
		<button type="submit">Update User</button>
    </form>
	<br>
	<a href="modify_users.php">Back to Users Page</a>
</body>
</html>
