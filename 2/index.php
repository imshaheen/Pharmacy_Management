<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Medicine Report</title>
    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">

</head>
<body>
<form method="post" action="process.php">
  <div class="container">
    <div class="row">
      <div class="col">
        <label for="medicine">Select Medicine:</label>
        <select class="form-control" id="medicine" name="medicine">
          <?php
          // Establish a database connection
          $host = 'localhost';
          $username = 'root';
          $password = '';
          $database = 'jmf';
          $conn = mysqli_connect($host, $username, $password, $database);

          // Check if the connection was successful
          if (mysqli_connect_errno()) {
            echo "Failed to connect to MySQL: " . mysqli_connect_error();
          }

          // Query the medicines_stock table to fetch medicine names
          $query = "SELECT NAME FROM medicines_stock";
          $result = mysqli_query($conn, $query);

          // Loop through the query results and generate options for the dropdown
          echo "<option disabled selected>Select One</option>";
          while ($row = mysqli_fetch_assoc($result)) {
            $medicineName = $row['NAME'];
            echo "<option value='$medicineName'>$medicineName</option>";
          }

          // Close the database connection
          mysqli_close($conn);
          ?>
        </select>
      </div>
      <div class="col">
        <label for="month">Select Month:</label>
        <select class="form-control" id="month" name="month">
          <option disabled selected>Select One</option>
          <option value="1">January</option>
          <option value="2">February</option>
          <option value="3">March</option>
          <option value="4">April</option>
          <option value="5">May</option>
          <option value="6">June</option>
          <option value="7">July</option>
          <option value="8">August</option>
          <option value="9">September</option>
          <option value="10">October</option>
          <option value="11">November</option>
          <option value="12">December</option>
        </select>
      </div>
      <div class="col">
        <label for="startDate">Select Start Date:</label>
        <input class="form-control" type="date" id="startDate" name="startDate">
      </div>
      <div class="col">
        <label for="endDate">Select End Date:</label>
        <input class="form-control" type="date" id="endDate" name="endDate">
      </div>
    </div>
  </div>
<div class="col">
  <button type="submit" class="btn btn-primary">Submit</button>
</div>
</form>

</body>
</html>