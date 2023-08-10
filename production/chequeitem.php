<?php 
include 'connection.php';
function cost($Item_ID,$amount){
	include 'connection.php';
	$sql2 = "UPDATE item SET CostPrice = $amount WHERE Item_ID = $Item_ID ";
	mysqli_query($conn,$sql2);
	mysqli_close($conn);
}
function wp($Item_ID,$amount){
	include 'connection.php';
	$sql2 = "UPDATE item SET Wprice = $amount WHERE Item_ID = $Item_ID ";
	mysqli_query($conn,$sql2);
	mysqli_close($conn);
}
$result = mysqli_query($conn, "SELECT * FROM item WHERE CostPrice = 0 AND Wprice = 0");
while($row = mysqli_fetch_array($result)){
echo $row[2]."<br/>";
$amount = 0;
echo "Retial Price: ".$row[3]."<br/>";
$amount = ($row[3]*75)/100;
wp($row[0],$amount);

echo "WholeSale Price: ".$row[5]."<br/>";
$amount = 0;
$amount = ($row[5]*90.5)/100;
cost($row[0],$amount);
echo "Cost Price: ".$row[4]."<br/>";
echo ".......................................................................<br/>";
}
        
mysqli_close($conn)
?>