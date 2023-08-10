<?php
session_start();
$id1 = $_SESSION['id'];
$company = $_SESSION['company'];

// header('location:systemupdate.php');

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
    <?php
    include 'HeaderMaintain.php';
    ?>
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
      <div class="col-sm-10 text-left" style="margin-top:10px;background-color: #F8F8F8;min-height:550px;text-align:center;">
        <h1>Welcome To <b style="color:teal;">WAYAMBA TRADE CENTER.</b> Online System</h1>
        <p>This is the Online system of <b style="color:teal;">WAYAMBA TRADE CENTER.</b>You will be able to handle the products,inventory,client,suppliers by using the This System.</p>
        <hr/>

        <div class="row">

          <div class="row text-center">
            <div class="col-sm-4">
              <div class="col-sm-12">
                <div class="well">
                  <label>PLACE A GRN</label>
                  <br/><label style="font-size:70px;"><span class="glyphicon glyphicon-share"></span></label>
                  <?php if(privCheck(24,$id1)>0) { ?>
                    <a href="NewPurchaseOrder.php" class="btn btn-primary btn-block" role="button">PROCEED <span class="glyphicon glyphicon-forward"></span> </a>
                  <?php } ?>
                </div>
              </div>
            </div>
            <div class="col-sm-4">
              <div class="col-sm-12">
                <div class="well">
                  <label>ISSUE AN INVOICE</label>
                  <br/><label style="font-size:70px;"><span class="glyphicon glyphicon-edit"></span></label>
                  <?php if(privCheck(27,$id1)>0) { ?>
                    <a href="NewInvoicePrimary.php" class="btn btn-primary btn-block" role="button">PROCEED <span class="glyphicon glyphicon-forward"></span> </a>
                  <?php } ?>
                </div>
              </div>
            </div>
            <div class="col-sm-4">
              <div class="col-sm-12">
                <div class="well">
                  <label>MAKE A COLLECTION</label>
                  <br/><label style="font-size:70px;"><span class="glyphicon glyphicon-check"></span></label>
                  <?php if(privCheck(30,$id1)>0) { ?>
                    <a href="NewCollection.php" class="btn btn-primary btn-block" role="button">PROCEED <span class="glyphicon glyphicon-forward"></span> </a>
                  <?php } ?>
                </div>
              </div>
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
