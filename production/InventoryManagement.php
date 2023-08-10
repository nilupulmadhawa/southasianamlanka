<?php
// function to add to stock
function addtostock($itemID,$qty){
  include 'connection.php';
  $newstock = 0;
  $rowcount = 0;
  $result = mysqli_query($conn,"SELECT * FROM inventory WHERE Item_Item_ID = $itemID");
  $rowcount=mysqli_num_rows($result);
  if($rowcount > 0){

    while($row = mysqli_fetch_array($result)){
      $stk = $row['Qty'];
    }
    $newstock = $stk + $qty;

    $sql = "UPDATE inventory SET Qty = $newstock WHERE Item_Item_ID = $itemID ";
    mysqli_query($conn, $sql);

  }else{
    $PrimaryKey = 0;
    $result = mysqli_query($conn,"SELECT * FROM inventory ORDER BY Inventory_ID ASC");
    while($row = mysqli_fetch_array($result)){
      $PrimaryKey = $row['Inventory_ID'];
    }
    $PrimaryKey = $PrimaryKey + 1;

    $sql = "INSERT INTO inventory (Inventory_ID, Qty, Item_Item_ID)
    VALUES ($PrimaryKey, $qty, $itemID)";
    mysqli_query($conn, $sql);

  }

  mysqli_close($conn);
}

// function to remove from the stock
function removefromstock($itemID,$qty){
  include 'connection.php';
  $newstock = 0;
  $rowcount = 0;
  $result = mysqli_query($conn,"SELECT * FROM inventory WHERE Item_Item_ID = $itemID");
  $rowcount=mysqli_num_rows($result);
  if($rowcount > 0){

    while($row = mysqli_fetch_array($result)){
      $stk = $row['Qty'];
    }
    $newstock = $stk - $qty;

    $sql = "UPDATE inventory SET Qty = $newstock WHERE Item_Item_ID = $itemID ";
    mysqli_query($conn, $sql);

  }

  mysqli_close($conn);
}

function invqty($itemID){
  include 'connection.php';
  $stock = 0;
  $result = mysqli_query($conn,"SELECT * FROM multiprice WHERE Item_ID = $itemID ");
  while($row = mysqli_fetch_array($result)){
    $stock = $row['Qty'];
  }
  return $stock;
  mysqli_close($conn);
}
