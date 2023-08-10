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
    // var cusname = document.getElementById("CusName").value;
    // alert(cusname);
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
      xmlhttp.open("GET","freeissuedetails.php?q="+str,true);
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

      <div class="col-sm-10 text-left" style="margin-top:10px;background-color: #F8F8F8;padding-top:10px;">



        <div class="col-sm-6">
          <?php if($company != 3){ ?>
            <div class="col-sm-12" style="min-height:550px;">
              ----------------Product Wise Free Issue And Discount---------------
              <!--start of the form-->
              <form class="form-horizontal" role="form" action="ConnectionFreeIssue.php" method="post" enctype="multipart/form-data">




                <div class="form-group">
                  <label class="control-label col-sm-2">Item Name:</label>
                  <div class="col-sm-10">
                    <select class="form-control" name="product" onchange="showUser(this.value)" autofocus="on">
                      <option selected disabled>SELECT THE ITEM</option>
                      <?php
                      include 'connection.php';
                      $result = mysqli_query($conn,"SELECT * FROM item WHERE CompanyID = $company ORDER BY ItemCode");
                      while($row = mysqli_fetch_array($result)){
                        echo "<option value='".$row[0]."'> ".$row['ItemCode']." (".$row[2].")</option>";
                      }
                      mysqli_close($conn);
                      ?>
                    </select>
                  </div>
                </div>



                <div class="form-group">
                  <label class="control-label col-sm-2">Qty:</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" placeholder="Qty" name="qty" value="0">
                  </div>
                </div>

                <div class="form-group">
                  <label class="control-label col-sm-2">Free Issue:</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" placeholder="Free Issue" name="free" value="0">
                  </div>
                </div>

                <div class="form-group">
                  <label class="control-label col-sm-2">Discount:</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" placeholder="Discount" name="discount" value="0">
                  </div>
                </div>



                <div class="form-group">
                  <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-primary">SET</button>
                  </div>
                </div>
              </form>
              <!--end of the form-->
            </div>
            -------------------Category Wise Free Issue And Discount---------------
            <div class="col-sm-12" style="margin-top:10px;">
              <!--start of the form-->
              <!-- <form class="form-horizontal" role="form" action="ConnectionFreeIssuecat.php" method="post" enctype="multipart/form-data">


                <div class="form-group">
                  <label class="control-label col-sm-2">Customer Name:</label>
                  <div class="col-sm-10">
                    <select class="form-control" name="cusname">
                      <?php
                      include 'connection.php';
                      $result = mysqli_query($conn,"SELECT * FROM cus_profile ORDER BY Name ASC");
                      while($row = mysqli_fetch_array($result)){
                        echo "<option value='".$row[0]."'>".$row[1]."</option>";
                      }
                      mysqli_close($conn);
                      ?>
                    </select>
                  </div>
                </div>

                <div class="form-group">
                  <label class="control-label col-sm-2">Category Name:</label>
                  <div class="col-sm-10">
                    <select class="form-control" name="cat">
                      <?php
                      include 'connection.php';
                      $result = mysqli_query($conn,"SELECT * FROM category WHERE CompanyID = $company ORDER BY Category ASC");
                      while($row = mysqli_fetch_array($result)){
                        echo "<option value='".$row[0]."'>".$row[1]."</option>";
                      }
                      mysqli_close($conn);
                      ?>
                    </select>
                  </div>
                </div>



                <div class="form-group">
                  <label class="control-label col-sm-2">Qty:</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" placeholder="Qty" name="qty">
                  </div>
                </div>

                <div class="form-group">
                  <label class="control-label col-sm-2">Free Issue:</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" placeholder="Free Issue" name="free">
                  </div>
                </div>

                <div class="form-group">
                  <label class="control-label col-sm-2">Discount:</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" placeholder="Discount" name="discount">
                  </div>
                </div>



                <div class="form-group">
                  <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-primary">SET</button>
                  </div>
                </div>
              </form> -->
              <!--end of the form-->
            </div>
          <?php }  ?>

          <?php if($company == 3){ ?>
            -------------------Multi Free Issue And Discount---------------
            <div class="col-sm-12" style="margin-top:10px;">
              <!--start of the form-->
              <form class="form-horizontal" role="form" action="ConnectionFreeMulti.php" method="post" enctype="multipart/form-data">


                <div class="form-group">
                  <label class="control-label col-sm-2">Product Name:</label>
                  <div class="col-sm-10">
                    <select class="form-control" name="product" autofocus="on" onchange="showUser(this.value)">
                      <?php
                      include 'connection.php';
                      $result = mysqli_query($conn,"SELECT * FROM item WHERE CompanyID = $company ORDER BY ItemCode");
                      while($row = mysqli_fetch_array($result)){
                        echo "<option value='".$row[0]."'>".$row[1]."(".$row[2].")</option>";
                      }
                      mysqli_close($conn);
                      ?>
                    </select>
                  </div>
                </div>



                <div class="form-group">
                  <label class="control-label col-sm-2">Qty:</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" placeholder="Qty" name="qty">
                  </div>
                </div>

                <div class="form-group">
                  <label class="control-label col-sm-2">Free Issue:</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" placeholder="Free Issue" name="free">
                  </div>
                </div>

                <div class="form-group">
                  <label class="control-label col-sm-2">Discount:</label>
                  <div class="col-sm-10">
                    <input type="text" class="form-control" placeholder="Discount" name="discount">
                  </div>
                </div>



                <div class="form-group">
                  <div class="col-sm-offset-2 col-sm-10">
                    <button type="submit" class="btn btn-primary">SET</button>
                  </div>
                </div>
              </form>
              <!--end of the form-->
            </div>
          <?php }  ?>

        </div>





        <div class="col-sm-6 ">
          <div id="txtHint" style="background-color:#eee;"><b></b></div>

        </div>


      </div>
      <div class="col-sm-2 sidenav">
        <?php include 'RightNavBar.php'; ?>
      </div>
    </div>
  </div>
</div>

<footer class="container-fluid text-center">
  <?php include 'footer.php'; ?>
</footer>

</body>
</html>
