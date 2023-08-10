<?php
// Establish a database connection
$host = 'localhost';
$username = 'root';
$password = '';
$database = 'jmf';
$conn = mysqli_connect($host, $username, $password, $database);

// Check if the connection was successful
if (mysqli_connect_errno()) {
  echo "Failed to connect to MySQL: " . mysqli_connect_error();
}

// Process the selected options and generate the appropriate result
if (!empty($medicine) && empty($startDate) && empty($endDate)) {
  // Handle Medicine selection

  // Sanitize the input
  $sanitizedMedicine = mysqli_real_escape_string($conn, $medicine);

  // Query the invoices table for matching medicine
  $query = "SELECT * FROM invoices WHERE MEDICINE_NAME = '$sanitizedMedicine'";
  $result = mysqli_query($conn, $query);

  // Check if any matching records were found
  if (mysqli_num_rows($result) > 0) {
    // Output the results
    while ($row = mysqli_fetch_assoc($result)) {
      // Access the relevant data from the row
      $invoiceNumber = $row['INVOICE_NUMBER'];
      $customerName = $row['CUSTOMER_NAME'];
      $invoiceDate = $row['INVOICE_DATE'];

      // Output the data
      echo "Invoice Number: $invoiceNumber, Customer Name: $customerName, Invoice Date: $invoiceDate <br>";
    }
  } else {
    echo "No matching records found for the selected medicine.";
  }
} elseif (empty($medicine) && !empty($month) && empty($startDate) && empty($endDate)) {
  // Fetch month options from invoices table
$query = "SELECT DISTINCT MONTH(INVOICE_DATE) AS MONTH FROM invoices";
$result = mysqli_query($conn, $query);

// Create an empty array to store month options
$monthOptions = [];

// Loop through the query results and store month numbers in the array
while ($row = mysqli_fetch_assoc($result)) {
  $monthNumber = $row['MONTH'];
  $monthOptions[] = $monthNumber;
}
} elseif (empty($medicine) && empty($month) && !empty($startDate) && !empty($endDate)) {
  // Handle Start and End Date selection
  echo "Displaying results for the selected date range: " . htmlspecialchars($startDate) . " to " . htmlspecialchars($endDate);
} elseif (!empty($medicine) && !empty($month) && !empty($startDate) && !empty($endDate)) {
  // Handle all selections
  echo "Displaying results for Medicine: " . htmlspecialchars($medicine) . ", Month: " . htmlspecialchars($month) . ", Start Date: " . htmlspecialchars($startDate) . ", End Date: " . htmlspecialchars($endDate);
} else {
  // No specific selection made
  echo "Please make a selection";
}

// Close the database connection
mysqli_close($conn);



?>