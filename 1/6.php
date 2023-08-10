<?php
// Establish a database connection
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "jmf";

$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// SQL query
$sql = "SELECT DATEPART(day, INVOICE_DATE) AS Day,
               MEDICINE_NAME,
               SUM(SUBSTRING_INDEX(SUBSTRING_INDEX(ISSUEQUANTITY, ',', numbers.n), ',', -1)) AS Quantity
        FROM invoices
        CROSS JOIN
        (
          SELECT 1 AS n UNION ALL SELECT 2 UNION ALL SELECT 3 UNION ALL SELECT 4
        ) numbers
        WHERE MONTH(INVOICE_DATE) = { }
          AND FIND_IN_SET(MEDICINE_NAME, '{selected_medicines}') > 0
        GROUP BY DATEPART(day, INVOICE_DATE), MEDICINE_NAME
        ORDER BY DATEPART(day, INVOICE_DATE), MEDICINE_NAME";

$result = $conn->query($sql);

// Check if any rows are returned
if ($result->num_rows > 0) {
    // Output data for each row
    while ($row = $result->fetch_assoc()) {
        echo "Day: " . $row["Day"] . "<br>";
        echo "Medicine: " . $row["Medicine"] . "<br>";
        echo "Quantity: " . $row["Quantity"] . "<br>";
        echo "-------------------------<br>";
    }
} else {
    echo "No results found.";
}

// Close the database connection
$conn->close();
?>
