<?php
// Assuming you have already established a database connection
$SERVER = 'localhost';
$USERNAME = 'root';
$PASSWORD = '';
$DB = 'JMF';

$connection = mysqli_connect($SERVER, $USERNAME, $PASSWORD, $DB)
or
die("<div class='text-danger text-center h5'>Oops, Unable to connect with database!</div>");

// Query to retrieve medicine-wise report
$query = "SELECT MEDICINE_NAME, ISSUEQUANTITY FROM invoices";

// Execute the query
$result = mysqli_query($connection, $query);

// Check if the query was successful
if ($result) {
    // Create an array to store medicine quantities
    $medicineQuantities = array();

    // Fetch the results
    while ($row = mysqli_fetch_assoc($result)) {
        // Split the medicine names by the separator
        $medicineNames = explode(",", $row['MEDICINE_NAME']);

        // Split the quantities by the separator
        $quantities = explode(",", $row['ISSUEQUANTITY']);

        // Loop through each medicine name and quantity
        foreach ($medicineNames as $key => $medicineName) {
            // Trim any whitespace around the medicine name and quantity
            $medicineName = trim($medicineName);
            $quantity = trim($quantities[$key]);

            // Check if the medicine name already exists in the quantities array
            if (isset($medicineQuantities[$medicineName])) {
                // Increment the quantity for the medicine
                $medicineQuantities[$medicineName] += $quantity;
            } else {
                // Initialize the quantity for the medicine
                $medicineQuantities[$medicineName] = $quantity;
            }
        }
    }

    // Display the report header
    echo "<h2>Medicine-wise Report</h2>";
    echo "<table>";
    echo "<tr><th>Medicine Name</th><th>Total Quantity</th></tr>";

    // Display each medicine and its total quantity
    foreach ($medicineQuantities as $medicineName => $totalQuantity) {
        echo "<tr><td>" . $medicineName . "</td><td>" . $totalQuantity . "</td></tr>";
    }

    echo "</table>";
} else {
    // Display an error message if the query fails
    echo "Error: " . mysqli_error($connection);
}

// Close the database connection
mysqli_close($connection);
?>
