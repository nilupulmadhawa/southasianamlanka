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
<body>
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
    <div class="col-sm-12 text-left" style="margin-top:10px;background-color: #F8F8F8;"> 
      <div class="row">
      <div class="col-sm-12 text-left">
        <!--form start-->
		<?php 
    include 'connection.php';
		$result = mysqli_query($conn,"SELECT * FROM company WHERE ID = $company ");
        while($row=mysqli_fetch_array($result)) {
		GLOBAL $ComName,$address;
		$ComName = $row[1];
		$address = $row[2];
		}	
		?>
		
		
         <!--form end-->
         <div class="col-sm-12" id="txtHint" style="margin-top:10px;">

          <!--start of the tabele--><div>
        <table width="97%" style="font-size:15px;">
        <thead>
        <tr style="border-top:2px solid;border-bottom:2px solid;">
        <th class="tablecol1" >Inv No</th>
        <th class="tablecol1">Inv Date</th>
        <th class="tablecol1 text-right">0-30</th>
        <th class="tablecol1 text-right">30-60</th>
        <th class="tablecol1 text-right">60-90</th>
        <th class="tablecol1 text-right">>90</th>
        <th class="tablecol1 text-right">Balance</th>
              
        
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
            $result1 = mysqli_query($conn,"SELECT * FROM cus_profile WHERE CompanyID = $company ORDER BY Address ASC,Name ASC ");
            while($row=mysqli_fetch_array($result1)) {
              $count = $count + 1;
              }
              //echo $count;
              $steps = 1;
			  $totalone = 0;
			  $totaltwo = 0;
			  $totalthree = 0;
			  $totalfour = 0;
			  $totalfive = 0;
				$totalsix = 0;
			 
            while($steps <= $count){
              $result1 = mysqli_query($conn,"SELECT * FROM cus_profile WHERE CompanyID = $company ORDER BY Address ASC,Name ASC LIMIT $steps");
              while($row=mysqli_fetch_array($result1)) {
              GLOBAL $name,$cusid,$contact,$addres;
             $name = $row[1];
             $cusid = $row[0];
			       $contact = $row[7];
			       $addres = $row[3];
              }

              $che = 0;
              //echo $name."</br>";
			  //get the cheque amount
			  
				$rowcount = 0;
              $result2 = mysqli_query($conn,"SELECT * FROM invoice WHERE Customer_id = $cusid AND status = 0 AND deliver = 0 ORDER BY InvDate ASC ");
              $rowcount=mysqli_num_rows($result2);
			  if($rowcount> 0){
			  echo "<tr style='height:50px;'>";
			  echo "<td colspan='8'>".$name." - (".sprintf("%04d", $cusid).")"." - ".$addres." - ".$contact."</td>";
			  echo "</tr>";}
			  $one = 0;
			  $two = 0;
			  $three = 0;
			  $four = 0;
			  $five = 0;
				$six = 0;
				
				
              $ncount = 0;
              if($rowcount != 0){
                $s = 1;
                while($s <= $rowcount){
                  $result1 = mysqli_query($conn,"SELECT * FROM invoice WHERE Customer_id = $cusid AND status = 0 AND deliver = 0 ORDER BY InvDate ASC LIMIT $s ");
                while($row=mysqli_fetch_array($result1)) {
                  GLOBAL $inid,$bal,$dat,$inv;
                  $inid = $row[0];
                  $bal = $row[6];
                  $dat = $row[1];
				  $inv = $row[11];
                }
				$to = date("Y-m-d");
                $date1=date_create($dat);
                $date2=date_create( $to);
                $diff=date_diff($date2,$date1);
                $dif =  $diff->format("%a");
				$total = 0;
                $total = sum($inid);
                $ncount = $ncount + 1;

                echo "<tr>";
                $in = sprintf("%04d", $inv);
				echo "<td class='text-left'>".$in."</td>";
				echo "<td class='text-center'>".$dat."</td>";
				if($dif < 30){
                echo "<td class='text-right'>".number_format($total,2)."</td>";
				echo "<td class='text-right'> ".number_format(0,2)."</td>";
				echo "<td class='text-right'> ".number_format(0,2)."</td>";
				echo "<td class='text-right'> ".number_format(0,2)."</td>";
				$one = $one + $total;
				}
				if($dif < 60 && $dif >= 30){
				echo "<td></td>";
                echo "<td class='text-right'>".number_format($total,2)."</td>";
				
				echo "<td class='text-right'> ".number_format(0,2)."</td>";
				echo "<td class='text-right'> ".number_format(0,2)."</td>";

				$two = $two + $total;
				
				}
				if($dif < 90 && $dif >= 60){
				echo "<td></td>";
				echo "<td></td>";
                echo "<td class='text-right'>".number_format($total,2)."</td>";
				
				echo "<td></td>";

				$three = $three + $total;
				
				}
				
				if($dif >= 90){
				echo "<td></td>";

				echo "<td></td>";
				echo "<td class='text-right'> ".number_format(0,2)."</td>";
                echo "<td class='text-right'>".number_format($total,2)."</td>";
				$five = $five + $total;
				}
				$balance = 0;
				$balance = $total - $bal;
				$six = $six + $balance;
				echo "<td class='text-right'>".number_format($balance,2)."</td>";
                echo "</tr>";

                $s = $s + 1;

                }
				
				echo "<tr style='border:1px solid;'>";
				echo "<td></td>";
				echo "<td></td>";
				echo "<td class='text-right'>".number_format($one,2)."</td>";
				$totalone = $totalone + $one;
				echo "<td class='text-right'>".number_format($two,2)."</td>";
				$totaltwo = $totaltwo + $two;
				echo "<td class='text-right'>".number_format($three,2)."</td>";
				$totalthree = $totalthree + $three;
				echo "<td class='text-right'>".number_format($five,2)."</td>";
				$totalfive = $totalfive + $five;
				echo "<td class='text-right'>".number_format($six,2)."</td>";
				$totalsix = $totalsix + $six;
				echo "</tr>";

             
            }
			
			
              $steps = $steps + 1;
              $rowcount = 0;
            }
			echo "<tr>";
				echo "<td>-------</td>";
				echo "<td class='text-center'>-------</td>";
				echo "<td class='text-right'>-------</td>";
				
				echo "<td class='text-right'>-------</td>";
				
				echo "<td class='text-right'>-------</td>";
				
				echo "<td class='text-right'>-------</td>";
				

				
				echo "<td class='text-right'>-------</td>";
				
				echo "</tr>";
			echo "<tr style='border:1px solid;margin-top:10px;'>";
				echo "<td></td>";
				echo "<td><b>TOTAL</b> </td>";
				echo "<td class='text-right'>".number_format($totalone,2)."</td>";
				
				echo "<td class='text-right'>".number_format($totaltwo,2)."</td>";
				
				echo "<td class='text-right'>".number_format($totalthree,2)."</td>";
				
				
				echo "<td class='text-right'>".number_format($totalfive,2)."</td>";
				
				echo "<td class='text-right'>".number_format($totalsix,2)."</td>";
				
				echo "</tr>";
				
            
?>
 </tbody>
        </table>
      <!--end of the tabele--></div>
	 
         </div>

      </div> 

     
    </div>
    
    </div>
    
  </div>
<script>
window.print();
</script>
</div>

</body>
</html>
