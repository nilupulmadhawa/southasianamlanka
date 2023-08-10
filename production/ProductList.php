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
        <div class="row">
          <div class="col-sm-12 text-left">



            <!--start of the table--><div style="height:500px;overflow:auto;">
            <table class="table table-striped">
              <thead>
                <tr>

                  <th class="left">Name</th>

                  <!--
                  <th class="left">Ret Price</th>
                  <th class="center">Cost Price  </th>
                  <th class="center">W/p</th>
                -->
                <th class="center">Reorder Level</th>
                <!-- <th class="center">MRQ</th>
                <th class="center">Maximum Quantity</th> -->

              </tr>
            </thead>
            <tbody>
              <?php
              include 'functions/quantity.php';
              $costtotal = 0;
              $wholetotal = 0;
              include 'connection.php';
              $count = 0;
              $result = mysqli_query($conn,"SELECT * FROM category WHERE CompanyID = $company");
              $rowcount=mysqli_num_rows($result);
              $steps = 1;
              while($rowcount>=$steps){
                $result = mysqli_query($conn,"SELECT * FROM category WHERE CompanyID = $company ORDER BY Category ASC LIMIT $steps");
                while($row = mysqli_fetch_array($result)){
                  GLOBAL $catid,$catname;
                  $catid = $row[0];
                  $catname = $row[1];
                }
                echo "<tr style='background-color:purple;color:white;'><td style='text-align:left;'>---</td><td style='font-size:15px;color:white;'><b>".$catname."</b></td><td style='text-align:center;'>---</td><td style='text-align:center;'>---</td></tr>";
                $result = mysqli_query($conn,"SELECT * FROM item WHERE CompanyID = $company AND Category_Cat_ID = $catid ORDER BY Name ASC");
                while($row = mysqli_fetch_array($result)){
                  $productqty = 0;
                  echo "<tr>";

                  echo "<td style='text-align:left;'> ".$row[1]." ( ".$row[2]." ) </td>";
                  //              echo "<td style='text-align:center;'>".$row[3]."</td>";
                  //              echo "<td style='text-align:center;'>".$row[4]."</td>";
                  //              echo "<td style='text-align:center;'>".$row[5]."</td>";
                  echo "<td style='text-align:center;'>".$row[6]."</td>";
                  // echo "<td style='text-align:center;'>".$row[7]."</td>";
                  // echo "<td style='text-align:center;'>".productqty($row[0])."</td>";
                  $quantity = 0;
                  $quantity = productqty($row[0]);
                  $costtotal = $costtotal + ($row[4]*$quantity);
                  $wholetotal = $wholetotal + ($row[5]* $quantity);

                  echo "<td style='text-align:right;'> <a href='DeleteProduct.php?id=".$row[0]."'> DELETE </a></td>";
                  echo "</tr>";
                }
                $steps = $steps + 1;
              }
              mysqli_close($conn);
              ?>
            </tbody>
          </table>
          <!--end of the table--></div>
          <!-- <div class="col-sm-12">
            <div class="col-sm-3"></div>
            <div class="col-sm-3">COST TOTAL: <br/><b><?php echo  number_format($costtotal,2); ?></b></div>
            <div class="col-sm-3">WHOLESALE TOTAL: <br/><b><?php echo  number_format($wholetotal,2); ?></b></div>
            <div class="col-sm-3">PROFIT: <br/><b><?php echo  number_format($wholetotal - $costtotal,2); ?></b></div>

          </div> -->


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
