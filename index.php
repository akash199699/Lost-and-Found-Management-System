<!DOCTYPE html>
<html>
<head>
    <title>Lost and Found</title>
    <link rel="stylesheet" type="text/css" href="styles.css">
    <script>
        // JavaScript function to prompt login before redirecting to external links
        function promptLogin(link) {
            // Redirect to login page with return URL
            window.location.href = "login.php?return_to=" + encodeURIComponent(link.href);
            return false;
        }
    </script>
</head>
<body>
    <div class="container">
        <h1>Lost and Found Items</h1>
        <div class="link-box">
            <ul>
                <li><a href="home.php">Home</a></li>
            </ul>
        </div>
        <div class="link-box">
            <ul>
                <li><a href="lost.php" onclick="return promptLogin(this);">Lost Items</a></li>
            </ul>
        </div>
        <div class="link-box">
            <ul>
                <li><a href="found.php" onclick="return promptLogin(this);">Found Items</a></li>
            </ul>
        </div>
        <div class="link-box">
            <ul>
                <li><a href="about.php">About</a></li>
            </ul>
        </div>
        <div class="link-box">
            <ul>
				<?php
                // Start session
                session_start();

                // Check if user is logged in
                if (isset($_SESSION['username'])) {
                    // If logged in, display logout link
                    echo '<li><a href="logout.php">Logout</a></li>';
                } else {
                    // If not logged in, display login link
                    echo '<li><a href="login.php">Login</a></li>';
                }
                ?>
                
            </ul>
        </div>
    </div>
</body>
</html>
