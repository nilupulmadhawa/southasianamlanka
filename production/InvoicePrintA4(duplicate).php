<?php 
			session_start();
			include 'connection.php';
			$profid = $_SESSION['pid'];
			$result = mysqli_query($conn,"SELECT * FROM user_profile WHERE ID = $profid ");
			while($row = mysqli_fetch_array($result)){
				$location  = $row[6];
				
				}

				$profid = $_SESSION['pid'];
				$result = mysqli_query($conn,"SELECT * FROM user_profile WHERE ID = $profid ");
			while($row = mysqli_fetch_array($result)){
				$username  = $row[1];
				
				}
				mysqli_close($conn);
			?>
<html>
<head>

</head>
<body>
	<div style="width:700px;font-size:28px;text-align:center;margin-left:15px;"><?php if($location == 1){echo "A.G.M. DIESEL SERVICE CENTER";} else if($location == 3){ echo "A.G.M. DIESEL ENGINEERING CO."; } else if($location == 2){ echo "A.G.M. DIESEL ENGINEERING CO."; } ?></div>
	<div style="width:700px;font-size:12px;text-align:center;margin-left:10px;">
		<?php 
			
				if($location == 1){
					
					echo "77/A,Panchikawattha Road,Colombo 10,Sri Lanka. Tel:+94 11 4062807,2322452,Fax:+94 11 2392039";
					}
					else if($location == 3){
					echo "No.607, Kandy Road,Kalaniya,Sri Lanka. Tel: +94 11 4989713,4895830,Fax: +94 11 2910791";
					}
					else if($location == 2){
					echo "No.78,Panchikawattha Road,Colombo 10,Sri Lanka. Tel:+94 11 4021244,4895838,Fax:+94 11 2392039 ";
					}
			?>
	</div>
	<?php $inv = $_SESSION['invoice']; $inv = sprintf("%04d", $inv);  ?>
<?php include 'connection.php'; $result = mysqli_query($conn,"SELECT * FROM invoice WHERE ID = $inv "); while($row = mysqli_fetch_array($result)){GLOBAL $dat,$discount,$credit;$dat = $row[1];$discount = $row[6];$credit = $row[7];} mysqli_close($conn); ?>

	<div style="width:700px;font-size:14px;text-align:center;margin-left:10px;"> <?php if($location == 1){echo "Branch:No 607,Kandy Road,Kelaniya,Sri Lanka.Tel:+94 11 4989713,4895830,Fax:+94 11 2910791";} else if($location == 3){ echo "Branch:77/A,Panchikawattha Road,Colombo 10,Sri Lanka. Tel:+94 11 4062807,2322452,Fax:+94 11 2392039"; } else if($location == 2){echo "Branch:No 607,Kandy Road,Kelaniya,Sri Lanka.Tel:+94 11 4989713,4895830,Fax:+94 11 2910791";} ?> </div>
	<div style="width:700px;font-size:14px;text-align:center;margin-left:10px;"><?php if($location == 1){echo "E-Mail:agmservice@sltnet.lk / agmkelaniya@sltnet.lk";} else if($location == 3){ echo "E-Mail:agmkelaniya@sltnet.lk/agmservice@sltnet.lk"; } else if($location == 2){ echo "E-Mail:agmdiesel@sltnet.lk"; } ?></div>
	<div style="width:700px;font-size:15px;margin-top:5px;border:1px solid;margin-left:10px;border-color:#c2c2a3;">
		<div style="width:170px;float:left;text-align:left;margin-left:5px;">
			Invoice Number </br>
			Invoice Date <br/>
			Job No <br/>
			P/S No <br/>
		</div>
		<div style="width:175px;float:left;text-align:left;">
			<?php $invoice =  $_SESSION['invoice']; $invoice = sprintf("%04d", $invoice); echo ": ".$invoice; ?></br>
			<?php echo ": ".$dat; ?><br/>
			 <br/>
			 <br/>
		</div>
		<div style="width:175px;float:left;text-align:left;">
			Customer Name </br>
			Invoice Type <br/>
			Order No <br/>
			V/No <br/>
		</div>
		<div style="width:175px;float:left;text-align:left;">
			<?php include 'connection.php'; $result = mysqli_query($conn,"SELECT * FROM invoice WHERE ID = $inv "); while($row = mysqli_fetch_array($result)){GLOBAL $dat,$discount,$credit;echo ": ".$row['customer_name'];$dat = $row[1];$discount = $row[6];$credit = $row[7];} mysqli_close($conn); ?> </br>
			<?php if($credit == 1){echo ": Credit";} else if($credit == 0){ echo ": Cash"; } ?> <br/>
			 <br/>
			 <br/>
		</div>
		
		<div style="width:700px;font-size:15px;clear:both;margin-top:5px;border-top:0.5px solid;border-bottom:0.5px solid;height:25px;border-color:#c2c2a3;">
			<div style="width:175px;float:left;text-align:center;">Qty</div>
			<div style="width:175px;float:left;text-align:left;">Description</div>
			<div style="width:175px;float:left;text-align:right;">Rate</div>
			<div style="width:170px;float:left;text-align:right;padding-right:5px;">Amount (Rs.) </div>
		</div>
		<?php if($credit == 0){
		echo "<div style='width:700px;font-size:15px;clear:both;height:802px;'>"; }
		else if($credit == 1){
		echo "<div style='width:700px;font-size:15px;clear:both;height:747px;'>"; }
		 ?>
		 <?php if($credit == 0){
			echo "<div style='width:700px;font-size:15px;clear:both;height:auto;height:750px;'>"; }
			if($credit == 1){
			echo "<div style='width:700px;font-size:15px;clear:both;height:auto;height:675px;'>"; }
			?>
			<?php
	  include 'connection.php';
	  $total = 0;
	  $result = mysqli_query($conn,"SELECT * FROM sub_invoice WHERE invoice_id = $inv LIMIT 6");
	  while($row = mysqli_fetch_array($result)){
		  GLOBAL $total;
		  echo "<div style='width:clear:both;width:700px;'>";
echo"<div style='width:175px;float:left;text-align:center;margin-top:3px;'>".$row[2]."</div>";
echo"<div style='width:175px;float:left;text-align:left;margin-top:3px;'>".$row[1]."</div>";
echo "<div style='width:175px;float:left;text-align:right;margin-top:3px;'>".number_format($row[3],2)."</div>";
$p = $row[2]* $row[3];
echo"<div style='width:170px;float:left;text-align:right;margin-top:3px;padding-right:5px'>".number_format($p,2)."</div>";
	echo '</div>';
	  $total = $total + $p;
		  }
		  
            
	  ?>
	</div>
	<div style="width:100px;float:left;text-align:right;font-size:25px;">Copy</div>
		<div style="width:425px;float:left;text-align:right;">
			Sub Total Rs.: </br>
			Discount: <br/>
			Total: <br/>
		</div>
		<div style="width:175px;float:left;text-align:right;">
			<?php echo number_format($total,2); ?> </br>
			<?php echo $discount."%"; 
			$disprice = (100-$discount);
      $disprice = $disprice * $total;
      $disprice = $disprice/100;?> <br/>
			<?php echo number_format($disprice,2); ?> <br/>
		</div>
		
		</div>
		
		</div>
		<div style="width:700px;float:left;text-align:left;font-size:15px;margin-left:10px;margin-top:15px;">
			<?php
			if($credit == 0){
			echo "<div style='float:left;width:400px;'>Pepared By: ".$username." </div><div style='float:left;width:300px;text-align:right;'>Received By: ................................</div> "; }
			
			else if($credit == 1){
			echo "<div style='float:left;width:400px;'>Checked By: ".$username." </div><div style='float:left;width:300px;text-align:right;'>Name: ..................................................</div> ";
			echo "<div style='float:left;width:400px;margin-top:10px;'>Approved By: ............................................... </div><div style='float:left;width:300px;text-align:right;margin-top:10px;'>Date: ..................................................</div> ";
			echo "<div style='float:left;width:400px;margin-top:10px;'>Leger F.Nos: <img src='images/box.png' alt='Smiley face' height='25' width='200'> </div><div style='float:left;width:300px;text-align:right;margin-top:10px;'>Register F.No: <img src='images/box.png' alt='Smiley face' height='25' width='200'></div> ";
		 }
		 ?>
		</div>
	</div>
	<script>
window.print();
</script>
<script>
//window.location.assign("index.php");
</script>
</body>
</html>