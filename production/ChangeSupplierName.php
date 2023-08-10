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

      <div class="col-sm-10 text-left" style="margin-top:10px;background-color: #F8F8F8; padding-top:10px;">
        <div class="row">
          <div class="col-sm-5">
            <!--add stock to inventory form-->
            <form class="form-horizontal" role="form" method="post" action="ConnectionChangeSupplierName.php">
              <div class="form-group">
                <label class="control-label col-sm-2" for="email">Supplier:</label>
                <div class="col-sm-10">
                  <select class="form-control" name="product">
                    <?php include'connection.php'; $result = mysqli_query($conn, "SELECT * FROM supplier WHERE CompanyID = $company ORDER BY Name ASC");
                    while($row = mysqli_fetch_array($result)){
                      echo "<option value = '".$row[0]."'>".$row[1]."</option>";
                    }
                    mysql_close($conn);
                    ?>
                  </select>
                </div>
              </div>
              <div class="form-group">
                <label class="control-label col-sm-2" for="pwd" >New Name:</label>
                <div class="col-sm-10">
                  <input type="text" class="form-control" placeholder="New Name" name="name">
                </div>
              </div>

              <div class="form-group">
                <div class="col-sm-offset-2 col-sm-10">
                  <button type="submit" class="btn btn-default">Update</button>
                </div>
              </div>
            </form>
            <!--end of add stock to inventory form-->

          </div>
          <div class="col-sm-7" style="margin-top:5px;margin-bottum:5px;border:1px solid;border-radius:15px;height:450px;overflow:auto;">

            <!--table-->
            <!--start of the table-->
            <table class="table table-striped">
              <thead>
                <tr>
                  <th>Supplier Name</th>

                </tr>
              </thead>
              <tbody>
                <?php include'connection.php';


                $result = mysqli_query($conn,"SELECT Name FROM supplier WHERE CompanyID = $company ORDER BY Name ASC ");
                while($row = mysqli_fetch_array($result)){
                  GLOBAL $Name;

                  $Name = $row[0];
                  echo "<tr><td>".$Name."</td>";

                }



                mysqli_close($conn);?>

              </tbody>
            </table>
            <!--end of the table-->

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
