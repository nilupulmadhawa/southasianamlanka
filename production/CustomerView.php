<?php
include 'connection.php';
$q = $_REQUEST["q"];
?>
<div class="form-group">

  <label>Customer Name:</label>
  <select class="form-control" name="customer" onchange="showUser(this.value)" >
    <option selected disabled> SELECT THE CUSTOMER</option>
    <?php include'connection.php';
    if(!isset($_SESSION['cust_name'])){
      $result = mysqli_query($conn, "SELECT * FROM cus_profile WHERE Rep_Code = $q ORDER BY Customer_Code ASC");
      while($row = mysqli_fetch_array($result)){
        echo "<option value = '".$row[0]."'> ".$row['Customer_Code']." (".$row[1].") </option>";
      }
    }
    mysql_close($conn);
    ?>
  </select>
</div>
