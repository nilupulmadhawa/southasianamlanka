<?php
include 'connection.php';
session_start();

$pro = mysqli_real_escape_string($conn,$_POST['pro']);
$repID = mysqli_real_escape_string($conn,$_POST['repID']);
$qty = mysqli_real_escape_string($conn,$_POST['Qty']);
$comm = mysqli_real_escape_string($conn,$_POST['comm']);

//item name
$itemname = "NULL";
$result = mysqli_query($conn,"SELECT * FROM item WHERE Item_ID = $pro ");
while($row=mysqli_fetch_array($result)) {
    $itemname = $row['Name'];
}

$sql = "INSERT INTO item_commisiion (ItemID, Qty, Commision, ItemName, RepID)
VALUES ($pro, $qty, $comm, '$itemname', $repID)";

if (mysqli_query($conn, $sql)) {
    $_SESSION['success'] = "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

mysqli_close($conn);

header('location:Commision.php');
?>
