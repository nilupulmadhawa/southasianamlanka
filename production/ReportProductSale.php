	<?php
  include 'connection.php';
  if(isset($_POST['name'])){
    $name = $_POST['name'];
  } 
  session_start(); 
$id1 = $_SESSION['id']; 
$company = $_SESSION['company'];
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <?php include 'title.php'; ?>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="Resource/css/bootstrap.min.css">
  <script src="Resource/jquery/jquery-1.11.3.min.js"></script>
  <script src="Resource/js/bootstrap.min.js"></script>
  <!--jquery related-->
  <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
  <script src="//code.jquery.com/jquery-1.10.2.js"></script>
  <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
  <style>
    /* Remove the navbar's default margin-bottom and rounded borders */ 
    .navbar {
      margin-bottom: 0;
      border-radius: 0;
      border-bottom: 2px solid;
    }
    
    /* Set height of the grid so .sidenav can be 100% (adjust as needed) */
    .row.content {height: 450px}
    
    /* Set gray background color and 100% height */
    .sidenav {
      padding-top: 20px;
      height: 100%;
    }
    
    /* Set black background color, white text and some padding */
    footer {
      background-color: #555;
      color: white;
      padding: 15px;
      margin-top: 10px;
    }
    
    /* On small screens, set height to 'auto' for sidenav and grid */
    @media screen and (max-width: 767px) {
      .sidenav {
        height: auto;
        padding: 15px;
      }
      .row.content {height:auto;} 
    }

  </style>
<script>

  $(function() {

    $( "#datepicker" ).datepicker({dateFormat: 'yy-mm-dd'});

  });

  </script>
<script>

  $(function() {

    $( "#datepicker1" ).datepicker({dateFormat: 'yy-mm-dd'});

  });

  </script>

  
</head>
<body style="background-color:#e3e3e3;">

<nav class="navbar">
  <?php include 'HeaderMaintain.php'; ?>
</nav>
  <!--model content for the login sectoin-->
  <!-- Modal -->
  <div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog">
    
      <!-- Modal content-->
      <div class="modal-content">
        <div class="modal-header">
          <button type="button" class="close" data-dismiss="modal">&times;</button>
          <h4 class="modal-title">Modal Header</h4>
        </div>
        <div class="modal-body">
          <p>Some text in the modal.</p>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
        </div>
      </div>
      
    </div>
  </div>
  <!--end of model content for the login sectoin-->
<div class="container-fluid text-center">    
  <div class="row content">
    
    <div class="col-sm-10 text-left" style="margin-top:10px;background-color: #F8F8F8;padding-top:10px;"> 
      <div class="row" style="margin-left:5px;">
	  <label>SET THE FOLLOWING DATE RANGE TO GET THE RESULTS</label>
	  <!--form start-->
	  <form class="form-inline" role="form" method="post" action="ReportProductSale.php">
		<div class="form-group">
		  <label>Product:</label>
		  <select name='product' class="form-control" autofocus="on" required>
			<?php 
			include 'connection.php';
			$result = mysqli_query($conn,"SELECT * FROM item ORDER BY Name ASC");
			while($row = mysqli_fetch_array($result)){
				echo "<option value='".$row[0]."'>".$row[2]."</option>";
						
			}
			mysqli_close($conn);
			?>
		  </select>
		 </div>
		<div class="form-group">
		  <label>From:</label>
		  <input type="text" class="form-control" id="datepicker" name="start" placeholder="Date" autocomplete="off" required>
        </div>
		<div class="form-group">
		  <label>To:</label>
		  <input type="text" class="form-control" id="datepicker1" name="end" placeholder="Date" autocomplete="off" required>
        </div>
		
		<button type="submit" class="btn btn-primary">SET</button>
	  </form>
	  <!--form end-->
	  <hr/>
		
	  </div>
	  <div class="row" style="font-size:20px;margin-left:0px;"><a href="ReportProductWise.php" target="_blank">EXPORT</a></div>
	  <div class="row">
	  <div style="height:500px;overflow:auto;">
		<table class="table table-striped">
		<thead>
		  <tr>
			<th>Product Code</th>
			<th>Description</th>
			
			
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
			include 'connection.php';
			if(isset($_POST['start']) && isset($_POST['end'])){
			$start = $_POST['start'];
			$end = $_POST['end'];
			$itemid = $_POST['product'];
			$_SESSION['start'] = $start;
			$_SESSION['end'] = $end;
			$_SESSION['itemid'] = $itemid;
			
			$result = mysqli_query($conn,"SELECT * FROM item WHERE Item_ID = $itemid ");
			while($row = mysqli_fetch_array($result)){
			GLOBAL $itemid,$itemcode,$itemname;
				$itemid = $row[0];
				$itemcode = $row[1];
				$itemname = $row[2];
			}
			$retotal = 0;
			$wptotal = 0;
			$invcount = 0;
				$result = mysqli_query($conn,"SELECT * FROM invoice WHERE Allocated = 1 AND InvDate BETWEEN '$start' AND '$end'");
				$invcount=mysqli_num_rows($result);
				$invsteps = 1;
				$itemqt = 0;
				$itemwp = 0;
				
				while($invsteps <= $invcount){
					$result = mysqli_query($conn,"SELECT * FROM invoice WHERE Allocated = 1 AND InvDate BETWEEN '$start' AND '$end' LIMIT $invsteps");
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
				$check = 0;
				if($itemqt > 0){
				echo "<tr>";
				echo "<td>".$itemcode."</td>";
				echo "<td>".$itemname."</td>";
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
					
				echo "<td style='color:red'>".$itemcode."</td>";
				echo "<td style='color:red'>".$itemname."</td>";	
				}
				
				echo "<td style='text-align:center;color:red'>".$returntotal." (RET.)</td>";
				echo "<td style='text-align:right;color:red'>-1". number_format($tempre,2)."</td>";
				//$tempre = multotal($row[9],$row[2]);
						$retotal = $retotal + $tempre;
				echo "</tr>";
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
	  </table></div>
	  <div class='col-sm-12'>
	  <div class="col-sm-4">
	   <?php //echo "TOTAL WHOLESALE: <b>Rs.". number_format($twhole,2); ?></b>
	   </div>
	  <div class="col-sm-4">
	   <?php //echo "TOTAL COST: <b>Rs.". number_format($tcost,2); ?></b>
	   </div>
	  <div class="col-sm-4">
	   <?php //echo "PROFIT: <b>Rs.". number_format($twhole-$tcost,2); ?></b>
	   </div>
	   </div>
	  </div>
    </div>

    <div class="col-sm-2 sidenav">
      <?php include 'RightNavBar.php' ?>
    </div>
  </div>
</div>

<footer class="container-fluid text-center">
  <?php include 'footer.php'; ?>
</footer>

</body>
</html>