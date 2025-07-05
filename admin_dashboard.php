<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <style>
        body {
            font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f5f5f5;
            color: #333;
        }
        .container {
            max-width: 800px;
            margin: 50px auto;
            padding: 20px;
            background-color: #fff;
            border-radius: 10px;
            box-shadow: 0 0 20px rgba(0, 0, 0, 0.1);
        }
        h1, h2 {
            margin-top: 0;
        }
        ul {
            list-style: none;
            padding: 0;
        }
        ul li {
            margin-bottom: 15px;
        }
        ul li a {
            display: block;
            padding: 15px;
            background-color: #007bff;
            color: #fff;
            text-decoration: none;
            border-radius: 5px;
            transition: background-color 0.3s ease;
        }
        ul li a:hover {
            background-color: #0056b3;
        }
        .logout-btn {
            background-color: #dc3545;
            color: #fff;
            border: none;
            padding: 10px 20px;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
        }
        .logout-btn:hover {
            background-color: #c82333;
        }
    </style>
</head>
<body>
    <div class="container">
        <h1 style="text-align: center; font-size: 2.5rem;">Welcome, Admin!</h1>
        <h2 style="font-size: 1.5rem;">Modify Data:</h2>
        <ul>
            <li><a href="modify_lost_items.php">Modify Lost Items</a></li>
            <li><a href="modify_found_items.php">Modify Found Items</a></li>
            <li><a href="modify_users.php">Modify Users</a></li>
            <li><a href="modify_categories.php">Modify Categories</a></li>
            <!-- Add more links for other modifications as needed -->
        </ul>
        <br>
        <button class="logout-btn" onclick="window.location.href='logout.php'">Logout</button>
    </div>
</body>
</html>
