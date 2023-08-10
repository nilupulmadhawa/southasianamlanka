<?php 
include 'connection.php';
$result = mysqli_query($conn,"SELECT * FROM item");
$count=mysqli_num_rows($result);
$steps = 1;
while($steps<=$count){
    $result = mysqli_query($conn,"SELECT * FROM item LIMIT $steps");
    while($row = mysqli_fetch_array($result)){
       GLOBAL $itemid,$itemname;
        $itemid = $row[0];
        $itemname = $row[1];
    }
    //check the inventory
    $check = 0;
    $result = mysqli_query($conn,"SELECT * FROM inventory WHERE Item_Item_ID = $itemid");
    $check=mysqli_num_rows($result);
    if($check == 0){
        $result = mysqli_query($conn,"SELECT * FROM inventory");
        while($row = mysqli_fetch_array($result)){
           GLOBAL $invid;
            $invid = $row[0];            
        }
        $invid = $invid +1;
        $result = "INSERT INTO inventory (Inventory_ID,CostPrice,RetPrice,Wprice,Qty,Item_Item_ID,Main_GRN_Grn_ID) VALUES ($invid ,0 ,0 ,0 ,0 ,$itemid ,0)";
        mysqli_query($conn,$result);
        echo $itemname."</br>";
    }
    $steps = $steps + 1;
}
mysqli_close($conn);
header('location:Maintain.php');
?>