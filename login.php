<?php
// Start session
session_start();

// If user is already logged in, redirect to home page
if (isset($_SESSION['username'])) {
    // Check if a return URL is provided
    if (isset($_GET['return_to'])) {
        $return_to = $_GET['return_to'];
        // Redirect to the return URL
        header("Location: $return_to");
        exit();
    } else {
        // If no return URL is provided, redirect to home page
        header("Location: index.php");
        exit();
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <title>Login</title>
    <link rel="stylesheet" type="text/css" href="sty.css">
</head>
<body>
    <div class="container">
        <h2>Login</h2>
        <form action="login_process.php" method="post">
            <div class="input-group">
                <label for="username_login">Username:</label>
                <input type="text" id="username_login" name="username_login">
            </div>
            <div class="input-group">
                <label for="password_login">Password:</label>
                <input type="password" id="password_login" name="password_login">
            </div>
            <input type="hidden" name="return_to" value="<?php echo isset($_GET['return_to']) ? htmlspecialchars($_GET['return_to']) : ''; ?>">
            <button type="submit" class="button">Login</button>
        </form>
        <p>Don't have an account? <a href="signup.php">Sign up here</a>.</p>
		<a href="index.php">Back</a>
    </div>
</body>
</html>
