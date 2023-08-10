<div style="font-size:15px;">
 <h3>Purchase Order Details</h3>
        
        <!--start of the table--><div style="height:300px;overflow:auto;">
        <table class="table table-bordered">
          <thead>
            <tr>
              <th>Item Name</th>
              <th>Quantity</th>
              
            </tr>
          </thead>
          <tbody>
<?php
include 'connection.php'; 
$name  = $_GET['q'];
include 'functions/POquantity.php';

$result = mysqli_query($conn,"SELECT * FROM supplier WHERE Name='$name' ");
            while($row = mysqli_fetch_array($result)){
              GLOBAL $supid;
              $supid = $row[0];
            }


            $result = mysqli_query($conn,"SELECT * FROM item WHERE Supplier_ID='$supid' ");
            while($row = mysqli_fetch_array($result)){
              echo "<tr>";
              
              
                echo"<td>".$row[2]."</td>";
                echo "<td>".quantity($row[0],$row[6])."</td>";
            
              
              echo "</tr>";
            }
            mysqli_close($conn);
?> 
</tbody>
        </table>
        <!--end of the table--></div>
        <div style="margin-top:25px;"><button type="submit" class="btn btn-info" onClick="document.location.href='ProceedPO.php?name=<?php echo $name; ?>'">Porceed</button>
</div>
