<!DOCTYPE html>
<html lang="en" dir="ltr">
  <head>
    <meta charset="utf-8">
    <title>Dashboard - Home</title>
    <link rel="stylesheet" href="bootstrap/css/bootstrap.min.css">
		<script src="bootstrap/js/jquery.min.js"></script>
		<script src="bootstrap/js/bootstrap.min.js"></script>
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.3.1/css/all.css" integrity="sha384-mzrmE5qonljUremFsqc01SB46JvROS7bZs3IO2EmfFsd15uHvIt+Y8vEf7N7fWAU" crossorigin="anonymous">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <link rel="shortcut icon" href="images/icon.svg" type="image/x-icon">
    <link rel="stylesheet" href="css/sidenav.css">
    <link rel="stylesheet" href="css/home.css">
    <script src="js/restrict.js"></script>
  </head>
  <body>
    <?php include "sections/sidenav.html"; ?>
    <div class="container-fluid">
      <div class="container">
        <!-- header section -->
        <?php
          require "php/header.php";
          createHeader('home', 'Dashboard', 'Home');
        ?>
        <!-- header section end -->

        <!-- form content -->
        <div class="row">
          <div class="row col col-xs-8 col-sm-8 col-md-8 col-lg-8">

            <?php
              function createSection1($location, $title, $table) {
                require 'php/db_connection.php';

                $query = "SELECT * FROM $table";
                if($title == "Out of Stock")
                  $query = "SELECT * FROM $table WHERE QUANTITY = 0";

                $result = mysqli_query($con, $query);
                $count = mysqli_num_rows($result);


                if($title == "Expired") {
                  // logic
                  $count = 0;
                  while($row = mysqli_fetch_array($result)) {
                    $expiry_date = $row['EXPIRY_DATE'];
                    if(substr($expiry_date, 3) < date('y'))
                      $count++;
                    else if(substr($expiry_date, 3) == date('y')) {
                      if(substr($expiry_date, 0, 2) < date('m'))
                        $count++;
                    }
                  }
                }

                echo '
                  <div class="col-xs-12 col-sm-6 col-md-6 col-lg-4" style="padding: 10px">
                    <div class="dashboard-stats" onclick="location.href=\''.$location.'\'">
                      <a class="text-dark text-decoration-none" href="'.$location.'">
                        <span class="h4">'.$count.'</span>
                        <span class="h6"><i class="fa fa-play fa-rotate-270 text-warning"></i></span>
                        <div class="small font-weight-bold">'.$title.'</div>
                      </a>
                    </div>
                  </div>
                ';
              }
              createSection1('manage_invoice.php', 'Total Distribution', 'invoices');
              createSection1('manage_customer.php', 'Total Employee', 'customers');
              createSection1('manage_medicine.php', 'Total Medicine', 'medicines');
              // createSection1('manage_supplier.php', 'Total Supplier', 'suppliers');
              createSection1('manage_medicine_stock.php?out_of_stock', 'Out of Stock', 'medicines_stock');
              createSection1('manage_medicine_stock.php?expired', 'Expired', 'medicines_stock');

            ?>

          </div>

          <div class="col col-xs-4 col-sm-4 col-md-4 col-lg-4" style="padding: 7px 0; margin-left: 15px;">
            <div class="todays-report">
              <div class="h5">Todays Report</div>
              <table class="table table-bordered table-striped table-hover">
                <tbody>
                <tr>
                <?php
                require 'php/db_connection.php';

                // Check connection
                if ($con->connect_error) {
                  die("Connection failed: " . $con->connect_error);
                }

                // Get today's date
                $today = date('Y-m-d');

                // SQL query to count rows with today's date
                $sql = "SELECT COUNT(*) as total_rows FROM invoices WHERE INVOICE_DATE = '$today'";

                // Execute the query
                $result = $con->query($sql);

                if ($result) {
                  // Fetch the row as an associative array
                  $row = $result->fetch_assoc();
                  
                  // Access the total_rows column
                  $totalRows = $row['total_rows'];
                  
                  //  echo "Total rows for today: " . $totalRows;
                } else {
                  echo "Error executing query: " . $con->error;
                }

                    ?>
                    <th>Today's Distribution :</th>
                    <th class="text-success"> <?php echo $totalRows; ?></th>
                  </tr>
                  <tr>
                    <?php
                    // Get previous day's date

                    // Get current year and month
                    $currentYear = date('Y');
                    $currentMonth = date('m');

                    // Construct the start and end dates of the month
                    $startDate = date('Y-m-01');
                    $endDate = date('Y-m-t');


                    // SQL query to count rows with today's date
                    $sql = "SELECT COUNT(*) as total_rows FROM invoices WHERE INVOICE_DATE BETWEEN '$startDate' AND '$endDate'";

                    // Execute the query
                    $result = $con->query($sql);

                    if ($result) {
                      // Fetch the row as an associative array
                      $row = $result->fetch_assoc();
                      
                      // Access the total_rows column
                      $totalRows = $row['total_rows'];
                    }
                    ?>
                    <th>This Month Distribution</th>
                    <th class="text-danger"> <?php echo $totalRows; ?></th>
                  </tr>
                </tbody>
              </table>
            </div>
          </div>

        </div>

        <hr style="border-top: 2px solid #ff5252;">

        <div class="row">

          <?php
            function createSection2($icon, $location, $title) {
              echo '
                <div class="col-xs-12 col-sm-6 col-md-3 col-lg-3" style="padding: 10px;">
              		<div class="dashboard-stats" style="padding: 30px 15px;" onclick="location.href=\''.$location.'\'">
              			<div class="text-center">
                      <span class="h1"><i class="fa fa-'.$icon.' p-2"></i></span>
              				<div class="h5">'.$title.'</div>
              			</div>
              		</div>
                </div>
              ';
            }
            createSection2('address-card', 'new_invoice.php', 'Create New Distribution');
            // createSection2('bar-chart', 'add_purchase.php', 'Add New Purchase');
            createSection2('shopping-bag', 'add_medicine.php', 'Add New Medicine');
            createSection2('handshake', 'add_customer.php', 'Add New Employee');
            // createSection2('group', 'add_supplier.php', 'Add New Supplier');
            createSection2('book', 'sales_report.php', 'Report');
            // createSection2('book', 'purchase_report.php', 'Purchase Report');
          ?>

        </div>
        <!-- form content end -->

        <hr style="border-top: 2px solid #ff5252;">

      </div>
    </div>
  </body>
</html>
