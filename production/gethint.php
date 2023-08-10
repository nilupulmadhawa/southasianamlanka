<?php
session_start();
$id1 = $_SESSION['id'];
$company = $_SESSION['company'];
include 'connection.php';
 $result = mysqli_query($conn,"SELECT Name FROM cus_profile WHERE CompanyID = $company");
$a = Array();
while($row=mysqli_fetch_array($result)){
    $a[] =  $row['Name'];
}
mysqli_close($conn);

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
                $hint = "<b><a href='UpdateCustomers.php?name=".$name."'>".$name."</a></b>";
            } else {
                $hint = $hint. "<b><br/><a href='UpdateCustomers.php?name=".$name."'>". $name."</a></b>";
            }
        }
    }
}

// Output "no suggestion" if no hint was found or output correct values
echo $hint === "" ? "No Results In The Database." : $hint;
?>
