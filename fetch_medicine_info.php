<?php
// Assuming you have already established a database connection
$SERVER = 'localhost';
$USERNAME = 'root';
$PASSWORD = '';
$DB = 'JMF';

$connection = mysqli_connect($SERVER, $USERNAME, $PASSWORD, $DB)
or
die("<div class='text-danger text-center h5'>Oops, Unable to connect with database!</div>");

// if (isset($_GET['medicine'])) {
//     $selectedMedicine = $_GET['medicine'];

//     // Query to fetch the medicine information
//     $query = "SELECT * FROM medicines_stock WHERE NAME = '" . mysqli_real_escape_string($connection, $selectedMedicine) . "'";
//     $result = mysqli_query($connection, $query);

//     // Check if the query was successful and display the medicine information
//     if ($result && mysqli_num_rows($result) > 0) {
//         $medicineInfo = mysqli_fetch_assoc($result);

//         echo "<h2>Medicine Information</h2>";
//         echo "<p><strong>Medicine Name:</strong> " . $medicineInfo['NAME'] . "</p>";
//         echo "<p><strong>Quantity:</strong> " . $medicineInfo['QUANTITY'] . "</p>";
//         // Add more fields as needed
//     } else {
//         echo "No information available for the selected medicine.";
//     }
// } else {
//     echo "Invalid request.";
// }

// // Close the database connection
// mysqli_close($connection);

// Assuming you have already established a database connection

// if (isset($_GET['medicine'])) {
//     $selectedMedicine = $_GET['medicine'];

//     // Query to fetch the medicine information
//     $query = "SELECT * FROM invoices WHERE MEDICINE_NAME LIKE '%" . mysqli_real_escape_string($connection, $selectedMedicine) . "%'";
//     $result = mysqli_query($connection, $query);

//     // Check if the query was successful and display the medicine information
//     if ($result && mysqli_num_rows($result) > 0) {
//         echo "<h2>Medicine Information</h2>";

//         while ($row = mysqli_fetch_assoc($result)) {
//             $medicineNames = explode(",", $row['MEDICINE_NAME']);
//             $quantities = explode(",", $row['ISSUEQUANTITY']);

//             foreach ($medicineNames as $key => $medicineName) {
//                 $medicineName = trim($medicineName);
//                 $quantity = trim($quantities[$key]);

//                 if ($medicineName === $selectedMedicine) {
//                     echo "<p><strong>Medicine Name:</strong> " . $medicineName . "</p>";
//                     echo "<p><strong>Quantity:</strong> " . $quantity . "</p>";
//                     // Add more fields as needed
//                 }
//             }
//         }
//     } else {
//         echo "No information available for the selected medicine.";
//     }
// } else {
//     echo "Invalid request.";
// }

// // Close the database connection
// mysqli_close($connection);
// if (isset($_GET['medicine'])) {
//     $selectedMedicine = $_GET['medicine'];

//     // Query to fetch the medicine information
//     $query = "SELECT * FROM invoices WHERE MEDICINE_NAME LIKE '%" . mysqli_real_escape_string($connection, $selectedMedicine) . "%'";
//     $result = mysqli_query($connection, $query);

//     // Check if the query was successful and display the medicine information
//     if ($result && mysqli_num_rows($result) > 0) {
//         echo "<h2>Medicine Information</h2>";

//         while ($row = mysqli_fetch_assoc($result)) {
//             $medicineNames = explode(",", $row['MEDICINE_NAME']);
//             $quantities = explode(",", $row['ISSUEQUANTITY']);

//             $invoiceDate = $row['INVOICE_DATE'];

//             foreach ($medicineNames as $key => $medicineName) {
//                 $medicineName = trim($medicineName);
//                 $quantity = trim($quantities[$key]);

//                 if ($medicineName === $selectedMedicine) {
//                     echo "<p><strong>Medicine Name:</strong> " . $medicineName . "</p>";
//                     echo "<p><strong>Quantity:</strong> " . $quantity . "</p>";
//                     echo "<p><strong>Invoice Date:</strong> " . $invoiceDate . "</p>";
//                     // Add more fields as needed
//                 }
//             }
//         }
//     } else {
//         echo "No information available for the selected medicine.";
//     }
// } else {
//     echo "Invalid request.";
// }

// // Close the database connection
// mysqli_close($connection);


// Assuming you have already established a database connection

// $query = "SELECT * FROM invoices WHERE ";

// $filters = array();
// if (!empty($idNumber)) {
//     $filters[] = "CUSTOMER_ID = '" . mysqli_real_escape_string($connection, $idNumber) . "'";
// } elseif (!empty($selectedMedicine)) {
//     $filters[] = "MEDICINE_NAME LIKE '%" . mysqli_real_escape_string($connection, $selectedMedicine) . "%'";
// } elseif (!empty($selectedMonth)) {
//     $filters[] = "MONTH(INVOICE_DATE) = " . mysqli_real_escape_string($connection, $selectedMonth);
// } elseif (!empty($startDate) && !empty($endDate)) {
//     $filters[] = "INVOICE_DATE BETWEEN '" . mysqli_real_escape_string($connection, $startDate) . "' AND '" . mysqli_real_escape_string($connection, $endDate) . "'";
// }

// if (!empty($filters)) {
//     $query .= implode(" AND ", $filters);

//     $result = mysqli_query($connection, $query);

//     // Check if the query was successful and display the data
//     if ($result && mysqli_num_rows($result) > 0) {
//         echo "<div class='container mt-4'>";
//         echo "<h2>Filtered Data</h2>";

//         while ($row = mysqli_fetch_assoc($result)) {
//             // Display the relevant data
//             echo "<p><strong>ID Number:</strong> " . $row['CUSTOMER_ID'] . "</p>";
//             echo "<p><strong>Medicine Name:</strong> " . $row['MEDICINE_NAME'] . "</p>";
//             echo "<p><strong>Invoice Date:</strong> " . $row['INVOICE_DATE'] . "</p>";
//             // Add more fields as needed
//             echo "<hr>";
//         }

//         echo "</div>";
//     } else {
//         echo "<div class='container mt-4'>";
//         echo "<div class='alert alert-info' role='alert'>";
//         echo "No data available for the selected filters.";
//         echo "</div>";
//         echo "</div>";
//     }
// } else {
//     echo "<div class='container mt-4'>";
//     echo "<div class='alert alert-info' role='alert'>";
//     echo "Please select at least one filter.";
//     echo "</div>";
//     echo "</div>";
// }

// // Close the database connection
// mysqli_close($connection);
// ?>
<?php
// Assuming you have already established a database connection
$SERVER = 'localhost';
$USERNAME = 'root';
$PASSWORD = '';
$DB = 'JMF';

$con = mysqli_connect($SERVER, $USERNAME, $PASSWORD, $DB) or die("<div class='text-danger text-center h5'>Oops, Unable to connect with the database!</div>");

// Check if any filter value is received
if (isset($_GET['id_number']) || isset($_GET['medicine']) || isset($_GET['month']) || isset($_GET['start_date']) || isset($_GET['end_date'])) {
    $idNumber = $_GET['id_number'];
    $medicine = $_GET['medicine'];
    $month = $_GET['month'];
    $startDate = $_GET['start_date'];
    $endDate = $_GET['end_date'];

    // Query to fetch data based on the filters
    $query = "SELECT * FROM invoices WHERE MEDICINE_NAME LIKE '%" . $medicine . "%' ";

    // if (!empty($idNumber)) {
    //     $query .= " AND CUSTOMER_ID = '" . mysqli_real_escape_string($con, $idNumber) . "'";
    // }

    // if (!empty($medicine)) {
    //     $query .= " AND MEDICINE_NAME LIKE '%" . $medicine . "%'";
    // }

    // if (!empty($month)) {
    //     $query .= " AND MONTH(INVOICE_DATE) = " . mysqli_real_escape_string($con, $month);
    // }

    // if (!empty($startDate) && !empty($endDate)) {
    //     $query .= " AND INVOICE_DATE BETWEEN '" . mysqli_real_escape_string($con, $startDate) . "' AND '" . mysqli_real_escape_string($con, $endDate) . "'";
    // }

    $result = mysqli_query($con, $query);

    print_r($result);

    // Check if the query was successful and display the data
    if ($result && mysqli_num_rows($result) > 0) {
        echo "<div class='container mt-4'>";
        echo "<h2>Filtered Data</h2>";

        while ($row = mysqli_fetch_assoc($result)) {
            // Display the relevant data
            echo "<p><strong>ID Number:</strong> " . $row['CUSTOMER_ID'] . "</p>";
            echo "<p><strong>Medicine Name:</strong> " . $row['MEDICINE_NAME'] . "</p>";
            echo "<p><strong>Invoice Date:</strong> " . $row['INVOICE_DATE'] . "</p>";
            // Add more fields as needed
            echo "<hr>";
        }

        echo "</div>";
    } else {
        echo "<div class='container mt-4'>";
        echo "<div class='alert alert-info' role='alert'>";
        echo "No data available for the selected filters.";
        echo "</div>";
        echo "</div>";
    }
} else {
    echo "<div class='container mt-4'>";
    echo "<div class='alert alert-info' role='alert'>";
    echo "Please select at least one filter.";
    echo "</div>";
    echo "</div>";
}

// Close the database connection
mysqli_close($con);
?>

