<?php
session_start();
include 'connection.php';
include 'models.php';
$potype = $_SESSION['potype'];

$poid = $_SESSION['podi'];

$result = mysqli_query($conn,"SELECT * FROM po WHERE ID = $poid ");
while($row=mysqli_fetch_array($result)) {
  $ponumber = $row['PoID'];
}

$sql2 = "UPDATE po SET status = 1 WHERE ID = $poid ";
mysqli_query($conn,$sql2);

$count = 0;
$result = mysqli_query($conn,"SELECT * FROM temp_po WHERE PoID = '$ponumber' ");
$count=mysqli_num_rows($result);

$steps = 1;

while($steps<=$count){

  $result = mysqli_query($conn,"SELECT * FROM temp_po WHERE PoID = '$ponumber' LIMIT $steps ");
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
  addtoinv($ItemID,$imei,$mul,$imei2);
  $product =  $ItemID;

  $vinidcount = 0;
  $result = mysqli_query($conn,"SELECT * FROM sub_po ");
  while($row = mysqli_fetch_array($result)){
    $vinidcount = $vinidcount + 1;
  }
  $vinidcount = $vinidcount + 1;


  $result = "INSERT INTO sub_po (ID,Qty,FreeIssue,RetPrice,CostPrice,Wprice,Discount,ItemID,PoID, multiID, imei, imei2)
  VALUES ($vinidcount, $Qty, $FreeIssue, $RetPrice, $CostPrice, $Wprice, $Discount, $ItemID, '$ponumber', $mul, '$imei', '$imei2')";

  if (mysqli_query($conn, $result)) {

    $stockCount = 0;
    $result = mysqli_query($conn,"SELECT * FROM multiprice WHERE ID = $mul ");
    while($row = mysqli_fetch_array($result)){
      $stockCount = $row['Qty'];
    }

    // $sql = "UPDATE MyGuests SET lastname='Doe' WHERE id=2";

    echo $stockCount."<br/>";


  } else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
  }



  $steps = $steps + 1;

}

mysqli_close($conn);

unset($_SESSION['productID']);
header('location:NewPurchaseOrder.php');
?>
