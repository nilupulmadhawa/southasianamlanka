<?php 
$id = $_POST['empid'];
$priv = $_POST['priv'];
$fname = $_POST['fname'];
$username = $_POST['username'];
$address = $_POST['address'];
$contact = $_POST['contact'];
$nic = $_POST['nic'];
$email = $_POST['email'];
$priv = intval($priv);

include 'connection.php';

$sql2 = "UPDATE user_profile SET Name = '$fname' WHERE Prof_ID = $id ";
	mysqli_query($conn,$sql2);
$sql2 = "UPDATE user_profile SET Address = '$address' WHERE Prof_ID = $id ";
	mysqli_query($conn,$sql2);
$sql2 = "UPDATE user_profile SET NIC = '$nic' WHERE Prof_ID = $id ";
	mysqli_query($conn,$sql2);
$sql2 = "UPDATE user_profile SET TPNo = '$contact' WHERE Prof_ID = $id ";
	mysqli_query($conn,$sql2);
$sql2 = "UPDATE user_profile SET Email = '$email' WHERE Prof_ID = $id ";
	mysqli_query($conn,$sql2);
$sql2 = "UPDATE user_profile SET Privilages_Priv_ID = $priv WHERE Prof_ID = $id ";
	mysqli_query($conn,$sql2);

mysqli_close($conn);
header('location:UserRegistration.php');
?>