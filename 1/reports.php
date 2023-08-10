<!DOCTYPE html>
<html>
<head>
    <title>Medicine-wise Report</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <?php
        // Assuming you have already established a database connection
        $SERVER = 'localhost';
        $USERNAME = 'root';
        $PASSWORD = '';
        $DB = 'JMF';

        $connection = mysqli_connect($SERVER, $USERNAME, $PASSWORD, $DB) or die("<div class='text-danger text-center h5'>Oops, Unable to connect with the database!</div>");

        if (isset($_POST['month'])) {
            $month = $_POST['month'];

            // Construct the start and end dates based on the selected month
            $startDate = date("Y-$month-01");
            $endDate = date("Y-$month-t", strtotime($startDate));

            // Construct the previous month start and end dates
            $previousMonthStartDate = date("Y-m-01", strtotime("-1 month", strtotime($startDate)));
            $previousMonthEndDate = date("Y-m-t", strtotime($previousMonthStartDate));

            // Query to retrieve opening balance
            $openingBalanceQuery = "SELECT SUM(ISSUEQUANTITY) AS total FROM invoices WHERE INVOICE_DATE < '$startDate'";

            // Execute the opening balance query
            $openingBalanceResult = mysqli_query($connection, $openingBalanceQuery);
            $openingBalanceRow = mysqli_fetch_assoc($openingBalanceResult);
            $openingBalance = $openingBalanceRow['total'];

            // Query to retrieve closing balance
            $closingBalanceQuery = "SELECT SUM(ISSUEQUANTITY) AS total FROM invoices WHERE INVOICE_DATE > '$endDate'";

            // Execute the closing balance query
            $closingBalanceResult = mysqli_query($connection, $closingBalanceQuery);
            $closingBalanceRow = mysqli_fetch_assoc($closingBalanceResult);
            $closingBalance = $closingBalanceRow['total'];

            // Query to retrieve medicine-wise report within the selected month
            $query = "SELECT MEDICINE_NAME, ISSUEQUANTITY FROM invoices WHERE MONTH(INVOICE_DATE) = MONTH('$startDate')";

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

                // Display the report header and date range
                echo "<h2 class='mt-4'>Monthly Report: " . date('F', strtotime($startDate)) . "</h2>";
                echo "<table class='table table-striped'>";
                echo "<thead><tr><th>Medicine Name</th><th>Total Quantity</th></tr></thead>";
                echo "<tbody>";

                // Display each medicine and its total quantity
                foreach ($medicineQuantities as $medicineName => $totalQuantity) {
                    echo "<tr><td>$medicineName</td><td>$totalQuantity</td></tr>";
                }

                echo "</tbody>";
                echo "</table>";

                // Display opening and closing balances
                echo "<p>Opening Balance (Before $startDate): $openingBalance</p>";
                echo "<p>Closing Balance (After $endDate): $closingBalance</p>";

                // Print button
                echo "<button class='btn btn-primary mt-3' onclick='window.print()'>Print</button>";
            } else {
                // Display an error message if the query fails
                echo "<div class='text-danger text-center h5'>Error: " . mysqli_error($connection) . "</div>";
            }
        }

        // Close the database connection
        mysqli_close($connection);
        ?>
    </div>
</body>
</html>
