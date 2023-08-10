<?php
session_start();
$company = $_SESSION['company'];
include 'connection.php';
 $result = mysqli_query($conn,"SELECT ItemCode FROM item WHERE CompanyID = $company");
$a = Array();
while($row=mysqli_fetch_array($result)){
    $a[] =  $row['ItemCode'];
}
mysqli_close($conn);
function ProductCode($Name){
	include 'connection.php';
	$result = mysqli_query($conn,"SELECT * FROM item WHERE ItemCode = '$Name' ");
	while($row = mysqli_fetch_array($result)){
		return $row[0];
	}
	mysqli_close($conn);
}

function ProductName($Name){
	include 'connection.php';
	$result = mysqli_query($conn,"SELECT * FROM item WHERE ItemCode = '$Name' ");
	while($row = mysqli_fetch_array($result)){
		return $row[2];
	}
	mysqli_close($conn);
}
// get the q parameter from URL
$q = $_REQUEST["q"];

$hint = "";

// lookup all hints from array if $q is different from ""
if ($q !== "") {
    $q = strtolower($q);
    $len=strlen($q);
    foreach($a as $name) {
        if (stristr($q, substr($name, 0, $len))) {
            if ($hint === "") {
                $hint = "<b><a href='UpdateProduct.php?name=".ProductCode($name)."'> ".$name." (".ProductName($name).")</a></b>";
            } else {
                $hint = $hint. "<b><br/><a href='UpdateProduct.php?name=".ProductCode($name)."'> ".$name." (". ProductName($name).")</a></b>";
            }
        }
    }
}

// Output "no suggestion" if no hint was found or output correct values
echo $hint === "" ? "No Products In The Database." : $hint;
?>
