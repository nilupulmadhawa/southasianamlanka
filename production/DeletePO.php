<?php
//function start
function addtostock($itemID,$qty,$multiID){
	include 'connection.php';
	$currentStock = 0;
	$result = mysqli_query($conn,"SELECT * FROM multiprice WHERE ID = $multiID ");
	while($row = mysqli_fetch_array($result)){
		$currentStock = $row['Qty'];
	}
	$NewStock = 0;
	$NewStock = $currentStock - $qty;
	$sql = "UPDATE multiprice SET Qty= $NewStock WHERE ID = $multiID ";
	mysqli_query($conn,$sql);
	mysqli_close($conn);
}
//function ends
include 'connection.php';

$id = $_GET['id'];
echo $id;

$result = mysqli_query($conn,"SELECT * FROM temp_po WHERE PoID = '$id' ");
while($row = mysqli_fetch_array($result)){
	$quantity = $row['Qty'] + $row['FreeIssue'];
	addtostock($row['ItemID'],$quantity,$row['multiID']);
}
// delete from po
$sql = "DELETE FROM po WHERE PoID = '$id' ";
mysqli_query($conn,$sql);

// delete from temp_po
$sql = "DELETE FROM temp_po WHERE PoID = '$id' ";
mysqli_query($conn,$sql);

// delete from sub_po
$sql = "DELETE FROM sub_po WHERE PoID = '$id' ";
mysqli_query($conn,$sql);

mysql_close($conn);

header('location:DetailedReportPO.php');

?>
