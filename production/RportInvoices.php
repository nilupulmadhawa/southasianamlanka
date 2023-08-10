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

      <div class="col-sm-10 text-left" style="margin-top:10px;background-color: #F8F8F8;">
        <div style="text-align:right;"><label>REPORTS // INVOICE DETAILED REPORT</label></div>
        <label>SET THE FOLLOWING DATE RANGE TO GET THE RESULTS</label>

        <ul class="nav nav-tabs">
          <li class="active"><a data-toggle="tab" href="#home">REPRESENTATIVE WISE</a></li>
          <li><a data-toggle="tab" href="#menu1">CUSTOMER WISE</a></li>

        </ul>

        <div class="tab-content">
          <div id="home" class="tab-pane fade in active" style='padding:10px;'>

            <div class="row" style="margin-left:5px;" id='one'>

              <!--form start-->
              <form class="form-inline" role="form" method="post" action="RportInvoices.php">
                <div class="form-group">
                  <label>Officer:</label>
                  <select name="rep" class="form-control">
                    <?php
                    include 'connection.php';
                    $result = mysqli_query($conn, "SELECT * FROM user_profile WHERE Privilages_Priv_ID = 3 ");
                    while ($row = mysqli_fetch_array($result)) {
                      echo "<option value='" . $row[0] . "'>" . $row[1] . "</option>";
                    }
                    mysqli_close($conn);
                    ?>
                  </select>
                </div>
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
          <div id="menu1" class="tab-pane fade" style='padding:10px;'>
            <!--filter start-->
            <div class="row" style="margin-left:5px;">

              <!--form start-->
              <form class="form-inline" role="form" method="post" action="RportInvoices.php">
                <div class="form-group">
                  <label>Customer:</label>
                  <select name="cus" class="form-control">
                    <?php
                    include 'connection.php';
                    $result = mysqli_query($conn, "SELECT * FROM cus_profile ORDER BY Name ASC");
                    while ($row = mysqli_fetch_array($result)) {
                      echo "<option value='" . $row[0] . "'>" . $row[1] . "</option>";
                    }
                    mysqli_close($conn);
                    ?>
                  </select>
                </div>
                <div class="form-group">
                  <label>From:</label>
                  <input type="text" class="form-control" id="datepicker2" name="start" placeholder="Date" autocomplete="off" autofocus="on">
                </div>
                <div class="form-group">
                  <label>To:</label>
                  <input type="text" class="form-control" id="datepicker3" name="end" placeholder="Date" autocomplete="off" autofocus="on">
                </div>

                <button type="submit" class="btn btn-primary">SET</button>
              </form>
              <!--form end-->
              <hr/>

            </div>
            <!--filter end-->
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
                  <th>Customer</th>
                  <th>Officer</th>
                  <th style="text-align:right;">Wholesale Ammount</th>
                  <th style="text-align:right;">Cost Ammount</th>
                  <th style="text-align:right;">Retail Ammount</th>
                  <th style="text-align:right;">Invoice Profit</th>
                </tr>
              </thead>
              <tbody>
                <?php
                include 'connection.php';
                if (isset($_POST['start']) && isset($_POST['end']) && isset($_POST['rep'])) {
                  $start = $_POST['start'];
                  $end = $_POST['end'];
                  $rep = $_POST['rep'];
                  $count = 0;
                  $result = mysqli_query($conn, "SELECT * FROM invoice WHERE deliver = 0 AND Allocated = 1 AND User_User_ID = $rep AND InvDate BETWEEN '$start' AND '$end'");
                  while ($row = mysqli_fetch_array($result)) {
                    GLOBAL $count;
                    $count = $count + 1;
                  }

                  $steps = 1;
                  $wholetot = 0;
                  $costtot = 0;
                  $rettot = 0;
                  while ($steps <= $count) {

                    $result = mysqli_query($conn, "SELECT * FROM invoice WHERE deliver = 0 AND Allocated = 1 AND User_User_ID = $rep AND InvDate BETWEEN '$start' AND '$end' ORDER BY Inv_ID DESC LIMIT $steps");
                    while ($row = mysqli_fetch_array($result)) {
                      //              GLOBAL $invoiceID,$dat,$userID,$CustomerID,$Allocated,$Deliverd;
                      $invoiceID = $row['Inv_ID'];
                      $dat = $row['InvDate'];
                      $userID = $row['User_User_ID'];
                      $CustomerID = $row['Customer_id'];
                      $Allocated = $row['Allocated'];
                      $Deliverd = $row['deliver'];
                      $inv = $row[0];
                      $InvNumber = $row['BillID'];
                    }

                    $result = mysqli_query($conn, "SELECT * FROM user_profile WHERE User_User_ID = $userID ");
                    while ($row = mysqli_fetch_array($result)) {
                      //                                                    GLOBAL $repname;
                      $repname = $row['Name'];
                    }

                    $result = mysqli_query($conn, "SELECT * FROM deliver WHERE Invoice_ID = $invoiceID ");
                    while ($row = mysqli_fetch_array($result)) {
                      //              GLOBAL $deliverID;
                      $deliverID = $row['Employee_ID'];
                    }
                    $result = mysqli_query($conn, "SELECT * FROM user WHERE User_ID = $deliverID ");
                    while ($row = mysqli_fetch_array($result)) {
                      //              GLOBAL $deliverName;
                      $deliverName = $row['UserName'];
                    }

                    $cusname = " ";
                    $result = mysqli_query($conn, "SELECT * FROM cus_profile WHERE Customer_Cus_ID = $CustomerID ");
                    while ($row = mysqli_fetch_array($result)) {
                      //              GLOBAL $cusname;
                      $cusname = $row['Name'];
                    }
                    echo "<tr><td>" . $InvNumber . "</td>";
                    echo "<td>" . $dat . "</td>";

                    echo "<td>" . $cusname . "</td>";
                    echo "<td>" . $repname . "</td>";

                    $steps = $steps + 1;
                    $t = 0;
                    $sub = 0;

                    $result = mysqli_query($conn, "SELECT * FROM sub_invoice WHERE Invoice_Inv_ID = $invoiceID ");
                    while ($row = mysqli_fetch_array($result)) {
                      //              GLOBAL $qty,$wp,$Discount,$t;
                      $qty = $row[1];
                      $wp = $row[5];
                      $Discount = $row[6];
                      $sub = (100 - $Discount);
                      $sub = $sub * $qty * $wp;
                      $sub = $sub / 100;
                      $t = $t + $sub;
                    }
                    echo "<td>Rs. " . $t . "</td>";
                    $wholetot = $wholetot + $t;

                    $t1 = 0;
                    $sub = 0;

                    $result = mysqli_query($conn, "SELECT * FROM sub_invoice WHERE Invoice_Inv_ID = $invoiceID ");
                    while ($row = mysqli_fetch_array($result)) {
                      //              GLOBAL $qty,$wp,$Discount,$t1;
                      $qty = $row[1];
                      $wp = $row[4];
                      $Discount = $row[6];

                      $sub = $qty * $wp;

                      $t1 = $t1 + $sub;
                    }

                    echo "<td>Rs. " . $t1 . "</td>";
                    $costtot = $costtot + $t1;

                    $t2 = 0;
                    $sub = 0;

                    $result = mysqli_query($conn, "SELECT * FROM sub_invoice WHERE Invoice_Inv_ID = $invoiceID ");
                    while ($row = mysqli_fetch_array($result)) {
                      //              GLOBAL $qty,$wp,$Discount,$t2;
                      $qty = $row[1];
                      $wp = $row[3];
                      $Discount = $row[6];

                      $sub = $qty * $wp;

                      $t2 = $t2 + $sub;
                    }

                    echo "<td>Rs. " . $t2 . "</td>";
                    // echo "<td> " . number_format($t-$t1,".",",") . "</td>";
                    $ttt = $t-$t1;
                    echo "<td> " . $ttt . "</td>";
                    $rettot = $rettot + $t2;
                    echo "</tr>";
                  }
                } else if (isset($_POST['start']) && isset($_POST['end']) && isset($_POST['cus'])) {
                  $start = $_POST['start'];
                  $end = $_POST['end'];
                  $cus = $_POST['cus'];
                  $count = 0;
                  $result = mysqli_query($conn, "SELECT * FROM invoice WHERE deliver = 0 AND Allocated = 1 AND Customer_id = $cus AND InvDate BETWEEN '$start' AND '$end'");
                  while ($row = mysqli_fetch_array($result)) {
                    GLOBAL $count;
                    $count = $count + 1;
                  }

                  $steps = 1;
                  $wholetot = 0;
                  $costtot = 0;
                  $rettot = 0;
                  while ($steps <= $count) {

                    $result = mysqli_query($conn, "SELECT * FROM invoice WHERE deliver = 0 AND Allocated = 1 AND Customer_id = $cus AND InvDate BETWEEN '$start' AND '$end' ORDER BY Inv_ID DESC LIMIT $steps");
                    while ($row = mysqli_fetch_array($result)) {
                      //              GLOBAL $invoiceID,$dat,$userID,$CustomerID,$Allocated,$Deliverd;
                      $invoiceID = $row['Inv_ID'];
                      $dat = $row['InvDate'];
                      $userID = $row['User_User_ID'];
                      $CustomerID = $row['Customer_id'];
                      $Allocated = $row['Allocated'];
                      $Deliverd = $row['deliver'];
                      $inv = $row[0];
                      $InvNumber = $row['BillID'];
                    }

                    $result = mysqli_query($conn, "SELECT * FROM user_profile WHERE User_User_ID = $userID ");
                    while ($row = mysqli_fetch_array($result)) {
                      //                                                    GLOBAL $repname;
                      $repname = $row['Name'];
                    }

                    $result = mysqli_query($conn, "SELECT * FROM deliver WHERE Invoice_ID = $invoiceID ");
                    while ($row = mysqli_fetch_array($result)) {
                      //              GLOBAL $deliverID;
                      $deliverID = $row['Employee_ID'];
                    }
                    $result = mysqli_query($conn, "SELECT * FROM user WHERE User_ID = $deliverID ");
                    while ($row = mysqli_fetch_array($result)) {
                      //              GLOBAL $deliverName;
                      $deliverName = $row['UserName'];
                    }

                    $cusname = " ";
                    $result = mysqli_query($conn, "SELECT * FROM cus_profile WHERE Customer_Cus_ID = $CustomerID ");
                    while ($row = mysqli_fetch_array($result)) {
                      //GLOBAL $cusname;
                      $cusname = $row['Name'];
                    }
                    echo "<tr><td>" . $InvNumber . "</td>";
                    echo "<td>" . $dat . "</td>";

                    echo "<td>" . $cusname . "</td>";
                    echo "<td>" . $repname . "</td>";

                    $steps = $steps + 1;
                    $t = 0;
                    $sub = 0;

                    $result = mysqli_query($conn, "SELECT * FROM sub_invoice WHERE Invoice_Inv_ID = $invoiceID ");
                    while ($row = mysqli_fetch_array($result)) {
                      //              GLOBAL $qty,$wp,$Discount,$t;
                      $qty = $row[1];
                      $wp = $row[5];
                      $Discount = $row[6];
                      $sub = (100 - $Discount);
                      $sub = $sub * $qty * $wp;
                      $sub = $sub / 100;
                      $t = $t + $sub;
                    }
                    echo "<td>Rs. " . $t . "</td>";
                    $wholetot = $wholetot + $t;

                    $t1 = 0;
                    $sub = 0;

                    $result = mysqli_query($conn, "SELECT * FROM sub_invoice WHERE Invoice_Inv_ID = $invoiceID ");
                    while ($row = mysqli_fetch_array($result)) {
                      //              GLOBAL $qty,$wp,$Discount,$t1;
                      $qty = $row[1];
                      $wp = $row[4];
                      $Discount = $row[6];

                      $sub = $qty * $wp;

                      $t1 = $t1 + $sub;
                    }

                    echo "<td>Rs. " . $t1 . "</td>";
                    $costtot = $costtot + $t1;

                    $t2 = 0;
                    $sub = 0;

                    $result = mysqli_query($conn, "SELECT * FROM sub_invoice WHERE Invoice_Inv_ID = $invoiceID ");
                    while ($row = mysqli_fetch_array($result)) {
                      //              GLOBAL $qty,$wp,$Discount,$t2;
                      $qty = $row[1];
                      $wp = $row[3];
                      $Discount = $row[6];

                      $sub = $qty * $wp;

                      $t2 = $t2 + $sub;
                    }

                    echo "<td>Rs. " . $t2 . "</td>";
                    // echo "<td> " . number_format($t-$t1,".",",") . "</td>";
                    $ttt = $t-$t1;
                    echo "<td> " . $ttt . "</td>";
                    $rettot = $rettot + $t2;
                    echo "</tr>";
                  }
                } else {

                  $count = 0;
                  $result = mysqli_query($conn, "SELECT * FROM invoice WHERE deliver = 0 AND Allocated = 1");
                  while ($row = mysqli_fetch_array($result)) {
                    GLOBAL $count;
                    $count = $count + 1;
                  }

                  $steps = 1;
                  $wholetot = 0;
                  $costtot = 0;
                  $rettot = 0;
                  while ($steps <= $count) {

                    $result = mysqli_query($conn, "SELECT * FROM invoice WHERE deliver = 0 AND Allocated = 1 LIMIT $steps");
                    while ($row = mysqli_fetch_array($result)) {
                      //                                                    GLOBAL $invoiceID, $dat, $userID, $CustomerID, $Allocated, $Deliverd;
                      $invoiceID = $row['Inv_ID'];
                      $dat = $row['InvDate'];
                      $userID = $row['User_User_ID'];
                      $CustomerID = $row['Customer_id'];
                      $Allocated = $row['Allocated'];
                      $Deliverd = $row['deliver'];
                      $inv = $row[0];
                      $InvNumber = $row['BillID'];
                    }

                    $result = mysqli_query($conn, "SELECT * FROM user_profile WHERE User_User_ID = $userID ");
                    while ($row = mysqli_fetch_array($result)) {
                      //                                                    GLOBAL $repname;
                      $repname = $row['Name'];
                    }

                    $result = mysqli_query($conn, "SELECT * FROM deliver WHERE Invoice_ID = $invoiceID ");
                    while ($row = mysqli_fetch_array($result)) {
                      //                                                    GLOBAL $deliverID;
                      $deliverID = $row['Employee_ID'];
                    }
                    $result = mysqli_query($conn, "SELECT * FROM user WHERE User_ID = $deliverID ");
                    while ($row = mysqli_fetch_array($result)) {
                      //                                                    GLOBAL $deliverName;
                      $deliverName = $row['UserName'];
                    }

                    $cusname = " ";
                    $result = mysqli_query($conn, "SELECT * FROM cus_profile WHERE Customer_Cus_ID = $CustomerID ");
                    while ($row = mysqli_fetch_array($result)) {
                      //GLOBAL $cusname;
                      $cusname = $row['Name'];
                    }
                    echo "<tr><td>" . $InvNumber . "</td>";
                    echo "<td>" . $dat . "</td>";

                    echo "<td>" . $cusname . "</td>";
                    echo "<td>" . $repname . "</td>";

                    $steps = $steps + 1;
                    $t = 0;
                    $sub = 0;

                    $result = mysqli_query($conn, "SELECT * FROM sub_invoice WHERE Invoice_Inv_ID = $invoiceID ");
                    while ($row = mysqli_fetch_array($result)) {
                      //                                                    GLOBAL $qty, $wp, $Discount, $t;
                      $qty = $row[1];
                      $wp = $row[5];
                      $Discount = $row[6];
                      $sub = (100 - $Discount);
                      $sub = $sub * $qty * $wp;
                      $sub = $sub / 100;
                      $t = $t + $sub;
                    }
                    echo "<td>Rs. " .  number_format($t, 2). "</td>";
                    $wholetot = $wholetot + $t;

                    $t1 = 0;
                    $sub = 0;

                    $result = mysqli_query($conn, "SELECT * FROM sub_invoice WHERE Invoice_Inv_ID = $invoiceID ");
                    while ($row = mysqli_fetch_array($result)) {
                      //                                                    GLOBAL $qty, $wp, $Discount, $t1;
                      $qty = $row[1];
                      $wp = $row[4];
                      $Discount = $row[6];

                      $sub = $qty * $wp;

                      $t1 = $t1 + $sub;
                    }

                    echo "<td>Rs. " .  number_format($t1, 2). "</td>";
                    $costtot = $costtot + $t1;

                    $t2 = 0;
                    $sub = 0;

                    $result = mysqli_query($conn, "SELECT * FROM sub_invoice WHERE Invoice_Inv_ID = $invoiceID ");
                    while ($row = mysqli_fetch_array($result)) {
                      //                                                    GLOBAL $qty, $wp, $Discount, $t2;
                      $qty = $row[1];
                      $wp = $row[3];
                      $Discount = $row[6];

                      $sub = $qty * $wp;

                      $t2 = $t2 + $sub;
                    }

                    echo "<td>Rs. " .  number_format($t2, 2). "</td>";

                    // echo "<td> " . number_format($ttt,".",",") . "</td>";
                    $ttt = $t-$t1;
                    echo "<td>Rs. " .  number_format($ttt, 2). "</td>";
                    $rettot = $rettot + $t2;
                    echo "</tr>";
                  }
                }
                mysqli_close($conn);
                ?>
              </tbody>
            </table>
            <!--end of the table--></div>
            <div class="col-sm-12" style='font-size:15px;'>
              <div class="col-sm-4">WHOLESALE TOTAL: <b>Rs. <?php echo number_format($wholetot, 2); ?></b></div>
              <div class="col-sm-4">COST TOTAL: <b>Rs. <?php echo number_format($costtot, 2); ?></b></div>
              <div class="col-sm-4">RETAIL TOTAL: <b>Rs. <?php echo number_format($rettot, 2); ?></b></div>
            </div>
            <div class="col-sm-12" style='font-size:25px;text-align:center;'>
              <div class="col-sm-12">PROFIT: <b>Rs. <?php echo number_format($wholetot - $costtot, 2); ?></b></div>
            </div>
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
