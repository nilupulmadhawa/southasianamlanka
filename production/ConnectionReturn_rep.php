<?php
session_start();
$company = $_SESSION['company'];
$cus = 0;
$reID = 0;
include 'connection.php';
$imei = mysqli_real_escape_string($conn,$_POST['imei']);
// echo $item."<br/>";

$result = mysqli_query($conn,"SELECT * FROM inventory_rep WHERE imei = '$imei' OR imei2 = '$imei' ");
while($row = mysqli_fetch_array($result)){
  $imei = $row['imei'];
  $multiprice = $row['multiID'];
  $item = $row['Item_Item_ID'];
  $multi = $row['multiID'];
  $imei = $row['imei'];
  $imei2 = $row['imei2'];
}

$qty = 1;
$type = mysqli_real_escape_string($conn,$_POST['type']);
//check the item type
if($type == 3){
  $_SESSION['issue'] = "issue" ;
  // $sql = "UPDATE inventory_sub SET Qty = 1 WHERE imei= $imei ";
  // mysqli_query($conn, $sql);
}
//end of item check
// $multi = $_POST['multi'];
$idate = date("Y-m-d");

  $count = 0;
  $result = mysqli_query($conn,"SELECT * FROM return_invoice_rep WHERE status = 1 ");
  while($row = mysqli_fetch_array($result)){
    // GLOBAL $count;
    $count = $row['InvoiceID'];
  }
  $count = $count + 1;

  $result = "INSERT INTO return_invoice_rep (Item_ID,Qty,FreeIssue,Customer_ID,reduced_invoice,ReturnDate,status,type,multiID,CompanyID,reID,InvoiceID,imei,imei2)
  VALUES ($item,$qty,0,$cus,0,'$idate',0,$type,$multi,$company,$reID,$count,'$imei','$imei2')";
  if (mysqli_query($conn, $result)) {
    echo "New record created successfully";
  } else {
    echo "Error: " . $result . "<br>" . mysqli_error($conn);
  }


mysqli_close($conn);
header('location:Return_rep.php');

// log process
include 'functions/activity.php';
activity($_SESSION['id'],"Placed A New Return");
// end of log process

?>
