<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Add New Doctor</title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
		<!-- <script src="bootstrap/js/jquery.min.js"></script> -->
		<script src="bootstrap/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <link rel="shortcut icon" href="images/icon.svg" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/sidenav.css">
    <link rel="stylesheet" href="css/home.css">
    <script src="js/validateForm.js"></script>
    <script src="js/restrict.js"></script>
  </head>
  <body>
    <!-- including side navigations -->
    <?php include("sections/sidenav.html"); ?>


    <div class="container-fluid">
      <div class="container">
        <!-- header section -->
        <?php
          require "php/header.php";
          require "php/add_new_doctor.php";
          // require "php/add_new_doctor.php";
          createHeader('group', 'Add Doctor', 'Add New Doctor');
          // header section end
        ?>
        <div class="row">
          <div class="row col col-md-6">
            
             <!-- supplier details content -->

             <form action="" method="post" class="row col col-md-12">
             <!-- supplier name control -->
             <div class="row col col-md-12">
               <div class="col col-md-12 form-group">
                 <label class="font-weight-bold" for="supplier_name">Doctor Name :</label>
                 <input type="text" name="doctor_name" class="form-control" placeholder="Doctor Name" id="supplier_name" onkeyup="validateAddress(this.value, 'address_error');">
                 <code class="text-danger small font-weight-bold float-right" id="address_error" style="display: none;"></code>
               </div>
             </div>
             
             <!-- supplier email control -->
             <div class="row col col-md-12">
               <div class="col col-md-12 form-group">
                 <label class="font-weight-bold" for="supplier_email">Doctor Degree :</label>
                 <input type="text" name="doctor_degree" autocomplete="off" class="form-control" placeholder="Doctor Degree" id="supplier_email" onblur="validateAddress(this.value, 'email_error');">
                 <code class="text-danger small font-weight-bold float-right" id="email_error" style="display: none;"></code>
               </div>
             </div>
             
             <!-- supplier contact number control -->
             <div class="row col col-md-12">
               <div class="col col-md-12 form-group">
                 <label class="font-weight-bold" for="supplier_contact_number">Doctor Contact Number :</label>
                 <input type="number" name="contact_number" class="form-control" placeholder="Contact Number" id="supplier_contact_number" onblur="validateContactNumber(this.value, 'contact_number_error');">
                 <code class="text-danger small font-weight-bold float-right" id="contact_number_error" style="display: none;"></code>
               </div>
             </div>
             
             <!-- supplier address control -->
             <div class="row col col-md-12">
               <div class="col col-md-12 form-group">
                 <label class="font-weight-bold" for="supplier_address">Doctor Address :</label>
                 <textarea class="form-control" name="Address" placeholder="Address" id="supplier_address" onblur="validateAddress(this.value, 'address_error');"></textarea>
                 <code class="text-danger small font-weight-bold float-right" id="address_error" style="display: none;"></code>
               </div>
             </div>
             <!-- supplier details content end -->
             
             
             <div class="col col-md-12">
               <hr class="col-md-12 float-left" style="padding: 0px; width: 95%; border-top: 2px solid  #02b6ff;">
             </div>
             
             <!-- new user button -->
             <div class="row col col-md-12">
               &emsp;
               <div class="form-group m-auto">
                 <button type="submit" name="submit" class="btn btn-primary form-control">ADD</button>
               </div>
               <!--
               &emsp;
               <div class="form-group">
                 <button class="btn btn-success form-control">Save and Add Another</button>
               </div>
               -->
             </div>
             </form>
             <!-- result message -->
             <div id="supplier_acknowledgement" class="col-md-12 h5 text-success font-weight-bold text-center" style="font-family: sans-serif;"></div>
             
            
          </div>
        </div>
        <hr style="border-top: 2px solid #ff5252;">

      </div>
    </div>
  </body>
</html>
