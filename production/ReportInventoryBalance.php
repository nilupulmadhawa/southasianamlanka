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
	  <form class="form-inline" role="form" method="post" action="ReportInventoryBalance.php">
		<div class="form-group">
		  <label>From:</label>
		  <input type="text" class="form-control" id="datepicker" name="start" placeholder="Date" autocomplete="off" autofocus="on" required>
        </div>
		<div class="form-group">
		  <label>To:</label>
		  <input type="text" class="form-control" id="datepicker1" name="end" placeholder="Date" autocomplete="off" autofocus="on" required>
        </div>
		
		<button type="submit" class="btn btn-primary">SET</button>
	  </form>
	  <!--form end-->
	  <hr/>
		
	  </div>
	  <div class="row">
	  <div style="height:500px;overflow:auto;">
		<table class="table table-striped">
		<thead>
		  <tr>
			<th>Date</th>
			<th>Product Name</th>
			<th>Old Quantity</th>
			<th>New Quantity After Balaced</th>
			<th>User Name</th>
			
		  </tr>
		</thead>
		<tbody>
		 <?php 
			include 'connection.php';
			if(isset($_POST['start']) && isset($_POST['end'])){
			$start = $_POST['start'];
			$end = $_POST['end'];
			function pname($itemid){
				include 'connection.php';
				$result = mysqli_query($conn,"SELECT * FROM item WHERE Item_ID = $itemid ");
			while($row = mysqli_fetch_array($result)){
				GLOBAL $name;
				$name = $row[2];
				
			}
			return $name;
				mysqli_close($conn);
			}
			function empname($empid){
				include 'connection.php';
				$result = mysqli_query($conn,"SELECT * FROM user_profile WHERE Prof_ID = $empid ");
			while($row = mysqli_fetch_array($result)){
				GLOBAL $user;
				$user = $row[1];
			}
			return $user;
				mysqli_close($conn);
			}
			
			$result = mysqli_query($conn,"SELECT * FROM initial_inv WHERE ChangeDate BETWEEN '$start' AND '$end' ");
			while($row = mysqli_fetch_array($result)){
				echo "<tr>";
				echo "<td>".$row[3]."</td>";
				echo "<td>". pname($row[1])."</td>";
				echo "<td>".$row[2]."</td>";
				echo "<td>".$row[6]."</td>";
				echo "<td>". empname($row[4])."</td>";
				
				echo "</tr>";
			}
			
			}			
			mysqli_close($conn);
		 ?>
		</tbody>
	  </table></div>
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