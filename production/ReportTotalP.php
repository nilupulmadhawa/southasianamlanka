<html>
<head>
</head>
<body>
<div style="width:700px;text-align:center;margin-bottom:10px;font-size:20px;"><b>TOTAL PRODUCT SALE </b></div> 
<div>
<table class="table table-striped" style="font-size:12px;">
		<thead>
		  <tr>
			<th width='100px'>Product Code</th>
			<th width='500px' style='text-align:center;'>Description</th>
			
			
			<th style='text-align:center;'>Qty</th>
			
			<th style='text-align:right;'>WholeSale</th>			
		  </tr>
		</thead>
		<tbody>
		 <?php 
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
		 session_start();
		 $company = $_SESSION['company'];
			include 'connection.php';
			if(isset($_SESSION['start']) && isset($_SESSION['end'])){
			$start = $_SESSION['start'];
			$end = $_SESSION['end'];
			
			echo "<b style='font-size:15px;'>Date Range <br/>From: ".$start." To: ".$end."</b>";
			$itemcount = 0;
			$result = mysqli_query($conn,"SELECT * FROM item WHERE CompanyID = $company ");
			$itemcount=mysqli_num_rows($result);
			$itemsteps = 1;
			$wptotal = 0;
			$retotal = 0;
			while($itemsteps <= $itemcount){
				$result = mysqli_query($conn,"SELECT * FROM item WHERE CompanyID = $company LIMIT $itemsteps ");
				while($row = mysqli_fetch_array($result)){
				GLOBAL $itemid,$itemcode,$itemname;
				$itemid = $row[0];
				$itemcode = $row[1];
				$itemname = $row[2];
				}
				
				$invcount = 0;
				$result = mysqli_query($conn,"SELECT * FROM invoice WHERE CompanyID = $company AND deliver = 0 AND InvDate BETWEEN '$start' AND '$end'");
				$invcount=mysqli_num_rows($result);
				$invsteps = 1;
				$itemqt = 0;
				$itemwp = 0;
				
				while($invsteps <= $invcount){
					$result = mysqli_query($conn,"SELECT * FROM invoice WHERE CompanyID = $company AND deliver = 0 AND InvDate BETWEEN '$start' AND '$end' LIMIT $invsteps");
					while($row = mysqli_fetch_array($result)){
					GLOBAL $invid,$invdate;
					$invid = $row[0];
					}
					
					
					$result = mysqli_query($conn,"SELECT * FROM sub_invoice WHERE Invoice_Inv_ID = $invid AND Item_Item_ID = $itemid ");
					while($row = mysqli_fetch_array($result)){
						GLOBAL $itemqt,$itemwp;
						if($row[6] != 100){
						$itemqt = $itemqt + $row[1];
						$itemdis = 0;
						$itemdis = $row[6];
						$itemdis = (100-$itemdis)/100;						
						$itemwp = $itemwp + ($row[1]*$row[5]*$itemdis);
						
						}
					}
					
				$invsteps =  $invsteps + 1;
				}
				if($itemqt > 0){
				echo "<tr>";
				echo "<td>".$itemcode."</td>";
				echo "<td width='500px' style='text-align:left;'>".$itemname."</td>";
				echo "<td style='text-align:center;'>".$itemqt."</td>";
				echo "<td style='text-align:right;'>". number_format($itemwp,2)."</td>";
				echo "</tr>";
				$check = $itemid;
				$wptotal = $wptotal + $itemwp;
				}
				$returntotal = 0;
				$result = mysqli_query($conn,"SELECT * FROM return_invoice WHERE Item_ID = $itemid AND status = 1 AND ReturnDate BETWEEN '$start' AND '$end' ");
				while($row = mysqli_fetch_array($result)){
					GLOBAL $returntotal;
					$returntotal = $returntotal + $row[2];
				}
				$tempre = 0;
				$result = mysqli_query($conn,"SELECT * FROM return_invoice WHERE Item_ID = $itemid AND status = 1 AND ReturnDate BETWEEN '$start' AND '$end' ");
				while($row = mysqli_fetch_array($result)){
					$tempre = $tempre + multotal($row[9],$row[2]);
						
				}
				if($returntotal > 0){
				
					$mult= 0;
				echo "<tr>";
				if($check == $row[1]){
					$check = 0;
				echo "<td></td>";
				echo "<td></td>";
				}
				else if($check != $row[1]){
					
				echo "<td style=''>".$itemcode."</td>";
				echo "<td style=''>".$itemname."</td>";	
				}
				
				echo "<td style='text-align:center;'>".$returntotal." (RET.)</td>";
				echo "<td style='text-align:right;'>-".number_format($tempre,2)."</td>";
				//$tempre = multotal($row[9],$row[2]);
						$retotal = $retotal + $tempre;
				echo "</tr>";
				}
				$itemsteps = $itemsteps + 1;
			}			
			
			echo "<tr>";
				echo "<td></td>";
				echo "<td></td>";
				echo "<td style='text-align:left;'><b>SUB TOTAL</b></td>";
				echo "<td style='text-align:right;'><b>". number_format($wptotal,2)."</b></td>";
			echo "</tr>";
				
			echo "<tr>";
				echo "<td></td>";
				echo "<td></td>";
				echo "<td style='text-align:left;'><b>RETURN TOTAL</b></td>";
				echo "<td style='text-align:right;'><b>". number_format(-1 * $retotal,2)."</b></td>";
			echo "</tr>";
			
			echo "<tr>";
				echo "<td></td>";
				echo "<td></td>";
				echo "<td style='text-align:left;'><b>TOTAL</b></td>";
				echo "<td style='text-align:right;'><b>". number_format($wptotal - $retotal,2)."</b></td>";
			echo "</tr>";
			
			}			
			mysqli_close($conn);
		 ?>
		</tbody>
	  </table>
</div>
<script>
window.print();
</script>
</body>
</html>
