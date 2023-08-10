<?php
session_start();
// $invo = $_GET['invo'];
include 'connection.php';

function returninv($imei){
  include 'connection.php';

  $sql = "UPDATE inventory_rep SET Qty = 1 WHERE imei = '$imei' ";
  mysqli_query($conn, $sql);

  $sql = "UPDATE inventory_rep SET issued = 0 WHERE imei = '$imei' ";
  mysqli_query($conn, $sql);

  mysqli_close($conn);
}

$result = mysqli_query($conn,"SELECT * FROM return_invoice_rep WHERE status = 0");
while($row = mysqli_fetch_array($result)){
  $imei = $row['imei'];
  returninv($imei);
}

$sql = "UPDATE return_invoice_rep SET status = 1 WHERE status = 0 ";
mysqli_query($conn, $sql);

mysqli_close($conn);

header('location:Return_rep.php');



?>
