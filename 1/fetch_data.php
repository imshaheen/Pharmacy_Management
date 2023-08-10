<?php
// Assuming you have already established a database connection
$SERVER = 'localhost';
$USERNAME = 'root';
$PASSWORD = '';
$DB = 'JMF';

$connection = mysqli_connect($SERVER, $USERNAME, $PASSWORD, $DB)
or
die("<div class='text-danger text-center h5'>Oops, Unable to connect with database!</div>");

// if (isset($_GET['id_number'], $_GET['medicine'], $_GET['month'], $_GET['start_date'], $_GET['end_date'])) {
//     $idNumber = $_GET['id_number'];
//     $selectedMedicine = $_GET['medicine'];
//     $selectedMonth = $_GET['month'];
//     $startDate = $_GET['start_date'];
//     $endDate = $_GET['end_date'];

    

//     // Query to fetch the data based on the filters
//     $query = "SELECT * FROM invoices WHERE CUSTOMER_ID = '" . mysqli_real_escape_string($connection, $idNumber) . "'";

//     if (!empty($selectedMedicine)) {
//         $query .= " AND MEDICINE_NAME LIKE '%" . mysqli_real_escape_string($connection, $selectedMedicine) . "%'";
//     }

//     if (!empty($selectedMonth)) {
//         $query .= " AND MONTH(INVOICE_DATE) = " . mysqli_real_escape_string($connection, $selectedMonth);
//     }

//     if (!empty($startDate) && !empty($endDate)) {
//         $query .= " AND INVOICE_DATE BETWEEN '" . mysqli_real_escape_string($connection, $startDate) . "' AND '" . mysqli_real_escape_string($connection, $endDate) . "'";
//     }

//     $result = mysqli_query($connection, $query);

//     // Check if the query was successful and display the data
//     if ($result && mysqli_num_rows($result) > 0) {
//         echo '<div class="container mt-4">';
//         echo '<h2 class="mb-3">Filtered Data</h2>';

//         while ($row = mysqli_fetch_assoc($result)) {
//             echo '<div class="card mb-3">';
//             echo '<div class="card-body">';
//             echo '<h5 class="card-title">ID Number: ' . $row['CUSTOMER_ID'] . '</h5>';
//             echo '<p class="card-text"><strong>Medicine Name:</strong> ' . $row['MEDICINE_NAME'] . '</p>';
//             echo '<p class="card-text"><strong>Invoice Date:</strong> ' . $row['INVOICE_DATE'] . '</p>';
//             // Add more fields as needed
//             echo '</div>';
//             echo '</div>';
//         }

//         echo '</div>';
//     } else {
//         echo '<div class="container mt-4">';
//         echo '<div class="alert alert-info" role="alert">';
//         echo 'No data available for the selected filters.';
//         echo '</div>';
//         echo '</div>';
//     }
// } else {
//     echo '<div class="container mt-4">';
//     echo '<div class="alert alert-danger" role="alert">';
//     echo 'Invalid request.';
//     echo '</div>';
//     echo '</div>';
// }

// // Close the database connection
// mysqli_close($connection);
// ?>
<?php
// Assuming you have already established a database connection

$query = "SELECT * FROM invoices ";

$filters = array();
if (!empty($idNumber)) {
    $filters[] = "CUSTOMER_ID = '" . mysqli_real_escape_string($connection, $idNumber) . "'";
}

if (!empty($selectedMedicine)) {
    $filters[] = "MEDICINE_NAME LIKE '%" . mysqli_real_escape_string($connection, $selectedMedicine) . "%'";
}

if (!empty($selectedMonth)) {
    $filters[] = "MONTH(INVOICE_DATE) = " . mysqli_real_escape_string($connection, $selectedMonth);
}

if (!empty($startDate) && !empty($endDate)) {
    $filters[] = "INVOICE_DATE BETWEEN '" . mysqli_real_escape_string($connection, $startDate) . "' AND '" . mysqli_real_escape_string($connection, $endDate) . "'";
}

if (!empty($filters)) {
    $query .= implode(" AND ", $filters);

    $result = mysqli_query($connection, $query);

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
mysqli_close($connection);
?>
