<?php
// Assuming you have already established a database connection
$SERVER = 'localhost';
$USERNAME = 'root';
$PASSWORD = '';
$DB = 'JMF';

$connection = mysqli_connect($SERVER, $USERNAME, $PASSWORD, $DB)
or
die("<div class='text-danger text-center h5'>Oops, Unable to connect with database!</div>");

// Query to fetch medicines from medicines_stock
$query = "SELECT NAME FROM medicines_stock";
$result = mysqli_query($connection, $query);

// Check if the query was successful and fetch medicine names
if ($result && mysqli_num_rows($result) > 0) {
    $medicines = mysqli_fetch_all($result, MYSQLI_ASSOC);
} else {
    echo "No medicines available.";
}

// Close the database connection
mysqli_close($connection);
?>

<!DOCTYPE html>
<html>
<head>
    <title>Medicine Report</title>
    <!-- Include Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container mt-4">
        <h2>Medicine Report</h2>
        <form method="GET" action="fetch_data.php" class="row">
     <div class="col-md-2">
     <div class="form-group">
                <label for="id_number">ID Number:</label>
                <input type="text" class="form-control" id="id_number" name="id_number">
            </div>
     </div>
            <div class="col-md-2">
                <div class="form-group">
                    <label for="medicine">Medicine:</label>
                    <select class="form-control" id="medicine" name="medicine">
                        <option value="">Select Medicine</option>
                        <?php foreach ($medicines as $medicine) { ?>
                            <option value="<?php echo $medicine['NAME']; ?>"><?php echo $medicine['NAME']; ?></option>
                        <?php } ?>
                    </select>
                </div>
            </div>
    <div class="col-md-2">
        <div class="form-group">
                <label for="month">Month:</label>
                <select class="form-control" id="month" name="month">
                    <option value="">Select Month</option>
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
        </div>
    <div class="col-md-2">
        <div class="form-group">
                <label for="start_date">Start Date:</label>
                <input type="date" class="form-control" id="start_date" name="start_date">
            </div>

    </div>
    <div class="col-md-2">
            <div class="form-group">
                <label for="end_date">End Date:</label>
                <input type="date" class="form-control" id="end_date" name="end_date">
            </div>      
    </div>
         <div class="col-md-12">
            <button type="submit" class="btn btn-primary">Fetch Data</button>
        </div>
        </form>
    </div>

    <!-- Include Bootstrap JS -->
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.2/js/bootstrap.min.js"></script>
</body>
</html>
