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

// Get the customer information
$customersName = $_POST['customers_name'];
$invoiceDate = $_POST['invoice_date'];
$inTime = $_POST['in_time'];
$outTime = $_POST['out_time'];
$disease = $_POST['disease'];
$fitForWork = $_POST['fit_for_work'];
$cDoctor = $_POST['c_doctor'];

// Prepare and execute the SQL query for customer information
$sqlCustomer = "INSERT INTO invoices (CUSTOMER_ID, INVOICE_DATE, IN_TIME, OUT_TIME, DISEASE, FIT_FOR_WORK, CONSULTED_DOCTOR) VALUES (?, ?, ?, ?, ?, ?, ?)";
$stmtCustomer = $conn->prepare($sqlCustomer);
$stmtCustomer->bind_param("sssssss", $customersName, $invoiceDate, $inTime, $outTime, $disease, $fitForWork, $cDoctor);
$stmtCustomer->execute();

// Get the product information
$productNames = $_POST['product_name'];
$quantities = $_POST['quantity'];

// Combine product names and quantities into a single row
$productData = array();
for ($i = 0; $i < count($productNames); $i++) {
  $productData[] = "(" . $conn->real_escape_string($productNames[$i]) . ", " . $conn->real_escape_string($quantities[$i]) . ")";
}

// Prepare and execute the SQL query for product information
$sqlProduct = "UPDATE invoices SET (MEDICINE_NAME, ISSUEQUANTITY) VALUES " . implode(", ", $productData) . " WHERE customers_name = ?";
$stmtProduct = $conn->prepare($sqlProduct);
$stmtProduct->bind_param("s", $customersName);
$stmtProduct->execute();

$stmtCustomer->close();
$stmtProduct->close();
$conn->close();
?>
