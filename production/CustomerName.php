<?php
$q = $_REQUEST["q"];
// echo $q;
?>
<select class="form-control" name="cusname" autofocus>
  <?php
  include 'connection.php';
    $cusname = $_SESSION['cusname'];
    $result = mysqli_query($conn,"SELECT DISTINCT * FROM cus_profile WHERE Route = '$q' ");
    while($row = mysqli_fetch_array($result)){
      echo "<option>".$row['Name']."</option>";
    }
  mysqli_close($conn);
  ?>
</select>
