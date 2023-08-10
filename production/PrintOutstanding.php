<?php 
session_start(); 
$id1 = $_SESSION['id']; 
$company = $_SESSION['company'];
?>
<html>
<head>
</head>
<body>
<div style="width:700px;text-align:center;margin-bottom:10px;font-size:30px;"><b>TOTAL OUTSTANDING</b></div> 
<?php 
include 'connection.php';
		$result = mysqli_query($conn,"SELECT * FROM company WHERE ID = $company ");
        while($row=mysqli_fetch_array($result)) {
		GLOBAL $ComName,$address;
		$ComName = $row[1];
		$address = $row[2];
		}	
mysqli_close($conn);
		?>
<div class="col-sm-6">
		<div class="col-sm-12">
		<?php echo $ComName; ?>
		</div>
		<div class="col-sm-12">
		<?php echo $address; ?>
		</div>
		<div class="col-sm-12">
		Age Balance Listing All Customers As At : <?php echo date("Y-M-d"); ?>
		</div>
		</div>
<div>
<div class="col-sm-12" id="txtHint" style="margin-top:10px;">

          <!--start of the tabele-->
        <table width="97%" style="font-size:15px;">
        <thead>
        <tr style="border-top:2px solid;border-bottom:2px solid;">
        <th style='text-align:left;' >Inv No</th>
        <th style='text-align:center;'>Inv Date</th>
        <th style='text-align:right;'>0-30</th>
        <th style='text-align:right;'>30-45</th>
        <th style='text-align:right;'>45-55</th>
        <th style='text-align:right;'>55-60</th>
        <th style='text-align:right;'>>60</th>
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
			  $totalone = 0;
			  $totaltwo = 0;
			  $totalthree = 0;
			  $totalfour = 0;
			  $totalfive = 0;
				$totalsix = 0;
			 
            while($steps <= $count){
              $result1 = mysqli_query($conn,"SELECT * FROM cus_profile WHERE CompanyID = $company LIMIT $steps");
              while($row=mysqli_fetch_array($result1)) {
              GLOBAL $name,$cusid,$contact,$addres;
              $name = $row[1];
              $cusid = $row[0];
			  $contact = $row[7];
			  $addres = $row[3];
              }

              $che = 0;
              //echo $name."</br>";
			  //get the cheque amount
			  
				$rowcount = 0;
              $result2 = mysqli_query($conn,"SELECT * FROM invoice WHERE Customer_id = $cusid AND status = 0 AND deliver = 0 ORDER BY InvDate ASC ");
              $rowcount=mysqli_num_rows($result2);
			  if($rowcount> 0){
			  echo "<tr style='height:50px;'>";
			  echo "<td colspan='8'>".$name." - (".sprintf("%04d", $cusid).")"." - ".$addres." - ".$contact."</td>";
			  echo "</tr>";}
			  $one = 0;
			  $two = 0;
			  $three = 0;
			  $four = 0;
			  $five = 0;
				$six = 0;
              $ncount = 0;
              if($rowcount != 0){
                $s = 1;
                while($s <= $rowcount){
                  $result1 = mysqli_query($conn,"SELECT * FROM invoice WHERE Customer_id = $cusid AND status = 0 AND deliver = 0 ORDER BY InvDate ASC LIMIT $s ");
                while($row=mysqli_fetch_array($result1)) {
                  GLOBAL $inid,$bal,$dat,$inv;
                  $inid = $row[0];
                  $bal = $row[6];
                  $dat = $row[1];
				  $inv = $row[11];
                }
				$to = date("Y-m-d");
                $date1=date_create($dat);
                $date2=date_create( $to);
                $diff=date_diff($date2,$date1);
                $dif =  $diff->format("%a");
				$total = 0;
                $total = sum($inid);
                $ncount = $ncount + 1;

                echo "<tr>";
                $in = sprintf("%04d", $inv);
				echo "<td style='text-align:left;'>".$in."</td>";
				echo "<td style='text-align:center;'>".$dat."</td>";
				if($dif < 30){
                echo "<td style='text-align:right;'>".number_format($total,2)."</td>";
				echo "<td style='text-align:right;'> ".number_format(0,2)."</td>";
				echo "<td style='text-align:right;'> ".number_format(0,2)."</td>";
				echo "<td style='text-align:right;'> ".number_format(0,2)."</td>";
				echo "<td style='text-align:right;'> ".number_format(0,2)."</td>";
				$one = $one + $total;
				}
				if($dif < 45 && $dif >= 30){
				echo "<td style='text-align:right;'>".number_format(0,2)."</td>";
                echo "<td style='text-align:right;'>".number_format($total,2)."</td>";
				
				echo "<td style='text-align:right;'> ".number_format(0,2)."</td>";
				echo "<td style='text-align:right;'> ".number_format(0,2)."</td>";
				echo "<td style='text-align:right;'> ".number_format(0,2)."</td>";
				$two = $two + $total;
				
				}
				if($dif < 55 && $dif >= 45){
				echo "<td style='text-align:right;'>".number_format(0,2)."</td>";
				echo "<td style='text-align:right;'>".number_format(0,2)."</td>";
                echo "<td style='text-align:right;'>".number_format($total,2)."</td>";
				
				echo "<td style='text-align:right;'>".number_format(0,2)."</td>";
				echo "<td style='text-align:right;'>".number_format(0,2)."</td>";
				$three = $three + $total;
				
				}
				if($dif < 60 && $dif >= 55){
				echo "<td style='text-align:right;'>".number_format(0,2)."</td>";
				echo "<td style='text-align:right;'>".number_format(0,2)."</td>";
				echo "<td style='text-align:right;'>".number_format(0,2)."</td>";
                echo "<td style='text-align:right;'>".number_format($total,2)."</td>";
				
				echo "<td style='text-align:right;'>".number_format(0,2)."</td>";
				$four = $four + $total;
				
				}
				if($dif >= 60){
				echo "<td style='text-align:right;'>".number_format(0,2)."</td>";
				echo "<td style='text-align:right;'>".number_format(0,2)."</td>";
				echo "<td style='text-align:right;'>".number_format(0,2)."</td>";
				echo "<td style='text-align:right;'> ".number_format(0,2)."</td>";
                echo "<td style='text-align:right;'>".number_format($total,2)."</td>";
				$five = $five + $total;
				}
				$balance = 0;
				$balance = $total - $bal;
				$six = $six + $balance;
				echo "<td style='text-align:right;'>".number_format($balance,2)."</td>";
                echo "</tr>";

                $s = $s + 1;

                }
				
				echo "<tr style='border:1px solid;'>";
				echo "<td ></td>";
				echo "<td ></td>";
				echo "<td style='border-top:1px solid;border-bottom:1px solid;text-align:right;'>".number_format($one,2)."</td>";
				$totalone = $totalone + $one;
				echo "<td style='border-top:1px solid;border-bottom:1px solid;text-align:right;'>".number_format($two,2)."</td>";
				$totaltwo = $totaltwo + $two;
				echo "<td style='border-top:1px solid;border-bottom:1px solid;text-align:right;'>".number_format($three,2)."</td>";
				$totalthree = $totalthree + $three;
				echo "<td style='border-top:1px solid;border-bottom:1px solid;text-align:right;'>".number_format($four,2)."</td>";
				$totalfour = $totalfour + $four;
				echo "<td style='border-top:1px solid;border-bottom:1px solid;text-align:right;'>".number_format($five,2)."</td>";
				$totalfive = $totalfive + $five;
				echo "<td style='border-top:1px solid;border-bottom:1px solid;text-align:right;'>".number_format($six,2)."</td>";
				$totalsix = $totalsix + $six;
				echo "</tr>";

             
            }
              $steps = $steps + 1;
              $rowcount = 0;
            }
			echo "<tr style='border:1px solid;'>";
				echo "<td style='text-align:right;'>-------</td>";
				echo "<td style='text-align:right;'>-------</td>";
				echo "<td style='text-align:right;'>-------</td>";
				
				echo "<td style='text-align:right;'>-------</td>";
				
				echo "<td style='text-align:right;'>-------</td>";
				
				echo "<td style='text-align:right;'>-------</td>";
				
				echo "<td style='text-align:right;'>-------</td>";
				
				echo "<td style='text-align:right;'>-------</td>";
				
				echo "</tr>";
			echo "<tr style='border:1px solid;'>";
				echo "<td ></td>";
				echo "<td ><b>TOTAL</b></td>";
				echo "<td style='border-top:1px solid;border-bottom:1px solid;text-align:right;'>".number_format($totalone,2)."</td>";
				
				echo "<td style='border-top:1px solid;border-bottom:1px solid;text-align:right;'>".number_format($totaltwo,2)."</td>";
				
				echo "<td style='border-top:1px solid;border-bottom:1px solid;text-align:right;'>".number_format($totalthree,2)."</td>";
				
				echo "<td style='border-top:1px solid;border-bottom:1px solid;text-align:right;'>".number_format($totalfour,2)."</td>";
				
				echo "<td style='border-top:1px solid;border-bottom:1px solid;text-align:right;'>".number_format($totalfive,2)."</td>";
				
				echo "<td style='border-top:1px solid;border-bottom:1px solid;text-align:right;'>".number_format($totalsix,2)."</td>";
				
				echo "</tr>";
            
?>
 </tbody>
        </table>
      <!--end of the tabele-->
	 
         </div>
</div>
<script>
window.print();
</script>
</body>
</html>
