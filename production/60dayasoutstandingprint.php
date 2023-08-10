<?php 
session_start(); 
$id1 = $_SESSION['id']; 
$company = $_SESSION['company'];
?>
<html>
<head>
</headl>
<body>
	<div style="width:750px;margin-left:25px;text-align:center;"><b>OUTSTANDING OVER 60DAYS (DETAILED REPORT)</b></div>
	<div style="width:750px;margin-left:25px;">
	<table class="table table-striped" width="100%" style="font-size:12px;">
        <thead>
        <tr>
        <th>Customer Name</th>
        <th>Address</th>
        <th>Contact</th>
        <th style='text-align:center;'>Date</th>
        <th style='text-align:center;'>Invoice Number</th>
        <th style='text-align:right;'>Amount</th> 
        <th style='text-align:right;'>Balance</th>        
        
        </tr>
      </thead>
         <tbody>
<?php
function sum($invoice){
            include 'connection.php';
      
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
                  return $total;
          }
          $today = "2014-01-01";

          include 'connection.php';
         
          
      

           // echo $route."</br>";

            

            //echo $invdate."</br>";
            $count = 0;
            $result1 = mysqli_query($conn,"SELECT * FROM cus_profile WHERE CompanyID = $company ");
            while($row=mysqli_fetch_array($result1)) {
              $count = $count + 1;
              }
              //echo $count;
              $steps = 1;
        $one = 0;
        $two = 0;
        $three = 0;
        $four = 0;
        $five = 0;
            while($steps <= $count){
              $result1 = mysqli_query($conn,"SELECT * FROM cus_profile WHERE CompanyID = $company LIMIT $steps");
              while($row=mysqli_fetch_array($result1)) {
              GLOBAL $name,$cusid,$contact,$address;
              $name = $row[1];
              $cusid = $row[0];
        $contact = $row[7];
        $address = $row[3];
              }

              $che = 0;
              //echo $name."</br>";
        //get the cheque amount
        

              $result2 = mysqli_query($conn,"SELECT * FROM invoice WHERE Customer_id = $cusid AND status = 0 ORDER BY InvDate ASC ");
              $rowcount=mysqli_num_rows($result2);

              $ncount = 0;
              if($rowcount != 0){
                $s = 1;
                while($s <= $rowcount){
                  $result1 = mysqli_query($conn,"SELECT * FROM invoice WHERE Customer_id = $cusid AND status = 0 ORDER BY InvDate ASC LIMIT $s ");
                while($row=mysqli_fetch_array($result1)) {
                  GLOBAL $inid,$bal,$dat;
                  $inid = $row[0];
                  $bal = $row[6];
                  $dat = $row[1];
                }
        $to = date("Y-m-d");
                $date1=date_create($dat);
                $date2=date_create( $to);
                $diff=date_diff($date2,$date1);
                $dif =  $diff->format("%a");

                $total = sum($inid);
                $ncount = $ncount + 1;

                echo "<tr>";
                if($dif >= 60 ){
                if($ncount == 1){ 
        echo "<td>".$name."</td>"; 
        echo "<td>".$address."</td>"; 
        echo "<td>".$contact."</td>"; 
        }
                else { 
        echo "<td> </td>"; 
        echo "<td> </td>"; 
        echo "<td> </td>"; 
        }
               
                echo "<td class='text-center'>".$dat."</td>";
        
                $in = sprintf("%04d", $inid);
        echo "<td style='text-align:center;'>".$in."</td>";
        echo "<td style='text-align:right;'>". number_format($total,2)."</td>";
        
        
        
                
               $che1 = " ";
                
              $balance = $total - $bal;
        
                
        
       
       
       
        
                echo "<td style='text-align:right;'>".number_format($balance,2)." ".$che1."</td>";
        $one = $one + $balance;
        }
                echo "</tr>";
                $balance = 0;
                $total = 0;

                $s = $s + 1;

                }

             
            }
              $steps = $steps + 1;
              $rowcount = 0;
            }
            

          
?>
<tr>
<td style='border-top:1px solid;border-bottom:1px solid;'></td>
<td style='text-align:right;border-top:1px solid;border-bottom:1px solid;'>TOTAL OUTSTANDING</td>
<td style='border-top:1px solid;border-bottom:1px solid;'></td>

<td style='border-top:1px solid;border-bottom:1px solid;'></td>
<td style='border-top:1px solid;border-bottom:1px solid;'></td>
<td style='border-top:1px solid;border-bottom:1px solid;'></td>

<td style='text-align:right;border-top:1px solid;border-bottom:1px solid;'><?php echo  number_format($one,2); ?></td>
<tr>
 </tbody>
        </table>
    </div>
<script>
window.print();
</script>
</body>
</html>