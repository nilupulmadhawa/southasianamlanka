<?php
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

      <div class="col-sm-10 text-left" style="margin-top:10px;background-color: #F8F8F8;">
        <div class="col-sm-6">
          <div class="col-sm-12 text-left">
            <!--start of the form-->
            <form role="form" method="post" action="ConnectionNewCustomer.php">

              <div class="form-group">
                <label>Company Name:</label>
                <input type="text" class="form-control" name="companyname" autofocus="on" autocomplete="off">
              </div>

              <div class="form-group">
                <label>Customer Full Name:</label>
                <input type="text" class="form-control" name="name" autofocus="on" autocomplete="off">
              </div>
              <div class="form-group">
                <label>Category:</label>
                <select class="form-control" name="cat">
                  <?php include'connection.php'; $result = mysqli_query($conn, "SELECT * FROM supplier_cat WHERE CompanyID = $company");
                  while($row = mysqli_fetch_array($result)){
                    echo "<option value = '".$row[0]."'>".$row[1]."</option>";
                  }
                  mysql_close($conn);
                  ?>
                </select>
              </div>
              <div class="form-group">
                <label>Adderss:</label>
                <input type="text" class="form-control" name="address" autocomplete="off">
              </div>


              <div class="form-group">
                <label>Route:</label>
                <!-- <input type="text" class="form-control" name="route" autocomplete="off"> -->

                <select class="form-control" name="route">
                  <?php
                  include 'connection.php';
                  $result = mysqli_query($conn,"SELECT * FROM tbl_route");
                  while($row=mysqli_fetch_array($result)) {
                    echo "<option value='".$row['RouteName']."'>".$row['RouteName']."</option>";
                  }
                  mysqli_close($conn);
                  ?>
                </select>

              </div>

              <div class="form-group">
                <label>Mobile Number:</label>
                <input type="text" class="form-control" name="contact" autocomplete="off">
              </div>
              <div class="form-group">
                <label>Land Phone Number:</label>
                <input type="text" class="form-control" name="land" autocomplete="off">
              </div>

              <div class="form-group">
                <label>Credit Limit:</label>
                <input type="text" class="form-control" name="c_limit" autocomplete="off">
              </div>
              <div class="form-group">
                <label>Credit Period:</label>
                <input type="text" class="form-control" name="c_period" autocomplete="off">
              </div>
              <button type="submit" class="btn btn-default">Add</button>
            </form>
            <!--end of the form-->
          </div>
        </div>
        <div class="col-sm-6">
          <br/>
          <!--start of the tabele--><div style="height:550px;overflow:auto;">
          <table class="table table-striped" width="100%" style="font-size:12px;">
            <thead>
              <tr>


                <th class="tablecol1">Company Name</th>
                <th class="tablecol1">Full Name</th>
                <th class="tablecol3">Address</th>


                <th class="tablecol3">Mobile Number</th>
                <th class="tablecol3">Land Number</th>
                <th class="tablecol3">Credit Limit</th>
                <th class="tablecol3">Credit Period</th>
              </tr>
            </thead>
            <tbody>
              <?php include 'connection.php'; $result = mysqli_query($conn,"SELECT * FROM cus_profile WHERE CompanyID = $company ORDER BY Cus_ID DESC LIMIT 20");
              while($row=mysqli_fetch_array($result)) {

                echo "<tr><td>".$row['CompanyName']."</td><td>".$row[1]."</td><td>".$row[3]."</td><td>".$row[7]."</td><td>".$row[15]."</td><td>".$row[13]."</td><td>".$row[14]."</td></tr>";
              }
              ?>
            </tbody>
          </table>
          <!--end of the tabele--></div>
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
