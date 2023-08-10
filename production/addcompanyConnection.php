<?php
include 'connection.php';

$refName = mysqli_real_escape_string($conn,$_POST['refName']);
$branchName = mysqli_real_escape_string($conn,$_POST['branchName']);
$address = mysqli_real_escape_string($conn,$_POST['address']);
$contactNumber = mysqli_real_escape_string($conn,$_POST['contactNumber']);
$fax = mysqli_real_escape_string($conn,$_POST['fax']);
$email = mysqli_real_escape_string($conn,$_POST['email']);

$sql = "INSERT INTO company (CompanyName, Address, Contact, Fax, Email, RefName)
VALUES ('$branchName', '$address', '$contactNumber', '$fax', '$email', '$refName')";

if (mysqli_query($conn, $sql)) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}


mysqli_close($conn);
?>
