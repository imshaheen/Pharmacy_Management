<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.5.2/css/bootstrap.min.css">
    <title>Medicine Purchase</title>
</head>
<body>


<div class="container">
  <h1>Medicine Purchase</h1>
  <?php
  // Check the query parameter for status
  $status = $_GET['status'] ?? '';
  $batchId = $_GET['batch_id'] ?? '';

  if ($status === 'success') {
      echo '<div class="alert alert-success">Purchase successfully processed! Latest Batch ID: ' . $batchId . '</div>';
  } elseif ($status === 'error') {
      echo '<div class="alert alert-danger">Error occurred. Batch ID already exists. Existing Batch Count: ' . $batchId . '</div>';
  }
  ?>
 <div class="row">
  <div class="col-md-12">
    <form action="process_purchase.php" method="post" class="row">
    <div class="col-md-3 form-group">
        <label for="medicineName" class="text-center">Medicine Name:</label>
        <input type="text" class="form-control" id="medicineName" name="medicineName" placeholder="Enter medicine name" list="medicineList">
        <datalist id="medicineList">
        </datalist>
      </div>
      <div class="col-md-2 form-group">
        <label for="quantity">Quantity:</label>
        <input type="number" class="form-control" id="quantity" name="quantity" placeholder="Enter quantity">
      </div>
      <div class="col-md-2 form-group">
        <label for="unit">Unit:</label>
        <select class="form-control" id="unit" name="unit">
          <option value="Pcs">pcs</option>
          <option value="Box">box</option>
        </select>
      </div>
      <div class="col-md-2 form-group">
        <label for="batchId">Batch ID:</label>
        <input type="text" class="form-control" id="batchId" name="batchId" placeholder="Enter batch ID">
      </div>
      <div class="col-md-2 form-group">
        <label for="expiryDate">Expiry Date:</label>
        <input type="text" class="form-control" id="expiryDate" name="expiryDate" placeholder="Enter expiry date (e.g., 12/42)">
      </div>
      <div class="col-md-1 form-group ">
      <label for="" class="mb-4"></label>

        <button type="submit" class="btn btn-primary">Submit</button>
      </div>
    </form>
  </div>
</div>

<script>
  // Fetch medicine data from the server
  function fetchMedicineData() {
    fetch('fetch_medicines.php')
      .then(response => response.json())
      .then(data => populateMedicineOptions(data))
      .catch(error => console.log(error));
  }

  // Populate the medicine options in the datalist
  function populateMedicineOptions(data) {
    const medicineList = document.getElementById('medicineList');
    medicineList.innerHTML = '';

    data.forEach(medicine => {
      const option = document.createElement('option');
      option.value = medicine.name;
      medicineList.appendChild(option);
    });
  }

  // Call the fetchMedicineData function to populate the datalist options
  fetchMedicineData();
</script>

</body>
</html>