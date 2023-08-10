<?php
session_start();
include 'connection.php';
include 'models.php';
$product = $_POST['product'];
$_SESSION['productID'] = $product;
$imei = $_POST['imei'];
$imei2 = $_POST['imei2'];
$qty = 1;
$free = 0;
$discount = $_POST['discount'];
$multi = $_POST['multi'];
$poid = $_SESSION['podi'];


$imeicheck = imeivalidation($imei);
echo $imeicheck."<br/>";
if($imeicheck == 0){

  $result = mysqli_query($conn,"SELECT * FROM multiprice WHERE ID = $multi ");
  while($row = mysqli_fetch_array($result)){
    //		GLOBAL $multiID,$st;
    $multiID = $row[0];
    $st = $row[2];
  }
  $newst = $st - $qty;



  //echo $product."</br>";


  //echo $qty."</br>";


  $result = mysqli_query($conn,"SELECT * FROM multiprice WHERE ID = $multi");
  while($row=mysqli_fetch_array($result)) {
    GLOBAL $cost,$whole,$retail;
    $cost = $row[3];
    $whole = $row[4];
    $retail = $row[5];
  }




  $result = mysqli_query($conn,"SELECT * FROM po WHERE  ID = $poid");
  while($row=mysqli_fetch_array($result)) {
    GLOBAL $ponumber;
    $ponumber = $row['PoID'];
  }





  $count = 0;
  $result = mysqli_query($conn,"SELECT * FROM temp_po");
  while($row = mysqli_fetch_array($result)){
    GLOBAL $count;
    $count = $row[0];
  }
  $count = $count + 1;

  if($_SESSION['potype'] == 2){
    if($newst >= 0 ){

      $sql = "INSERT INTO temp_po (ID, Qty, FreeIssue, RetPrice, CostPrice, Wprice, Discount, ItemID, PoID, multiID, imei, imei2)
      VALUES ($count, $qty, $free, $retail, $cost, $whole, $discount, $product, '$ponumber', $multi, '$imei', '$imei2')";
      if (mysqli_query($conn, $sql)) {
        echo "New record created successfully";
      } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
      }

    }
    else{
      echo "error";
    }
  }else{
    $sql = "INSERT INTO temp_po (ID, Qty, FreeIssue, RetPrice, CostPrice, Wprice, Discount, ItemID, PoID, multiID, imei, imei2)
    VALUES ($count, $qty, $free, $retail, $cost, $whole, $discount, $product, '$ponumber', $multi, '$imei', '$imei2')";
    if (mysqli_query($conn, $sql)) {
      echo "New record created successfully";
    } else {
      echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
  }


}
else{
  $_SESSION['errormessage'] = "IMEI NUMBER ALREADY EXISTS IN THE DATABASE!!!";
}


//echo $ponumber;
$pototal = 0;
$temptotal = 0;
$result = mysqli_query($conn,"SELECT * FROM temp_po WHERE  PoID = '$ponumber' ");
while($row=mysqli_fetch_array($result)) {
  GLOBAL $qty,$cost,$discount,$pototal;
  $qty = $row['Qty'];
  $cost = $row['CostPrice'];
  $discount = $row['Discount'];
  $temptotal = (100-$discount);
  $temptotal = $temptotal * $qty;
  $temptotal = $temptotal * $retail;
  $temptotal = $temptotal/100;
  $pototal = $pototal + $temptotal;
}

$_SESSION['pototal'] = $pototal;
mysqli_close($conn);
header('location:NewPurchaseOrderSecond.php');

// log process
include 'functions/activity.php';
activity($_SESSION['id'],"Finalized A GRN");
// end of log process


?>
