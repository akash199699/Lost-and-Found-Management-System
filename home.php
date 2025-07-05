<!DOCTYPE html>
<html>
<head>
    <title>Lost and Found</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-image: url('background/bg.jpg'); 
            background-size: cover;
            background-repeat: no-repeat;
            color: #fff;
            padding: 200px;
        }

        h2 {
            text-align: center;
            font-size: 64px;
            text-shadow: 2px 2px 4px rgba(0, 0, 0, 0.7);
        }

        ul {
            list-style-type: none;
            padding: 0;
            text-align: center;
        }

        li {
            display: inline;
            margin-right: 27px;
        }

        li a {
            color: #fff;
            text-decoration: none;
            font-size: 27px;
            padding: 10px 20px;
            border-radius: 7px;
            background-color: rgba(0, 0, 0, 0.7);
            transition: background-color 0.2s ease;
        }

        li a:hover {
            background-color: rgba(0, 0, 0, 0.9);
        }
    </style>
    <script>
    // Function to prompt login before redirecting to external links
    function promptLogin(link) {
        <?php
        // Start session
        session_start();

        // Check if user is not logged in
        if (!isset($_SESSION['username'])) {
            echo 'var confirmLogin = confirm("You need to login to view this page. Do you want to login?");
                if (confirmLogin) {
                    window.location.href = "login.php?return_to=" +link;

                }
                return false;';
        }
        ?>
        // If logged in, proceed to the requested link
        console.log("Logged in successfully, redirecting to:", link);
        window.location.href = link;
    }

    // Function to handle logout
    function logout() {
        // Redirect to logout page
        window.location.href = "logout.php";
    }
</script>

</head>
<body>
    <h2>Welcome to the Lost and Found website!</h2>
    <ul>
        <li><a href="javascript:void(0)" onclick="promptLogin('lost.php')">Lost Items</a></li>
        <li><a href="javascript:void(0)" onclick="promptLogin('found.php')">Found Items</a></li>
        <li><a href="javascript:void(0)" onclick="promptLogin('transactions.php')">View ALL Items</a></li>
        <?php
        // Start session
        //session_start();

        // Check if user is logged in
        if (isset($_SESSION['username'])) {
            // If logged in, display logout link
            echo '<li><a href="#" onclick="logout()">Logout</a></li>';
        } else {
            // If not logged in, display login link
            echo '<li><a href="login.php">Login</a></li>';
        }
        ?>
        <!-- Add more links for other pages as needed -->
    </ul>
    <br>
    <br>
    <ul><li><a href="index.php">Back</a></li></ul>
</body>
</html>
