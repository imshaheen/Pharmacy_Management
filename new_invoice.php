<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>New Employee</title>
    <link href="library/bootstrap-5/bootstrap.min.css" rel="stylesheet" />
        <script src="library/bootstrap-5/bootstrap.bundle.min.js"></script>
        <script src="library/dselect.js"></script>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.2/dist/css/bootstrap.min.css" integrity="sha384-xOolHFLEh07PJGoPkLv1IbcEPTNtaed2xpHsD9ESMhqIYd0nLMwNLD69Npy4HI+N" crossorigin="anonymous">
		<script src="bootstrap/js/jquery.min.js"></script>
		<script src="bootstrap/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <link rel="shortcut icon" href="images/icon.svg" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/css/bootstrap.min.css" integrity="sha384-MCw98/SFnGE8fJT3GXwEOngsV7Zt27NXFoaoApmYm81iuXoPkFOJwJ8ERdknLPMO" crossorigin="anonymous">
    <script src="https://code.jquery.com/jquery-3.3.1.slim.min.js" integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.14.3/dist/umd/popper.min.js" integrity="sha384-ZMP7rVo3mIykV+2+9J3UJ46jBk0WLaUAdn689aCwoqbBJiSnjAK/l8WvCWPIPm49" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.1.3/dist/js/bootstrap.min.js" integrity="sha384-ChfqqxuZUCnJSK3+MXmPNIyE6ZbWh2IMqE241rYiqJxyMiZ6OW/JmZQ5stwEULTy" crossorigin="anonymous"></script>
    <script src="https://code.jquery.com/jquery-3.7.0.min.js" integrity="sha256-2Pmvv0kuTBOenSvLm6bvfBSSHrUJ+3A7x6P5Ebd07/g=" crossorigin="anonymous"></script>
    <script src="js/medicine_data_transfer.js"></script>
    <link rel="stylesheet" href="css/sidenav.css">
    <link rel="stylesheet" href="css/home.css">

    <script src="js/suggestions.js"></script>
    <script src="js/add_new_invoice.js"></script>
    <script src="js/manage_invoice.js"></script>
    <script src="js/validateForm.js"></script>
    <script src="js/restrict.js"></script>
  </head>
  <body>
    <div id="add_new_customer_model">
      <div class="modal-dialog">
      	<div class="modal-content">
      		<div class="modal-header" style="background-color: #ff5252; color: white">
            <div class="font-weight-bold">Add New Employee</div>
      			<button class="close" style="outline: none;" onclick="document.getElementById('add_new_customer_model').style.display = 'none';"><i class="fa fa-close"></i></button>
      		</div>
      		<div class="modal-body">
            <?php
              include('sections/add_new_customer.html');
            ?>
      		</div>
      	</div>
      </div>
    </div>
    <!-- including side navigations -->
    <?php include("sections/sidenav.html"); ?>

    <div class="container-fluid">
      <div class="container">

        <!-- header section -->
        <?php
          require "php/header.php";
          createHeader('clipboard', 'New Distribution', 'Create New Distribution');
        ?>
        <!-- header section end -->
        <?php
          require "php/insert_data.php";
        ?>
        <!-- form content -->
        <div class="row">
      <!-- <form action="" method="post"> -->
          <!-- customer details content -->
          <!-- ./php/insert_data.php -->
                   <!-- new user button -->
         <!-- <div class="col col-md-2 form-group">
               <label class="font-weight-bold d-flex justify-content-center" for="">Add From Here</label>
               <button class="btn btn-primary form-control" onclick="document.getElementById('add_new_customer_model').style.display = 'block';">New Employee</button>

              <code class="text-danger small font-weight-bold float-right" id="date_error" style="display: none;"></code>
            </div> -->
    <!-- new user button end -->
          
      <form action="" method="post" name="medicine" id="myForm">

          <div class="row col col-md-12">
            <div class="col col-md-3 form-group">
              <label class="font-weight-bold" for="customers_name" aria-autocomplete="off">Employee ID :</label>
              <input id="customers_name" type="text" class="form-control" placeholder="Employee ID" name="customers_name" onblur="checkcustomers_name(this.value, 'customers_name');" onkeyup="showSuggestions(this.value, 'customer');">
              <code class="text-danger small font-weight-bold float-right" id="customer_name_error" style="display: none;"></code>
              <div id="customer_suggestions" class="list-group position-fixed" style="z-index: 1; width: 18.30%; overflow: auto; max-height: 200px;"></div>
            </div>
            <div class="col col-md-2 form-group">
              <label class="font-weight-bold" for="customers_contact_number">Employee Name :</label>
              <input id="customers_contact_number" type="text" class="form-control" name="customers_contact_number" placeholder="Employee Name" disabled>
            </div>
            <div class="col col-md-2 form-group">
              <label class="font-weight-bold" for="customers_address">Designation :</label>
              <input id="customers_address" type="text" class="form-control" name="customers_address" placeholder="Designation" disabled>
            </div>
            <div class="col col-md-2 form-group">
              <label class="font-weight-bold" for="invoice_number">Distribution Number :</label>
              <input id="invoice_number" type="text" class="form-control" name="invoice_number" placeholder="Distribution Number" disabled>
            </div>
            <div class="col col-md-2 form-group">
               <label class="font-weight-bold" for="invoice_date">Date :</label>
              <input type="date" class="datepicker form-control hasDatepicker" value="<?php echo date('Y-m-d'); ?>" name="invoice_date" id="invoice_date" onblur="checkDate(this.value, 'date_error');" require>
              <code class="text-danger small font-weight-bold float-right" id="date_error" style="display: none;"></code>
            </div>
            <div class="col-md-2 form-group">
              <label class="font-weight-bold" for="in_time">IN Time :</label>
              <input type="time" class="form-control" name="in_time" id="in_time" onblur="checkin_time(this.value, 'in_time');" require>
              <code class="text-danger small font-weight-bold float-right" id="in_time" style="display: none;"></code>
            
            </div>
            <div class=" col-md-2 form-group">
              <label class="font-weight-bold" for="out_time">OUT Time :</label>
              <input type="time" class="form-control" name="out_time" id="out_time" onblur="checkout_time(this.value, 'out_time');" require>
              <code class="text-danger small font-weight-bold float-right" id="out_time" style="display: none;"></code>
            
            </div>
            <div class=" col-md-2 form-group">
              <label class="font-weight-bold" for="Disease">Disease :</label>
              <input id="Disease" type="text" class="form-control" name="Disease" placeholder="Disease" onblur="checkfit_for_work(this.value, 'fit_for_work');" require>
              <code class="text-danger small font-weight-bold float-right" id="Disease" style="display: none;"></code>
            
            </div>
            <div class="col col-md-2 form-group">
              <label class="font-weight-bold" for="fit_for_work">Fit for Work :</label>
              <select name="fit_for_work" id="" class="form-control" require>
                  <option disabled selected hidden>Select Ability</option>
                  <option value="yes">Yes</option>
                  <option value="no">No</option>
              </select>
              <code class="text-danger small font-weight-bold float-right" id="fit_for_work" style="display: none;"></code>
            </div>

          <div class="col col-md-12">
            <hr class="col-md-12" style="padding: 0px; border-top: 3px solid  #02b6ff;">
          </div>

          <!-- add medicines -->
          <div class="row col col-md-12 justify-content-center">
            <div class="row col col-md-12 font-weight-bold">
              <div class="col col-md-2">Medicine Name</div>
              <div class="col col-md-2">Batch ID</div>
              <div class="col col-md-2">Ava.Qty.</div>
              <div class="col col-md-0">Expiry</div>
              <div class="col col-md-2">Quantity</div>
              <div class="col col-md-2">Action</div>
            </div>
          </div>

          <div class="row col col-md-12" id="invoice_medicine_list_div">
              <script>getInvoiceNumber();   </script>
              <!-- addRow(); -->
         </div>


    <div id="fieldsContainer">
        <div id="medicines" class="row col col-md-12 mb-2">
          <div class="row col col-md-12 font-weight-bold medicine-row fieldsContainers" >
              <div class="col-md-2 ">
                <?php
              require './php/db_connection.php';
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
              <div class="col-md-1">
                 <button type="button" class="btn btn-primary" onclick="addField()">Add</button>
            </div>
            <div class="col-md-1">
                   <span class="remove-btn" onclick="removeField(this)">Remove</span>
              </div>
      </div>
  </div>
  </div>


        <div class="row col col-md-12" id="medicines">
            <div class="row col col-md-12 font-weight-bold medicine-row">
                
             </div>
         </div>
        <div class="col-md-2">
        </div>

    

            <div class="col col-md-12">
            <hr class="col-md-12" style="padding: 0px; border-top: 2px solid  #02b6ff;">
          </div>



            <div class="col col-md-2 form-group">
              <label class="font-weight-bold" for="c_doctor">Consulted Doctor</label>
            <?php
            $servername =  $SERVER;
            $username =  $USERNAME;
            $password = $PASSWORD;
            $dbname = $DB;
            
            $con = new mysqli($servername, $username, $password, $dbname);
            if ($con->connect_error) {
              die('Connection failed: ' . $con->connect_error);
            }
                $sql = 'SELECT * FROM drlist';
                $result = $con->query($sql);

                if ($result->num_rows > 0) {
                    echo "<select class='form-control' name='c_doctor' class='c_doctor'>";
                    echo "<option disabled selected>Choose Droctor</option>";
                    while ($row = $result->fetch_assoc()) {$value = $row['drname'];
                        echo "<option value='$value'>$value</option>";
                    }
                    echo "</select>";
                } else {
                    echo "No values found in the database.";
                }  ?>
            <code class="text-danger small font-weight-bold float-right" id="c_doctor" style="display: none;"></code>
           
            </div> 



          <div class="row col col-md-12">
            <div id="save_button" class="col col-md-2 form-group float-right">
              <label class="font-weight-bold" for=""></label>
              <input type="submit" class="btn btn-success form-control font-weight-bold" value="Save" name="Save">
              <!-- onclick="addInvoice();" -->
              <!-- onclick="sendmedicindata()" -->
 
            </form>

            </div>

            <div id="new_invoice_button" class="col col-md-2 form-group float-right"  style="display: none;">
              <label class="font-weight-bold" for=""></label>
              <button class="btn btn-primary form-control font-weight-bold" onclick="location.reload();;">New Distribution</button>
            </div>
            <div id="print_button" class="col col-md-2 for`m-group float-right" style="display: none;">
              <label class="font-weight-bold" for=""></label>
              <button class="btn btn-warning form-control font-weight-bold" onclick="printInvoice(document.getElementById('invoice_number').value);">Print</button>
            </div>
            <div class="col col-md-4 form-group"></div>
          </div>

          <div id="invoice_acknowledgement" class="col-md-12 h5 text-success font-weight-bold text-center" style="font-family: sans-serif;"</div>

        </div>
        <!-- form content end -->
        <hr style="border-top: 2px solid #ff5252;">
      </div>
    </div>
  </body>
</html>

<!-- <script>
  $('#addrow').click(function(){
    var newrow = $('next').append( 
      '<div class="row col col-md-12 font-weight-bold"><div class="col-md-2"><input type="text" id="nameofmedicine" name="name[]" class="form-control" list="" placeholder="Select Medicine"><code class="text-danger small font-weight-bold float-right" id="nameofmedicine" style="display: none;"></code></div><div class="col-md-2"><input id="batchid[]" name="batchid" class="form-control" placeholder="Batch ID" disabled><code class="text-danger small font-weight-bold float-right" id="batchid" style="display: none;"></code></div><div class="col-md-2"><input id="quantity[]" name="quantity" class="form-control" placeholder="Ava.Qty" disabled><code class="text-danger small font-weight-bold float-right" id="QUANTITY" style="display: none;"></code></div><div class="col-md-2"><input id="expiry_date[]" name="expiry_date" class="form-control" placeholder="Expiry" disabled><code class="text-danger small font-weight-bold float-right" id="expiry_date" style="display: none;"></code></div><div class="col-md-2"><input id="issueqty[]" name="issueqty" class="form-control" placeholder="0"><code class="text-danger small font-weight-bold float-right" id="issueqty" style="display: none;"></code></div> <div class="col col-md-2"><button type="button" id="addrow" name="addrow" class="btn btn-primary"><i class="fa fa-plus"></i></button><button class="btn btn-danger" ><i class="fa fa-trash"></i></button></div></div>' );
  });

</script> -->




<script>
      // JavaScript/jQuery code
      function addField() {
        var field = `
          <div class="form-group row">
          <div id="fieldsContainer" class="mt-5">
        <div id="medicines" class="row col col-md-12">
          <div class="row col col-md-12 font-weight-bold medicine-row" >
              <div class="col-md-2">
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
              <div class="col-md-1">
                   <span class="remove-btn" onclick="removeField(this)">Remove</span>
              </div>
        </div>

    </div>
        `;
        $('#fieldsContainer').append(field);
      }


      function addField() {
  var fieldContainer = document.getElementById("fieldsContainer");
  var rows = fieldContainer.getElementsByClassName("medicine-row");

  var newRow = rows[0].cloneNode(true);
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
  fieldContainer.appendChild(newRow);

  // Add "Remove" button to all rows except the first row
  var removeButtons = fieldContainer.getElementsByClassName("remove-btn");
  if (rows.length > 1) {
    for (var i = 0; i < removeButtons.length; i++) {
      removeButtons[i].style.display = "inline-block";
    }
  }

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
  var row = element.parentNode.parentNode;
  var fieldContainer = document.getElementById("fieldsContainer");
  var rows = fieldContainer.getElementsByClassName("medicine-row");

  if (rows.length > 1) {
    row.parentNode.removeChild(row);

    // Show "Remove" buttons for remaining rows
    var removeButtons = fieldContainer.getElementsByClassName("remove-btn");
    for (var i = 0; i < removeButtons.length; i++) {
      removeButtons[i].style.display = "inline-block";
    }
  }
}
    </script>