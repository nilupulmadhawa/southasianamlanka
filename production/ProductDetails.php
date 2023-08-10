<?php
session_start();
include 'connection.php';
$q = $_REQUEST["q"];
//echo $q."<br/>";
echo "<b>LATEST PRICE RANGE: </b><br/>";
$_SESSION['item'] = $q;
$result = mysqli_query($conn,"SELECT * FROM item WHERE Item_ID = '$q' ");
while($row = mysqli_fetch_array($result)){
    echo "Product Name: <b>".$row[2]."</b><br/>";
//    echo "Retail Price: <b>Rs. ".number_format($row[2],2)."</b><br/>";
//    echo "Cost Price: <b>Rs. ".number_format($row[3],2)."</b><br/>";
//    echo "Wholesale Price: <b>Rs. ".number_format($row[4],2)."</b><br/>";
}

$result = mysqli_query($conn,"SELECT * FROM multiprice WHERE Item_ID = '$q' ORDER BY ID DESC LIMIT 1");
while($row = mysqli_fetch_array($result)){


    echo "Cost Price: <b>Rs. ".number_format($row[3],2)."</b><br/>";
    echo "Wholesale Price: <b>Rs. ".number_format($row[4],2)."</b><br/>";
    echo "Retail Price: <b>Rs. ".number_format($row[5],2)."</b><br/>";


}
mysqli_close($conn);
?>
