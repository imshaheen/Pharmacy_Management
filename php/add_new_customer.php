<?php
  require "db_connection.php";
  if($con) {
    $name = ucwords($_GET["name"]);
    $contact_number = $_GET["contact_number"];
    $address = ucwords($_GET["address"]);
    $doctor_name = ucwords($_GET["doctor_name"]);
    $doctor_address = ucwords($_GET["doctor_address"]);

    $query = "SELECT * FROM customers WHERE NAME = '$name'";
    $result = mysqli_query($con, $query);
    $row = mysqli_fetch_array($result);
    if($row)
      echo "Employee ".$row['CONTACT_NUMBER']." with ID $name already exists!";
    else {
      $query = "INSERT INTO customers (NAME, CONTACT_NUMBER, ADDRESS, DOCTOR_NAME, DOCTOR_ADDRESS) VALUES('$name', '$contact_number', '$address', '$doctor_name', '$doctor_address')";
      $result = mysqli_query($con, $query);
      if(!empty($result))
  			echo "$contact_number added...";
  		else
  			echo "Failed to add $contact_number!";
    }
  }
?>
