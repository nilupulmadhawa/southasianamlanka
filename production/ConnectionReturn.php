<?php
session_start();
$company = $_SESSION['company'];
$cus = $_SESSION['cus'];
$reID = $_SESSION['reID'];
include 'connection.php';
$item = $_POST['item'];
echo $item."<br/>";

$result = mysqli_query($conn,"SELECT * FROM sub_invoice WHERE SubI_ID = $item ");
while($row = mysqli_fetch_array($result)){
  $item = $row['Item_Item_ID'];
  $multi = $row['multiID'];
  $imei = $row['imei'];
}

$qty = $_POST['qty'];
$type = $_POST['type'];
//check the item type
if($type == 3){
  $_SESSION['issue'] = "issue" ;
  // $sql = "UPDATE inventory_sub SET Qty = 1 WHERE imei= $imei ";
  // mysqli_query($conn, $sql);
}
//end of item check
// $multi = $_POST['multi'];
$idate = date("Y-m-d");
if(isset($_SESSION['cus'])){
  $count = 0;
  $result = mysqli_query($conn,"SELECT * FROM return_invoice");
  while($row = mysqli_fetch_array($result)){
    GLOBAL $count;
    $count = $row[0];
  }
  $count = $count + 1;

  $result = "INSERT INTO return_invoice (ID,Item_ID,Qty,FreeIssue,Customer_ID,reduced_invoice,ReturnDate,status,type,multiID,CompanyID,reID)
  VALUES ($count,$item,$qty,0,$cus,0,'$idate',0,$type,$multi,$company,$reID)";
  if (mysqli_query($conn, $result)) {
    echo "New record created successfully";
  } else {
    echo "Error: " . $result . "<br>" . mysqli_error($conn);
  }




}
else{
  $_SESSION['error'] = "true";
}
mysqli_close($conn);
header('location:Return.php');

// log process
include 'functions/activity.php';
activity($_SESSION['id'],"Placed A New Return");
// end of log process

?>
