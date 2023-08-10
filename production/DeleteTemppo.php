<?php
session_start();
include 'connection.php';
$id = $_GET['id'];
// echo $id;

$sql = "DELETE FROM temp_po WHERE ID = $id ";
if(mysqli_query($conn,$sql)){
  $_SESSION['successmessage'] = "You have successfully deleted the record";
}else{
  $_SESSION['errormessage'] = "Something went worng";
}



header('location:NewPurchaseOrderSecond.php');
?>
