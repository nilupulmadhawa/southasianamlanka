<?php 
session_start(); 
$id1 = $_SESSION['id']; 
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Dinu Distributers Admin Panel</title>
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
    <div class="col-sm-2 sidenav">
      <?php include 'SideBarMaintain.php'; ?>
    </div>
    <div class="col-sm-8 text-left" style="margin-top:10px;background-color: #F8F8F8;"> 
      <div class="row">
      <div class="col-sm-12 text-left">
         <!--start of the tabele--><div style="height:250px;overflow:auto;">
        <table class="table table-striped" width="100%" style="font-size:12px;">
        <thead>
        <tr>
        <th class="tablecol1">Product Name</th>
        <th class="tablecol3">Qty</th>
        <th class="tablecol3">Free Issue</th>        
        <th class="tablecol3">Retail Price</th>
        <th class="tablecol3">Wholesale Price</th>
        <th class="tablecol3">Discount</th>
        <th class="tablecol3">Sub Total</th>
        </tr>
      </thead>
         <tbody>
            <?php include 'connection.php'; 
            include 'functions/catname.php';
            if(isset($_GET['id'])){
              $invoice =  $_GET['id'];

             $count = 0; 
            $result = mysqli_query($conn,"SELECT * FROM sub_invoice WHERE  Invoice_inv_ID = $invoice");
              while($row=mysqli_fetch_array($result)) {
               $count = $count + 1;
              }
              $steps = 1;
              $total = 0;
              while($steps <= $count){
                $result = mysqli_query($conn,"SELECT * FROM sub_invoice WHERE  Invoice_inv_ID = $invoice LIMIT $steps");
              while($row=mysqli_fetch_array($result)) {
              GLOBAL $item_id,$qty,$RetPrice,$CostPrice,$FreeIssue,$Discount;
              $item_id = $row[8];
              $qty = $row[1];
              $RetPrice = $row[3];
              $wp = $row[5];
              $FreeIssue = $row[2];
              $Discount = $row[6];
              }

              $result1 = mysqli_query($conn,"SELECT * FROM item WHERE Item_ID = $item_id ");
              while($row=mysqli_fetch_array($result1)) {
              GLOBAL $name;
              $name = $row[1];
              }

              echo "<tr><td>".$name."</td>";
              echo "<td>".$qty."</td>";
              echo "<td>".$FreeIssue."</td>";
              echo "<td>Rs. ".number_format($RetPrice,2)."</td>";
              echo "<td>Rs.".number_format($wp,2)."</td>";
              echo "<td>".$Discount."%</td>";
              $sub = (100-$Discount);
              $sub = $sub * $qty *$wp;
              $sub = $sub/100;
              echo "<td>Rs.".number_format($sub,2)."</td></tr>";
              $total = $total + $sub;
              $steps = $steps + 1;
              }
              echo "<tr><td></td><td></td><td></td><td></td><td></td><td><b>TOTAL</b></td><td><b>Rs. ".number_format($total,2)."</b></td></tr>";
              
            }
            $_SESSION['invoice'] = $invoice;
             ?>
          </tbody>
        </table>
      <!--end of the tabele--></div>
      <div style="margin-top:25px;">
          <p>Invoice Number: <b><?php 
		  if(!isset($_SESSION['invoice'])){echo "No Selected Invoice Number";}
		  else{
			$invoice =  $_SESSION['invoice']; 
			$result = mysqli_query($conn, "SELECT * FROM invoice WHERE Inv_ID = $invoice ");
          while($row = mysqli_fetch_array($result)){
            GLOBAL $inv;
            $inv =$row[11];
          }
			
			
		  $inv = sprintf("%04d", $inv);
		  echo $inv;
		  } 
		  ?></b></p>
          <p>Customer Name: <b><?php  $invoice =  $_SESSION['invoice']; if(!isset($_SESSION['invoice'])){echo "No Selected Customer";}
          else{ $result = mysqli_query($conn, "SELECT * FROM invoice WHERE Inv_ID = $invoice ");
          while($row = mysqli_fetch_array($result)){
            GLOBAL $cus,$rep;
            $cus =$row[4];
            $rep = $row[3];
          }
          $result = mysqli_query($conn, "SELECT * FROM cus_profile WHERE Cus_ID = $cus ");
          while($row = mysqli_fetch_array($result)){
            GLOBAL $name;
            $name =$row[1];
          }
          $result = mysqli_query($conn, "SELECT * FROM user_profile WHERE Prof_ID = $rep ");
          while($row = mysqli_fetch_array($result)){
            GLOBAL $repname;
            $repname =$row[1];
          }

          echo $name;}
          mysqli_close($conn); ?></b></p>
          <p>Representative Name: <b><?php echo $repname; ?></b></p>
          <p>Invoice Total: <b><?php echo "Rs. ".number_format($total,2); ?></b></p>
          
           
           
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
