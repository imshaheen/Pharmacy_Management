<?php
// Connect to your database
$servername =  $SERVER;
$username =  $USERNAME;
$password = $PASSWORD;
$dbname = $DB;

$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get the selected value from the query string
$selectedValue = $_GET['selectedValue'];

// Query your database and fetch data based on the selected value
$sql = "SELECT * FROM medicines_stock WHERE QUANTITY = '$selectedValue'";
$result = $conn->query($sql);

// Process the fetched data
if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        // Output the data
        echo "<p>" . $row["QUANTITY"] . "</p>";
    }
} else {
    echo "No data found.";
}

// Close the database connection
$conn->close();
?>
