<form method="post" action="">
  <label for="month">Select a Month:</label>
  <select name="month" id="month">
    <option value="01">January</option>
    <option value="02">February</option>
    <option value="03">March</option>
    <option value="04">April</option>
    <option value="05">May</option>
    <option value="06">June</option>
    <option value="07">July</option>
    <option value="08">August</option>
    <option value="09">September</option>
    <option value="10">October</option>
    <option value="11">November</option>
    <option value="12">December</option>
  </select>
  <button type="submit">Submit</button>
</form>

<?php
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
  $selectedMonth = $_POST['month'];
  $monthName = date('F', strtotime("2023-$selectedMonth-01"));

  // Get the number of days in the selected month
  $numDays = cal_days_in_month(CAL_GREGORIAN, $selectedMonth, 2023);

  // Generate the table rows
  echo '<table class="table table-striped table-bordered">';
  echo '<thead>';
  echo '<tr>';
  echo '<th>SL</th>';
  echo '<th>Date</th>';
  echo '<th>Opening Balance</th>';
  echo '<th>New Purchase</th>';
  echo '<th>Total Stocks</th>';
  echo '<th>Day\'s Distribution</th>';
  echo '<th>Closing Stocks</th>';
  echo '</tr>';
  echo '</thead>';
  echo '<tbody>';


  echo "You selected: $monthName";
}
?>
