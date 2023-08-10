<?php
function MinusStockBalance($cusID,$InvoiceID){
  include 'connection.php';
  echo "INVOICE ID: ".$InvoiceID;

  $sql="SELECT * FROM multiprice_minus WHERE Cus_ID = $cusID";

  if ($result=mysqli_query($conn,$sql))
  {
    $rowcount=mysqli_num_rows($result);
    while($row = mysqli_fetch_array($result)){
      $itemID = $row['Item_ID'];
      $itemQty = $row['Qty'];
      $itemMultiID = $row['multiID'];
      insertdata($itemID,$itemQty,$itemMultiID,$InvoiceID);
    }

  }

}
function insertdata($itemID,$itemQty,$itemMultiID,$InvoiceID){
  include 'connection.php';
  echo "<br/>INVOICE ID: ".$InvoiceID;
  // get the multi price details
  $result = mysqli_query($conn,"SELECT * FROM multiprice WHERE ID = $itemMultiID ");
  while($row = mysqli_fetch_array($result)){
    $CostPrice = $row['CostPrice'];
    $WholeSalePrice = $row['Wprice'];
    $RetailPrice = $row['RetailPrice'];
    $MultiStkQty = $row['Qty'];
  }

  $invoiceQty = 0;
  $minusQty = 0;
  if( $MultiStkQty > 0 && $MultiStkQty > $itemQty ){
    $minusQty = 0;
    $invoiceQty = $itemQty;
  }else if($MultiStkQty > 0 && $MultiStkQty < $itemQty){
    $minusQty = $itemQty - $MultiStkQty;
    $invoiceQty = $MultiStkQty;
  }else if($MultiStkQty <= 0){
    $minusQty = $itemQty;
    $invoiceQty = 0;
  }

  $TempRowID = 0;
  $result = mysqli_query($conn,"SELECT * FROM temp_invoice ORDER BY Temp_Invoice_ID ASC ");
  while($row = mysqli_fetch_array($result)){
    $TempRowID = $row[0];
  }
  $TempRowID = $TempRowID + 1;
  if($invoiceQty > 0){

    $sql = "INSERT INTO temp_invoice (Temp_Invoice_ID, Item_ID, Qty,RetPrice,CostPrice,Wprice,Discount,FreeIssue,Invoice_ID,multiID,MinusQty,ItemType)
    VALUES ($TempRowID,$itemID,$invoiceQty,$RetailPrice,$CostPrice,$WholeSalePrice,0,0,$InvoiceID,$itemMultiID,0,3)";

    if (mysqli_query($conn, $sql)) {
      $sql2 = "UPDATE multiprice SET qty = $MultiStkQty-$invoiceQty WHERE ID = $itemMultiID ";
      mysqli_query($conn,$sql2);
    } else {
      echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }

  }


  mysqli_close($conn);
}
?>
