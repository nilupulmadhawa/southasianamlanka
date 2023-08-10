<?php
session_start();
$q = $_REQUEST['q'];
// echo $q;
include 'connection.php';
$result = mysqli_query($conn,"SELECT * FROM item WHERE Item_ID = $q");
while($row = mysqli_fetch_array($result)){
	GLOBAL $RetPrice,$WholePrice,$name;
	$name = $row[2];

	$CostPrice = $row[3];
	$RetPrice = $row[2];
	$WholePrice = $row[4];
}
mysqli_close($conn);
?>
<div class="form-group">
				<label for="email">Multiple Prices:</label>
			  <select class="form-control" name="multi">
			<?php
			include 'connection.php';
			if($_SESSION['potype'] == 2){
				$result = mysqli_query($conn,"SELECT * FROM multiprice WHERE Item_ID = $q AND Qty > 0 ");
			}else {
				$result = mysqli_query($conn,"SELECT * FROM multiprice WHERE Item_ID = $q");
			}

			while($row = mysqli_fetch_array($result)){
				echo "<option value='".$row[0]."'> Wholesale Price:(".$row[4].") Retail Price (".$row[5].") Quantity:(".$row[2].")</option>";
			}
			mysqli_close($conn);
			?>
		</select>
			</div>
