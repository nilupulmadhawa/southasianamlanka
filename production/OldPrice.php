<?php
session_start();
$id1 = $_SESSION['id'];
$company = $_SESSION['company'];

if(isset($_POST['UpdatemulID'])){
  // echo "ok<br/>";
	include 'connection.php';

	$mulIDUpdate = mysqli_real_escape_string($conn,$_POST['UpdatemulID']);
	$cost = mysqli_real_escape_string($conn,$_POST['cost']);
	$whole = mysqli_real_escape_string($conn,$_POST['whole']);
  $ret = mysqli_real_escape_string($conn,$_POST['ret']);
	$bat = mysqli_real_escape_string($conn,$_POST['bat']);

  // echo $mulIDUpdate."<br>";

  // echo $cost."<br>";
  // echo $whole."<br>";
  // echo $ret."<br>";

	$cost = "UPDATE multiprice SET CostPrice = $cost WHERE ID = $mulIDUpdate ";
	$whole = "UPDATE multiprice SET Wprice = $whole WHERE ID = $mulIDUpdate ";
  $ret = "UPDATE multiprice SET RetailPrice = $ret WHERE ID = $mulIDUpdate ";
	$bat = "UPDATE multiprice SET batchID = '$bat' WHERE ID = $mulIDUpdate ";

	mysqli_query($conn,$whole);
	mysqli_query($conn,$ret);
  mysqli_query($conn,$cost);
  mysqli_query($conn,$bat);

	mysqli_close($conn);
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
        xmlhttp.open("GET","MultiDetails.php?q="+str,true);
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

    <div class="col-sm-10 text-left" style="margin-top:10px;background-color: #F8F8F8;padding:10px;">
      <div class="row">
      <div class="col-sm-4 text-left">
      <!--start of the form-->
       <form role="form" method="post" action="ConnectionOldPrice.php">
        <div class="form-group">
          <label>Item Name:</label>
           <select class="form-control" name="product" autofocus="on" onchange="showUser(this.value)"  >
						 <option selected disabled>SELECT THE ITEM</option>
            <?php include'connection.php'; $result = mysqli_query($conn, "SELECT * FROM item ORDER BY Name ASC");
            while($row = mysqli_fetch_array($result)){
              echo "<option value = '".$row[0]."'> ".$row['ItemCode']." (".$row[2].")</option>";
              }
              mysql_close($conn);
             ?>
          </select>
        </div>

		<div class="form-group">
          <label>Batch Number:</label>
          <input type="text" class="form-control" name="batch" autocomplete="off">
        </div>

		<div class="form-group">
          <label>Cost Price:</label>
          <input type="text" class="form-control" name="cost" autocomplete="off">
        </div>
		<div class="form-group">
          <label>Wholesale Price:</label>
          <input type="text" class="form-control" name="wp" autocomplete="off">
        </div>
		<div class="form-group">
          <label>Retail Price:</label>
          <input type="text" class="form-control" name="ret" autocomplete="off">
        </div>


        <button type="submit" class="btn btn-default">Add</button>
      </form>
      <!--end of the form-->
      </div>
      <div class="col-sm-8">
		<div  id="txtHint"></div>
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
