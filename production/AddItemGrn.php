<?php
session_start();
include 'connection.php';
$rowcount = 0;
$ImeiNumber = mysqli_real_escape_string($conn,$_POST['ImeiNumber']);
$result = mysqli_query($conn,"SELECT * FROM inventory WHERE issued = 0 AND imei = '$ImeiNumber' ");
$rowcount=mysqli_num_rows($result);

if($rowcount == 0){
  while($row = mysqli_fetch_array($result)){
    $itemID = $row['Item_Item_ID'];
    $imei = $row['imei'];
  }

  $sql = "INSERT INTO temp_po_sub (firstname, lastname, email)
  VALUES ('John', 'Doe', 'john@example.com')";
  mysqli_query($conn, $sql);

}else{
  $_SESSION['errormessage'] = 'ITEM NOT AVAILAVLE'
}

mysqli_close($conn);
?>
