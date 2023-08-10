<?php

$servername = "localhost";
$username = "root";
$password = "";
$dbname = "jmf";

// Create a connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
  die("Connection failed: " . $conn->connect_error);
}

if (isset($_POST['generateReport'])) {
  $selectedMonth = $_POST['month'];
  $selectedMedicine = $_POST['medicine'];

  
  $reportQuery = "SELECT * FROM report WHERE YEAR(Report_date) = '$selectedMonth' AND MONTH(Report_date) = '$selectedMonth' AND MedicineName = '$selectedMedicine'";
  $reportResult = mysqli_query($conn, $reportQuery);

  while ($reportRow = mysqli_fetch_assoc($reportResult)) {
      $reportId = $reportRow['id'];

     print_r($reportId);

      $purchaseQuery = "SELECT SUM(PurchaseAmount) AS totalPurchase FROM Purchase WHERE ReportId = $reportId";
      $purchaseResult = mysqli_query($conn, $purchaseQuery);
      $purchaseRow = mysqli_fetch_assoc($purchaseResult);

      $openingBalance = $reportRow['OpeningBalance'];
      $purchaseAmount = $purchaseRow['totalPurchase'];

      $totalAmount = $openingBalance + $purchaseAmount;

      // Step 3: Update the Report table with the calculated total amount
      $updateQuery = "UPDATE report SET totalStocks = $totalAmount WHERE id = $reportId";
      mysqli_query($conn, $updateQuery);
  }

  $reportQuery = "SELECT * FROM report WHERE YEAR(Report_date) = '$selectedMonth' AND MONTH(Report_date) = '$selectedMonth' AND MedicineName = '$selectedMedicine'";
  $reportResult = mysqli_query($conn, $reportQuery);

  print_r($reportResult);



  echo '<div class="container">';
  echo '<div class="text-center">';
  echo "<h2>Report of $selectedMonth</h2>";
  echo '<table class="table table-striped table-bordered">';
  echo '<thead>';
  echo '<tr>';
  echo '</tr>';
  echo '</thead>';
  echo '<tbody>';

$i = 10;
    echo '<tr>';
    echo '<td>' . $i .'</td>';
    echo '<td>' .$i. '</td>';
    echo '<td>' . $openingBalance . '</td>';
    echo '<td>' . $purchaseAmount . '</td>';
    echo '<td>' . $totalAmount . '</td>';
    echo '<td>' . $daysDistribution . '</td>';
    $openingBalance = $closingStocks; 
    echo '<td>' . $closingStocks . '</td>';
    echo '</tr>';
  }

  echo '</tbody>';
  echo '</table>';

  echo '</tbody>';
  echo '</table>';
  echo '</div>';
  echo '</div>';

  

?>