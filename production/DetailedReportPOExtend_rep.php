<?php
session_start();
$id1 = $_SESSION['id'];
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
            <!--start of the tabele--><div style="height:500px;overflow:auto;">
            <table class="table table-striped" width="100%" style="font-size:12px;">
              <thead>
                <tr>
                  <th class="tablecol1">Product Name</th>
                  <!-- <th class="tablecol3">Qty</th> -->
                  <th class="tablecol3">Imei</th>
                  <th class="tablecol3">Imei2</th>
                  <!-- <th class="tablecol3">Free Issue</th> -->
                  <th class="tablecol3">Cost Price</th>
                  <th class="tablecol3">Discount</th>
                  <th class="tablecol3">Sub Total</th>
                </tr>
              </thead>
              <tbody>
                <?php include 'connection.php';
                include 'functions/catname.php';
                if(isset($_GET['id'])){
                  $inv =  $_GET['id'];
                  $result = mysqli_query($conn,"SELECT * FROM po_rep WHERE ID = $inv ");
                  while($row = mysqli_fetch_array($result)){
                    GLOBAL $invoice;
                    $invoice =  $row[2];
                  }

                  $SubCount = 0;
                  $result = mysqli_query($conn,"SELECT * FROM sub_po_rep WHERE PoID = '$invoice' ");
                  while($row = mysqli_fetch_array($result)){
                    GLOBAL $SubCount;
                    $SubCount =  $SubCount + 1;
                  }
                  $steps = 1;
                  $pototal = 0;
                  while($steps<=$SubCount){
                    $subt = 0;

                    $result = mysqli_query($conn,"SELECT * FROM sub_po_rep WHERE PoID = '$invoice' LIMIT $steps");
                    while($row = mysqli_fetch_array($result)){
                      GLOBAL $itemid,$qty,$freeissue,$costprice,$discount;
                      $itemid = $row[7];
                      $qty = $row[1];
                      $freeissue = $row[2];
                      $costprice = $row[4];
                      $discount = $row[6];
                      $imei = $row['imei'];
                      $imei2 = $row['imei2'];
                    }

                    $result = mysqli_query($conn,"SELECT * FROM item WHERE Item_ID = $itemid ");
                    while($row = mysqli_fetch_array($result)){
                      GLOBAL $itemname;
                      $itemname = $row['Name'];
                    }
                    echo "<tr>";
                    echo "<td>".$itemname."</td>";
                    // echo "<td>".$qty."</td>";
                    echo "<td>".$imei."</td>";
                    echo "<td>".$imei2."</td>";
                    // echo "<td>".$freeissue."</td>";
                    echo "<td>".$costprice."</td>";
                    echo "<td>".$discount."</td>";
                    $subt = (100-$discount);
                    $subt = $subt *$qty *$costprice;
                    $subt = $subt/100;
                    echo "<td>Rs. ".number_format($subt,2)."</td>";
                    echo "</tr>";
                    $pototal = $pototal + $subt;

                    $steps = $steps + 1;
                  }
                  echo "<tr><td></td><td></td><td></td><td>TOTAL</td><td>Rs. ".number_format($pototal,2)."</td></tr>";



                }
                $_SESSION['invoice'] = $invoice;
                ?>
              </tbody>
            </table>
            <!--end of the tabele--></div>


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
