<?php
session_start();
include 'models.php';
include 'connection.php';
$imei = mysqli_real_escape_string($conn,$_POST['imei']);

echo $imei.'<br/>';
function AddToSubStock($Qty,$ItemID,$multiID,$imei,$imei2){
  include 'connection.php';
  $poid =  $_SESSION['podi'];
  echo "done<br/>";
  $sql = "INSERT INTO temp_po_rep (Qty, ItemID, PoID, multiID, imei, imei2)
  VALUES ($Qty, $ItemID, '$poid', $multiID, '$imei', '$imei2')";
  if(!mysqli_query($conn, $sql)){
    echo mysqli_error($conn);
  }
  mysqli_close($conn);
}
$result = mysqli_query($conn,"SELECT * FROM inventory_sub WHERE imei = '$imei' ");
while($row = mysqli_fetch_array($result)){

    AddToSubStock($row['Qty'],$row['Item_Item_ID'],$row['multiID'],$row['imei'],$row['imei2']);

}
header('location:NewPurchaseOrderSecond_rep.php');
