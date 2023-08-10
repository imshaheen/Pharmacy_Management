<?php
// Assuming you have already established a database connection
  $SERVER = 'localhost';
  $USERNAME = 'root';
  $PASSWORD = '';
  $DB = 'JMF';

  $con = mysqli_connect($SERVER, $USERNAME, $PASSWORD, $DB)
  or
  die("<div class='text-danger text-center h5'>Oops, Unable to connect with database!</div>");

// Check if a month value is received
if (isset($_GET['month'])) {
    $monthValue = $_GET['month'];

    // Query to retrieve all data for the specified month
    $query = "SELECT * FROM invoices WHERE MONTH(INVOICE_DATE) = $monthValue";

    // Execute the query
    $result = mysqli_query($con, $query);

    // Check if the query was successful
    if ($result) {
        // Check if there are any rows returned
        if (mysqli_num_rows($result) > 0) {
            // Fetch the results
            while ($row = mysqli_fetch_assoc($result)) {
                // Display the data for the month
                echo $row['CUSTOMER_ID'] . " - " . $row['MEDICINE_NAME'] . "<br>";
                // Adjust column_name1 and column_name2 with the actual column names you have in your table
            }
        } else {
            echo "No data available for the specified month.";
        }
    } else {
        // Display an error message if the query fails
        echo "Error: " . mysqli_error($con);
    }

    // Close the database connection
    mysqli_close($con);
    exit; // Stop further execution of the script
}
?>

<!-- HTML select element -->
<label for="month">Select a Month:</label>
<select name="month" id="month" onchange="fetchData(this.value)">
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
    <!-- Add more options for the remaining months -->
</select>

<!-- Container to display the fetched data -->
<div id="resultContainer"></div>

<!-- JavaScript code -->
<script>
    function fetchData(monthValue) {
        var resultContainer = document.getElementById('resultContainer');
        resultContainer.innerHTML = ''; // Clear previous results

        if (monthValue) {
            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function() {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                        resultContainer.innerHTML = xhr.responseText;
                    } else {
                        console.error('Request failed. Error code: ' + xhr.status);
                    }
                }
            };

            xhr.open('GET', '?month=' + monthValue, true);
            xhr.send();
        }
    }
</script>
