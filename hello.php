<!DOCTYPE html>
<html>
<head>
  <title>Dynamic Form with Bootstrap</title>
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.0/css/bootstrap.min.css">
  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <script src="js/medicine_data_transfer.js"></script>
  <style>
    /* Additional CSS styles */
    .form-group {
      margin-bottom: 10px;
    }
    .remove-btn {
      margin-left: 10px;
      color: red;
      cursor: pointer;
    }
  </style>
</head>
<body>
  <div class="container">
    <h1>Dynamic Form with Bootstrap</h1>
    <form id="myForm" action="insert.php" method="POST">
      <div id="fieldsContainer">
        <div id="medicines" class="row col col-md-12 mt-2">
          <div class="row col col-md-12 font-weight-bold medicine-row" >
              <div class="col-md-2 ">
                <?php
                require_once './php/db_connection.php';
              $sql = 'SELECT * FROM medicines_stock';
              $result = $con->query($sql);

              if ($result->num_rows > 0) {
                  echo "<select class='form-control' name='medicine_name[]' class='form-control' id='medicineDropdown'>";
                  echo "<option disabled selected hidden>Select Medicine</option>";
                  while ($row = $result->fetch_assoc()) {$value = $row['NAME'];
                      echo "<option value='$value'>$value</option>";
                  }
                  echo "</select>";
              } else {
                  echo "No values found in the database.";
              }  ?>
             <code class="text-danger small font-weight-bold float-right" id="nameofmedicine" style="display: none;"></code>
              </div>
              <div class="col-md-2">

                  <input id="batchId" name="batchid" class="form-control" placeholder="Batch ID"  disabled>
                  <code class="text-danger small font-weight-bold float-right" id="batchid" style="display: none;"></code>
              </div>
              <div class="col-md-2">
                  <input id="qty" name="quantity" class="form-control" placeholder="Ava.Qty" disabled>
                  <code class="text-danger small font-weight-bold float-right" id="QUANTITY" style="display: none;"></code>
              </div>
              <div class="col-md-2">
                  <input id="expiry" name="expiry_date" class="form-control" placeholder="Expiry" disabled>
                  <code class="text-danger small font-weight-bold float-right" id="expiry_date" style="display: none;"></code>
              </div>
              <div class="col-md-2">
                  <input id="issueqty" name="issue_quantity[]" class="form-control" placeholder="0" require>
                  <code class="text-danger small font-weight-bold float-right" id="issueqty" style="display: none;"></code>
              </div>
              <div class="col-md-2">
                 <button type="button" class="btn btn-primary" onclick="addField()">Add</button>
                 <button type="button" class="btn btn-danger" onclick="removeField(this)">Remove</button>
            </div>
      </div>
    </form>

   
    <script>

function addField() {
  var newRow = document.getElementById("medicines").cloneNode(true);
  var dropdown = newRow.querySelector("#medicineDropdown");
  var batchIdInput = newRow.querySelector("#batchId");
  var qtyInput = newRow.querySelector("#qty");
  var expiryInput = newRow.querySelector("#expiry");

  // Clear the values of the newly cloned row
  dropdown.selectedIndex = 0;
  batchIdInput.value = "";
  qtyInput.value = "";
  expiryInput.value = "";

  // Append the new row to the fields container
  var fieldsContainer = document.getElementById("fieldsContainer");
  fieldsContainer.appendChild(newRow);

  

  // Remove the "Add Row" button from the newly added row
  var addButton = newRow.querySelector(".add-row-button");
  addButton.remove();

  // Fetch the values from the database based on the selected medicine
  dropdown.addEventListener("change", function() {
    var selectedMedicine = dropdown.value;
    var url = "api.php?medicine=" + selectedMedicine;

    fetch(url)
      .then(function(response) {
        return response.json();
      })
      .then(function(data) {
        batchIdInput.value = data.batchId;
        qtyInput.value = data.qty;
        expiryInput.value = data.expiry;
      })
      .catch(function(error) {
        console.log("Error fetching data: ", error);
      });
  });
}

function removeField(element) {
  var row = element.closest(".row");
  row.remove();
}


function removeField(element) {
    var row = $(element).closest('.form-group');
    if (row.attr('id') === 'firstRow') {
      // Do not remove the first row
      return;
    }
    row.remove();
  }

</script>



  </div>
</body>
</html>
