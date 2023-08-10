<?php
include 'connection.php';
$product = $_POST['product'];
$cat = $_POST['sup'];

echo $product."<br/>";
echo $cat."<br/>";

$sql2 = "UPDATE item SET Supplier_ID = $cat WHERE Item_ID = $product ";
//	mysqli_query($conn,$sql2);

if (mysqli_query($conn, $sql2)) {
    echo "New record created successfully";
} else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}

	header('location:UpdateProductSupplier.php');

?>