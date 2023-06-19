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
          
          <form action="" method="post" name="medicine">
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
              <input type="date" class="datepicker form-control hasDatepicker" name="invoice_date" id="invoice_date" onblur="checkDate(this.value, 'date_error');">
              <code class="text-danger small font-weight-bold float-right" id="date_error" style="display: none;"></code>
            </div>
         <!-- new user button -->
         <!-- <div class="col col-md-2 form-group">
               <label class="font-weight-bold d-flex justify-content-center" for="">Add From Here</label>
               <button class="btn btn-primary form-control" onclick="document.getElementById('add_new_customer_model').style.display = 'block';">New Employee</button>

              <code class="text-danger small font-weight-bold float-right" id="date_error" style="display: none;"></code>
            </div> -->
    <!-- new user button end -->
            <div class="col-md-2 form-group">
              <label class="font-weight-bold" for="in_time">IN Time :</label>
              <input type="time" class="form-control" name="in_time" id="in_time" onblur="checkin_time(this.value, 'in_time');">
              <code class="text-danger small font-weight-bold float-right" id="in_time" style="display: none;"></code>
            
            </div>
            <div class=" col-md-2 form-group">
              <label class="font-weight-bold" for="out_time">OUT Time :</label>
              <input type="time" class="form-control" name="out_time" id="out_time" onblur="checkout_time(this.value, 'out_time');">
              <code class="text-danger small font-weight-bold float-right" id="out_time" style="display: none;"></code>
            
            </div>
            <div class=" col-md-2 form-group">
              <label class="font-weight-bold" for="Disease">Disease :</label>
              <input id="Disease" type="text" class="form-control" name="Disease" placeholder="Disease" onblur="checkfit_for_work(this.value, 'fit_for_work');">
              <code class="text-danger small font-weight-bold float-right" id="Disease" style="display: none;"></code>
            
            </div>
            <div class="col col-md-2 form-group">
              <label class="font-weight-bold" for="fit_for_work">Fit for Work :</label>
              <select name="fit_for_work" id="" class="form-control">
                
                  <option disabled selected>Select Ability</option>
                  <option value="yes">Yes</option>
                  <option value="no">No</option>
              </select>
              <!-- <input id="fit_for_work" type="text" class="form-control" id="fit_for_work" name="fit_for_work" placeholder="Fit for Work" onblur="checkfit_for_work(this.value, 'fit_for_work');"> -->
              <code class="text-danger small font-weight-bold float-right" id="fit_for_work" style="display: none;"></code>
           
            </div>


            <div class="col-md-2">
				      	<input type='text' name="user_id" id='user_id' class='form-control' placeholder='Enter user id' >
                <!-- onkeyup="GetDetail(this.value)" value="" -->
                <code class="text-danger small font-weight-bold float-right" id="NAME" style="display: none;"></code>
            </div>

          </div>
          <!-- closing new user button -->
          <!-- </div> -->
          <!-- customer details content end -->

 

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
              <!-- <div class="col col-md-1">MRP</div>
              <div class="col col-md-1">Discount%</div>
              <div class="col col-md-1">Total</div> -->
              <div class="col col-md-2">Action</div>
            </div>
          </div>
          <div class="col col-md-12">
            <hr class="col-md-12" style="padding: 0px; border-top: 2px solid  #02b6ff;">
          </div>

          <div class="row col col-md-12 " id="invoice_medicine_list_div">
      </div>

      <!-- <div class="row col col-md-12 ">
            <div class="row col col-md-12 font-weight-bold">
      
            <div class="col-md-2">
                <input type="text" id="NAME" name="NAME" class="form-control" list="" placeholder="Select Medicine" disabled>
                <code class="text-danger small font-weight-bold float-right" id="NAME" style="display: none;"></code>
            </div>
            <div class="col-md-2">
                <input id="BATCH_ID" name="BATCH_ID" class="form-control" list="BATCH_ID" placeholder="Batch ID" disabled>
                <code class="text-danger small font-weight-bold float-right" id="BATCH_ID" style="display: none;"></code>
            </div>
            <div class="col-md-2">
                <input id="QUANTITY" name="QUANTITY" class="form-control" list="" placeholder="Ava.Qty" disabled>
                <code class="text-danger small font-weight-bold float-right" id="QUANTITY" style="display: none;"></code>
            </div>
            <div class="col-md-2">
                <input id="EXPIRY_DATE" name="EXPIRY_DATE" class="form-control" list="" placeholder="Expiry" disabled>
                <code class="text-danger small font-weight-bold float-right" id="EXPIRY_DATE" style="display: none;"></code>
            </div>
            <div class="col-md-2">
                <input id="" name="issueqty" class="form-control" list="" placeholder="Quantity">
                <code class="text-danger small font-weight-bold float-right" id="issueqty" style="display: none;"></code>
            </div>
            </div> -->


            <script> addRow(); getInvoiceNumber(); </script>
	<script>

		function GetDetail(str) {
			if (str.length == 0) {
				document.getElementById("NAME").value = "";
				document.getElementById("BATCH_ID").value = "";
				document.getElementById("EXPIRY_DATE").value = "";
				document.getElementById("QUANTITY").value = "";
				return;
			}
			else {
				var xmlhttp = new XMLHttpRequest();
				xmlhttp.onreadystatechange = function () {

					if (this.readyState == 4 &&
							this.status == 200) {
						
						var myObj = JSON.parse(this.responseText);
						
						document.getElementById
							("NAME").value = myObj[0];
	
						document.getElementById(
							"BATCH_ID").value = myObj[1];
                        document.getElementById(
						"EXPIRY_DATE").value = myObj[2];
                        document.getElementById(
						"QUANTITY").value = myObj[3];
					}
				};

				xmlhttp.open("GET", "./php/gfg.php?user_id=" + str, true);
				xmlhttp.send();
			}
		}
	</script>





          </div>
           

          <!-- end medicines -->
          <section>
          <option value="">
            <input type="text" placeholder="Search" class="form-control">
          </option>
        </section> 
            <div class="col col-md-2 form-group">
              <label class="font-weight-bold" for="c_doctor">Consulted Doctor</label>
            <?php
                $sql = 'SELECT * FROM drlist';
                $result = $con->query($sql);

                // Generating the selection options 
                if ($result->num_rows > 0) {
                    echo "<select class='form-control' name='c_doctor' class='c_doctor'>";
                    echo "<option disabled selected>Choose Droctor</option>";
                    while ($row = $result->fetch_assoc()) {$value = $row['drname'];
                        echo "<option value='$value'>$value</option>";
                    }
                    echo "</select>";
                } else {
                    echo "No values found in the database.";
                } 
            ?>
            <code class="text-danger small font-weight-bold float-right" id="c_doctor" style="display: none;"></code>
           
            </div> 
            
          <!-- </div>  -->


          <div class="row col col-md-12">
            <div id="save_button" class="col col-md-2 form-group float-right">
              <label class="font-weight-bold" for=""></label>
              <input type="submit" class="btn btn-success form-control font-weight-bold" value="Save" name="Save" onclick="sendmedicindata()">
              <!-- onclick="addInvoice();" -->
            </div>
 
            </form>

            <div id="new_invoice_button" class="col col-md-2 form-group float-right"  style="display: none;">
              <label class="font-weight-bold" for=""></label>
              <button class="btn btn-primary form-control font-weight-bold" onclick="location.reload();;">New Distribution</button>
            </div>
            <div id="print_button" class="col col-md-2 form-group float-right" style="display: none;">
              <label class="font-weight-bold" for=""></label>
              <button class="btn btn-warning form-control font-weight-bold" onclick="printInvoice(document.getElementById('invoice_number').value);">Print</button>
            </div>
            <div class="col col-md-4 form-group"></div>
            <!-- <div class="col col-md-2 form-group float-right">
              <label class="font-weight-bold" for="">Paid Amount :</label>
              <input type="text" class="form-control" name="total_discount" onkeyup="getChange(this.value);">
            </div> -->
            <!-- <div class="col col-md-2 form-group float-right">
              <label class="font-weight-bold" for="">Change :</label>
              <input type="text" class="form-control" id="change_amt" disabled>
            </div> -->
          </div>

          <div id="invoice_acknowledgement" class="col-md-12 h5 text-success font-weight-bold text-center" style="font-family: sans-serif;"</div>

        </div>
        <!-- form content end -->
        <hr style="border-top: 2px solid #ff5252;">
      </div>
    </div>
  </body>
</html>


<style>

/* Dropdown Button */
.dropbtn {
  background-color: #3498DB;
  color: white;
  padding: 16px;
  font-size: 16px;
  border: none;
  cursor: pointer;
}

/* Dropdown button on hover & focus */
.dropbtn:hover, .dropbtn:focus {
  background-color: #2980B9;
}

/* The container <div> - needed to position the dropdown content */
.dropdown {
  position: relative;
  display: inline-block;
}

/* Dropdown Content Hidden by Default */
.dropdown-content {
  display: none;
  position: absolute;
  background-color: #f1f1f1;
  min-width: 160px;
  box-shadow: 0px 8px 16px 0px rgba(0,0,0,0.2);
  z-index: 1;
}

/* Links inside the dropdown */
.dropdown-content a {
  color: black;
  padding: 12px 16px;
  text-decoration: none;
  display: block;
}

/* Change color of dropdown links on hover */
.dropdown-content a:hover {background-color: #ddd;}

/* Show the dropdown menu use JS to add this class to the .dropdown-content container when the user clicks on the dropdown button */
.show {display:block;}</style>