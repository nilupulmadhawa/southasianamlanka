<?php 
session_start(); 
$id1 = $_SESSION['id']; 
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>DHN Vetmedicare Admin Panel</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="Resource/css/bootstrap.min.css">
  <script src="Resource/jquery/jquery-1.11.3.min.js"></script>
  <script src="Resource/js/bootstrap.min.js"></script>
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
</head>
<body>

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
    <div class="col-sm-2 sidenav">
      <?php include 'SideBarMaintain.php'; ?>
    </div>
    <div class="col-sm-8 text-left" style="margin-top:10px;background-color: #F8F8F8;"> 
      <div class="row">
      <div class="col-sm-4">

        <form role="form" method="post" action="ConnectionDaystart.php">
        <div class="form-group">
          <label>Vehicle Number:</label>
          <select class="form-control" name="vehicle" required>
            <option value="WP BCZ-7028">WP BCZ-7028</option>
            <option value="WP BCZ7003">WP BCZ7003</option>
            <option value="WP AAJ2899">WP AAJ2899</option>
            <option value="WP PG7281">WP PG7281</option>            
          </select>
        </div>  
        <div class="form-group">
          <label>Meter:</label>
          <input type="text" class="form-control" name="meter" autofocus="on" autocomplete="off" required>
        </div> 
        <div class="form-group">
          <label>Representative:</label>
          <select class="form-control" name="rep" required>
            <?php include'connection.php'; $result = mysqli_query($conn, "SELECT * FROM user_profile WHERE Privilages_Priv_ID = 3");
            while($row = mysqli_fetch_array($result)){
              echo "<option value = '".$row[0]."'>".$row[1]."</option>";
              }
              mysql_close($conn);
             ?>
          </select>
        </div>
              
        <button type="submit" class="btn btn-default">Start</button>
      </form>
      
      </div>
    </div>
    </div>
    <div class="col-sm-2 sidenav">
      <?php include 'RightNavBar.php'; ?>
      </div>
    </div>
  </div>
</div>

<footer class="container-fluid text-center">
  <?php include 'footer.php'; ?>
</footer>

</body>
</html>
