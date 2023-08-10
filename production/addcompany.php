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
  .row.content {height: 450px;}

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
      <?php
      include 'connection.php';
      if(isset($_POST['name'])){
        $routeName = $_POST['name'];
        $sql = "INSERT INTO tbl_route (RouteName) VALUES ('$routeName')";

        if (mysqli_query($conn, $sql)) {
          echo "New record created successfully";
        } else {
          echo "Error: " . $sql . "<br>" . mysqli_error($conn);
        }

        unset($_POST['name']);
      }

      if(isset($_GET['delID'])){

        $delID = $_GET['delID'];
        // sql to delete a record
        $sql = "DELETE FROM tbl_route WHERE ID=$delID";

        if (mysqli_query($conn, $sql)) {
          echo "Record deleted successfully";
        } else {
          echo "Error deleting record: " . mysqli_error($conn);
        }

        unset($_GET['delID']);
      }

      mysqli_close($conn);
      ?>
      <div class="col-sm-10 text-left" style="margin-top:10px;background-color: #F8F8F8;">
        <div class="col-sm-6">
          <div class="col-sm-12 text-left">
            <!--start of the form-->
            <form role="form" method="post" action="addcompanyConnection.php">

              <div class="form-group">
                <label>Referring Name:</label>
                <input type="text" class="form-control" name="refName" autofocus="on" autocomplete="off">
              </div>

              <div class="form-group">
                <label>Branch Name:</label>
                <input type="text" class="form-control" name="branchName" autocomplete="off">
              </div>

              <div class="form-group">
                <label>Address:</label>
                <input type="text" class="form-control" name="address" autocomplete="off">
              </div>

              <div class="form-group">
                <label>Contact Number:</label>
                <input type="text" class="form-control" name="contactNumber" autocomplete="off">
              </div>

              <div class="form-group">
                <label>Fax:</label>
                <input type="text" class="form-control" name="fax" autocomplete="off">
              </div>

              <div class="form-group">
                <label>Email:</label>
                <input type="text" class="form-control" name="email" autocomplete="off">
              </div>

              <button type="submit" class="btn btn-primary">Add</button>
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

                <th class="tablecol3">Ref Name</th>
                <th class="tablecol3">BranchName</th>
                <th class="tablecol3">Address</th>
                <th class="tablecol3">Contact Number</th>
                <th class="tablecol3">Fax</th>
                <th class="tablecol3">Email</th>

              </tr>
            </thead>
            <tbody>
              <?php
              include 'connection.php';
              $result = mysqli_query($conn,"SELECT * FROM company ");
              while($row=mysqli_fetch_array($result)) {
                echo "<tr>";
                echo "<td>".$row['RefName']."</td>";
                echo "<td>".$row['CompanyName']."</td>";
                echo "<td>".$row['Address']."</td>";
                echo "<td>".$row['Contact']."</td>";
                echo "<td>".$row['Fax']."</td>";
                echo "<td>".$row['Email']."</td>";
                echo "</tr>";
              }

              ?>
            </tbody>
          </table>
          <!--end of the tabele--></div>
        </div>
      </div>
      <div class="col-sm-2 sidenav">
        <?php include 'RightNavBar.php'; ?>
      </div>
    </div>
  </div>

  <footer class="container-fluid text-center">
    <?php include 'footer.php'; ?>
  </footer>

</body>
</html>
