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
  <link type="text/css" rel="stylesheet" href="css/custom.css">
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

        <!--        content start-->

        <div class="row" style='min-height:500px;'>
          <div class="col-sm-6">
            <form role="form">
              <div class="form-group">
                <label>Customer Name:</label>
                <select name="cus" class="form-control" autofocus="on">
                  <?php
                  include 'connection.php';
                  $result = mysqli_query($conn, "SELECT * FROM cus_profile ORDER BY Name ASC ");
                  while ($row = mysqli_fetch_array($result)) {
                    echo "<option value=" . $row[0] . ">" . $row[1] . "</option>";
                  }
                  mysqli_close($conn);
                  ?>
                </select>
              </div>


              <button type="submit" class="btn btn-primary">View</button>
            </form>
          </div>

          <?php if(isset($_GET['cus'])){?>

            <div class="col-sm-12">
              <?php
              include 'connection.php';
              if (isset($_GET['cus'])) {
                GLOBAL $cusid;
                $cusid = $_GET['cus'];
                //echo $cusid;
                $result = mysqli_query($conn, "SELECT * FROM cus_profile WHERE Cus_ID = $cusid ");
                while ($row = mysqli_fetch_array($result)) {
                  //GLOBAL $cusname,$cat,$address,$city,$district,$route,$tel,$fax,$email;
                  $cusname = $row[1];
                  $cat = $row[2];
                  $address = $row[3];
                  $city = $row[4];
                  $district = $row[5];
                  $route = $row[6];
                  $tel = $row[7];
                  $fax = $row[8];
                  $email = $row[9];
                  //                                    $DiscountDate = $row['SettleMent'];
                }
              }
              mysqli_close($conn);
              ?>
              <div class="row">
                <div class="col-sm-6" style="border-radius: 25px;border:1px solid;box-shadow: 10px 10px 5px #888888;padding:10px;margin-top:5px;">
                  <!--                                    <img src="images/img.png" class="img-rounded" alt="Cinque Terre" width="75" height="75"><br/>-->
                  <div class="col-sm-6">
                    Name: <b><?php echo $cusname; ?></b><br/>
                    Address: <b><?php echo $address; ?></b><br/>
                    City: <b><?php echo $city; ?></b><br/>
                    District: <b><?php echo $district; ?></b><br/>
                    Route: <b><?php echo $route; ?></b><br/>
                  </div>
                  <div class="col-sm-6">
                    Tel: <b><?php echo $tel; ?></b></br>
                    Fax: <b><?php echo $fax; ?></b></br>
                    Email: <b><?php echo $email; ?></b></br>
                  </div>
                </div>
              </div>

              <div class="col-sm-6" style="margin-top:10px;">
                <label>CUSTOMER HISTORY</label>
                <div style="height:300px;overflow:auto;">
                  <table class="table">
                    <thead>
                      <tr>
                        <th>Date</th>


                        <th class="text-center">ID</th>
                        <th class="text-right">Invoice Amount</th>
                        <th class="text-right">Collect Amount</th>
                        <!--                                                <th class="text-right">Discount Amount</th>-->
                        <th class="text-right">Return Amount</th>
                        <!--                                                <th class="text-right" style='text-align:right;'>Day Balance</th>-->



                      </tr>
                    </thead>
                    <tbody>

                      <?php

                      function check($invID) {
                        include 'connection.php';
                        $check = 0;
                        $result = mysqli_query($conn, "SELECT * FROM sub_invoice WHERE Invoice_Inv_ID = $invID ");
                        while ($row = mysqli_fetch_array($result)) {
                          if ($row[9] > 0 || $row[10] > 0) {
                            $check = 1;
                          }
                        }
                        mysqli_close($conn);
                        return $check;
                      }

                      include 'connection.php';



                      include 'functions/outtotal.php';
                      include 'functions/cusoutstanding.php';
                      //$gridtotal = outtotal($cusid);
                      //echo $gridtotal;

                      $cusID = $cusid;
                      $today = date('Y-m-d', strtotime("+1 days"));
                      $invdate = "2015-01-01";
                      $date1 = date_create($invdate);
                      $date2 = date_create($today);
                      $diff = date_diff($date2, $date1);
                      $dif = $diff->format("%a");

                      $inc = 5;

                      function invt($invoice) {
                        include 'connection.php';
                        $count = 0;
                        $result = mysqli_query($conn, "SELECT * FROM sub_invoice WHERE  Invoice_inv_ID = $invoice");
                        while ($row = mysqli_fetch_array($result)) {
                          $count = $count + 1;
                        }
                        $steps = 1;
                        $total = 0;
                        while ($steps <= $count) {
                          $result = mysqli_query($conn, "SELECT * FROM sub_invoice WHERE  Invoice_inv_ID = $invoice LIMIT $steps");
                          while ($row = mysqli_fetch_array($result)) {
                            GLOBAL $item_id, $qty, $RetPrice, $CostPrice, $FreeIssue, $Discount;
                            $item_id = $row[1];
                            $qty = $row[1];
                            $RetPrice = $row[3];
                            $wp = $row[5];
                            $FreeIssue = $row[2];
                            $Discount = $row[6];
                          }
                          $sub = (100 - $Discount);
                          $sub = $sub * $qty * $wp;
                          $sub = $sub / 100;

                          $total = $total + $sub;
                          $steps = $steps + 1;
                        }
                        return $total;
                        mysqli_close($conn);
                      }

                      function colamount($type, $id) {
                        $amount = 0;
                        include 'connection.php';
                        if ($type == 1) {
                          $result = mysqli_query($conn, "SELECT * FROM cash WHERE Collection_ID = $id");
                          while ($row = mysqli_fetch_array($result)) {
                            GLOBAL $amount;
                            $amount = $row[1];
                          }
                        } else if ($type == 2) {

                          $result = mysqli_query($conn, "SELECT * FROM cheque WHERE Collection_ID = $id AND status != 2");
                          while ($row = mysqli_fetch_array($result)) {
                            //GLOBAL $amount;
                            $amount = $row[2];
                          }
                        }
                        return $amount;
                      }

                      $invt = 0;
                      $colt = 0;
                      $dist = 0;
                      $ret = 0;
                      $i = 0;
                      $total = 0;
                      $gtotal = 0;
                      while ($i <= $dif) {



                        $date = strtotime("+$i day", strtotime("2015-01-01"));
                        //echo date("Y-m-d", $date)."</br>";
                        $dat = date("Y-m-d", $date);
                        //$dat = date('2015-01-01', strtotime("+$i days"));
                        //echo $dat."</br>";
                        //invoices
                        $rowcount = 0;
                        $result = mysqli_query($conn, "SELECT * FROM invoice WHERE Allocated = 1 AND InvDate = '$dat' AND Customer_id = $cusID ");
                        $rowcount = mysqli_num_rows($result);
                        if ($rowcount != 0) {
                          $result = mysqli_query($conn, "SELECT * FROM invoice WHERE Allocated = 1 AND InvDate = '$dat' AND Customer_id = $cusID ");
                          while ($row = mysqli_fetch_array($result)) {
                            GLOBAL $inv;
                            echo "<tr>";
                            echo "<td>" . $row[1] . "</td>";



                            echo "<td class='text-center'><a href='DetailedReportInvoiceExtend.php?id=" . $row[0] . "' target='_blank'>" . $row[0] . "</a></td>";


                            $b = invt($row[0]) - $row[6];

                            echo "<td class='text-right'>" . invt($row[0]) . "</td>";
                            $invamount = invt($row[0]);
                            echo "<td></td>";
                            echo "<td> </td>";
                            echo "<td> </td>";
                            $invt = $invt + $invamount;

                            $gtotal = $gtotal + $invamount;
                            //                                                        echo "<td style='text-align:right;'>" . $gtotal . "</td>";
                            echo "<tr/>";
                          }
                        }

                        $result = mysqli_query($conn, "SELECT * FROM collection WHERE Collection_date = '$dat' AND Customer_ID = $cusID ");
                        $rowcount = mysqli_num_rows($result);
                        if ($rowcount != 0) {
                          $result = mysqli_query($conn, "SELECT * FROM collection WHERE Collection_date = '$dat' AND Customer_ID = $cusID ");
                          while ($row = mysqli_fetch_array($result)) {
                            GLOBAL $inv;
                            if (colamount($row[5], $row[0]) != 0) {
                              echo "<tr>";

                              echo "<td>" . $row[3] . "</td>";



                              echo "<td class='text-center'>" . $row[0] . "</td>";
                              colamount($row[5], $row[0]);
                              echo "<td></td>";
                              echo "<td class='text-right'>" . colamount($row[5], $row[0]) . "</td>";
                              $colamoun = colamount($row[5], $row[0]);
                              echo "<td></td>";
                              echo "<td></td>";
                              $gtotal = $gtotal - $colamoun;
                              //                                                            echo "<td style='text-align:right;'>" . $gtotal . "</td>";
                              echo "<tr/>";
                              $colt = $colt + $colamoun;
                            }
                          }
                        }
                        //echo $DiscountDate;


                        $result = mysqli_query($conn, "SELECT * FROM return_invoice WHERE ReturnDate = '$dat'  AND Customer_id = $cusID ");
                        $rowcount = mysqli_num_rows($result);
                        if ($rowcount != 0) {
                          $result = mysqli_query($conn, "SELECT * FROM return_invoice WHERE ReturnDate = '$dat'  AND Customer_id = $cusID ");
                          while ($row = mysqli_fetch_array($result)) {
                            GLOBAL $inv;

                            echo "<tr>";

                            echo "<td>" . $row[6] . "</td>";



                            echo "<td class='text-center'><a href='ReturnDetail.php?id=" . $row[0] . "' target='_blank'>" . $row[0] . "</a></td>";
                            echo "<td></td>";
                            echo "<td></td>";
                            echo "<td></td>";



                            echo "<td class='text-right' style='color:red;'>" . $row[8] . "</td>";
                            $retamount = $row[8];
                            $gtotal = $gtotal - $retamount;
                            //                                                        echo "<td style='text-align:right;'>" . $gtotal . "</td>";
                            echo "<tr/>";
                            $ret = $ret + $retamount;
                          }
                        }



                        $i = $i + 1;
                      }
                      ?>

                    </tbody>
                  </table></div>
                  <div class="col-sm-12" style="font-size:20px;text-align:center;"><?php
                  $net = $invt - $colt - $dist - $ret;

                  ?></div>
                  <div class="col-sm-12" style="font-size:15px;">
                    <div class="col-sm-4">Invoice:<br/> <?php echo number_format($invt, 2) ?></div>
                    <div class="col-sm-4">Collection:<br/> <?php echo number_format($colt, 2) ?></div>

                    <div class="col-sm-4">Return: <br/> <?php echo number_format($ret, 2) ?></div>

                  </div>


                </div>
                <div class="col-sm-6">
                  <label>CUSTOMER OUTSTANDING</label>
                  <!--start of the table--><div style="height:200px;overflow:auto;">
                  <table class="table table-striped" style="font-size:12px;">
                    <thead>
                      <tr>
                        <th>Invoice ID</th>
                        <th>Invoice Date</th>
                        <th>Days</th>
                        <th>Ammount</th>
                        <th></th>

                      </tr>
                    </thead>
                    <tbody>
                      <?php

                      function notification($cusID) {

                      }

                      function chque($cusID) {
                        include 'connection.php';
                        $chtotal = 0;
                        $result = mysqli_query($conn, "SELECT * FROM cheque WHERE Customer_id = $cusID AND status = 0 ");
                        while ($row = mysqli_fetch_array($result)) {
                          $chtotal = $chtotal + $row[2];
                        }
                        return $chtotal;
                        mysqli_close($conn);
                      }

                      include 'connection.php';
                      $chtotal = chque($cusID);
                      $green = 0;
                      $yellow = 0;
                      $red = 0;
                      $lastinv = 0;
                      $balance = 0;
                      if ($net > 0) {
                        $tnet = $net;
                        $i = 0;

                        //notification(565);
                        $result = mysqli_query($conn, "SELECT * FROM invoice WHERE Allocated = 1 AND status = 0 AND Customer_id = $cusID ORDER BY InvDate DESC , Inv_ID DESC ");
                        while ($row = mysqli_fetch_array($result)) {


                          $lastinv = $row[0];
                          $invto = invt($row[0]);
                          $today = date("Y-m-d");
                          $date2 = date_create($row[1]);
                          $date1 = date_create($today);
                          $diff = date_diff($date2, $date1);
                          $dif = $diff->format("%a");


                          echo "<tr>";
                          echo "<td>" . $row[0] . "</td>";
                          echo "<td>" . $row[1] . "</td>";
                          echo "<td>" . $dif . "</td>";


                          if ($dif < 45) {
                            if ($dif == 40) {
                              //notification($cusID);
                            }
                            $green = $green + $invto;
                            echo "<td style='color:green;'>" . number_format($invto, 2) . "</td>";
                          } else if ($dif >= 45 && $dif < 60) {
                            if ($dif == 55) {
                              //notification($cusID);
                            }
                            $yellow = $yellow + $invto;
                            echo "<td style='color:orange;'>" . number_format($invto, 2) . "</td>";
                          } else if ($dif >= 60) {
                            $red = $red + $invto;
                            echo "<td style='color:red;'>" . number_format($invto, 2) . "</td>";
                          }

                          echo "</tr>";




                          $i = $i + 1;
                        }
                      }
                      include 'connection.php';
                      $bal = 0;
                      $lastinv = 0;
                      $allbalance = 0;
                      $allbalance = $chtotal + $net;
                      //echo "balance amount: ".number_format($allbalance, 2)."<br/>";
                      $bal = $chtotal + $net;
                      $result = mysqli_query($conn, "SELECT * FROM invoice WHERE Customer_id = $cusID ORDER BY Inv_ID DESC ");
                      while ($row = mysqli_fetch_array($result)) {
                        $invtot = 0;
                        $invtot = invt($row[0]);
                        if($allbalance > 0){
                          $allbalance = $allbalance - $invtot;
                          //echo "-".number_format($invtot, 2)." REST: = ".number_format($allbalance, 2)."<br/>";
                          $lastinv = $row[0];
                        }
                        else {
                          break;
                        }
                        $bal = $bal - $invtot;
                      }
                      $updateinvoice = 0;
                      $updateinvoice = $lastinv;

                      //                                            echo "LAST INVOICE:" . $updateinvoice . "<br/>";
                      //echo "LAST INVOICE:".$updateinvoice."<br/>";

                      $bal = $bal * (-1);
                      //                                            echo "BALANCE:" . $bal . "<br/>";
                      //                                            echo "CUSID:" . $cusID . "<br/>";


                      //                                            if ($updateinvoice == 0) {
                      //                                                $sql = "UPDATE invoice SET status = 1 WHERE Customer_id = $cusID ";
                      //                                                //mysqli_query($conn, $sql);
                      //                                                if (mysqli_query($conn, $sql)) {
                      //                                                    echo "Record updated successfully";
                      //                                                } else {
                      //                                                    echo "Error updating record: " . mysqli_error($conn);
                      //                                                }
                      //                                                echo "ok";
                      //                                            } else {
                      //                                                $sql = "UPDATE invoice SET Balance = $bal WHERE Inv_ID = $lastinv ";
                      //                                                mysqli_query($conn, $sql);
                      //                                                $sql = "UPDATE invoice SET status = 1 WHERE Customer_id = $cusID AND Inv_ID < $lastinv ";
                      //                                                mysqli_query($conn, $sql);
                      //                                                $sql = "UPDATE invoice SET status = 0 WHERE Customer_id = $cusID AND Inv_ID >= $lastinv ";
                      //                                                mysqli_query($conn, $sql);
                      //                                                $sql = "UPDATE invoice SET Balance = 0 WHERE Customer_id = $cusID AND Inv_ID > $lastinv ";
                      //                                                mysqli_query($conn, $sql);
                      //                                            }


                      $today = date("Y-m-d");
                      //                                            $sql = "UPDATE cus_profile SET checked = '$today' WHERE Cus_ID = $cusID ";
                      //                                            mysqli_query($conn, $sql);
                      //                                            $sql = "UPDATE cus_profile SET OutOne = $green WHERE Cus_ID = $cusID ";
                      //                                            mysqli_query($conn, $sql);
                      //                                            $sql = "UPDATE cus_profile SET OutTow = $yellow WHERE Cus_ID = $cusID ";
                      //                                            mysqli_query($conn, $sql);
                      //                                            $sql = "UPDATE cus_profile SET OutThree = $red WHERE Cus_ID = $cusID ";
                      //                                            mysqli_query($conn, $sql);
                      mysqli_close($conn);
                      ?>
                    </tbody>
                  </table>

                  <!--end of the table--></div>



                </div>
              </div>
            <?php } ?>
          </div>

          <!--        content ends-->


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
