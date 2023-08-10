
<div class="col-sm-6">
<?php
session_start();
include 'connection.php';
$q = $_REQUEST["q"];
$_SESSION["itemID"] = $q;
$result = mysqli_query($conn,"SELECT * FROM item WHERE Item_ID = $q ");
	while($row = mysqli_fetch_array($result)){
		GLOBAL $name;
		$_SESSION['itemcat'] = $row[10];
		//$_SESSION['itemgroup'] = $row[14];
		$name = $row[2];
		$itemid = $row[0];
	}
	$productqty = 0;
	include 'functions/quantity.php';
	$productqty = productqty($itemid);
	echo "<b>".$name."</b><br/>";
	if($productqty > 0 && $productqty!=NULL ){
	echo "Stock In Hand : <b>".$productqty."</b>";}
	if($productqty <= 0 || $productqty==NULL ){
		echo "<b style='color:red;'>OUT OF STOCK</b>";
	}
?>
</div>
<div class="col-sm-6">
<div style="height:50px;overflow:auto;margin-top:10px;">
        <table  width="100%" style="font-size:12px;">
        <thead>
        <tr>
        <th class="tablecol1">Qty</th>
        <th class="tablecol3">Free Issue</th>
        </tr>
      </thead>
<?php

$freeissue = 0;
$quantity = 0;
$result = mysqli_query($conn,"SELECT * FROM freeissue WHERE Item_ID = $q ");
	while($row = mysqli_fetch_array($result)){
		GLOBAL $freeissue;
		echo "<tr>";
		echo "<td>".$row[2]."</td>";
		echo "<td>".$row[3]."</td>";
		$freeissue = $row[3];
		$quantity = $row[2];
		echo "</tr>";
	}
	$_SESSION['freeissue'] = $freeissue;
	$_SESSION['quantity'] = $quantity;
mysqli_close($conn);
function pname($pid){
	include 'connection.php';
	$result = mysqli_query($conn,"SELECT * FROM item WHERE Item_ID = $pid ");
	while($row = mysqli_fetch_array($result)){
		GLOBAL $name;
		$name = $row[2];
	}
	return $name;
	mysqli_close($conn);
}
?>
 <tbody>
         <tbody>
		 </table>
</div>
</div>
<?php
include 'connection.php';
if($_SESSION['prev'] == 3){
	$profileID = $_SESSION['id'];
	$result = mysqli_query($conn, "SELECT * FROM multiprice WHERE Item_ID = $q");
}
else {
	$result = mysqli_query($conn, "SELECT * FROM multiprice WHERE Item_ID = $q");
}

$rowcount=mysqli_num_rows($result);




?>
<div class="col-sm-12" style="margin-left:-15px;margin-bottom:20px;">
<label>Batch</label>
 <select class="form-control" name="multi" >
            <?php
			$count = 1;
			$result = mysqli_query($conn, "SELECT * FROM multiprice WHERE Item_ID = $q");
            while($row = mysqli_fetch_array($result)){
              echo "<option value = '".$row[0]."'> ".$row[8]." . ".pname($row[1])." (In Stock:".$row[2].")"." (Cost Price: ".$row[3].")"." (Wholesale Price: ".$row[4].")"." (Retail Price: ".$row[5].")"."</option>";
              $count = $count + 1;
			  }
              mysql_close($conn);
             ?>
          </select>

</div>
