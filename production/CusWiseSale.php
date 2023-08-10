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
	  <form class="form-inline" role="form" method="post" action="CusWiseSale.php">
		<div class="form-group">
		  <label>From:</label>
		  <input type="text" class="form-control" id="datepicker" name="start" placeholder="Date" autocomplete="off" autofocus="on">
        </div>
		<div class="form-group">
		  <label>To:</label>
		  <input type="text" class="form-control" id="datepicker1" name="end" placeholder="Date" autocomplete="off" autofocus="on">
        </div>
		
		<button type="submit" class="btn btn-primary">SET</button>
	  </form>
	  <!--form end-->
	  <hr/>
		
	  </div>
	  <div class="row" style="font-size:20px;margin-left:0px;"><a href="ReportTotaCusWise.php" target="_blank">EXPORT</a></div>
	  <div class="row">
	  <div style="height:500px;overflow:auto;">
		<table class="table table-striped">
		<thead>
		  <tr>
			<th>Customer Details: Name,Address</th>
			<th>Date</th>
			
			
			<th style='text-align:center;'>Invoice</th>
			
			<th style='text-align:right;'>Amount Rs.</th>
			<th style='text-align:right;'></th>
			
		  </tr>
		</thead>
		<tbody>
		 <?php 
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
			if(isset($_POST['start']) && isset($_POST['end'])){
			$start = $_POST['start'];
			$end = $_POST['end'];
			$_SESSION['start'] = $start;
			$_SESSION['end'] = $end;
			//echo $start."<br/>";
			//echo $end."<br/>";
			$invcount = 0;
			$result = mysqli_query($conn,"SELECT * FROM cus_profile");
			$invcount=mysqli_num_rows($result);
			//echo $invcount."<br/>";
			$steps = 1;
			$TotalInv = 0;
			$retotal = 0;
			while($steps <= $invcount){
//                echo $steps."<br/>";
				$result = mysqli_query($conn,"SELECT * FROM cus_profile LIMIT $steps");
				while($row = mysqli_fetch_array($result)){
//				GLOBAL $cusid,$cusname;
					$cusid = $row[0];
					$cusname = $row[1];
					$address = $row[3];
				}
				
				$namecheck = "NULL";
				$count = 0;
				$result = mysqli_query($conn,"SELECT * FROM invoice WHERE Allocated = 1 AND Customer_id = $cusid AND InvDate BETWEEN '$start' AND '$end'");
				$count=mysqli_num_rows($result);
                
//                echo "Cus ID:".$end."<br/>";
                
				$steps1 = 1;
				while($steps1 <= $count){
					$result = mysqli_query($conn,"SELECT * FROM invoice WHERE Allocated = 1 AND Customer_id = $cusid AND InvDate BETWEEN '$start' AND '$end' LIMIT $steps1");
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
						echo "<td style='text-align:right;'>".$in."</td>";
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
						echo "<td style='text-align:right;color:red;'>(RET)</td>";
						echo "<td style='text-align:right;color:red;'>".(-1)*multotal($row[9],$row[2])."</td>";
						$tempre = multotal($row[9],$row[2]);
						$retotal = $retotal + $tempre;
						echo "</tr>";
					}
					else if($namecheck == $cusname){
						$namecheck = $cusname;
						echo "<tr>";
						echo "<td></td>";
						echo "<td>".$row[6]."</td>";
						echo "<td style='text-align:right;color:red;'>(RET)</td>";
						echo "<td style='text-align:right;color:red;'>".(-1)*multotal($row[9],$row[2])."</td>";
						$tempre = multotal($row[9],$row[2]);
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
	  <div>
		<div class="col-sm-4" style="text-align:center;">TOTAL: <?php if(isset($TotalInv)){echo $TotalInv;} ?></div>
		<div class="col-sm-4" style="text-align:center;">RETURN TOTAL: <?php if(isset($retotal)){echo (-1)*$retotal;} ?></div>
		<div class="col-sm-4" style="text-align:center;">NET VALUE: <?php if(isset($TotalInv)){echo $TotalInv - $retotal;} ?></div>
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