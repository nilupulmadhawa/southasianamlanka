<?php
session_start();
include 'connection.php';
$product = $_POST['product'];
$qty = $_POST['qty'];
$multi = $_POST['multi'];
$company = $_SESSION['company'];
$id1 = $_SESSION['id']; 
//get the multi price stock
$multyqty = 0;
$result = mysqli_query($conn,"SELECT * FROM multiprice WHERE ID = $multi");
while($row = mysqli_fetch_array($result)){
	GLOBAL $multyqty;
	$multyqty = $row[2];
}

echo $multyqty."<br/>";
$newqty = 0;
$newqty = $qty - $multyqty; 

//get the item price stock
$invqty = 0;
$result = mysqli_query($conn,"SELECT * FROM inventory WHERE Item_Item_ID = $product");
while($row = mysqli_fetch_array($result)){
	GLOBAL $invqty;
	$invqty = $row[4];
}
$newinv = 0;
$newinv = $invqty + $newqty;

	$sql2 = "UPDATE multiprice SET Qty = $qty WHERE ID = $multi ";
	mysqli_query($conn,$sql2);




$today = date("Y-m-d");
$id = 0;
$result = mysqli_query($conn,"SELECT * FROM initial_inv");
$id=mysqli_num_rows($result);
	

$result = "INSERT INTO initial_inv (ID,ProductName,Qty,ChangeDate,UserID,Company,NewQty,multiID) VALUES ($id,$product,$multyqty,'$today',$id1,$company,$qty,$multi)";
mysqli_query($conn,$result);

mysqli_close($conn);

header('location:InitialInventory.php');
?>

