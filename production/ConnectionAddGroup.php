<?php 
session_start();
$company = $_SESSION['company'];
include 'connection.php';
$name = $_POST['name'];
$id = 0;
$result = mysqli_query($conn,"SELECT * FROM grouping");
while($row = mysqli_fetch_array($result)){
	GLOBAL $id;
	$id = $row[0];
}
	$id = $id + 1;

$result = "INSERT INTO grouping (ID,Grouping,CompanyID) VALUES ($id, '$name',$company)";
mysqli_query($conn,$result);
mysqli_close($conn);
header('location:SetGroup.php');
?>