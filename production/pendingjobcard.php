<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>A.G.M. Deisel Engineering Co.(Pvt)LTD.</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="Resource/css/bootstrap.min.css">
  <script src="https://ajax.googleapis.com/ajax/libs/jquery/1.11.3/jquery.min.js"></script>
  <script src="Resource/js/bootstrap.min.js"></script>
  <style>
    /* Remove the navbar's default margin-bottom and rounded borders */ 
    .navbar {
      margin-bottom: 0;
      border-radius: 0;
    }
    
    /* Set height of the grid so .sidenav can be 100% (adjust as needed) */
    .row.content {height: 450px}
    
    /* Set gray background color and 100% height */
    .sidenav {
      padding-top: 20px;
      background-color: #f1f1f1;
      height: 100%;
    }
    
    /* Set black background color, white text and some padding */
    footer {
      background-color: #555;
      color: white;
      padding: 15px;
    }
    
    /* On small screens, set height to 'auto' for sidenav and grid */
    @media screen and (max-width: 767px) {
      .sidenav {
        height: auto;
        padding: 15px;
      }
      .row.content { height:auto; } 
    }
  </style>
</head>
<body>

<nav class="navbar navbar-inverse">
  <div class="container-fluid">
    <div class="navbar-header">
      <button type="button" class="navbar-toggle" data-toggle="collapse" data-target="#myNavbar">
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>
        <span class="icon-bar"></span>                        
      </button>
      <a class="navbar-brand" href="index.php">A.G.M. Deisel Engineering Co.(Pvt)LTD.</a>
    </div>
    <div class="collapse navbar-collapse" id="myNavbar">
      <?php include 'Header.php'; ?>
    </div>
  </div>
</nav>
  
<div class="container-fluid" style="font-size:12px;">    
  <div class="row content">
    <div class="col-sm-9 text-left"> 
       <table class="table table-striped">
	    <thead>
	      <tr>
	        <th>Jobcard ID</th>
	        <th>Customer Name</th>
	        <th>User</th>
	        <th>Date Of Issue</th>
          <th>Action</th>
	      </tr>
	    </thead>
	    <tbody>
	      <?php 
	      function name($id){
	      	include 'connection.php';
	      	$result = mysqli_query($conn,"SELECT * FROM user_profile");
			while($row = mysqli_fetch_array($result)){
				GLOBAL $name;
				$name = $row['name'];
			}
			return $name;
			mysqli_close($conn);
	      }
	      include 'connection.php'; 
	      	$result = mysqli_query($conn,"SELECT * FROM jobcard_primary WHERE status = 0 ");
			while($row = mysqli_fetch_array($result)){
				echo "<tr>";
				$id = sprintf("%04d", $row[0]);
				echo "<td><a href='pendingjobcard_extend.php?id=".$row[0]."'>".$id."</a></td>";
				
				echo "<td>".$row[1]."</td>";
				
				$name = name($row[2]);
				echo "<td>".$name."</td>";
				
				echo "<td>".$row[3]."</td>";
        echo "<td><a href='deletejob.php?id=".$row[0]."'>Delete</a></td>";
				echo "</tr>";
			}
	       ?>
	    </tbody>
	  </table>
        
    </div>
    <div class="col-sm-3 sidenav">
      <?php include 'NavBar.php'; ?>
    </div>
  </div>
</div>

<footer class="container-fluid text-center">
   <?php include 'footer.php'; ?>
</footer>

</body>
</html>