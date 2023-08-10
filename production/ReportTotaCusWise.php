<?php 
session_start();	

?>
<html>
<head>
</head>
<body>
<div style="width:700px;text-align:left;margin-bottom:10px;font-size:20px;"><b><u>CUSTOMER WISE SALES</u> </b></div> 
<?php 
if(isset($_SESSION['start']) && isset($_SESSION['end'])){
			$start = $_SESSION['start'];
			$end = $_SESSION['end'];
}
?>
<div style="float:left; margin-right:10px;font-size:15px;"><i>DATED: <?php echo $start; ?></div><div style="float:left;font-size:20px;">TO: <?php echo $end; ?></i></div>

<div style="clear:both;">
<hr/>
<table class="table table-striped" style="font-size:12px;">
		<thead>
		  <tr>
			<th style='text-align:left;'>Customer Details: Name,Address</th>
			<th>Date</th>
			
			
			<th style='text-align:center;'>Invoice</th>
			
			<th style='text-align:right;'>Amount Rs.</th>
					
		  </tr>
		</thead>
		<tbody>
		 <?php 
		 
		 $company = $_SESSION['company'];
		 function invtotal($invoiceID){
			include 'connection.php';
			$t = 0;
              $result = mysqli_query($conn,"SELECT * FROM sub_invoice WHERE Invoice_Inv_ID = $invoiceID ");
            while($row = mysqli_fetch_array($result)){
              GLOBAL $qty,$wp,$Discount,$t;
              $qty = $row[1];
              $wp = $row[5];
              $Discount = $row[6];
              $sub = (100-$Discount);
                $sub = $sub * $qty *$wp;
                $sub = $sub/100;
                $t = $t + $sub;
            }
			return $t;
			mysqli_close($conn);
		 }
		 function multotal($mulID,$qty){
			include 'connection.php';
			$mult = 0;
			$result = mysqli_query($conn,"SELECT * FROM multiprice WHERE ID = $mulID ");
            while($row = mysqli_fetch_array($result)){
				GLOBAL $wholeS;
				$wholeS = $row[4];
			}
			$mult = $wholeS * $qty;
			return $mult;
			mysqli_close($conn);
		 }
			include 'connection.php';
			if(isset($_SESSION['start']) && isset($_SESSION['end'])){
			$start = $_SESSION['start'];
			$end = $_SESSION['end'];
			
			//echo $start."<br/>";
			//echo $end."<br/>";
			$invcount = 0;
			$result = mysqli_query($conn,"SELECT * FROM cus_profile WHERE CompanyID = $company");
			$invcount=mysqli_num_rows($result);
			//echo $invcount."<br/>";
			$steps = 1;
			$TotalInv = 0;
			$retotal = 0;
			while($steps <= $invcount){
				$result = mysqli_query($conn,"SELECT * FROM cus_profile WHERE CompanyID = $company LIMIT $steps");
				while($row = mysqli_fetch_array($result)){
				GLOBAL $cusid,$cusname;
					$cusid = $row[0];
					$cusname = $row[1];
					$address = $row[3];
				}
				
				$namecheck = "NULL";
				$count = 0;
				$result = mysqli_query($conn,"SELECT * FROM invoice WHERE CompanyID = $company AND deliver = 0 AND Customer_id = $cusid AND InvDate BETWEEN '$start' AND '$end'");
				$count=mysqli_num_rows($result);
				$steps1 = 1;
				while($steps1 <= $count){
					$result = mysqli_query($conn,"SELECT * FROM invoice WHERE CompanyID = $company AND deliver = 0 AND Customer_id = $cusid AND InvDate BETWEEN '$start' AND '$end' LIMIT $steps1");
				while($row = mysqli_fetch_array($result)){
					GLOBAL $invdate,$in,$idinv;
					$invdate = $row[1];
					$in = $row[11];
					$idinv = $row[0];					
					}
					$t = 0;
					$it = invtotal($idinv);
					
						
						
						echo "<tr>";
						if($namecheck != $cusname){
						$namecheck = $cusname;
						echo "<td>".$cusname.",".$address."</td>";}
						else {
							echo "<td></td>";
						}
						echo "<td>".$invdate."</td>";
						echo "<td style='text-align:center;'>".$in."</td>";
						echo "<td style='text-align:right;'>".number_format($it,2)."</td>";
						$TotalInv = $TotalInv + $it;
						
						echo "</tr>";
						
					
					
					
					
					$steps1 = $steps1 + 1;
				}
				
				$result = mysqli_query($conn,"SELECT * FROM return_invoice WHERE Customer_ID = $cusid AND status = 1 AND ReturnDate BETWEEN '$start' AND '$end' ");
				while($row = mysqli_fetch_array($result)){
				
					$tempre = 0;
					$mult= 0;
					if($namecheck != $cusname){
						$namecheck = $cusname;
						echo "<tr>";
						echo "<td>".$cusname.",".$address."</td>";
						echo "<td>".$row[6]."</td>";
						echo "<td style='text-align:center;'>(RET.)</td>";
						
						$tempre = multotal($row[9],$row[2]);
						echo "<td style='text-align:right;'>"."-".number_format($tempre,2)."</td>";
						$retotal = $retotal + $tempre;
						echo "</tr>";
					}
					else if($namecheck == $cusname){
						$namecheck = $cusname;
						echo "<tr>";
						echo "<td></td>";
						echo "<td>".$row[6]."</td>";
						echo "<td style='text-align:center;'>(RET.)</td>";
						
						$tempre = multotal($row[9],$row[2]);
						echo "<td style='text-align:right;'>"."-".number_format($tempre,2)."</td>";
						$retotal = $retotal + $tempre;
						echo "</tr>";
					}
				}
				$steps = $steps + 1;
			}
			
			}		
			mysqli_close($conn);
		 ?>
		
		</tbody>
	  </table>
</div>
<div style="border:1px solid; padding:3px;height:25px;width:700px;">
		<div style="text-align:left;width:250px;float:left;">INVOICE TOTAL: <?php echo number_format($TotalInv,2); ?></div>
		<div style="text-align:left;width:225px;float:left;">RETURN TOTAL: <?php echo "-".number_format($retotal,2); ?></div>
		<div style="text-align:left;width:225px;float:left;">TOTAL: <?php echo number_format($TotalInv - $retotal,2); ?></div>
	  </div>	
<script>
//window.print();
</script>
</body>
</html>
