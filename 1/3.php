<!DOCTYPE html>
<html>
<head>
    <title>Medicine-wise Report</title>
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
</head>
<body>
    <div class="container">
        <h2 class="mt-4">Medicine-wise Report</h2>
        <form method="POST" action="report.php">
            <div class="form-group">
                <label for="month">Month:</label>
                <select id="month" name="month" class="form-control" required>
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
            </div>
            <button type="submit" class="btn btn-primary">Generate Report</button>
        </form>
    </div>
</body>
</html>
