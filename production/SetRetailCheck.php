<table class="table">
  <thead>
    <tr>

      <th style="text-align:left;">Group ID <a class='btn btn-danger btn-xs' href='OldPrice.php?clearall=".$row[0]."'>CLEAR ALL</a></th>
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
