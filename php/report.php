<?php

if(isset($_GET['action']) && $_GET['action'] == "purchase")
  showPurchases($_GET['start_date'], $_GET['end_date']);

if(isset($_GET['action']) && $_GET['action'] == "sales")
  showSales($_GET['start_date'], $_GET['end_date']);

function showPurchases($start_date, $end_date) {
  ?>
  <thead>
    <tr>
      <th>SL</th>
      <th>Purchase Date</th>
      <th>Voucher Number</th>
      <th>Invoice No</th>
      <th>Supplier Name</th>
      <!-- <th>Total Amount</th> -->
    </tr>
  </thead>
  <tbody>
  <?php
  require "db_connection.php";
  if($con) {
    $seq_no = 0;
    $total = 0;
    if($start_date == "" || $end_date == "")
      $query = "SELECT * FROM purchases";
    else
      $query = "SELECT * FROM purchases WHERE PURCHASE_DATE BETWEEN '$start_date' AND '$end_date'";
    $result = mysqli_query($con, $query);
    while($row = mysqli_fetch_array($result)) {
      $seq_no++;
      showPurchaseRow($seq_no, $row);
      // $total = $total + $row['TOTAL_AMOUNT'];
    }
    ?>
    </tbody>
    <!-- <tfoot class="font-weight-bold">
      <tr style="text-align: right; font-size: 24px;">
        <td colspan="5" style="color: green;">&nbsp;Total Purchases =</td>
        <td style="color: red;"><?php echo $total; ?></td>
      </tr>
    </tfoot> -->
    <?php
  }
}

function showPurchaseRow($seq_no, $row) {
  ?>
  <tr>
    <td><?php echo $seq_no; ?></td>
    <td><?php echo $row['PURCHASE_DATE']; ?></td>
    <td><?php echo $row['VOUCHER_NUMBER']; ?></td>
    <td><?php echo $row['INVOICE_ID']; ?></td>
    <td><?php echo $row['SUPPLIER_NAME'] ?></td>
    <!-- <td><?php echo $row['TOTAL_AMOUNT']; ?></td> -->
  </tr>
  <?php
}

function showSales($start_date, $end_date) {
  ?>
  <thead>
    <tr>
      <th>SL</th>
      <th>Employee ID</th>
      <th>Employee Name</th>
      <th>Distibution Number</th>
      <th>Medicin Name</th>
      <th>How Many Medicine</th>
      <th>IN Time</th>
      <th>OUT Time</th>
      <th>Total Spend Time</th>
      <th>Disease</th>
      <th>Fit For Work</th>
      <th>Consulted Doctor</th>
    </tr>
  </thead>
  <tbody>
  <?php
  require "db_connection.php";
  if($con) {
    $seq_no = 0;
    $total = 0;
    if($start_date == "" || $end_date == "")
      $query = "SELECT * FROM invoices INNER JOIN customers ON invoices.CUSTOMER_ID = customers.NAME";
      // $result = mysqli_query($con, $query);
    else
      $query = "SELECT * FROM invoices INNER JOIN customers ON invoices.NAME = customers.NAME WHERE INVOICE_DATE BETWEEN '$start_date' AND '$end_date'";
    $result = mysqli_query($con, $query);
        print_r($result);
    while($row = mysqli_fetch_array($result)) {
      $seq_no++;
      //print_r($row);
      showSalesRow($seq_no, $row);
      // $total = $total + $row['NET_TOTAL'];
    }
    ?>
    </tbody>
    <!-- <tfoot class="font-weight-bold">
      <tr style="text-align: right; font-size: 24px;">
        <td colspan="4" style="color: green;">&nbsp;Total Sales =</td>
        <td class="text-primary"><?php echo $total; ?></td>
      </tr>
    </tfoot> -->
    <?php
  }
}

function showSalesRow($seq_no, $row) {
  ?>
  <tr>
    <td><?php echo $seq_no; ?></td>
    <td><?php echo $row['ID']; ?></td>
    <td><?php echo $row['CONTACT_NUMBER']; ?></td>
    <td><?php echo $row['INVOICE_ID']; ?></td>
    <td><?php echo $row['MEDICINE_NAME'] ?></td>
    <td><?php echo $row['ISSUEQUANTITY'] ?></td>
    <td><?php echo $row['IN_TIME'] ?></td>
    <td><?php echo $row['OUT_TIME'] ?></td>
    <td><?php echo $row['TOTAL_SPEND'] ?></td>
    <td><?php echo $row['DISEASE'] ?></td>
    <td><?php echo $row['FIT_FOR_WORK'] ?></td>
    <td><?php echo $row['CONSULTED_DOCTOR'] ?></td>
  </tr>
  <?php
}

?>
