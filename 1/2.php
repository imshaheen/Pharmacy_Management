<!DOCTYPE html>
<html>
<head>
    <title>Medicine-wise Report</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h2 class="mt-4">Medicine-wise Report</h2>
        <form method="GET" action="">
            <div class="form-group">
                <label for="start-date">Start Date:</label>
                <input type="date" id="start-date" name="start_date" class="form-control" required>
            </div>
            <div class="form-group">
                <label for="end-date">End Date:</label>
                <input type="date" id="end-date" name="end_date" class="form-control" required>
            </div>
            <button type="submit" class="btn btn-primary">Generate Report</button>
        </form>

        <?php
        // Assuming you have already established a database connection
        $SERVER = 'localhost';
        $USERNAME = 'root';
        $PASSWORD = '';
        $DB = 'JMF';

        $connection = mysqli_connect($SERVER, $USERNAME, $PASSWORD, $DB) or die("<div class='text-danger text-center h5'>Oops, Unable to connect with the database!</div>");

        if (isset($_GET['start_date']) && isset($_GET['end_date'])) {
            $startDate = $_GET['start_date'];
            $endDate = $_GET['end_date'];

            // Query to retrieve medicine-wise report within the selected date range
            $query = "SELECT MEDICINE_NAME, ISSUEQUANTITY FROM invoices WHERE INVOICE_DATE BETWEEN '$startDate' AND '$endDate'";

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
                echo "<h4 class='mt-4'>Date Range: $startDate to $endDate</h4>";
                echo "<table class='table table-striped'>";
                echo "<thead><tr><th>Medicine Name</th><th>Total Quantity</th></tr></thead>";
                echo "<tbody>";

                // Display each medicine and its total quantity
                foreach ($medicineQuantities as $medicineName => $totalQuantity) {
                    echo "<tr><td>$medicineName</td><td>$totalQuantity</td></tr>";
                }

                echo "</tbody>";
                echo "</table>";

                // Print button
                echo "<button class='btn btn-primary mt-3' onclick='window.print()'>Print</button>";
            } else {
                // Display an error message if the query fails
                echo "Error: " . mysqli_error($connection);
            }
        }

        // Close the database connection
        mysqli_close($connection);
        ?>
    </div>
</body>
</html>
