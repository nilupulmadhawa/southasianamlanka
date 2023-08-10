<?php
session_start();

if(isset($_SESSION['potype'])){
  unset($_SESSION['potype']);
}

if(isset($_SESSION['repID'])){
  unset($_SESSION['repID']);
}

include 'connection.php';
$podate = mysqli_real_escape_string($conn,$_POST['podate']);
$poid = mysqli_real_escape_string($conn,$_POST['poid']);
$supplier = mysqli_real_escape_string($conn,$_POST['supplier']);
$potype = mysqli_real_escape_string($conn,$_POST['potype']);
$_SESSION['potype'] = $potype;
//get the credit perooid
$duedate = 0;
$result = mysqli_query($conn,"SELECT * FROM supplier WHERE Sup_ID = $supplier ");
while($row = mysqli_fetch_array($result)){
  GLOBAL $duedate;
  $duedate = $row['DueDate'];
}


$count = 0;
$result = mysqli_query($conn,"SELECT * FROM po");
while($row = mysqli_fetch_array($result)){
  GLOBAL $count;
  $count = $row[0];
}
$count = $count + 1;

if($potype == 1){

  $sql = "INSERT INTO po (ID,PurchaseDate,PoID,SupplierID,DueDate,po_type) VALUES ($count,'$podate','$poid',$supplier,$duedate,$potype)";
  if (mysqli_query($conn, $sql)) {
    echo "New record created successfully";
  } else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
  }

}
else if($potype == 2){

  $repID = mysqli_real_escape_string($conn,$_POST['repID']);

  $_SESSION['repID'] = $repID;

  $sql = "INSERT INTO po (ID,PurchaseDate,PoID,SupplierID,DueDate,po_type,RepID) VALUES ($count,'$podate','$poid',$supplier,$duedate,$potype,$repID)";
  if (mysqli_query($conn, $sql)) {
    echo "New record created successfully";
  } else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
  }

}



$_SESSION['podi'] = $count;

$_SESSION['pototal'] = 0;

mysqli_close($conn);
header('location:NewPurchaseOrderSecond.php');
?>
