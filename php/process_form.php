<?php
// Establish connection to MySQL database
$conn = mysqli_connect('localhost', 'root', '', 'jmf');
if (!$conn) {
  die("Connection failed: " . mysqli_connect_error());
}

// Check if the form is submitted
if (isset($_POST['submit'])) {
  $name = mysqli_real_escape_string($conn, $_POST['name']);
  $specialization = mysqli_real_escape_string($conn, $_POST['specialization']);
  $phone_number = mysqli_real_escape_string($conn, $_POST['phone_number']);
  $address = mysqli_real_escape_string($conn, $_POST['address']);

  // Check if a doctor_id is present (edit mode)
  if (!empty($_POST['doctor_id'])) {
    $doctor_id = mysqli_real_escape_string($conn, $_POST['doctor_id']);
    $sql = "UPDATE drlist SET name='$name', specialization='$specialization', phone_number='$phone_number', address='$address' WHERE id='$doctor_id'";
  } else { // Insert new doctor (add mode)
    $sql = "INSERT INTO drlist (name, specialization, phone_number, address) VALUES ('$name', '$specialization', '$phone_number', '$address')";
  }

  // Execute the SQL statement
  if (mysqli_query($conn, $sql)) {
    echo "Doctor saved successfully";
  } else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
  }
}

// Close the database connection
mysqli_close($conn);
?>
