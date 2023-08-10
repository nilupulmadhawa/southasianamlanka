<?php
session_start();
$id1 = $_SESSION['id'];
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

  <script type="text/javascript">
  function noNumbers(e) {

    keynum = e.which;

    if (keynum == 13){
      document.getElementById("Text2").focus();
      event.preventDefault();}
    }
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

    <script type="text/javascript">


    $(document).ready(function(){
      $('#checkbox1').change(function(){
        if(this.checked)
        $('#autoUpdate').fadeIn('slow');
        else
        $('#autoUpdate').fadeOut('slow');

      });
    });

    </script>

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
        xmlhttp.open("GET","ProductDetails.php?q="+str,true);
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
        xmlhttp.open("GET","itemdetails1.php?q="+str,true);
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

        <?php if(isset($_SESSION['errormessage'])){ ?>
          <div class="alert alert-danger">
            <strong>OOPS!</strong> <?php echo $_SESSION['errormessage']; ?>
          </div>
          <?php unset($_SESSION['errormessage']); } ?>


          <?php if(isset($_SESSION['successmessage'])){ ?>
            <div class="alert alert-success">
              <strong>OOPS!</strong> <?php echo $_SESSION['successmessage']; ?>
            </div>
            <?php unset($_SESSION['successmessage']); } ?>


            <div class="row">

              <div class="col-sm-5 text-left">

                <!--start of the form-->
                <form role="form" method="post" action="ConnectionNewPurchaseOrderSecond.php">


                  <div class="form-group">
                    <label>Product:</label>
                    <select class="form-control" name="product" autofocus="on" onchange="showUser1(this.value)">
                      <option selected disabled>SELECT THE PRODUCT</option>
                      <?php include'connection.php'; $result = mysqli_query($conn, "SELECT * FROM item ORDER BY Name ASC");
                      while($row = mysqli_fetch_array($result)){
                        if(isset($_SESSION['productID'])){
                          if($_SESSION['productID'] == $row[0]){
                            echo "<option value = '".$row[0]."' selected> ".$row[1]." (".$row[2].")</option>";
                          }else{
                            echo "<option value = '".$row[0]."'>".$row[1]." (".$row[2].")</option>";
                          }

                        }else{
                          echo "<option value = '".$row[0]."'>".$row[1]." (".$row[2].")</option>";
                        }

                      }
                      mysql_close($conn);
                      ?>
                    </select>
                  </div>
                  <?php   if(isset($_SESSION['productID'])){
                    ?>
                    <script>
                    showUser1(<?php echo $_SESSION['productID']; ?>);
                    </script>
                    <?php
                  } ?>
                  <div  id="txtHint1"></div>

                  <!-- <div class="form-group">
                    <label>SIM TYPE:</label>
                    <select class="form-control" onchange="Simstatus(this.value)">
                      <option value="1">Single Sim</option>
                      <option value="2">Dual Sim</option>
                    </select>
                  </div> -->

                  <div class="form-group">
                    <label>ITEM TYPE:</label>
                    <select class="form-control">
                      <option>GENERAL ITEM</option>
                      <option>WARRENTY ITEM</option>
                    </select>
                  </div>

                  <div class="form-group">
                    <label>IMEI:</label>
                    <input type="text" class="form-control" placeholder="IMEI" name="imei" onkeydown="return noNumbers(event)" autocomplete="off" required>
                  </div>

                  <div class="form-group" id="myDIV">
                    <label>IMEI2:</label>
                    <input type="text" class="form-control" placeholder="IMEI" name="imei2" onkeydown="return noNumbers(event)" id="Text2" autocomplete="off">
                  </div>

                  <!-- <div class="form-group">
                  <label>Free Issue:</label>
                  <input type="text" class="form-control" placeholder="Free Issue" name="free" value="0" autocomplete="off">
                </div> -->


                <div class="form-group">
                  <label>Discount:</label>
                  <div class="input-group">
                    <input type="text" class="form-control"  placeholder="Discount" id="Text2" name="discount" value="0" autocomplete="off">
                    <div class="input-group-addon">%</div>
                  </div>
                </div>


                <button type="submit" class="btn btn-default">Add</button>
              </form>
              <!--end of the form-->
            </div>
            <div class="col-sm-7">
              <div style="margin-top:25px;">
                <p>GRN Number: <b><?php include 'connection.php'; if(isset($_SESSION['podi'])){ $poid = $_SESSION['podi']; $result = mysqli_query($conn,"SELECT * FROM po WHERE ID = $poid"); while($row = mysqli_fetch_array($result)){ $pid = $row['PoID'];} echo $pid;} ?> </b></p>
                <p>GRN Sub Total: <b>
                  <?php include 'connection.php';

                  if(isset($_SESSION['podi'])){
                    $poid =  $_SESSION['podi'];

                    $result = mysqli_query($conn,"SELECT * FROM po WHERE  ID = $poid");
                    while($row=mysqli_fetch_array($result)) {
                      GLOBAL $ponumber;
                      $ponumber = $row['PoID'];
                    }

                    $count = 0;
                    $result = mysqli_query($conn,"SELECT * FROM temp_po WHERE PoID = '$ponumber' ");
                    $count = mysqli_num_rows($result);

                    $steps = 1;
                    $total = 0;
                    while($steps <= $count){
                      $result = mysqli_query($conn,"SELECT * FROM temp_po WHERE PoID = '$ponumber' ORDER BY ID DESC LIMIT $steps");
                      while($row=mysqli_fetch_array($result)) {
                        GLOBAL $poid1, $item_id,$qty,$RetPrice,$CostPrice,$retail,$whole,$FreeIssue,$Discount;
                        $poid1 = $row[0];
                        $item_id = $row[7];
                        $qty = $row[1];

                        $whole = $row[5];
                        $CostPrice = $row[4];
                        $retail = $row[3];
                        $FreeIssue = $row[2];
                        $Discount = $row[6];
                      }

                      $result1 = mysqli_query($conn,"SELECT * FROM item WHERE Item_ID = $item_id ");
                      while($row=mysqli_fetch_array($result1)) {
                        GLOBAL $name;
                        $name = $row[1];
                      }




                      $sub = (100-$Discount);
                      $sub = $sub * $qty *$CostPrice;
                      $sub = $sub/100;

                      $total = $total + $sub;
                      $steps = $steps + 1;
                    }

                    echo number_format($total,2);
                  }
                  ?>
                </b></p>

              </div>
              <!-- <div class="col-sm-12" style="margin-top:5px;border:1px solid;padding:2px;padding-left:5px;box-shadow: 10px 10px 5px #888888;border-radius: 15px;" id="txtHint"></div> -->
              <button type="submit" class="btn btn-primary" onClick="document.location.href='ConnectionSubmitPo.php'">SUBMIT GRN</button>
            </div>
          </div>
          <div class="row" style="padding-bottom:5px;">
            <br/>
            <!--start of the tabele--><div style="height:250px;overflow:auto;">
            <table class="table table-striped" width="100%" style="font-size:12px;">
              <thead>
                <tr>
                  <th class="tablecol1">Product Name</th>
                  <th class="tablecol3" style='text-align:left;'>IMEI</th>
                  <th class="tablecol3" style='text-align:left;'>IMEI2</th>
                  <!-- <th class="tablecol3">Free Issue</th> -->

                  <!-- <th class="tablecol3">Cost Price</th> -->
                  <!-- <th class="tablecol3">Retail Price</th> -->
                  <!-- <th class="tablecol3">Wholesale Price</th> -->
                  <th class="tablecol3" style='text-align:center;'>Discount</th>

                  <th class="tablecol3"></th>
                </tr>
              </thead>
              <tbody>
                <?php include 'connection.php';

                if(isset($_SESSION['podi'])){
                  $poid =  $_SESSION['podi'];

                  $result = mysqli_query($conn,"SELECT * FROM po WHERE  ID = $poid");
                  while($row=mysqli_fetch_array($result)) {
                    //               GLOBAL $ponumber;
                    $ponumber = $row['PoID'];
                  }

                  $count = 0;
                  $result = mysqli_query($conn,"SELECT * FROM temp_po WHERE PoID = '$ponumber' ");
                  $count = mysqli_num_rows($result);

                  $steps = 1;
                  $total = 0;
                  $itemName = "NULL";
                  while($steps <= $count){
                    $result = mysqli_query($conn,"SELECT * FROM temp_po WHERE PoID = '$ponumber' ORDER BY ID DESC LIMIT $steps");
                    while($row=mysqli_fetch_array($result)) {
                      //              GLOBAL $poid1, $item_id,$qty,$RetPrice,$CostPrice,$retail,$whole,$FreeIssue,$Discount;
                      $poid1 = $row[0];
                      $item_id = $row[7];
                      $qty = $row[1];
                      $whole = $row[5];
                      $CostPrice = $row[4];
                      $retail = $row[3];
                      $FreeIssue = $row[2];
                      $Discount = $row[6];
                      $imei = $row['imei'];
                      $imei2 = $row['imei2'];
                    }

                    $result1 = mysqli_query($conn,"SELECT * FROM item WHERE Item_ID = $item_id ");
                    while($row=mysqli_fetch_array($result1)) {
                      //              GLOBAL $name;
                      $name = $row[2];
                    }
                    if($itemName == $name){
                      echo "<tr><td></td>";
                    }else{
                      echo "<tr><td><b>".$name."</b></td>";
                      $itemName = $name;
                    }

                    echo "<td style='text-align:left;'>".$imei."</td>";
                    echo "<td style='text-align:left;'>".$imei2."</td>";
                    // echo "<td>".$FreeIssue."</td>";

                    // echo "<td>Rs.".number_format($CostPrice)."</td>";
                    // echo "<td>Rs.".number_format($retail,2)."</td>";
                    // echo "<td>Rs.".number_format($whole,2)."</td>";
                    echo "<td style='text-align:center;'>".$Discount."%</td>";
                    $sub = (100-$Discount);
                    $sub = $sub * $qty *$whole;
                    $sub = $sub/100;

                    echo "<td> <a class='btn btn-primary btn-block' href='DeleteTemppo.php?id=".$poid1."'> DELETE </a></td></tr>";
                    $total = $total + $sub;
                    $steps = $steps + 1;
                  }
                }
                ?>
              </tbody>
            </table>
            <!--end of the tabele-->

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
  <script>
  function Simstatus(str){
    var x = document.getElementById("myDIV");
    if (x.style.display === "none") {
      x.style.display = "block";
    } else {
      x.style.display = "none";
    }
  }
</script>
</body>
</html>
