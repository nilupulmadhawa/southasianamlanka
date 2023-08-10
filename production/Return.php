<?php
require_once 'models.php';
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
      xmlhttp.open("GET","itemdetails2.php?q="+str,true);
      xmlhttp.send();
    }
  }
  </script>
  <script>
  function showUser1(str) {
    if (str == "") {
      document.getElementById("txtHint1").innerHTML = "";
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
          document.getElementById("txtHint1").innerHTML = xmlhttp.responseText;
        }
      }
      xmlhttp.open("GET","note.php?q="+str,true);
      xmlhttp.send();
    }
  }
  </script>
</script>
<script>
function showUser2(str) {
  if (str == "") {
    document.getElementById("txtHint2").innerHTML = "";
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
        document.getElementById("txtHint2").innerHTML = xmlhttp.responseText;
      }
    }
    xmlhttp.open("GET","noteset.php?q="+str,true);
    xmlhttp.send();
  }
}
</script>


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

      <div class="col-sm-10 text-left" style="margin-top:10px;background-color: #F8F8F8;padding-top:5px;">
        <?php if(isset($_SESSION['error'])){ ?>
          <div class="alert alert-danger">
            <strong>WARNING!</strong> You Have To Set The Customer First!!
          </div>
        <?php } unset($_SESSION['error']); ?>

        <hr/>
        <div class="row">
          <div class="col-sm-6">
            <!--form start-->
            <form role="form" method="post" action="ConnectionReturn.php">
              <div class="form-group">
                <label for="email">Return Type:</label>
                <select class="form-control" name="type" autofocus="on">
                  <option value="1">Warrenty Return</option>
                  <option value="2">Damaged Item Return</option>
                  <option value="3">Item Return</option>
                  <!-- <option value="4">Free Issue</option> -->

                </select>
              </div>

              <div class="form-group">
								<label for="email">IMEI:</label>
								<input type="text" class="form-control" name="imei" placeholder="Imei Number" autofocus>
							</div>



              <!-- <div class="form-group">
                <div id="txtHint" ><b></b></div>
              </div> -->

              <div class="form-group">

                <input type="hidden" class="form-control" placeholder="Quantity" name="qty" value="1" required>
              </div>

              <button type="submit" class="btn btn-default">ADD</button>
            </form>
            <!--form end-->
          </div>

          <div class="col-sm-6" style="margin-top:24px;">
            <div class="col-sm-12" style="font-size:20px;">RETURN INVOICE ID: <b><?php if(isset($_SESSION['reID'])){ $reid = $_SESSION['reID']; $reid = sprintf("%04d", $reid); echo $reid; } else { echo "0000"; } ?></b></div>
            <?php
            if(isset($_SESSION['issue'])){
              if($_SESSION['issue'] == "issue"){
                ?>
                <div class="checkbox">
                  <label><input type="checkbox" value="1" onchange="showUser2(this.value)">Get An Freeissue Note</label>
                </div>
                <?php
              }
            }
            ?>
            <div id="txtHint2" ></div>
          </div>
          <div class="col-sm-6" style="margin-top:24px;">
            <form class="form-inline" action="ReturnSet.php">
              <div class="form-group">
                <label for="email">Invoice ID:</label>
                <select class="form-control" name="invo">
                  <?php
                  if(isset($_SESSION['cus'])){
                    $cus = $_SESSION['cus'];
                    include 'connection.php';
                    $result = mysqli_query($conn,"SELECT * FROM invoice WHERE User_User_ID = $cus ORDER BY Inv_ID ASC");
                    while($row = mysqli_fetch_array($result)){
                      $invo = sprintf("%04d", $row[0]);
                      echo "<option value='".$row[0]."'>".$invo ."</option>";
                    }
                    mysqli_close($conn);}
                    ?>
                  </select>
                </div>


                <button type="submit" class="btn btn-primary">SUBMIT RETURN NOTE</button>
              </form>

            </div>
          </div>
          <div class="row">
            <div class="col-sm-12">
              <div style="height:250px;overflow:auto;">
                <!--table-->
                <table class="table">
                  <thead>
                    <tr>
                      <th>Item Name</th>
                      <th style='text-align:center;'>Quantity</th>
                      <!-- <th style='text-align:center;'>Customer Name</th> -->
                      <th style='text-align:center;'>Date</th>
                      <th style='text-align:center;'>Type</th>
                      <th></th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    function name($itemid){
                      include('connection.php');
                      $itemname = 0;
                      $result = mysqli_query($conn,"SELECT * FROM item WHERE Item_ID = $itemid");
                      while($row = mysqli_fetch_array($result)){
                        $itemname = $row[2];
                      }
                      return $itemname;
                      mysqli_close($conn);
                    }
                    function cusname($cusid){
                      include('connection.php');
                      $cusname = 0;
                      $result = mysqli_query($conn,"SELECT * FROM cus_profile WHERE Cus_ID = $cusid");
                      while($row = mysqli_fetch_array($result)){
                        $cusname = $row[1];
                      }
                      return $cusname;
                      mysqli_close($conn);
                    }
                    include 'connection.php';
                    $result = mysqli_query($conn,"SELECT * FROM return_invoice WHERE status = 0");
                    while($row = mysqli_fetch_array($result)){
                      echo "<tr>";
                      echo "<td>".name($row[1])."</td>";
                      echo "<td style='text-align:center;'>".$row[2]."</td>";
                      // echo "<td style='text-align:center;'>".cusname($row[4])."</td>";
                      echo "<td style='text-align:center;'>".$row[6]."</td>";
                      if($row[8] == 1){
                        echo "<td style='text-align:center;'>Expired Item Return</td>";}
                        else if($row[8] == 2){
                          echo "<td style='text-align:center;'>Damaged Item Return</td>";}
                          else if($row[8] == 3){
                            echo "<td style='text-align:center;'>Item Return</td>";}
                            else if($row[8] == 4){
                              echo "<td style='text-align:center;'>Free Issue</td>";}
                              echo "<td> <a href='DeleteReturn.php?id=".$row[0]."'> DELETE </a></td></tr>";
                              echo "</tr>";
                            }
                            mysqli_close($conn);
                            ?>
                          </tbody>
                        </table>
                        <!--end of table-->
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
