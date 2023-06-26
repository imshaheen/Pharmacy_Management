<?php
// Establish a database connection
$servername =  $SERVER;
$username =  $USERNAME;
$password = $PASSWORD;
$dbname = $DB;

$conn = new mysqli($servername, $username, $password, $dbname);
if ($conn->connect_error) {
  die('Connection failed: ' . $conn->connect_error);
}

// Get the input data
$names = $_POST['names'];
$emails = $_POST['emails'];

// Concatenate the values
$nameData = implode(',', $names);
$emailData = implode(',', $emails);

// Prepare and execute the SQL query
$sql = "INSERT INTO invoices (MEDICINE_NAME, ISSUEQUANTITY) VALUES (?, ?)";
$stmt = $conn->prepare($sql);
$stmt->bind_param("ss", $nameData, $emailData);
$stmt->execute();

$stmt->close();
$conn->close();
?>