<?php
session_start();
include 'connection.php';
if(!empty($_REQUEST['q']) && !empty($_REQUEST['r'])){

  $retGroup = $_REQUEST['q'];
  $retPrice = $_REQUEST['r'];
  $FreeQty = $_REQUEST['s'];
  $FreeIssue = $_REQUEST['t'];
  $Discount = $_REQUEST['u'];


  $sql = "INSERT INTO tbl_ret (GroupID, RetPrice, Qty, FreeIssue, Discount)
  VALUES ('$retGroup',$retPrice, $FreeQty, $FreeIssue, $Discount)";

  if (mysqli_query($conn, $sql)) {
    echo "<p style='text-align:center;color:green;'>New record created successfully</p>";
  } else {
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
  }

}else{
  echo "<p style='text-align:center;color:red;'>OOPS EMPTY FIELDS DETECTED!!</p>";
}


mysqli_close($conn);
?>
<table class="table">
  <thead>
    <tr>

      <th style="text-align:left;">Group ID</th>
      <th style="text-align:right;">Retail Price</th>
      <th style="text-align:right;">Qty</th>
      <th style="text-align:right;">Free Issue</th>
      <th style="text-align:right;" style="text-align:center;">Discount</th>
      <th style="text-align:right;"></th>
    </tr>
  </thead>
  <tbody>
    <?php
    include 'connection.php';
    $result = mysqli_query($conn, "SELECT * FROM tbl_ret ORDER BY ID ASC");
    while($row = mysqli_fetch_array($result)){
      echo "<tr>";
      echo "<td>".$row['GroupID']."</td>";
      echo "<td style='text-align:right;'>".number_format($row['RetPrice'],2)."</td>";
      echo "<td>".$row['Qty']."</td>";
      echo "<td>".$row['FreeIssue']."</td>";
      echo "<td style='text-align:center;'>".$row['Discount']."%</td>";
      if(isset($_GET['Edit'])){
        echo "<td style='text-align:right;'><a class='btn btn-warning btn-xs' href='OldPrice.php?delRetEdit=".$row[0]."'> <span class='glyphicon glyphicon-trash'></span> DELETE</a></td>";
      }else{
        echo "<td style='text-align:right;'><a class='btn btn-warning btn-xs' href='OldPrice.php?delRet=".$row[0]."'> <span class='glyphicon glyphicon-trash'></span> DELETE</a></td>";

      }

      echo "</tr>";
    }
    mysqli_close($conn);
    ?>
  </tbody>
</table>
