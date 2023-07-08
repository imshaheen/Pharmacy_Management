<?php
// api.php
require_once './php/db_connection.php';

$medicineName = $_GET['medicine'];

$sql = "SELECT QUANTITY, BATCH_ID, EXPIRY_DATE FROM medicines_stock WHERE NAME = ?";

$stmt = $con->prepare($sql);
$stmt->bind_param("s", $medicineName);

$stmt->execute();

$result = $stmt->get_result();

if ($result->num_rows > 0) {
  $row = $result->fetch_assoc();

  $data = array(
    'qty' => $row['QUANTITY'],
    'batchId' => $row['BATCH_ID'],
    'expiry' => $row['EXPIRY_DATE']
  );

  $jsonData = json_encode($data);

  echo $jsonData;
} else {
  echo "{}";
}

$stmt->close();
$con->close();
?>
