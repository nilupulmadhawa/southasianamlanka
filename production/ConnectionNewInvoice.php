<?php

session_start();
include 'connection.php';
$product = $_POST['product'];
$qty = $_POST['qty'];
$add_dis = $_POST['add_dis'];

if (isset($_POST['multi'])) {
  $multiID = $_POST['multi'];
} else {
  $multiID = 0;
}

function catcaount($category, $invoice) {
  include 'connection.php';
  $count = 0;
  $result = mysqli_query($conn, "SELECT * FROM temp_invoice WHERE Invoice_ID = $invoice");
  $rowcount = mysqli_num_rows($result);
  $st = 1;
  while ($st <= $rowcount) {
    $result = mysqli_query($conn, "SELECT * FROM temp_invoice WHERE Invoice_ID = $invoice LIMIT $st");
    while ($row = mysqli_fetch_array($result)) {
      GLOBAL $item, $itemqt;
      $item = $row[1];
      $itemqt = $row[2];
    }
    $result = mysqli_query($conn, "SELECT * FROM item WHERE Item_ID = $item");
    while ($row = mysqli_fetch_array($result)) {
      GLOBAL $cate;
      $cate = $row[10];
      echo $row[1] . "</br>";
    }
    if ($category == $cate) {
      $count = $count + $itemqt;
    }
    $st = $st + 1;
  }
  return $count;
  mysqli_close($conn);
}

$invoice = $_SESSION['invoice'];
//echo $product."</br>";
//set the free issue
$qt = 1;
$free = 0;
$discount = 0;
$result = mysqli_query($conn, "SELECT * FROM freeissue WHERE Item_ID = $product");
while ($row = mysqli_fetch_array($result)) {
  //GLOBAL $free,$discount,$qt;
  $qt = $row[2];
  $free = $row[3];
  $discount = $row[4];
}
$discount = $discount + $add_dis;

//echo $free."</br>";
//echo $discount."</br>";
//echo $qty."</br>";

$result = mysqli_query($conn, "SELECT * FROM item WHERE Item_ID = $product");
while ($row = mysqli_fetch_array($result)) {
  GLOBAL $category;
  $category = $row[9];
  echo $row[1] . "</br>";
}
$check = ($qty) / $qt;
$check = intval($check);
$free = $free * $check;
echo "Item count of same category: " . catcaount($category, $invoice) . "<br/>";

$result = mysqli_query($conn, "SELECT * FROM multiprice WHERE ID = $multiID");
while ($row = mysqli_fetch_array($result)) {
  //GLOBAL $stk;
  $stk = $row['Qty'];
}

//check the already set qty
$itemqty = 0;
$result = mysqli_query($conn, "SELECT * FROM temp_invoice WHERE Invoice_ID = $invoice AND Item_ID = $product ");
while ($row = mysqli_fetch_array($result)) {
  $itemqty = $itemqty + $row['Qty'];
}

if ($stk > 0 && ($qty + $free + $itemqty) <= $stk) {
  echo $stk . "</br>";
  //$newstock = $stk - $qty - $free;
  //echo $newstock."</br>";
  //$sql2 = "UPDATE inventory SET qty = $newstock WHERE Item_Item_ID = $product ";
  //mysqli_query($conn,$sql2);


  $result = mysqli_query($conn, "SELECT * FROM multiprice WHERE ID = $multiID");
  while ($row = mysqli_fetch_array($result)) {
    // GLOBAL $CostPrice, $RetPrice, $wprice;
    $CostPrice = $row[3];
    $RetPrice = $row[5];
    $wprice = $row[4];
  }

  $count = 0;
  $result = mysqli_query($conn, "SELECT * FROM temp_invoice ORDER BY Temp_Invoice_ID ASC");
  while ($row = mysqli_fetch_array($result)) {
    GLOBAL $count;
    $count = $row[0];
  }
  $count = $count + 1;
  //check for assigned free issues
  $oldfreeissue = 0;
  $result = mysqli_query($conn, "SELECT * FROM temp_invoice WHERE Discount = 100 AND Invoice_ID = $invoice ");
  while ($row = mysqli_fetch_array($result)) {
    GLOBAL $oldfreeissue;
    $oldfreeissue = $oldfreeissue + $row[2];
  }
  echo "<br/> past free: " . $oldfreeissue;
  echo "<br/> free: " . $free;

  $free = $free;

  if($_POST['free']>0){
    $free = $_POST['free'];
  }

  $result = "INSERT INTO temp_invoice (Temp_Invoice_ID, Item_ID ,Qty, FreeIssue, RetPrice, CostPrice, Wprice,Discount,Invoice_ID, multiID) VALUES ($count, $product, $qty, $free, $RetPrice, $CostPrice, $wprice, $discount, $invoice, $multiID)";
  mysqli_query($conn, $result);

  $newst = $stk - ($qty + $free);
  $sql2 = "UPDATE multiprice SET Qty = $newst WHERE ID = $multiID ";
  mysqli_query($conn,$sql2);


  //    if ($free > 0) {
  //        $count = $count + 1;
  //        $result = "INSERT INTO temp_invoice (Temp_Invoice_ID, Item_ID ,Qty, FreeIssue, RetPrice, CostPrice, Wprice,Discount,Invoice_ID, multiID)
  //VALUES ($count, $product, $free, $free, $RetPrice, $CostPrice, $wprice, 100, $invoice, $multiID)";
  //        mysqli_query($conn, $result);
  //    }


  if (isset($_POST['freeissue'])) {
    $freeitem = $_POST['freeissue'];
    //---------------------------------------------
    $result = mysqli_query($conn, "SELECT * FROM item WHERE Item_ID = $product");
    while ($row = mysqli_fetch_array($result)) {
      GLOBAL $freeRetPrice;

      $freeRetPrice = $row[3];
    }
    //--------------------------------------------
    echo "ok";
    $count = $count + 1;

    $result = "INSERT INTO temp_invoice (Temp_Invoice_ID, Item_ID ,Qty, RetPrice, CostPrice, Wprice,Discount,Invoice_ID, multiID) VALUES ($count, $freeitem, $free, $freeRetPrice, 0, 0, 100, $invoice, 0)";
    mysqli_query($conn, $result);
  }
  $t = 0;
  $result = mysqli_query($conn, "SELECT * FROM temp_invoice WHERE Invoice_ID = $invoice ");
  while ($row = mysqli_fetch_array($result)) {
    GLOBAL $qty, $wp, $Discount, $t;
    $qty = $row[2];
    $wp = $row[5];
    $Discount = $row[6];
    $sub = (100 - $Discount);
    $sub = $sub * $qty * $wp;
    $sub = $sub / 100;
    $t = $t + $sub;
  }
  $_SESSION['t'] = $t;
  unset($_SESSION['error']);
} else {
  $_SESSION['error'] = 1;
}
mysqli_close($conn);
header('location:NewInvoice.php');
?>
