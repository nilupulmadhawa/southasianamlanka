<?php 
include 'connection.php';
$name = $_POST['CompanyName'];
$address = $_POST['Address'];
$contact = $_POST['Contact'];
$fax = $_POST['Fax'];
$email = $_POST['Email'];




$count = 0;
$result = mysqli_query($conn,"SELECT * FROM company");
while($row = mysqli_fetch_array($result)){
	GLOBAL $count;
	$count = $count + 1;
}
$count = $count + 1;

$result = "INSERT INTO company (ID, CompanyName, Address, Contact, Fax, Email) VALUES ($count,'$name','$address','$contact','$fax','$email')";
mysqli_query($conn,$result);
mysqli_close($conn);
header('location:CompanyRegistration.php');

?>