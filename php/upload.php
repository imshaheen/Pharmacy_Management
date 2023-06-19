<?php

include_once './php/db_connection.php';
 
if (isset($_POST['submit']))
{
     
    $fileMimes = array(
        'text/x-comma-separated-values',
        'text/comma-separated-values',
        'application/octet-stream',
        'application/vnd.ms-excel',
        'application/x-csv',
        'text/x-csv',
        'text/csv',
        'application/csv',
        'application/excel',
        'application/vnd.msexcel',
        'text/plain'
    );
 
    // Validate selected file is a CSV file or not
    if (!empty($_FILES['file']['name']) && in_array($_FILES['file']['type'], $fileMimes))
    {
 
        // Open uploaded CSV file with read-only mode
        $csvFile = fopen($_FILES['file']['tmp_name'], 'r');

        // Skip the first line
        fgetcsv($csvFile);

        // Parse data from CSV file line by line        
        while (($getData = fgetcsv($csvFile, 10000, ",")) !== FALSE)
        {
            // Get row data
            $NAME = $getData[0];
            $CONTACT_NUMBER = $getData[1]; 
            $ADDRESS = $getData[2]; 
            $DOCTOR_NAME = $getData[3]; 
            $DOCTOR_ADDRESS = $getData[4]; 


            // If user already exists in the database with the same email
            $query = "SELECT NAME FROM customers WHERE NAME = '" . $getData[0] . "'";

            $check = mysqli_query($con, $query);

            if ($check->num_rows > 0)
            {
                mysqli_query($con, "UPDATE customers SET NAME = '" . $NAME . "', CONTACT_NUMBER = '" . $CONTACT_NUMBER . "', ADDRESS = '" . $ADDRESS . "', DOCTOR_NAME = '" . $DOCTOR_NAME . "', DOCTOR_ADDRESS = '" . $DOCTOR_ADDRESS . "'");
            }
            else
            {
                $result = mysqli_query($con, "INSERT INTO customers (NAME, CONTACT_NUMBER, ADDRESS, DOCTOR_NAME, DOCTOR_ADDRESS) VALUES ('" . $NAME . "', '" . $CONTACT_NUMBER . "', '" . $ADDRESS . "', '" . $DOCTOR_NAME . "', '" . $DOCTOR_ADDRESS . "')");
            }
        }

        // Close opened CSV file
        fclose($csvFile);

        // header("Location: index.php");         
        echo "error_log($result)";
    }
    else
    {
        echo "Please select valid file";
    }
}