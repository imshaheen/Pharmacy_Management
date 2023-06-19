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
$sql = "INSERT INTO invoices (CUSTOMER_ID, INVOICE_DATE, IN_TIME, OUT_TIME, TOTAL_SPEND,  DISEASE, FIT_FOR_WORK, CONSULTED_DOCTOR) 
VALUES ('$customers_name', '$invoice_date', '$in_time', '$out_time', '$formattedTimeDiff', '$Disease', '$fit_for_work', '$c_doctor')";

if ($con->query($sql) === TRUE) {
    //  echo "Data inserted successfully";
    // echo "<script> alert('Data inserted successfully');</script>";   
    // header("Location: ../home.php");
      
} else {
    echo "Error: " . $sql . "<br>" . $con->error;
}
}

?>