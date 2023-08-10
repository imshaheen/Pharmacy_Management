<?php
// Database connection settings
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "jmf";

// Create a connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check the connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}


// Get user input
$start_date = $_POST['start_date'];
$end_date = $_POST['end_date'];
$medicine_name = $_POST['medicine_name'];


 // Check if today's date entry exists, and if not, create it
$today_date = date('Y-m-d');
$check_entry_query = "SELECT * FROM report WHERE Report_date = '$today_date' AND MedicineName = '$medicine_name'";
$check_entry_result = $conn->query($check_entry_query);

if ($check_entry_result->num_rows === 0) {
    $previous_date = date('Y-m-d', strtotime($today_date . ' -1 day'));
    $previous_closing_query = "SELECT ClosingStocks FROM report WHERE Report_date = '$previous_date' AND MedicineName = '$medicine_name'";
    $previous_closing_result = $conn->query($previous_closing_query);
    $previous_closing_balance = null; // Initialize with null
    
    if ($previous_closing_result->num_rows > 0) {
        $previous_closing_row = $previous_closing_result->fetch_assoc();
        $previous_closing_balance = $previous_closing_row['ClosingStocks'];
    } else {
        // If previous day's closing balance is not available in the report table, fetch opening balance from purchases
        $opening_balance_query = "SELECT quantity FROM purchases WHERE purchase_date = '$previous_date' AND medicine_name = '$medicine_name'";
        $opening_balance_result = $conn->query($opening_balance_query);
        
        if ($opening_balance_result->num_rows > 0) {
            $opening_balance_row = $opening_balance_result->fetch_assoc();
            $previous_closing_balance = $opening_balance_row['quantity']; // Use the quantity as opening balance
            
            // Insert a new row for the previous day with the opening balance
            $insert_previous_day_query = "INSERT INTO report (Report_date, MedicineName, OpeningBalance) VALUES ('$today_date', '$medicine_name', $previous_closing_balance)";
            $conn->query($insert_previous_day_query);
        }
    }
    
    // Fetch opening balance for the current day from purchases if available
    $today_opening_balance_query = "SELECT quantity FROM purchases WHERE purchase_date = '$today_date' AND medicine_name = '$medicine_name'";
    $today_opening_balance_result = $conn->query($today_opening_balance_query);
    $today_opening_balance = null;
    
    if ($today_opening_balance_result->num_rows > 0) {
        $today_opening_balance_row = $today_opening_balance_result->fetch_assoc();
        $today_opening_balance = $today_opening_balance_row['quantity'];
    }
    
    // Insert a new row for the current day with the opening balance from purchases
    $insert_today_query = "INSERT INTO report (Report_date, MedicineName, OpeningBalance, daysDistribution, ClosingStocks) VALUES ('$today_date', '$medicine_name', $today_opening_balance, 0, 0)";
    $conn->query($insert_today_query);
    
    // Initialize the sum_quantities_by_date array
    $sum_quantities_by_date = array();
    
    // Update the report table with the calculated sum quantities for each date
    foreach ($sum_quantities_by_date as $date => $sum_quantity) {
        $update_query = "UPDATE report SET daysDistribution = $sum_quantity WHERE Report_date = '$date' AND MedicineName = '$medicine_name'";
        $result = $conn->query($update_query);
    
        // If no rows were updated, insert a new entry
        if ($conn->affected_rows === 0) {
            $insert_query = "INSERT INTO report (Report_date, MedicineName, daysDistribution) VALUES ('$date', '$medicine_name', $sum_quantity)";
            $conn->query($insert_query);
        }
        
        // Calculate the difference between previous day's closing balance and current day's distribution
        $diff = $sum_quantity - ($previous_closing_balance !== null ? $previous_closing_balance : 0);
    
        // Update the closing balance for the current day
        $update_closing_query = "UPDATE report SET ClosingStocks = $diff WHERE Report_date = '$date' AND MedicineName = '$medicine_name'";
        $conn->query($update_closing_query);
    
        // Set the previous day's closing balance for the next iteration
        $previous_closing_balance = $sum_quantity;
    }
    
    echo "Quantities and Closing Stocks updated in report successfully.";
} else {
    echo "Today's entry already exists in the report.";
}


// Query the database based on the selected dates
if (empty($end_date)) {
    $sql = "SELECT MedicineName, OpeningBalance FROM report WHERE Report_date = '$start_date' AND MedicineName = '$medicine_name'";
} else {
    $sql = "SELECT * FROM report WHERE Report_date >= '$start_date' AND Report_date <= '$end_date' AND MedicineName = '$medicine_name'";
}

$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<h2>Opening Balances Report</h2>";
    echo "<table>";
    echo "<tr><th>Date</th><th>Opening Balance</th><th>Medicine Name</th></tr>";
    
    while ($row = $result->fetch_assoc()) {
        $rdate = $row['Report_date'];
        $opening_balance = $row['OpeningBalance'];
        $Medicine = $row['MedicineName'];
        
        echo "<tr><td>$rdate</td><td>$opening_balance</td><td>$Medicine</td></tr>";
    }
    
    echo "</table>";
} else {
    echo "No Opening data found for the selected date range.";
}

$sql = "SELECT purchase_date, medicine_name, SUM(quantity) AS TotalQuantity FROM purchases WHERE purchase_date >= '$start_date' AND purchase_date <= '$end_date' AND medicine_name = '$medicine_name' GROUP BY purchase_date, medicine_name";
$result = $conn->query($sql);

if ($result->num_rows > 0) {
    echo "<h2>Daily Purchases Quantity Report</h2>";
    echo "<table>";
    echo "<tr><th>Date</th><th>Total Quantity</th></tr>";
    
    while ($row = $result->fetch_assoc()) {
        $pdate = $row['purchase_date'];
        $total_quantity = $row['TotalQuantity'];
        $medicine_Name = $row['medicine_name'];
        
        echo "<tr><td>$pdate</td><td>$total_quantity</td><td>$medicine_Name</td></tr>";
    }
    
    echo "</table>";
} else {
    echo "No Purchases data found";  
}

$balance_query = "SELECT * FROM report WHERE Report_date >= '$start_date' AND Report_date <= '$end_date' AND MedicineName = '$medicine_name'";
$quantity_query = "SELECT purchase_date, medicine_name, SUM(quantity) AS TotalQuantity FROM purchases WHERE purchase_date >= '$start_date' AND purchase_date <= '$end_date' AND medicine_name = '$medicine_name' GROUP BY purchase_date, medicine_name";

$balance_result = $conn->query($balance_query);
$quantity_result = $conn->query($quantity_query);

$opening_balance_map = array();

if ($balance_result->num_rows > 0) {
    while ($row = $balance_result->fetch_assoc()) {
        $rdate = $row['Report_date'];
        $M_name = $row['MedicineName'];
        $opening_balance = $row['OpeningBalance'];
        $opening_balance_map[$rdate] = $opening_balance;
    }
}

if ($quantity_result->num_rows > 0) {
    while ($row = $quantity_result->fetch_assoc()) {
        $pdate = $row['purchase_date'];
        $total_quantity = $row['TotalQuantity'];
        $Medi_name = $row['medicine_name'];
        
        if (isset($opening_balance_map[$pdate])) {
            $opening_balance = $opening_balance_map[$pdate];
            $total_stocks = $opening_balance + ($total_quantity !== null ? $total_quantity : 0);
            
            // Update the report table with the calculated total stocks
            $update_query = "UPDATE report SET totalStocks = $total_stocks WHERE Report_date = '$pdate' AND MedicineName = '$Medi_name'";
            $conn->query($update_query);
        }
    }
    
    echo "Total stocks updated successfully.";
} else {
    // Loop through opening balances when no quantity data is available
    foreach ($opening_balance_map as $odate => $opening_balance) {
        $update_query = "UPDATE report SET totalStocks = $opening_balance WHERE Report_date = '$odate' AND MedicineName = '$medicine_name'";
        $conn->query($update_query);
    }
    
    echo "Total stocks updated successfully (using only opening balances).";
}




// Query the database for invoices within the selected date range and medicine
$invoice_query = "SELECT INVOICE_DATE, ISSUEQUANTITY, MEDICINE_NAME FROM invoices WHERE INVOICE_DATE >= '$start_date' AND INVOICE_DATE <= '$end_date'";
$invoice_result = $conn->query($invoice_query);


$sum_quantities_by_date = array();

if ($invoice_result->num_rows > 0) {
    while ($row = $invoice_result->fetch_assoc()) {
        $invoice_date = $row['INVOICE_DATE'];
        $medicine_names = explode(',', $row['MEDICINE_NAME']);
        $quantities = explode(',', $row['ISSUEQUANTITY']);

        // Loop through each medicine and quantity pair
        for ($i = 0; $i < count($medicine_names); $i++) {
            $medicine = trim($medicine_names[$i]);
            $quantity = trim($quantities[$i]);

            // Check if the medicine name matches the selected medicine name
            if ($medicine === $medicine_name) {
                // Add quantity to the sum for the respective date
                if (!isset($sum_quantities_by_date[$invoice_date])) {
                    $sum_quantities_by_date[$invoice_date] = 0;
                }
                $sum_quantities_by_date[$invoice_date] += (int)$quantity;
            }
        }
    }
    
       // Update the report table with the calculated sum quantities for each date
       foreach ($sum_quantities_by_date as $date => $sum_quantity) {
        $update_query = "UPDATE report SET daysDistribution = $sum_quantity WHERE Report_date = '$date' AND MedicineName = '$medicine_name'";
        $result = $conn->query($update_query);

        // If no rows were updated, insert a new entry
        if ($conn->affected_rows === 0) {
            $insert_query = "INSERT INTO report (Report_date, MedicineName, daysDistribution) VALUES ('$date', '$medicine_name', $sum_quantity)";
            $conn->query($insert_query);
        }

            // Calculate the difference between totalStocks and daysDistribution
    $closing_balance_query = "UPDATE report SET ClosingStocks = totalStocks - daysDistribution WHERE Report_date = '$date' AND MedicineName = '$medicine_name'";
    $conn->query($closing_balance_query);
    }
    
    echo "Quantities updated in report successfully.";
} else {
    echo "No invoices found for the selected date range and medicine.";
}







?>
