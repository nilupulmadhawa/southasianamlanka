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
  function ShowProducts(str) {
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
      xmlhttp.open("GET","MainInvProducts.php?q="+str,true);
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


                <!-- <div class="form-group">
                <label>Product:</label>
                <select class="form-control" name="product" autofocus="on" onchange="ShowProducts(this.value)">
                <option selected disabled>SELECT THE PRODUCT</option> -->
                <?php
                // include'connection.php'; $result = mysqli_query($conn, "SELECT * FROM item ORDER BY Name ASC");
                // while($row = mysqli_fetch_array($result)){
                //   echo "<option value = '".$row[0]."'> ".$row[1]." (".$row[2].")</option>";
                // }
                // mysql_close($conn);
                ?>
                <!-- </select>
              </div> -->

              <form method="post" action="AddToSubStock.php">
                <div class="form-group">
                  <label for="email">IMEI:</label>
                  <input type="text" class="form-control" name="imei" placeholder="Imei Number" autofocus>
                </div>
                <button type="submit" class="btn btn-primary">ADD</button>
              </form>


              <!--end of the form-->
            </div>
            <div class="col-sm-7" style="border:1px solid;padding:5px;height:250px;overflow:auto;box-shadow: 5px 10px #888888;">

              <div class="col-sm-6">
                <label style="background-color:teal;padding:5px;color:white;">GENRAL ITEMS</label>
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th>IMEI</th>
                      <th>IMEI2</th>
                      <th>TYPE</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    include 'connection.php';
                    $result = mysqli_query($conn,"SELECT * FROM inventory WHERE itemtype = 'GENERAL' AND issued = 0 ");
                    while($row = mysqli_fetch_array($result)){
                      echo "<tr>";
                      echo "<td>".$row['imei']."</td>";
                      echo "<td>".$row['imei2']."</td>";
                      echo "<td>".$row['itemtype']."</td>";
                      echo "</tr>";
                    }
                    mysqli_close($conn);
                    ?>
                  </tbody>
                </table>
              </div>
              <div class="col-sm-6">
                <label style="background-color:teal;padding:5px;color:white;">WARRENTY ITEMS</label>
                <table class="table table-bordered">
                  <thead>
                    <tr>
                      <th>IMEI</th>
                      <th>IMEI2</th>
                      <th>TYPE</th>
                    </tr>
                  </thead>
                  <tbody>
                    <?php
                    include 'connection.php';
                    $result = mysqli_query($conn,"SELECT * FROM inventory WHERE itemtype = 'WARRENTY' AND issued = 0 ");
                    while($row = mysqli_fetch_array($result)){
                      echo "<tr>";
                      echo "<td>".$row['imei']."</td>";
                      echo "<td>".$row['imei2']."</td>";
                      echo "<td>".$row['itemtype']."</td>";
                      echo "</tr>";
                    }
                    mysqli_close($conn);
                    ?>
                  </tbody>
                </table>
              </div>

            </div>
            <div class="col-sm-12">
              <div style="margin-top:25px;">

                <p>GRN Number: <b><?php include 'connection.php'; if(isset($_SESSION['podi'])){ $poid = $_SESSION['podi']; $result = mysqli_query($conn,"SELECT * FROM po_sub WHERE ID = $poid"); while($row = mysqli_fetch_array($result)){ $pid = $row['PoID'];} echo $pid;} ?> </b></p>

              </div>
              <!-- <div class="col-sm-12" style="margin-top:5px;border:1px solid;padding:2px;padding-left:5px;box-shadow: 10px 10px 5px #888888;border-radius: 15px;" id="txtHint"></div> -->
              <button type="submit" class="btn btn-primary" onClick="document.location.href='ConnectionSubmitPo_sub.php'">SUBMIT GRN</button>
            </div>
          </div>
          <div class="col-sm-12" style="padding-bottom:5px;border:1px solid;margin-top:20px;box-shadow: 5px 10px 10px #888888;">
            <br/>
            <!--start of the tabele--><div style="height:250px;overflow:auto;">
            <table class="table table-striped" width="100%" style="font-size:12px;">
              <thead>
                <tr>
                  <th class="tablecol1">Product Name</th>
                  <th class="tablecol3" style='text-align:left;'>IMEI</th>
                  <th class="tablecol3" style='text-align:left;'>IMEI2</th>
                  <th class="tablecol3"></th>
                </tr>
              </thead>
              <tbody>
                <?php include 'connection.php';
                if(isset($_GET['delTemp'])){
                  $delID = $_GET['delTemp'];
                  $sql = "DELETE FROM temp_po_sub WHERE ID = $delID ";
                  mysqli_query($conn, $sql);
                  unset($_GET['delTemp']);
                }
                if(isset($_SESSION['podi'])){
                  $poid =  $_SESSION['podi'];
                  $result = mysqli_query($conn,"SELECT * FROM temp_po_sub WHERE PoID = '$poid' ");
                  while($row = mysqli_fetch_array($result)){
                    echo "<tr>";
                    echo "<td>".ItemName($row['ItemID'])."</td>";
                    echo "<td>".$row['imei']."</td>";
                    echo "<td>".$row['imei2']."</td>";
                    echo "<td><a href='NewPurchaseOrderSecond_sub.php?delTemp=".$row[0]."' class='btn btn-xs btn-primary'>DELETE</a></td>";
                    echo "</tr>";
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

</body>
</html>
