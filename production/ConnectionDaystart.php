<?php
session_start();
$id1 = $_SESSION['id'];

$veh = $_POST['vehicle'];
$meter = $_POST['meter'];
$rep = $_POST['rep'];

echo $veh."<br>";
echo $meter."<br>";
echo $rep."<br>";

include 'connection.php';

 $meterdate = date("Y-m-d");
 date_default_timezone_set("Asia/Kolkata");
$starttime = date("h:i:s");

echo $starttime."<br>";
echo $meterdate."<br>";

$count = 0;
$result = mysqli_query($conn,"SELECT * FROM running_chart");
while($row = mysqli_fetch_array($result)){
    GLOBAL $count;
    $count = $row[0];
}
$count = $count + 1;
echo $count."<br>";

$result = "INSERT INTO running_chart (ID, meter, place, meterdate, running_time, rep_id) VALUES ($count, $meter, 'Begining', '$meterdate', '$starttime', $rep)";
mysqli_query($conn,$result);

$count1 = 0;
$result = mysqli_query($conn,"SELECT * FROM day_start");
while($row = mysqli_fetch_array($result)){
    GLOBAL $count1;
    $count1 = $row[0];
}
$count1 = $count1 + 1;

echo $count1."<br>";

$result = "INSERT INTO day_start (ID, Veh_no, Rep_id, startdate, time) VALUES ($count1, '$veh', $rep, '$meterdate', '$starttime')";
mysqli_query($conn,$result);

$sql2 = "UPDATE user SET Status = 1 WHERE User_ID = $rep ";
	mysqli_query($conn,$sql2);

mysqli_close($conn);
header('location:Daystart.php');
?>