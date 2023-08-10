<?php
session_start();
$company = $_SESSION['company'];


if(isset($_SESSION['potype'])){
  unset($_SESSION['potype']);
}

if(isset($_SESSION['repID'])){
  unset($_SESSION['repID']);
}

include 'connection.php';
$podate = mysqli_real_escape_string($conn,$_POST['podate']);
$poid = mysqli_real_escape_string($conn,$_POST['poid']);
$supplier = 0;
$potype = mysqli_real_escape_string($conn,$_POST['potype']);
$rep = mysqli_real_escape_string($conn,$_POST['company']);

$_SESSION['potype'] = $potype;

//get the credit perooid
$duedate = 0;
$result = mysqli_query($conn,"SELECT * FROM supplier WHERE Sup_ID = $supplier ");
while($row = mysqli_fetch_array($result)){
  GLOBAL $duedate;
  $duedate = $row['DueDate'];
}

$count = 0;
$result = mysqli_query($conn,"SELECT * FROM po_rep ");
while($row = mysqli_fetch_array($result)){
  GLOBAL $count;
  $count = $row[0];
}
$count = $count + 1;

if($potype == 1){
  $sql = "INSERT INTO po_rep (PurchaseDate,PoID,SupplierID,DueDate,po_type,RepID,CompanyID)
  VALUES ('$podate','$poid',$supplier,$duedate,$potype,$rep,$company)";
  if (mysqli_query($conn, $sql)) {
    echo "New record created successfully";
  } else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
  }
}
else if($potype == 2){
  $repID = mysqli_real_escape_string($conn,$_POST['repID']);
  // $_SESSION['repID'] = $repID;
  $sql = "INSERT INTO po_rep (PurchaseDate,PoID,SupplierID,DueDate,po_type,RepID,CompanyID)
  VALUES ('$podate','$poid',$supplier,$duedate,$potype,$repID,$company)";
  if (mysqli_query($conn, $sql)) {
    echo "New record created successfully";
  } else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
  }
}

$_SESSION['podi'] = $count;
$_SESSION['pototal'] = 0;

mysqli_close($conn);
header('location:NewPurchaseOrderSecond_rep.php');
?>
