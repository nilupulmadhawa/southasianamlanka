<div style="font-size:15px;">
<?php
include 'connection.php'; 
$invoice  = $_GET['q'];

if($invoice != 0){

    $result = mysqli_query($conn,"SELECT * FROM invoice WHERE  Inv_ID = $invoice");
              while($row=mysqli_fetch_array($result)) {
               GLOBAL $invdate,$userID,$cusID;
               $invdate = $row[1];
               $userID = $row[3];
               $cusID = $row[4];
              }
              $result = mysqli_query($conn,"SELECT * FROM customer WHERE  Cus_ID = $cusID");
              while($row=mysqli_fetch_array($result)) {
               GLOBAL $cusname;
               $cusname = $row['UserName'];
              }
              $result = mysqli_query($conn,"SELECT * FROM user_profile WHERE  User_User_ID = $userID");
              while($row=mysqli_fetch_array($result)) {
               GLOBAL $username;
               $username = $row['Name'];
              }

            $count = 0; 
            $result = mysqli_query($conn,"SELECT * FROM sub_invoice WHERE  Invoice_inv_ID = $invoice");
              while($row=mysqli_fetch_array($result)) {
               $count = $count + 1;
              }
              $steps = 1;
              $total = 0;
              while($steps <= $count){
                $result = mysqli_query($conn,"SELECT * FROM sub_invoice WHERE  Invoice_inv_ID = $invoice LIMIT $steps");
              while($row=mysqli_fetch_array($result)) {
              GLOBAL $item_id,$qty,$RetPrice,$CostPrice,$FreeIssue,$Discount,$total;
              $item_id = $row[8];
              $qty = $row[1];
              $RetPrice = $row[3];
              $wp = $row[5];
              $FreeIssue = $row[2];
              $Discount = $row[6];
              }

              $sub = (100-$Discount);
              $sub = $sub * $qty *$wp;
              $sub = $sub/100;
              
              $total = $total + $sub;
              $steps = $steps + 1;
              }
              
              $today = date("Y-m-d");
              $date1=date_create($invdate);
                $date2=date_create( $today);
                $diff=date_diff($date2,$date1);
                $dif =  $diff->format("%a");
               

                

              echo"<table ><thead><tr><th></th><th></th></tr></thead>
              <tbody>
              <tr>
              <td><b>Customer: </b></td><td>".$cusname."</td></tr>
              <td><b>Rep: </b></td><td>".$username."</td></tr>";
               if($dif < 42 ){            
              echo "<td><b>Invoice Date: </b></td><td><b style='color:green;'> ".$invdate."</b></td></tr>"; }
              else if(40 < $dif && $dif <= 60 ){            
              echo "<td><b>Invoice Date: </b></td><td><b style='color:#ff9900;'> ".$invdate."</b></td></tr>"; }
             else if($dif > 60 ){            
              echo "<td><b>Invoice Date: </b></td><td><b style='color:red;'> ".$invdate."</b></td></tr>"; }
              echo"<td><b>Ammount: </b></td><td>".number_format($total,2)."</td></tr>
              </tr>
              </tbody></table>";

          }
else{
    echo "Select invoice number";
}
?> 
</div>
