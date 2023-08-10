<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Report</title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
		<script src="bootstrap/js/jquery.min.js"></script>
		<script src="bootstrap/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <link rel="shortcut icon" href="images/icon.svg" type="image/x-icon">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="stylesheet" href="css/sidenav.css">
    <link rel="stylesheet" href="css/home.css">
    <script src="js/report.js"></script>
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
          createHeader('book', 'Report', 'Showing Report');
        ?>
        <!-- header section end -->

        <!-- form content -->
        <div class="row">
        <style>
  /* Change the color of the form-control select field */
  .form-control {
    color: black;
    background-color: while;
    border-width: 2px;
  }

</style>

          <div class="col-md-12 form-group form-inline">
          <label class="font-weight-bold" for="fit_for_work">Select Month :</label>
          &emsp;
            <select name="month" id="month" class="form-control" onchange="fetchData(this.value)">
                  <option disabled selected hidden>Select One</option>
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
          


          <div class="col col-md-12">
            <hr class="col-md-12" style="padding: 0px; border-top: 2px solid  #02b6ff;">
          </div>

          <div class="col col-md-12 table-responsive">
            <div id="print_content" class="table-responsive">
            	<table class="table table-bordered table-striped table-hover" id="sales_report_div">
                 <div id="resultContainer"></div>>
            	</table>
            </div>
          </div>

          <div class="col-md-12 text-center">
            <button class="btn btn-primary" onclick="printReport('Monthly');">Print</button>
          </div>

        </div>
        <!-- form content end -->
        <hr style="border-top: 2px solid #ff5252;">
      </div>
    </div>
  </body>
</html>
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