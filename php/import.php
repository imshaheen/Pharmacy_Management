<?php
include '../php/db_connection.php';
if(isset($_POST["Import"])){
		

		echo $filename=$_FILES["file"]["tmp_name"];
		

		 if($_FILES["file"]["size"] > 0)
		 {

		  	$file = fopen($filename, "r");
			  fgetcsv($file);
	         while (($emapData = fgetcsv($file, 10000, ",")) !== FALSE){

			  // If user already exists in the database with the same email
			  $query = "SELECT NAME FROM customers WHERE NAME = '" . $emapData[0] . "'";

			  $check = mysqli_query($con, $query);
  
			  if (mysqli_num_rows($check) > 0){

				$sql = "UPDATE customers SET CONTACT_NUMBER = '$emapData[1]', ADDRESS = '$emapData[2]',DOCTOR_NAME = '$emapData[3]',DOCTOR_ADDRESS = '$emapData[4]' WHERE NAME = '$emapData[0]'";
				
				$result = mysqli_query( $con, $sql );
			  }else {
					 //It wiil insert a row to our subject table from our csv file`
					   $sql = "INSERT into customers (`NAME`, `CONTACT_NUMBER`, `ADDRESS`, `DOCTOR_NAME`,DOCTOR_ADDRESS) 
					   values('$emapData[0]','$emapData[1]','$emapData[2]','$emapData[3]','$emapData[4]')";
					   //we are using mysql_query function. it returns a resource on true else False on error
						$result = mysqli_query( $con, $sql );	

				}
	         }
	         fclose($file);
	        //  throws a message if data successfully imported to mysql database from excel file
	         echo "<script type=\"text/javascript\">
						alert(\"CSV File has been successfully Imported.\");
						window.location.href='http://localhost/Pharmacy_Management/manage_customer.php';
					
						</script>";
	        
			 

			 //close of connection
			mysqli_close($con); 
				
		 	
			
		 }
	}	 
?>		 