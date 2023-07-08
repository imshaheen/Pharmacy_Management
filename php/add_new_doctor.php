<?php
  require "db_connection.php";
  if (isset($_POST['submit'])){

    $doctor_name = $_POST['doctor_name'];
    $doctor_degree = $_POST['doctor_degree'];
    $contact_number = $_POST['contact_number'];
    $Address = $_POST['Address'];
 

    $query = "SELECT * FROM doctor WHERE UPPER(NAME) = '".strtoupper($doctor_name)."'";
    $result = mysqli_query($con, $query);
    $row = mysqli_fetch_array($result);
    if($row)
      echo "Doctor with name $doctor_name already exists!";
    else {
      $query = "INSERT INTO drlist(drname, drdegree, drphone, draddress) VALUES('$doctor_name', '$doctor_degree', '$contact_number', '$Address')";
      $result = mysqli_query($con, $query);
      if(!empty($result))
  			echo "$doctor_name added...";
  		else
  			echo "Failed to add $doctor_name!";
    }
  }
?>
