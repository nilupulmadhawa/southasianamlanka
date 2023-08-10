<?php
session_start();
$id1 = $_SESSION['id'];
$prev = $_SESSION['prev'];
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
  <script>
  function showUser(str) {
    if (str == "") {
      document.getElementById("txtHint").innerHTML = "";
      return;
    } else {
      if (window.XMLHttpRequest) {
        // code for IE7+, Firefox, Chrome, Opera, Safari
        xmlhttp = new XMLHttpRequest();
      } else {
        // code for IE6, IE5
        xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
      }
      xmlhttp.onreadystatechange = function() {
        if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
          document.getElementById("txtHint").innerHTML = xmlhttp.responseText;
        }
      }
      xmlhttp.open("GET","active.php?q="+str,true);
      xmlhttp.send();
    }
  }
  </script>
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
        <div style="text-align:right;"><label>SALES // INVOICE DETAILED REPORT</label></div>
        <div class="row">


          <div class="col-sm-12" style="margin-bottom:5px;text-align:right;">
            <!--Activate Delete-->
            <form class="form-inline" role="form">
              <div class="form-group">
                <label>DELETE OPTION STATUS: <div id="txtHint" style="background-color:#eee;float:right;width:200px;text-align:center;"><b><?php if(isset($_SESSION['active'])){echo $_SESSION['active'];} else{ echo "DEACTIVATED"; } ?></b></div></label>
                <select class="form-control" onchange="showUser(this.value)">
                  <option value="DEACTIVE">Deactivate</option>
                  <option value="ACTIVE">Activate</option>

                </select>
              </div>

            </form>

          </div>


          <div class="col-sm-12 text-left">

            <p>Total Number of Completed Invoices in the database: <b><?php include 'connection.php'; $count = 0; $result = mysqli_query($conn,"SELECT * FROM invoice WHERE Allocated = 1");
            while($row = mysqli_fetch_array($result)){
              //          GLOBAL $count;
              $count = $count +1;
            }
            echo $count;
            ?></b></p>
            <!--start of the table--><div style="height:500px;overflow:auto;font-size:16px;">
            <table class="table table-bordered">
              <thead>
                <tr>
                  <th>Invoice ID</th>
                  <th>Invoice Date</th>
                  <th>Customer</th>
                  <th style='text-align:right;'>Ammount</th>
                  <th style='text-align:center;'>Rep</th>
                  <th style='text-align:center;'>Status</th>
                  <th style='text-align:center;'>Action</th>
                  <?php if($prev == 1){echo "<th></th>";} ?>
                </tr>
              </thead>
              <tbody>
                <?php
                include 'connection.php';
                $count = 0;
                $result = mysqli_query($conn,"SELECT * FROM invoice WHERE Allocated = 1");
                while($row = mysqli_fetch_array($result)){
                  GLOBAL $count;
                  $count = $count +1;
                }

                $steps = 1;
                while($steps<=$count){

                  $result = mysqli_query($conn,"SELECT * FROM invoice WHERE Allocated = 1 ORDER BY Inv_ID DESC, InvDate DESC LIMIT $steps");
                  while($row = mysqli_fetch_array($result)){
                    //              GLOBAL $invoiceID,$dat,$userID,$CustomerID,$Allocated,$Deliverd;
                    $invoiceID = $row['Inv_ID'];
                    $dat = $row['InvDate'];
                    $userID = $row['User_User_ID'];
                    $CustomerID = $row['Customer_id'];
                    $Allocated = $row['Allocated'];
                    $Deliverd = $row['deliver'];
                    $BillID = $row['BillID'];
                    //            	$InvID = $row['InvNumber'];
                  }

                  // $result = mysqli_query($conn,"SELECT * FROM deliver WHERE Invoice_ID = $invoiceID");
                  // while($row = mysqli_fetch_array($result)){
                  //   $employee = $row[1];
                  // }
                  // $result = mysqli_query($conn,"SELECT * FROM user_profile WHERE Prof_ID = $employee");
                  // while($row = mysqli_fetch_array($result)){
                  //   $rename = $row[1];
                  //   $usercontact = $row[3];
                  // }

                  $result = mysqli_query($conn,"SELECT * FROM user WHERE User_ID = $userID ");
                  while($row = mysqli_fetch_array($result)){
                    //              GLOBAL $repname;
                    $repname = $row['UserName'];
                  }
                  if($Allocated == 1){
                    $result = mysqli_query($conn,"SELECT * FROM deliver WHERE Invoice_ID = $invoiceID ");
                    while($row = mysqli_fetch_array($result)){
                      //              GLOBAL $deliverID;
                      $deliverID = $row['Employee_ID'];
                    }
                    // $result = mysqli_query($conn,"SELECT * FROM user WHERE User_ID = $deliverID ");
                    // while($row = mysqli_fetch_array($result)){
                    //   //              GLOBAL $deliverName;
                    //   $deliverName = $row['UserName'];
                    // }
                  }

                  $result = mysqli_query($conn,"SELECT * FROM cus_profile WHERE Customer_Cus_ID = $CustomerID ");
                  while($row = mysqli_fetch_array($result)){
                    //              GLOBAL $cusname;
                    $cusname = $row['Name'];
                  }
                  echo "<tr><td><a href='DetailedReportInvoiceExtend.php?id=".$invoiceID."'>".$BillID."</a></td>";
                  echo "<td>".$dat."</td>";

                  echo "<td>".$cusname."</td>";

                  $steps = $steps + 1;
                  $t = 0;

                  $result = mysqli_query($conn,"SELECT * FROM sub_invoice WHERE Invoice_Inv_ID = $invoiceID ");
                  while($row = mysqli_fetch_array($result)){
                    //GLOBAL $qty,$wp,$Discount,$t;
                    $qty = $row[1];
                    $wp = $row[5];
                    $Discount = $row[6];
                    $sub = (100-$Discount);
                    $sub = $sub * $qty *$wp;
                    $sub = $sub/100;
                    $t = $t + $sub;
                  }
                  echo "<td style='text-align:right;'>Rs. ". number_format($t,2)."</td>";
                  echo "<td style='text-align:center;'>".$repname."</td>";
                  if($Allocated == 0){
                    echo "<td style='color:red;'>New*</td>";}
                    else if($Allocated == 1 && $Deliverd == 0){
                      echo "<td style='color:orange;text-align:center;'>Allocated* </td>";}
                      else if($Allocated = 1 && $Deliverd == 1){
                        echo "<td style='color:green;text-align:center;'>Deliverd* </td>";}
                        echo "<td class='text-center'><a href='InvoicePrint.php?id=".$invoiceID."' target='_blank'><img src='images/print.png' width='25' height='25'></a></td>";
                          if($prev == 1){
                            echo "<td> <a href='DeleteInvoice.php?id=".$invoiceID."'> DELETE </a></tr>";
                          }
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
