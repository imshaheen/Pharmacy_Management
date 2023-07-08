<?php
require "db_connection.php";

if ($con) {
  if (isset($_GET["action"]) && $_GET["action"] == "delete") {
    $id = $_GET["id"];
    $query = "DELETE FROM doctor WHERE ID = $id";
    $result = mysqli_query($con, $query);
    if (!empty($result))
      showSuppliers(0);
  }

  if (isset($_GET["action"]) && $_GET["action"] == "edit") {
    $id = $_GET["id"];
    showSuppliers($id);
  }

  if (isset($_POST["action"]) && $_POST["action"] == "update") {
    $id = $_POST["id"];
    $name = ucwords($_POST["name"]);
    $degree = $_POST["degree"];
    $contact_number = $_POST["contact_number"];
    $address = ucwords($_POST["address"]);
    updateSupplier($id, $name, $degree, $contact_number, $address);
  }

  if (isset($_GET["action"]) && $_GET["action"] == "cancel")
    showSuppliers(0);

  if (isset($_GET["action"]) && $_GET["action"] == "search")
    searchSupplier(strtoupper($_GET["text"]));
}

function showSuppliers($id)
{
  require "db_connection.php";
  if ($con) {
    $seq_no = 0;
    $query = "SELECT * FROM drlist";
    $result = mysqli_query($con, $query);
    while ($row = mysqli_fetch_array($result)) {
      $seq_no++;
      if ($row['ID'] == $id)
        showEditOptionsRow($seq_no, $row);
      else
        showSupplierRow($seq_no, $row);
    }
  }
}

function showSupplierRow($seq_no, $row)
{
  ?>
  <tr>
    <td><?php echo $seq_no; ?></td>
    <td><?php echo $row['ID'] ?></td>
    <td><?php echo $row['drname']; ?></td>
    <td><?php echo $row['drdegree']; ?></td>
    <td><?php echo $row['drphone']; ?></td>
    <td><?php echo $row['draddress']; ?></td>
    <td>
      <button href="" class="btn btn-info btn-sm" onclick="editSupplier(<?php echo $row['ID']; ?>);">
        <i class="fa fa-pencil"></i>
      </button>
      <button class="btn btn-danger btn-sm" onclick="deleteSupplier(<?php echo $row['ID']; ?>);">
        <i class="fa fa-trash"></i>
      </button>
    </td>
  </tr>
  <?php
}

function showEditOptionsRow($seq_no, $row)
{
  ?>
  <tr>
    <td><?php echo $seq_no; ?></td>
    <td><?php echo $row['ID'] ?></td>
    <td>
      <input type="text" class="form-control" value="<?php echo $row['drname']; ?>" placeholder="Name" id="supplier_name" onkeyup="validateAddress(this.value, 'name_error');">
      <code class="text-danger small font-weight-bold float-right" id="name_error" style="display: none;"></code>
    </td>
    <td>
      <input type="text" class="form-control" value="<?php echo $row['drdegree']; ?>" placeholder="Degree" id="supplier_email" onblur="validateContactNumber(this.value, 'email_error');">
    </td>
    <td>
      <input type="number" class="form-control" value="<?php echo $row['drphone']; ?>" placeholder="Contact Number" id="supplier_contact_number" onblur="validateContactNumber(this.value, 'contact_number_error');">
      <code class="text-danger small font-weight-bold float-right" id="contact_number_error" style="display: none;"></code>
    </td>
    <td>
      <textarea class="form-control" placeholder="Address" id="supplier_address" onblur="validateAddress(this.value, 'address_error');"><?php echo $row['draddress']; ?></textarea>
      <code class="text-danger small font-weight-bold float-right" id="address_error" style="display: none;"></code>
    </td>
    <td>
      <button href="" class="btn btn-success btn-sm" onclick="updateSupplier(<?php echo $row['ID']; ?>);">
        <i class="fa fa-edit"></i>
      </button>
      <button class="btn btn-danger btn-sm" onclick="cancel();">
        <i class="fa fa-close"></i>
      </button>
    </td>
  </tr>
  <?php
}

function updateSupplier($id, $name, $degree, $contact_number, $address)
{
  require "db_connection.php";
  $query = "UPDATE drlist SET drname = '$name', drdegree = '$degree', drphone = '$contact_number', draddress = '$address' WHERE ID = $id";
  $result = mysqli_query($con, $query);
  if (!empty($result))
    showSuppliers(0);
}

function searchSupplier($text)
{
  require "db_connection.php";
  if ($con) {
    $seq_no = 0;
    $query = "SELECT * FROM drlist WHERE UPPER(drname) LIKE '%$text%'";
    $result = mysqli_query($con, $query);
    while ($row = mysqli_fetch_array($result)) {
      $seq_no++;
      showSupplierRow($seq_no, $row);
    }
  }
}

?>