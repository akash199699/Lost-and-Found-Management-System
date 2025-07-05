<html>
<head>
    <title>Lost and Found</title>
</head>
<body>
    <h1>Lost and Found Items</h1>

    <?php
    // Define lost and found items array
    $items = array();

    // Function to add an item
    function addItem($type, $description) {
        global $items;
        $items[] = array('type' => $type, 'description' => $description);
    }

    // Function to display all items
    function displayItems() {
        global $items;
        echo "<h2>All Items</h2>";
        echo "<ul>";
        foreach ($items as $item) {
            echo "<li>Type: " . $item['type'] . ", Description: " . $item['description'] . "</li>";
        }
        echo "</ul>";
    }

    // Check if form is submitted
    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        // Process the form data
        $type = $_POST["type"];
        $description = $_POST["description"];
        addItem($type, $description);
    }
    ?>

    <h2>Submit a Lost or Found Item</h2>
    <form method="post" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]);?>">
        Type: <input type="text" name="type"><br>
        Description: <input type="text" name="description"><br>
        <input type="submit" value="Submit">
    </form>

    <?php
    // Display all items
    displayItems();
    ?>

</body>
</html>
