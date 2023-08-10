<?php
session_start();
$id1 = $_SESSION['id'];
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



    <!--    pnotify-->
    <script type="text/javascript" src="pnotofy/pnotify.custom.min.js"></script>
    <link href="pnotofy/pnotify.custom.min.css" media="all" rel="stylesheet" type="text/css" />

</head>
<body>


    <?php if(isset($_SESSION['error'])) { ?>
    <script type="text/javascript">
    $(function(){

    PNotify.prototype.options.styling = "bootstrap3";

     new PNotify({
            title: 'LOGING FAILED!',
            text: '<b><?php echo $_SESSION['error'] ?></b>',
            type: 'error'
        });

    });
    </script>
    <?php
        unset($_SESSION['error']);
    }
    if(isset($_SESSION['success'])) { ?>
    <script type="text/javascript">
    $(function(){

    PNotify.prototype.options.styling = "bootstrap3";

     new PNotify({
            title: 'Success!',
            text: '<?php echo $_SESSION['success']; ?>',
            type: 'success'
        });

    });
    </script>
    <?php
        unset($_SESSION['success']);
    }

    ?>



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
        <div style="text-align:right;"><label>PURCHASE // PURCHASE ORDER DETAILED REPORT</label></div>
      <div class="row">
	  <div class="col-sm-12" style="margin-bottom:5px;">
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

      <p>Total Number of Invoices in the database: <b><?php include 'connection.php'; $count = 0; $result = mysqli_query($conn,"SELECT * FROM po");
        while($row = mysqli_fetch_array($result)){
          GLOBAL $count;
          $count = $count +1;
        }
        echo $count;
         ?></b></p>
         <!--start of the table--><div style="height:500px;overflow:auto;">
        <table class="table table-bordered">
          <thead>
            <tr>
              <th>GRN ID</th>
              <th style='text-align:center;'>GRN Date</th>

              <th style="text-align:center;">Supplier</th>



              <th></th>
            </tr>
          </thead>
          <tbody>
            <?php
            include 'connection.php';
            $count = 0;
            $result = mysqli_query($conn,"SELECT * FROM po");
            while($row = mysqli_fetch_array($result)){
              GLOBAL $count;
              $count = $count +1;
            }

            $steps = 1;
            while($steps<=$count){

            $result = mysqli_query($conn,"SELECT * FROM po ORDER BY ID DESC LIMIT $steps");
            while($row = mysqli_fetch_array($result)){

              $poid = $row['PoID'];
              $dat = $row['PurchaseDate'];
              $pid = $row['ID'];

              $supplierID = $row['SupplierID'];
			  $status = $row[6];
            }

            $supname = " ";
            $result = mysqli_query($conn,"SELECT * FROM supplier WHERE Sup_ID = $supplierID ");
            while($row = mysqli_fetch_array($result)){
              // GLOBAL $supname;
              $supname = $row['Name'];
            }

            echo "<tr><td><a href='DetailedReportPOExtend.php?id=".$pid."'>".$poid."</a></td>";
            echo "<td style='text-align:center;'>".$dat."</td>";

            echo "<td style='text-align:center;'>".$supname."</td>";


              $steps = $steps + 1;


            echo "<td style='text-align:center;'> <a href='DeletePO.php?id=".$poid."'> DELETE </a></tr>";
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
