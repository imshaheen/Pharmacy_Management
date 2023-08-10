<?php
// Assuming you have already established a database connection
$SERVER = 'localhost';
$USERNAME = 'root';
$PASSWORD = '';
$DB = 'JMF';

$connection = mysqli_connect($SERVER, $USERNAME, $PASSWORD, $DB)
or
die("<div class='text-danger text-center h5'>Oops, Unable to connect with database!</div>");

// Fetch all medicines from the medicines_stock table
$query = "SELECT NAME FROM medicines_stock";
$result = mysqli_query($connection, $query);


// Check if the query was successful and fetch all medicine names
if ($result && mysqli_num_rows($result) > 0) {
    $medicineNames = mysqli_fetch_all($result, MYSQLI_ASSOC);
} else {
    echo "No medicines available.";
}

// Close the database connection
mysqli_close($connection);
?>

<!-- HTML select element for choosing a medicine -->
<label for="medicine">Select a Medicine:</label>
<select name="medicine" id="medicine" onchange="fetchMedicineInfo(this.value)">
    <option value="">Select</option>
    <?php foreach ($medicineNames as $medicine) { ?>
        <option value="<?php echo $medicine['NAME']; ?>"><?php echo $medicine['NAME']; ?></option>
    <?php } ?>
</select>

<!-- Container to display the medicine information -->
<div id="medicineInfoContainer"></div>

<!-- JavaScript code -->
<script>
    function fetchMedicineInfo(medicineName) {
        var medicineInfoContainer = document.getElementById('medicineInfoContainer');
        medicineInfoContainer.innerHTML = ''; // Clear previous information

        if (medicineName) {
            var xhr = new XMLHttpRequest();
            xhr.onreadystatechange = function() {
                if (xhr.readyState === XMLHttpRequest.DONE) {
                    if (xhr.status === 200) {
                        medicineInfoContainer.innerHTML = xhr.responseText;
                    } else {
                        console.error('Request failed. Error code: ' + xhr.status);
                    }
                }
            };

            xhr.open('GET', 'fetch_medicine_info.php?medicine=' + encodeURIComponent(medicineName), true);
            xhr.send();
        }
    }
</script>
