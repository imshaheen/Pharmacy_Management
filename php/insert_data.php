<?php
require "db_connection.php";
if (isset($_POST['Save'])){

// Extract the data fields
$customers_name = $_POST['customers_name'];
$invoice_date = date('Y-m-d', strtotime($_POST['invoice_date']));
// $invoice_date = $_POST['invoice_date'];
$in_time = $_POST['in_time'];
$out_time = $_POST['out_time'];
$Disease = $_POST['Disease'];
$fit_for_work = $_POST['fit_for_work'];
$c_doctor = $_POST['c_doctor'];
$medicineNames = $_POST['medicine_name'];
$issueQuantities = $_POST['issue_quantity'];

     // Escape and prepare the values for the SQL query
     $escapedMedicineNames = array_map(function ($value) use ($con) {
        return mysqli_real_escape_string($con, $value);
    }, $medicineNames);
    $escapedIssueQuantities = array_map(function ($value) use ($con) {
        return mysqli_real_escape_string($con, $value);
    }, $issueQuantities);

    // Combine the values into a single string
    $combinedMedicineNames = implode(", ", $escapedMedicineNames);
    $combinedIssueQuantities = implode(", ", $escapedIssueQuantities);

// Retrieve the "in" time and "out" time from the HTML form
// $inTime = $_POST['in_time'];
// $outTime = $_POST['out_time'];

// Convert inTime and outTime to DateTime objects
$startTime = new DateTime($in_time);
$endTime = new DateTime($out_time);

// Calculate the time difference
$timeDiff = $startTime->diff($endTime);

// Format the time difference as a string
$formattedTimeDiff = $timeDiff->format('%H hours, %i minutes');

// Output the formatted time difference
// echo $formattedTimeDiff;

// Perform database insertion
$sql = "INSERT INTO invoices (CUSTOMER_ID, INVOICE_DATE, IN_TIME, OUT_TIME, TOTAL_SPEND, DISEASE, FIT_FOR_WORK, CONSULTED_DOCTOR, MEDICINE_NAME, ISSUEQUANTITY) 
VALUES ('$customers_name', '$invoice_date', '$in_time', '$out_time', '$formattedTimeDiff', '$Disease', '$fit_for_work', '$c_doctor', '$combinedMedicineNames', '$combinedIssueQuantities')";
// $stmt = $con->prepare($sql);
// $stmt->bind_param("ss", $nameData, $emailData);
// $stmt->execute();

// $insertResult = mysqli_query(con,$sql);
$insertResult = mysqli_query($con, $sql);

// Check if the insert query was successful
if ($insertResult) {
    // Update stock quantities
    $updateQuery = "UPDATE medicines_stock SET QUANTITY = QUANTITY - $combinedIssueQuantities WHERE NAME = '$combinedMedicineNames'";
    $updateResult = mysqli_query($con, $updateQuery);

    // Check if the update query was successful
    if ($updateResult) {
        // echo "Data inserted and stocks updated successfully.";
    } else {
        echo "Error updating stocks: " . mysqli_error($con);
    }
} else {
    echo "Error inserting data: " . mysqli_error($con);
}

// Close the database connection
mysqli_close($con);

// if ($con->query($sql) === TRUE) {
//      echo "Data inserted successfully";
    // echo "<script> alert('Data inserted successfully');</script>";   
    // header("Location: ../home.php");

   
// Prepare and execute the SQL query
// $sql = "INSERT INTO invoices (MEDICINE_NAME, ISSUEQUANTITY) VALUES (?, ?)";
// $stmt = $con->prepare($sql);
// $stmt->bind_param("ss", $nameData, $emailData);
// $stmt->execute();

// $stmt->close();
// $con->close();    
      
// } else {
//     echo "Error: " . $sql . "<br>" . $con->error;
// }
}


 
?>