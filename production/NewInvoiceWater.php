<?php 

session_start(); 

if(!isset($_SESSION['company'])){
  header('location:logout.php');
}
$id1 = $_SESSION['id']; 
$company = $_SESSION['company'];
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
        xmlhttp.open("GET","getfree.php?q="+str,true);
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
        xmlhttp.open("GET","getfree2.php?q="+str,true);
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
    <div class="col-sm-2 sidenav">
      <?php include 'SideBarMaintain.php'; ?>
    </div>
    <div class="col-sm-8 text-left" style="margin-top:10px;background-color: #F8F8F8;"> 
      <div class="row">
      <div class="col-sm-6 text-left">
        
      <!--start of the form-->
       <form role="form" method="post" action="ConnectionNewInvoiceWater.php">
        
        
        <div class="form-group">
          <label>Product Code:</label>
          <select class="form-control" name="product" autofocus="on" onchange="showUser(this.value)"  >
            <?php include'connection.php'; $result = mysqli_query($conn, "SELECT * FROM item WHERE  CompanyID = $company ORDER BY ItemCode ASC");
            while($row = mysqli_fetch_array($result)){
              echo "<option value = '".$row[0]."'>".$row[1]." (".$row[2].")"."</option>";
              }
              mysql_close($conn);
             ?>
          </select>
        </div>
		<div  id="txtHint"></div>
        <div class="form-group">
          <label>Quantity:</label>
          <input type="text" class="form-control" placeholder="Quantity" name="qty"  autocomplete="off" onkeyup="showUser1(this.value)">
        </div>
		<div  id="txtHint1"></div>
        

        
        <button type="submit" class="btn btn-default">Add</button>
      </form>
      <!--end of the form-->
	  
      </div> 
      <div class="col-sm-6">
        <div style="margin-top:25px;">
          <p>Invoice Number: <b><?php if(!isset($_SESSION['invoicewater'])){echo "No Selected Invoice Number";}else{$invoice =  $_SESSION['invoicenumber']; $invoice = sprintf("%04d", $invoice);echo $invoice;} ?></b></p>
          <p>Customer Name: <b><?php  $invoice =  $_SESSION['invoicewater']; if(!isset($_SESSION['invoicewater'])){echo "No Selected Customer";}
          else{ $cus = $_SESSION['customer'];
          $result = mysqli_query($conn, "SELECT * FROM cus_profile WHERE Cus_ID = $cus ");
          while($row = mysqli_fetch_array($result)){
            GLOBAL $name;
            $name =$row[1];
          }

          echo $name;}
          mysqli_close($conn); ?></b></p>
          <p>Number Of Items Added: <b><?php include 'connection.php';  $invoice =  $_SESSION['invoicewater']; if(!isset($_SESSION['invoicewater'])){echo "Empty";} else{ $count = 0; $result = mysqli_query($conn, "SELECT * FROM temp_invoice WHERE Invoice_ID = $invoice ");
          while($row = mysqli_fetch_array($result)){
            GLOBAL $count;
            $count = $count + 1;
          }
          echo $count;}
          mysqli_close($conn);
           ?></b></p>
           
          
           
        </div>		
		<div class="col-sm-12" style="margin-top:5px;">
		<?php if(isset($_SESSION['error']) ){ ?>
		<div class="alert alert-danger">
		  <strong>Warning!</strong> Cannot Proceed With The Submitted Quantity.
		</div>
		<?php unset($_SESSION['error']); }?>
		</div>
		
      </div>  
    </div>
    <div class="row">
      <br/>
      <!--start of the tabele--><div style="height:150px;overflow:auto;">
        <table class="table table-striped" width="100%" style="font-size:12px;">
        <thead>
        <tr>
        <th class="tablecol1">Product Name</th>
        <th class="tablecol3">Qty</th>
                
        <th class="tablecol3">WholeSale Price</th>
        
        <th class="tablecol3">Discount</th>
        <th class="tablecol3">Sub Total</th>
        <th class="tablecol3"></th>
        </tr>
      </thead>
         <tbody>
            <?php include 'connection.php'; 
            include 'functions/catname.php';
            if(isset($_SESSION['invoicewater'])){
              $invoice =  $_SESSION['invoicewater'];

             $count = 0; 
            $result = mysqli_query($conn,"SELECT * FROM temp_invoice WHERE  Invoice_ID = $invoice");
              while($row=mysqli_fetch_array($result)) {
               $count = $count + 1;
              }
              $steps = 1;
              $total = 0;
              while($steps <= $count){
                $result = mysqli_query($conn,"SELECT * FROM temp_invoice WHERE  Invoice_ID = $invoice ORDER BY Temp_Invoice_ID ASC LIMIT $steps");
              while($row=mysqli_fetch_array($result)) {
              GLOBAL $item_id,$qty,$RetPrice,$CostPrice,$FreeIssue,$Discount;
              $item_id = $row[1];
              $qty = $row[2];
              $RetPrice = $row[3];
              $wp = $row[5];
              
              $Discount = $row[6];
              $temid = $row[0];
              }

              $result1 = mysqli_query($conn,"SELECT * FROM item WHERE Item_ID = $item_id ");
              while($row=mysqli_fetch_array($result1)) {
              GLOBAL $name;
              $name = $row[2];
              }

              echo "<tr><td>".$name."</td>";
              echo "<td>".$qty."</td>";
             
              echo "<td>Rs. ".number_format($wp,2)."</td>";
             
              echo "<td>".$Discount."%</td>";
              $sub = (100-$Discount);
              $sub = $sub * $qty *$wp;
              $sub = $sub/100;
              echo "<td>Rs.".number_format($sub,2)."</td>";
              echo "<td> <a href='DeleteTempItem.php?id=".$temid."'> DELETE </a></td></tr>";
              $total = $total + $sub;
              $steps = $steps + 1;
              }
              echo "<tr><td></td><td></td><td></td><td><b>TOTAL</b></td><td><b>Rs. ".number_format($total,2)."</b></td></tr>";
             
              
            }
             ?>
          </tbody>
        </table>
      <!--end of the tabele-->

    </div>
    <button type="submit" class="btn btn-primary" onClick="document.location.href='ConnectionSumitInvoice.php'">SUBMIT THE INVOICE</button>
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
