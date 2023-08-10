<table class="table">
  <thead>
    <tr>
      <th style='text-align:center;'>Qty</th>
      <th style='text-align:center;'>Free Issue</th>
      <th style='text-align:center;'>Discount</th>
      <th></th>
    </tr>
  </thead>
  <tbody>
    <?php
    $q = $_REQUEST["q"];
    // $r = $_REQUEST["r"];

    // echo $q."<br/>";
    // echo $r."<br/>";

    include 'connection.php';
    $result = mysqli_query($conn,"SELECT * FROM freeissue WHERE Item_ID = $q");
    while($row = mysqli_fetch_array($result)){
      echo "<tr>";
      echo "<td style='text-align:center;'>".$row[2]."</td>";
      echo "<td style='text-align:center;'>".$row[3]."</td>";
      echo "<td style='text-align:center;'>".$row[4]."</td>";
      echo "<td style='text-align:center;'><a href='Deletefreeissue.php?id=".$row[0]."'> DELETE </a></td>";
      echo "</tr>";
    }
    mysqli_close($conn);
    ?>
  </tbody>
</table>
