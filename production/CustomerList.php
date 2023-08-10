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
  <!--jquery related-->
  <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
  <script src="//code.jquery.com/jquery-1.10.2.js"></script>
  <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>

  <script>

  $(function() {

    $( "#datepicker" ).datepicker({dateFormat: 'yy-mm-dd'});

  });

  </script>

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

      <div class="col-sm-10 text-left" style="margin-top:10px;background-color: #F8F8F8;">
        <div class="row">
          <div class="col-sm-12 text-left">



            <!--start of the table--><div style="height:550px;overflow:auto;">
            <table class="table table-striped">
              <thead>
                <tr>
                  <th>Customer Name</th>


                  <th>Rote</th>
                  <th>Address</th>
                  <th>Contact</th>
                  <th>Fax</th>
                  <th>Email</th>
                  <th></th>

                </tr>
              </thead>
              <tbody>
                <?php
                include 'connection.php';
                function data($catID,$company){
                  include 'connection.php';
                  $count = 0;
                  $result = mysqli_query($conn,"SELECT * FROM cus_profile WHERE Category = $catID AND CompanyID = $company ORDER BY Name ASC");
                  while($row = mysqli_fetch_array($result)){
                    echo "<tr>";
                    echo "<td>".$row[1]."</td>";

                    echo "<td>".$row['Route']."</td>";
                    echo "<td>".$row[3]."</td>";
                    echo "<td>".$row[7]."</td>";
                    echo "<td>".$row[8]."</td>";
                    echo "<td>".$row[9]."</td>";

                    echo "<td> <a href='DeleteCustomer.php?id=".$row[0]."'> DELETE </a></td>";
                    echo "</tr>";
                  }
                  mysqli_close($conn);
                }

                $result = mysqli_query($conn,"SELECT * FROM supplier_cat WHERE CompanyID = $company ORDER BY Cat ASC");
                while($row = mysqli_fetch_array($result)){
                  echo "<tr>";
                  echo "<td colspan='7' style='text-align:center;font-size:25px;background-color:teal;color:white;'>".$row[1]."</td>";
                  echo "</tr>";
                  data($row[0],$company);
                }




                mysqli_close($conn);
                ?>
              </tbody>
            </table>
            <!--end of the table--></div>

          </div>


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
