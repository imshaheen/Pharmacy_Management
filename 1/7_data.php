<?php
      $servername = "localhost";
      $username = "root";
      $password = "";
      $dbname = "jmf";

      // Create a connection
      $conn = new mysqli($servername, $username, $password, $dbname);

      // Check connection
      if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
      }

$selectedMonth = 1; // Change this to the selected month (1 for January)
$selectedMedicineName = "Crosin";

// Query to retrieve reports for the selected month and medicine name
$sql = "SELECT r.*, m.MedicineName
        FROM report r
        INNER JOIN report m ON r.id = m.id
        WHERE MONTH(r.date) = $selectedMonth
        AND m.MedicineName = '$selectedMedicineName'";

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    while ($row = $result->fetch_assoc()) {
        echo "Report Date: " . $row["date"] . "<br>";
        echo "Medicine: " . $row["MedicineName"] . "<br>";
        // Display other report details here
        echo "<br>";
    }
} else {
    echo "No results found.";
}

$conn->close();
?>
