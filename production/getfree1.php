<?php
session_start();
$q = $_REQUEST["q"]; 

$itemcat = $_SESSION['itemcat'];
//echo $itemcat."<br/>";
$freeissue = $_SESSION['freeissue'];
$quantity = $_SESSION['quantity'];

$category = $itemcat;
echo $category;
$invoice =  $_SESSION['invoice'];
	include 'connection.php';
	$count = 0;
	$itemqt = 0;
	$result = mysqli_query($conn,"SELECT * FROM temp_invoice WHERE Invoice_ID = $invoice AND Discount!= 100 ");
	$rowcount=mysqli_num_rows($result);
	$st = 1;
	while($st <= $rowcount){
	$result = mysqli_query($conn,"SELECT * FROM temp_invoice WHERE Invoice_ID = $invoice AND Discount!= 100 LIMIT $st");
	while($row = mysqli_fetch_array($result)){
		GLOBAL $item,$itemqt;
		$item = $row[1];
		$itemqt = $row[2];
	}
	$result = mysqli_query($conn,"SELECT * FROM item WHERE Item_ID = $item");
	while($row = mysqli_fetch_array($result)){
		GLOBAL $cate;
		$cate = $row[9];
		
	}
	if($category == $cate){
		$count = $count + $itemqt;
	}
	$st = $st + 1;
	}
	//echo "invoice Number: ". $invoice."<br/>";
	//echo "all item count: ".($count+$q)."<br/>";
	//get the previous free issue count
	$freecount = 0;
	$result = mysqli_query($conn,"SELECT * FROM temp_invoice WHERE Invoice_ID = $invoice AND Discount= 100 ");
	while($row = mysqli_fetch_array($result)){
		GLOBAL $freecount;
		$freecount = $freecount + $row[2];		
	}
	//echo $freecount."<br/>";
	$currentvalue = $freecount * $quantity;
	//echo "current value: ". $currentvalue;
	$catfreeissue =($count+$q) - $currentvalue ;
	//echo "new amount: ".$catfreeissue."<br/>";
	mysqli_close($conn);
	if($freeissue != 0){
if($q >= $quantity || $catfreeissue >= $quantity){
?>

<div class="col-sm-12" style="margin-left:-15px;">
<label>Free Issue Item</label>
 <select class="form-control" name="freeissue" >
            <?php
			include 'connection.php';
			$count = 1;
			$result = mysqli_query($conn, "SELECT * FROM item WHERE Category_Cat_ID = $itemcat");
            while($row = mysqli_fetch_array($result)){
              echo "<option value = '".$row[0]."'>".$row[1]."</option>";              
			  }
              mysql_close($conn);
             ?>
          </select>
		  
</div>
	<?php }} ?>