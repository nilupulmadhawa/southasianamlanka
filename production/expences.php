<?php
session_start();
$id1 = $_SESSION['id'];
$company = $_SESSION['company'];

if(isset($_POST['exptype'])){
	$exptype = mysqli_real_escape_string($conn,$_POST['exptype']);
	$id = 0;
	$result = mysqli_query($conn,"SELECT * FROM expences_type");
	while($row = mysqli_fetch_array($result)){
		$id = $row[0];
	}
	$id = $id + 1;

	$result = "INSERT INTO expences_type (ID, type) VALUES ($id, '$exptype')";
	mysqli_query($conn,$result);
	header('location:expences.php');
}
else if(isset($_POST['type'])){
	//echo "ok";
	$expdate = date("Y-m-d");
	$type = mysqli_real_escape_string($conn,$_POST['type']);
	$des = mysqli_real_escape_string($conn,$_POST['des']);
	$bill = mysqli_real_escape_string($conn,$_POST['bill']);
	$amount = mysqli_real_escape_string($conn,$_POST['amount']);
	$billdate = mysqli_real_escape_string($conn,$_POST['billdate']);
	$ptype = mysqli_real_escape_string($conn,$_POST['ptype']);
	$id = 0;
	$result = mysqli_query($conn,"SELECT * FROM expences");
	while($row = mysqli_fetch_array($result)){
		$id = $row[0];
	}
	$id = $id + 1;

	$result = "INSERT INTO expences (ID, type, Amount, expdate, bill, des, billdate, paytype) VALUES ($id, '$type', $amount, '$expdate', '$bill', '$des', '$billdate', $ptype)";
	mysqli_query($conn,$result);
	if($ptype == 1){
		header('location:expences.php');
	}
	else if($ptype == 2){
		$_SESSION['expamount'] = $amount;
		$_SESSION['expID'] = $id;
		$_SESSION['type'] = $type;
		header('location:expences.php');
	}
}
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
      <div class="col-sm-10 text-left" style="margin-top:10px;background-color: #F8F8F8;min-height:550px;text-align:center;padding:10px;">

        <div class="col-sm-6">
          <!--EXPENCES TYPE-->
          <form class="form-horizontal" role="form" method="post" action="expences.php">
            <div class="form-group">
              <label class="control-label col-sm-2" for="email">EXPENCES TYPE:</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" placeholder="EXPENCES TYPE" name="exptype">
              </div>
            </div>
            <div class="form-group">
              <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-primary">ADD</button>
              </div>
            </div>



          </form>
        </div>
        <div class="col-sm-6">
          <!--start of the tabele--><div style="height:200px;overflow:auto;">
          <table class="table table-bordered">
            <thead>
              <tr>
                <th style='text-align:center;'>EXPENCES TYPE</th>
              </tr>
            </thead>
            <tbody>
              <?php
              include 'connection.php';
              $result = mysqli_query($conn,"SELECT * FROM expences_type ORDER BY ID ASC");
              while($row = mysqli_fetch_array($result)){
                echo "<tr>";
                echo "<td style='text-align:center;'>".$row[1]."</td>";
                echo "</tr>";
              }
              mysqli_close($conn);
              ?>
            </tbody>
          </table>
        </div>
      </div>
      <div class="col-sm-12">
        <div class="col-sm-6">


          <form class="form-horizontal" role="form" method="post" action="expences.php">
            <div class="form-group">
              <label class="control-label col-sm-2" for="email">EXPENCES TYPE:</label>
              <div class="col-sm-10">
                <select class="form-control" autofocus="on" name="type">
                  <?php
                  $billdate = date("Y-m-d");
                  include 'connection.php';
                  $result = mysqli_query($conn,"SELECT * FROM expences_type ORDER BY type ASC");
                  while($row = mysqli_fetch_array($result)){
                    echo "<option value='".$row[1]."'>".$row[1]."</option>";
                  }
                  mysqli_close($conn);
                  ?>
                </select>
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-sm-2" for="email">BILL NUMBER:</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" placeholder="BILL NUMBER" name="bill">
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-sm-2" for="email">BILL DATE:</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" id="datepicker" name="billdate" placeholder="BILL DATE" autocomplete="off" value="<?php echo $billdate; ?>">

              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-sm-2" for="email" name="desc">DESC:</label>
              <div class="col-sm-10">
                <textarea rows="4" cols="50" name="des" class="form-control"></textarea>
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-sm-2" for="email"  >TYPE:</label>
              <div class="col-sm-10">
                <select name="ptype" class="form-control">
                  <option value="1">CASH</option>
                  <option value="2">CHEQUE</option>
                </select>
              </div>
            </div>
            <div class="form-group">
              <label class="control-label col-sm-2" for="email">AMOUNT:</label>
              <div class="col-sm-10">
                <input type="text" class="form-control" placeholder="AMOUNT" name="amount">
              </div>
            </div>
            <div class="form-group">
              <div class="col-sm-offset-2 col-sm-10">
                <button type="submit" class="btn btn-primary">ADD</button>
              </div>
            </div>

          </form>
        </div>
        <div class="col-sm-6">
          <!-- <div style="margin-bottom:20px;"><a href="CashBook.php"><button type="button" class="btn btn-primary" style="width:200px;">CASH BOOK</button></a></div> -->

        </div>
        <div class="col-sm-12">
          <!--start of the tabele--><div style="height:300px;overflow:auto;">
          <table class="table table-bordered">
            <thead>
              <tr>
                <!-- <th style='text-align:left;'>Date</th> -->
                <th style='text-align:center;'>Bill Date</th>
                <th style='text-align:center;'>Expences Type</th>

                <th style='text-align:center;'>Bill Number</th>
                <th style='text-align:center;'>Description</th>

                <th style='text-align:right;'>Amount</th>
              </tr>
            </thead>
            <tbody>
              <?php
              include 'connection.php';
              $result = mysqli_query($conn,"SELECT * FROM expences ORDER BY expdate DESC LIMIT 30");
              while($row = mysqli_fetch_array($result)){
                echo "<tr>";
                // echo "<td style='text-align:left;'>".$row[3]."</td>";
                echo "<td style='text-align:center;'>".$row[6]."</td>";
                echo "<td style='text-align:center;'>".$row[1]."</td>";

                echo "<td style='text-align:center;'>".$row[4]."</td>";
                echo "<td style='text-align:center;'>".$row[5]."</td>";

                echo "<td style='text-align:right;'>".number_format($row[2],2)."</td>";
                echo "</tr>";
              }
              mysqli_close($conn);
              ?>
            </tbody>
          </table>
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
