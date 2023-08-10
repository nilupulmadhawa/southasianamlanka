<?php
session_start();
include 'connection.php';
include 'models.php';
$potype = $_SESSION['potype'];
$company = $_SESSION['company'];

$poid = $_SESSION['podi'];
echo $poid."<br/>";

$result = mysqli_query($conn,"SELECT * FROM po_rep WHERE ID = $poid ");
while($row=mysqli_fetch_array($result)) {
  $ponumber = $row['PoID'];
  $LocationID = $row['CompanyID'];
}

$sql2 = "UPDATE po_rep SET status = 1 WHERE ID = $poid ";
mysqli_query($conn,$sql2);

$count = 0;
$result = mysqli_query($conn,"SELECT * FROM temp_po_rep WHERE PoID = '$poid' ");
$count=mysqli_num_rows($result);

$steps = 1;

while($steps<=$count){

  $result = mysqli_query($conn,"SELECT * FROM temp_po_rep WHERE PoID = '$poid' LIMIT $steps ");
  while($row = mysqli_fetch_array($result)){
    $Qty = $row[1];
    $FreeIssue = $row[2];
    $RetPrice = $row[3];
    $CostPrice = $row[4];
    $Wprice = $row[5];
    $Discount = $row[6];
    $ItemID = $row[7];
    $PoID1 = $row[8];
    $mul = $row[9];
    $imei = $row[10];
    $imei2 = $row['imei2'];
  }
  addtoinv_rep($ItemID,$imei,$mul,$LocationID,$imei2);
  $product =  $ItemID;

  $vinidcount = 0;
  $result = mysqli_query($conn,"SELECT * FROM sub_po_rep ");
  while($row = mysqli_fetch_array($result)){
    $vinidcount = $vinidcount + 1;
  }
  $vinidcount = $vinidcount + 1;


  $result = "INSERT INTO sub_po_rep (Qty,ItemID,PoID, multiID, imei)
  VALUES ($Qty, $ItemID, '$ponumber', $mul, '$imei')";

  if (mysqli_query($conn, $result)) {
    echo "New record created successfully";
  } else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
  }

  // update main inventory
  $sql = "UPDATE inventory_sub SET Qty = 0  WHERE imei = '$imei' ";

  if (mysqli_query($conn, $sql)) {
    echo "Record updated successfully";
  } else {
    echo "Error updating record: " . mysqli_error($conn);
  }

  // update main inventory
  $sql = "UPDATE inventory_sub SET issued = 1  WHERE imei = '$imei' ";

  if (mysqli_query($conn, $sql)) {
    echo "Record updated successfully";
  } else {
    echo "Error updating record: " . mysqli_error($conn);
  }

  $steps = $steps + 1;

}

mysqli_close($conn);

unset($_SESSION['productID']);
header('location:NewPurchaseOrder_rep.php');
?>
