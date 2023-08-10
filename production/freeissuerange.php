<?php
session_start();
$id1 = $_SESSION['id'];
$prev = $_SESSION['prev'];
//$company = $_SESSION['company'];
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

  $(function () {

    $("#datepicker").datepicker({dateFormat: 'yy-mm-dd', changeMonth: true,
    changeYear: true});

  });

  </script>
  <script>

  $(function () {

    $("#datepicker1").datepicker({dateFormat: 'yy-mm-dd', changeMonth: true,
    changeYear: true});

  });

  </script>
  <script>

  $(function () {

    $("#datepicker2").datepicker({dateFormat: 'yy-mm-dd', changeMonth: true,
    changeYear: true});

  });

  </script>
  <script>

  $(function () {

    $("#datepicker3").datepicker({dateFormat: 'yy-mm-dd', changeMonth: true,
    changeYear: true});

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

      <div class="col-sm-12 text-left" style="margin-top:10px;background-color: #F8F8F8;">
        <div style="text-align:right;"><label>REPORTS // FREE ISSUE REPORT</label></div>
        <label>SET THE FOLLOWING DATE RANGE TO GET THE RESULTS</label>

        <ul class="nav nav-tabs">
          <li class="active"><a data-toggle="tab" href="#home">DATE RANGE</a></li>


        </ul>

        <div class="tab-content">
          <div id="home" class="tab-pane fade in active" style='padding:10px;'>

            <div class="row" style="margin-left:5px;" id='one'>

              <!--form start-->
              <form class="form-inline" role="form" method="post" action="freeissuerange.php">
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
          </div>


        </div>



        <div class="row">

          <div class="col-sm-12 text-left">


            <!--start of the table--><div style="height:500px;overflow:auto;">
            <table class="table table-bordered">
              <thead>
                <tr>
                  <th>Invoice ID</th>
                  <th>Invoice Date</th>
                  <th>Item Name</th>
                  <th>Free Issue Qty</th>
                  <th style='text-align:right;'>Cost Price</th>
                  <th style='text-align:right;'>Sub Total</th>
                </tr>
              </thead>
              <tbody>
                <?php
                if (isset($_POST['start']) && isset($_POST['end'])) {

                  $start = $_POST['start'];
                  $end = $_POST['end'];

                  include('class/mysql_crud.php');
                  $db = new Database();

                  function multi($multiID,$qty){
                    $db = new Database();
                    $db->connect();
                    $where = "ID=".$multiID;
                    $db->select('multiprice','*',NULL, $where); // Table name, Column Names, JOIN, WHERE conditions, ORDER BY conditions
                    $res = $db->getResult();
                    foreach($res as $dat){
                      echo "<td style='text-align:right;'>".$dat['CostPrice']."</td>";
                      echo "<td style='text-align:right;'>". number_format($dat['CostPrice']*$qty,2,".",",")."</td>";
                    }
                  }

                  function itemName($itemID){
                    $db = new Database();
                    $db->connect();
                    $where = "Item_ID=".$itemID;
                    $db->select('item','*',NULL, $where); // Table name, Column Names, JOIN, WHERE conditions, ORDER BY conditions
                    $res = $db->getResult();
                    foreach($res as $dat){
                      echo "<td>".$dat['Name']."</td>";
                    }
                  }

                  function freeissue($invID,$InvDate){
                    $db = new Database();
                    $db->connect();
                    $where = "Invoice_Inv_ID=".$invID." AND FreeIssue > 0 ";
                    $db->select('sub_invoice','*',NULL, $where); // Table name, Column Names, JOIN, WHERE conditions, ORDER BY conditions
                    $res = $db->getResult();
                    foreach($res as $dat){
                      echo "<tr>";
                      echo "<td>".$invID."</td>";
                      echo "<td>".$InvDate."</td>";
                      itemName($dat['Item_Item_ID']);
                      echo "<td>".$dat['FreeIssue']."</td>";
                      multi($dat['multiID'],$dat['FreeIssue']);
                      echo "</tr>";

                    }
                  }


                  $db->connect();
                  $where = "Allocated = 1 AND InvDate BETWEEN '".$start."' AND '".$end."'";
                  $db->select('invoice','*',NULL, $where ,'Inv_ID DESC'); // Table name, Column Names, JOIN, WHERE conditions, ORDER BY conditions
                  $res = $db->getResult();
                  // print_r($res);
                  foreach($res as $dat){
                     freeissue($dat['Inv_ID'],$dat['InvDate']);

                  }
                }
                ?>
              </tbody>
            </table>
            <!--end of the table--></div>

          </div>


        </div>

      </div>




    </div>
  </div>

  <footer class="container-fluid text-center">
    <?php include 'footer.php'; ?>
  </footer>

</body>
</html>
