<?php
session_start();
include 'models.php';
include 'connection.php';
$invoiceID = $_SESSION['invoice'];

$imeinumber = mysqli_real_escape_string($conn,$_POST['imei']);

function AddToSubStock($Qty,$ItemID,$multiID,$imei,$invoiceID){
  include 'connection.php';
  $poid =  $_SESSION['podi'];

  $result = mysqli_query($conn,"SELECT * FROM multiprice WHERE ID = $multiID ");
  while($row = mysqli_fetch_array($result)){
    $CostPrice = $row['CostPrice'];
    $Wprice = $row['Wprice'];
    $RetailPrice = $row['RetailPrice'];
  }
  $rowcnt = 0;
  $result = mysqli_query($conn,"SELECT * FROM temp_invoice ORDER BY Temp_Invoice_ID DESC LIMIT 1 ");
  while($row = mysqli_fetch_array($result)){
  $rowcnt = $row['Temp_Invoice_ID'];
  }
  $rowcnt = $rowcnt + 1;


  $sql = "INSERT INTO temp_invoice (Temp_Invoice_ID, Item_ID, Qty, RetPrice, CostPrice, Wprice, Discount, FreeIssue, Invoice_ID, multiID, imei)
  VALUES ($rowcnt, $ItemID, 1, $RetailPrice, $CostPrice, $Wprice, 0, 0, $invoiceID, $multiID, '$imei')";
  mysqli_query($conn, $sql);
  mysqli_close($conn);
}
$result = mysqli_query($conn,"SELECT * FROM inventory WHERE imei = '$imeinumber' OR imei2 = '$imeinumber' ");
while($row = mysqli_fetch_array($result)){
  $PlaceID = $row['Inventory_ID'];

    AddToSubStock($row['Qty'],$row['Item_Item_ID'],$row['multiID'],$row['imei'],$invoiceID);

}
// header('location:NewInvoice.php');
