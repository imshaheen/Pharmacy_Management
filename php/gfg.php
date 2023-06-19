<?php
$user_id = $_REQUEST['user_id'];
$con = mysqli_connect("localhost", "root", "", "JMF");
if ($user_id !== "") {
	$query = mysqli_query($con, "SELECT NAME,
	BATCH_ID, EXPIRY_DATE, QUANTITY FROM medicines_stock WHERE ID='$user_id'");
	$row = mysqli_fetch_array($query);
	$Medicine_name = $row["NAME"];
	$Medicine_batchid = $row["BATCH_ID"];
	$Medicine_expiry = $row["EXPIRY_DATE"];
	$Medicine_qty = $row["QUANTITY"];
}
$result = array("$Medicine_name", "$Medicine_batchid", "$Medicine_expiry", "$Medicine_qty");
$myJSON = json_encode($result);
echo $myJSON;
?>
