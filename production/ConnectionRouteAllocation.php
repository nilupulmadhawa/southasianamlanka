<?php
include 'connection.php';
$routedate = $_POST['routedate'];
$route = $_POST['route'];
$repname = $_POST['repname'];
$AllocatedDate = date("Y-m-d");

$count = 0;
$result = mysqli_query($conn,"SELECT * FROM route");
while($row = mysqli_fetch_array($result)){
	GLOBAL $count;
		$count = $row[0];
}
$count = $count + 1;

$result = "INSERT INTO route (ID, RouteNumber, RepID, RouteDate, AllocatedDate) VALUES ($count, $route, $repname, '$routedate', '$AllocatedDate')";
mysqli_query($conn,$result);
header('location:RouteAllocation.php');
?>