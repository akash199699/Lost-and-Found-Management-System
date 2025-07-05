<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modify Users</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            background-color: #f4f4f4;
            color: #333;
            margin: 0;
            padding: 0;
        }

        .container {
            max-width: 700px;
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

        ul {
            list-style: none;
            padding: 0;
        }

        li {
            margin-bottom: 10px;
            border-bottom: 1px solid #ccc;
            padding: 10px;
            display: flex;
            justify-content: space-between;
            align-items: center;
        }

        li:last-child {
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
        <h1>Modify Users</h1>
        <ul>
            <?php
            // Include database connection
            include_once "db_connection.php";

            // Retrieve and display all users from the database
            $sql = "SELECT * FROM Users";
            $result = $conn->query($sql);

            // Check if users are available
            if ($result->num_rows > 0) {
                // Output data of each user
                while($row = $result->fetch_assoc()) {
                    echo "<br><li>".$row["Username"]."<a href='edit_user.php?id=".$row["UserID"]."'>Edit</a> | <a href='delete_user.php?id=".$row["UserID"]."'>Delete</a></li><br>";
                }
            } else {
                echo "<li>No users found.</li>";
            }
            ?>
        </ul>
        <div class="add-new">
            <a href="add_user.php">Add New User</a>
        </div>
        <a class="back" href="admin_dashboard.php">Back to Dashboard</a>
    </div>
</body>
</html>
