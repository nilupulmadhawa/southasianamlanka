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
	   
        <a href='60dayasoutstandingprint.php' target="_blank"><img src='images/print.png' width='50' height='50'>
		<p style="margin-left:-10px;">Print Report</p></a>
		</div>
      <div class="col-sm-12 text-left">

         <!--start of the table-->
         <div style="height:450px;overflow:auto;">
        <table class="table table-striped" width="100%" style="font-size:15px;">
        <thead>
        <tr>
        <th class="tablecol1">Customer Name</th>
        <th class="tablecol1">Address</th>
        <th class="tablecol1">Contact</th>
        <th class="tablecol1 text-center">Date</th>
        <th class="tablecol3 text-center">Invoice Number</th>
        <th class="tablecol3 text-right">Amount</th> 
        <th class="tablecol3 text-right">Balance</th>        
        
        </tr>
      </thead>
         <tbody>
<?php
function sum($invoice){
            include 'connection.php';
      
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
                  GLOBAL $item_id,$qty,$RetPrice,$CostPrice,$FreeIssue,$Discount,$total;
                  $item_id = $row[8];
                  $qty = $row[1];
                  $RetPrice = $row[3];
                  $wp = $row[5];
                  $FreeIssue = $row[2];
                  $Discount = $row[6];
                  }

                  $sub = (100-$Discount);
                  $sub = $sub * $qty *$wp;
                  $sub = $sub/100;
                  
                  $total = $total + $sub;
                  $steps = $steps + 1;
                  }
                  return $total;
          }
          $today = "2014-01-01";

          include 'connection.php';
         
          
      

           // echo $route."</br>";

            

            //echo $invdate."</br>";
            $count = 0;
            $result1 = mysqli_query($conn,"SELECT * FROM cus_profile WHERE CompanyID = $company ");
            while($row=mysqli_fetch_array($result1)) {
              $count = $count + 1;
              }
              //echo $count;
              $steps = 1;
        $one = 0;
        $two = 0;
        $three = 0;
        $four = 0;
        $five = 0;
            while($steps <= $count){
              $result1 = mysqli_query($conn,"SELECT * FROM cus_profile WHERE CompanyID = $company LIMIT $steps");
              while($row=mysqli_fetch_array($result1)) {
              GLOBAL $name,$cusid,$contact,$address;
              $name = $row[1];
              $cusid = $row[0];
        $contact = $row[7];
        $address = $row[3];
              }

              $che = 0;
              //echo $name."</br>";
        //get the cheque amount
        

              $result2 = mysqli_query($conn,"SELECT * FROM invoice WHERE Customer_id = $cusid AND status = 0 ORDER BY InvDate ASC ");
              $rowcount=mysqli_num_rows($result2);

              $ncount = 0;
              if($rowcount != 0){
                $s = 1;
                while($s <= $rowcount){
                  $result1 = mysqli_query($conn,"SELECT * FROM invoice WHERE Customer_id = $cusid AND status = 0 ORDER BY InvDate ASC LIMIT $s ");
                while($row=mysqli_fetch_array($result1)) {
                  GLOBAL $inid,$bal,$dat;
                  $inid = $row[0];
                  $bal = $row[6];
                  $dat = $row[1];
                }
        $to = date("Y-m-d");
                $date1=date_create($dat);
                $date2=date_create( $to);
                $diff=date_diff($date2,$date1);
                $dif =  $diff->format("%a");

                $total = sum($inid);
                $ncount = $ncount + 1;

                echo "<tr>";
                if($dif >= 60 ){
                if($ncount == 1){ 
        echo "<td>".$name."</td>"; 
        echo "<td>".$address."</td>"; 
        echo "<td>".$contact."</td>"; 
        }
                else { 
        echo "<td> </td>"; 
        echo "<td> </td>"; 
        echo "<td> </td>"; 
        }
               
                echo "<td class='text-center'>".$dat."</td>";
        
                $in = sprintf("%04d", $inid);
        echo "<td class='text-center'>".$in."</td>";
        echo "<td class='text-right'>". number_format($total,2)."</td>";
        
        
        
                
               $che1 = " ";
                
              $balance = $total - $bal;
        
                
        
       
       
       
        
                echo "<td class='text-right'>".number_format($balance,2)." ".$che1."</td>";
        $balred = $five + $balance;
        }
                echo "</tr>";
                $balance = 0;
                $total = 0;

                $s = $s + 1;

                }

             
            }
              $steps = $steps + 1;
              $rowcount = 0;
            }
            

          
?>
 </tbody>
        </table>
      <!--end of the tabele--></div>

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
