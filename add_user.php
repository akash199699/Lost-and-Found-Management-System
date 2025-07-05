<?php
// Include database connection
include_once "db_connection.php";

// Handle form submission for adding a new user
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validate and sanitize input data
    $username = mysqli_real_escape_string($conn, $_POST['username']);
    $password = mysqli_real_escape_string($conn, $_POST['password']);
    $email = mysqli_real_escape_string($conn, $_POST['email']);

    // Perform database operations (add user)
    $sql = "INSERT INTO Users (Username, Password, Email) VALUES (?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sss", $username, $password, $email);
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
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Add User</title>
	<link rel="stylesheet" type="text/css" href="sty.css">
</head>
<body>
<div class="container">
    <h1>Add User</h1>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
        <label for="username">Username:</label>
        <input type="text" id="username" name="username" required><br>
        <label for="password">Password:</label>
        <input type="password" id="password" name="password" required><br>
        <label for="email">Email:</label>
        <input type="email" id="email" name="email" required><br>
        <br>
		<button type="submit">Add User</button>
    </form>
	<br>
	<a href="modify_users.php">Back to Users Page</a>
</body>
</html>
