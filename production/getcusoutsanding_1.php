<?php
include 'connection.php';
// get the q parameter from URL
$q = $_REQUEST["q"];
$result = mysqli_query($conn,"SELECT * FROM cus_profile WHERE Cus_ID = '$q' ");
while($row = mysqli_fetch_array($result)){
    GLOBAL $cusname,$address;
	$cusname = $row[1];
	$address = $row[3];
}
echo "Customer Name: <b>".$cusname."</b><br/><br/>";
echo "Customer Address: <b>".$address."</b>";
?>
<div style="height:300px;overflow:auto;margin-top:5px;">
        <table class="table table-striped" width="100%" style="font-size:12px;">
        <thead>
        <tr>
        <th class="tablecol1">Invoice Number</th>
        <th class="tablecol3">Date</th>
        <th class="tablecol3">Ammount</th>
        
        </tr>
      </thead>
         <tbody>
<?php








$count1 = 0;
$result = mysqli_query($conn,"SELECT * FROM invoice WHERE Customer_id = $q and status = 0 ");
while($row = mysqli_fetch_array($result)){
    $count1 = $count1 + 1;
}
$count1 = $count1+1;
$steps1 = 1;



while($steps1 < $count1){

	$result = mysqli_query($conn,"SELECT * FROM invoice WHERE Customer_id = $q and status = 0 LIMIT $steps1 ");
	while($row = mysqli_fetch_array($result)){
	    GLOBAL $invoice,$invdate,$balance;
	    $invoice = $row[0];
	    $invdate = $row[1];
        $balance = $row[6];
        
	}


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

	

	$steps1 = $steps1 + 1;
  
	echo"<tr>";
	echo "<td>".$invoice."<br/></td>";
	echo "<td>".$invdate."<br/></td>";
    $total = $total - $balance;
	echo "<td>".number_format($total,2)."<br/></td>";
	echo"</tr>";
}


mysqli_close($conn);
?> 	

</tbody>
        </table>
      <!--end of the tabele-->