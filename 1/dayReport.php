<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>Daily Ledger</title>
</head>
<body>
  <div class="container">
<!-- <form method="post" action="">
  <label for="month">Select a Month:</label>
  <select name="month" id="month" class="form-control">
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
  <br><br>
  <label for="medicine">Select a Medicine:</label>
  <select name="medicine" id="medicine" class="form-control">
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

      // Fetch medicine names from the database
      $sql = "SELECT NAME FROM medicines_stock";
      $result = $conn->query($sql);

      // Populate select options dynamically
      if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
          echo '<option value="' . $row['NAME'] . '">' . $row['NAME'] . '</option>';
        }
      }

      // Close the database connection
      $conn->close();
    ?>
  </select>
  <br><br>
  <button type="submit" class="btn btn-success">Submit</button>
</form> -->




<form method="post" action="day_r.php" class="row">
  <div class="col-md-4">
  <label for="month" style="display: inline;">Select a Month:</label>
  <input type="month" id="month" name="month" class="form-control">

  <!-- <select name="month" id="month" class="form-control" style="display: inline;">
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
  </select> -->
  </div>

  <div class="col-md-4">
  <label for="medicine" style="display: inline;">Select a Medicine:</label>
  <select name="medicine" id="medicine" class="form-control" style="display: inline;">
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

      // Fetch medicine names from the database
      $sql = "SELECT NAME FROM medicines_stock";
      $result = $conn->query($sql);

      // Populate select options dynamically
      if ($result->num_rows > 0) {
        while ($row = $result->fetch_assoc()) {
          echo '<option value="' . $row['NAME'] . '">' . $row['NAME'] . '</option>';
        }
      }

      // Close the database connection
      $conn->close();
    ?>
  </select>
  </div>

  <div class="col-md-4">

  <button type="submit" class="btn btn-success mt-4" style="display: inline;" name="generateReport" >Submit</button>
  </div>

</form>
<br><br>




</body>
</html>