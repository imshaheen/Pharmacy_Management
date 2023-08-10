<?php
// Retrieve form data
$medicineName = $_POST['medicineName'];
$quantity = $_POST['quantity'];
$unit = $_POST['unit'];
$batchId = $_POST['batchId'];
$expiryDate = $_POST['expiryDate'];

// Database connection parameters
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "jmf";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


// Insert into purchases table
$insertPurchaseQuery = "INSERT INTO purchases (medicine_name, quantity, unit, batch_id, expiry_date, supplier_name) VALUES ('$medicineName', $quantity, '$unit', '$batchId', '$expiryDate', 'Head Office')";
$conn->query($insertPurchaseQuery);


// Get the latest BATCH_ID from purchases
$latestBatchIdQuery = "SELECT batch_id FROM purchases ORDER BY purchase_date DESC LIMIT 1";
$latestBatchIdResult = $conn->query($latestBatchIdQuery);

if ($latestBatchIdResult->num_rows > 0) {
    $row = $latestBatchIdResult->fetch_assoc();
    $latestBatchId = $row['batch_id'];

    // Update BATCH_ID in medicines_stock
    $updateBatchIdQuery = "UPDATE medicines_stock SET batch_id = '$latestBatchId' , EXPIRY_DATE = '$expiryDate' WHERE NAME = '$medicineName'";
    $conn->query($updateBatchIdQuery);

    // Redirect back to the HTML form with success message and latest batch ID
    header("Location: index.php?status=success&batch_id=" . urlencode($latestBatchId));
}
 else {
    // Redirect back to the HTML form with error message
    header("Location: index.php?status=error&batch_id=" . urlencode($existingBatchCount));
  
}
// Check if the medicine exists in medicines_stock
$checkQuery = "SELECT * FROM medicines_stock WHERE NAME = '$medicineName'";
$checkResult = $conn->query($checkQuery);

if ($checkResult->num_rows > 0) {
    // Medicine exists, update quantity
    $updateQuery = "UPDATE medicines_stock SET QUANTITY = QUANTITY + $quantity , EXPIRY_DATE = '$expiryDate' WHERE NAME = '$medicineName'";
    $conn->query($updateQuery);
} else {
    // Medicine does not exist, insert into medicines_stock
    $insertQuery = "INSERT INTO medicines_stock (NAME, QUANTITY, BATCH_ID, EXPIRY_DATE) VALUES ('$medicineName', $quantity, '$latestBatchId', '$expiryDate')";
    $conn->query($insertQuery);
}

$conn->close();

?>
<?php
// Connect to the database (replace with your actual database credentials)
$host = 'localhost';
$dbName = 'jmf';
$user = 'root';
$password = '';

// Create a new mysqli connection
$mysqli = new mysqli($host, $user, $password, $dbName);

// Check for connection errors
if ($mysqli->connect_errno) {
  die('Connection failed: ' . $mysqli->connect_error);
}

// Fetch medicine data from the database table
$query = "SELECT NAME FROM medicines";
$result = $mysqli->query($query);

$medicineData = array();
while ($row = $result->fetch_assoc()) {
  $medicineData[] = $row;
}

// Close the database connection
$mysqli->close();

// Return the medicine data as JSON
header('Content-Type: application/json');
echo json_encode($medicineData);
?>