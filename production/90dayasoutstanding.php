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
      <div class="row">
      	<div class="col-sm-12 col-md-offset-10" style="margin-top:5px;">
	   
        <a href='90dayasoutstandingprint.php' target="_blank"><img src='images/print.png' width='50' height='50'>
		<p style="margin-left:-10px;">Print Report</p></a>
		</div>
      <div class="col-sm-12 text-left">

         <!--start of the table-->
        <div style="height:500px;overflow:auto;padding-top:5px;">
        <table class="table table-striped">
          <thead>
            <tr>
              <th>GRN ID</th>
              <th>GRN Date</th>
              
              <th class="text-center">Supplier</th>
              <th class="text-right">Amount</th>

            </tr>
          </thead>
          <tbody>
            <?php 
            function totalpo($poid){
            	include 'connection.php';
            	$potot = 0;
            	$result = mysqli_query($conn,"SELECT * FROM sub_po WHERE PO_POID = $poid ");
            	while($row = mysqli_fetch_array($result)){
            		GLOBAL $potot;
            		$potot = $potot + ($row[4]*$row[1]);
            	}
            	return $potot;
            	mysqli_close($conn);
            }
            include 'connection.php';
            $count = 0;
            $result = mysqli_query($conn,"SELECT * FROM po WHERE status = 1 AND CompanyID = $company AND paid = 0");
            while($row = mysqli_fetch_array($result)){
              GLOBAL $count;
              $count = $count +1;
            }

            $steps = 1;
            $pot = 0;
            while($steps<=$count){

            $result = mysqli_query($conn,"SELECT * FROM po WHERE status = 1 AND CompanyID = $company AND paid = 0 ORDER BY ID DESC LIMIT $steps");
            while($row = mysqli_fetch_array($result)){
              GLOBAL $poid,$dat,$supplierID,$idid;              
              $poid = $row['PoID'];
              $dat = $row['PurchaseDate'];
			  $idid = $row['ID'];
              
              $supplierID = $row['SupplierID'];
            }

            $result = mysqli_query($conn,"SELECT * FROM supplier WHERE Sup_ID = $supplierID ");
            while($row = mysqli_fetch_array($result)){
              GLOBAL $supname;
              $supname = $row['Name'];
            }
            $to = date("Y-m-d");
                $date1=date_create($dat);
                $date2=date_create( $to);
                $diff=date_diff($date2,$date1);
                $dif =  $diff->format("%a");
                if($dif >= 90){
            echo "<tr><td><a href='DetailedReportPOExtend.php?id=".$idid."'>".$poid."</a></td>";
            echo "<td>".$dat."</td>";
            
            echo "<td style='text-align:center;'>".$supname."</td>";
            
              
              $potot = 0;
            echo "<td class='text-right'>". number_format(totalpo($idid),2)."</td>";
            $potot = 0;
            $pot = $pot + totalpo($idid);
        }
            $steps = $steps + 1;
            }

            echo "<tr>";
            echo "<td style='border-top:1px solid;border-bottom:1px solid;'></td>";
            echo "<td style='border-top:1px solid;border-bottom:1px solid;'></td>";
            echo "<td style='text-align:right;border-top:1px solid;border-bottom:1px solid;'>TOTAL</td>";
            echo "<td style='text-align:right;border-top:1px solid;border-bottom:1px solid;'>".number_format($pot,2)."</td>";
            echo "<tr>";

            

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
