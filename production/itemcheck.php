<?php 
include 'connection.php';
$result = mysqli_query($conn, "SELECT * FROM item");
while($row = mysqli_fetch_array($result)){
echo "<option value = '".$row[0]."'>".$row[2]."</option>";
}
}
mysqli_close($conn);
?>