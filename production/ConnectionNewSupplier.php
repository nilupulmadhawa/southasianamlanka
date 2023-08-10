<?php 
session_start();
include 'connection.php';
$name = $_POST['name'];
$address = $_POST['address'];
$contact = $_POST['contact'];
$fax = $_POST['fax'];
$email = $_POST['email'];
$contactper = $_POST['contactper'];

$company = $_SESSION['company']; 

$count = 0;
$result = mysqli_query($conn,"SELECT * FROM supplier");
while($row = mysqli_fetch_array($result)){
	GLOBAL $count;
	$count = $count + 1;
}
$count = $count + 1;

$result = "INSERT INTO supplier (Sup_ID, Name, Address, TPNo, Fax, Email, Contact_per, CompanyID) VALUES ($count,'$name', '$address', '$contact', '$fax', '$email', '$contactper', $company)";
mysqli_query($conn,$result);
mysqli_close($conn);
header('location:NewSupplier.php');
?>