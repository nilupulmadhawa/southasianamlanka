<label>AVAILABLE MAIN STOCK ITEMS FOR THE SELECTED PRODUCT</label>
<form action="AddToSubStock.php" method="post">
<?php
session_start();
require_once 'models.php';
include 'connection.php';
$poid =  $_SESSION['podi'];
$productID = $_REQUEST['q'];

$result = mysqli_query($conn,"SELECT * FROM inventory WHERE Item_Item_ID = $productID AND Qty = 1 ");
while($row = mysqli_fetch_array($result)){
  echo "<div class='row' style='border-top:1px solid;margin-bottom:3px;font-size:16px;'>";
  echo "<div class='col-sm-3'>".$row['imei']."</div>";
  echo "<div class='col-sm-3'>".$row['itemtype']."</div>";
  if(checktempsubstock($row['imei']) == 0){
    echo "<div class='col-sm-6'><input type='checkbox' name='".$row[0]."' value='".$row['0']."'></div>";
  }else{
    echo "<div class='col-sm-6' style='color:green;'>You Have Already Selected This Item</div>";
  }

  echo "</div>";
}
mysqli_close($conn);
?>
<button type="submit" class="btn btn-warning btn-block">ADD</button>
</form>
