<?php session_start(); if(isset($_GET['id'])){$invoice =  $_GET['id'];} else {$invoice = $_SESSION['invoice'];} $userid = $_SESSION['id']; $company = $_SESSION['company'];
//echo $invoice;
$inv = $_SESSION['invoice'];
include'connection.php'; 
$result = mysqli_query($conn, "SELECT * FROM invoice WHERE  CompanyID = $company AND Inv_ID = $inv");
  while($row = mysqli_fetch_array($result)){
  $type = $row[12];
  }
?>

<head>
  <?php include 'title.php'; ?>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="Resource/css/bootstrap.min.css">
  <script src="Resource/jquery/jquery-1.11.3.min.js"></script>
  <script src="Resource/js/bootstrap.min.js"></script>
  <style>
@font-face {
    font-family: myFirstFont;
    src: url(Resource/Calibri.ttf);
}

body {
    font-family: myFirstFont;
}
    </style>
</head>
<body>
    <div id="dvContents" style="margin-left:10px;">
    <div class="container-fluid text-center">
<div class="row text-center" style="font-size:15px;">
    <?php 
    include 'connection.php';
    $result = mysqli_query($conn,"SELECT * FROM company WHERE ID = $company ");
            while($row = mysqli_fetch_array($result)){
              //GLOBAL $company,$address,$contact,$fax,$email;
              $companyname = $row[1];
              $address = $row[2];
              $contact = $row[3];
              $fax = $row[4];
              $email = $row[5];

            }
    mysqli_close($conn);
    ?>
    <div style="width:700px;font-size:15px;text-align:center;margin-left:15px;margin-bottom:-10px;">INVOICE</div>
    <div style="width:700px;font-size:20px;text-align:center;margin-left:15px;margin-bottom:-5px;"><?php echo $companyname; ?></div>
    <div style="width:700px;font-size:10px;text-align:center;margin-left:12px;"><?php echo "Address: ".$address.", Tel: ".$contact.", Fax:".$fax.", Email:".$email; ?></div>
  <!--description of invoice-->
  <?php 
  include 'connection.php';
  $result = mysqli_query($conn,"SELECT * FROM invoice WHERE Inv_ID = $invoice ");
            while($row = mysqli_fetch_array($result)){
              //GLOBAL $invdate,$cusid;
              $invdate = $row[1];
              $cusid = $row[4];
              $inv = $row[11];
            }
  if($type == 2 ){
              $result = mysqli_query($conn, "SELECT * FROM invoice WHERE Inv_ID = $invoice");
              while($row = mysqli_fetch_array($result)){
              $cusname = $row[13];
              }
            }
            else{

           
          $result = mysqli_query($conn, "SELECT * FROM cus_profile WHERE Cus_ID = $cusid ");
          while($row = mysqli_fetch_array($result)){
            //GLOBAL $name;
            $cusname =$row[1];
          }

            }
      $result = mysqli_query($conn,"SELECT * FROM deliver WHERE Invoice_ID = $invoice ");
            while($row = mysqli_fetch_array($result)){
              //GLOBAL $repid;
              $repid = $row[1];
              
            }
      

  mysqli_close($conn);
   ?>

  <div style="width:700px;font-size:10px;margin-top:5px;margin-left:20px;">
    
    <div style="width:400px;float:left;text-align:left;margin-left:30px;">
      Customer  : <b><?php echo $cusname; ?></b><br/>
       Invoice Number : <b><?php  $count = sprintf("%04d", $inv); echo $count; ?></b>
    </div>
  <div style="width:110px;float:left;text-align:left;">
     
     
      Invoice Date <br/>
    
    
      <br/>
      <br/>
    </div>
    <div style="width:160px;float:left;text-align:left;">
   
    
      : <?php echo $invdate; ?><br/>
       
        
       
    </div>
   
    
    <div style="width:700px;font-size:12px;clear:both;height:22px;border:1px solid;">
      
     
      <div style="width:352px;float:left;text-align:left;margin-left:-5px; padding-left:10px;">Product</div>
      <div style="width:47px;float:left;text-align:center;">Qty</div>
      <div style="width:90px;float:left;text-align:right;">Rate/Pc</div>
      <div style="width:88px;float:left;text-align:right;">Discount</div>
      <div style="width:120px;float:left;text-align:right;padding-right:5px;">Value (Rs.) </div>
    </div>
    
  </div>
  <!--end of invoice description-->
</div>

<div class="row" style="padding-left:15px;padding-right:25px;">
    
    
            
       
            <div style="width:700px;margin-left:-5px;padding-top:5px;"><table>
          <thead>
           
            <tr>
              
              </tr>

            

          </thead>
          <tbody>
            <?php 
            include 'connection.php';
           function name($id){
            include 'connection.php';
            $result = mysqli_query($conn,"SELECT * FROM item WHERE Item_ID = $id");
            while($row = mysqli_fetch_array($result)){
              //GLOBAL $name;
              $name = $row[2];
            }  
            return $name;
            mysqli_close($conn);
           }
       function code($id){
            include 'connection.php';
            $result = mysqli_query($conn,"SELECT * FROM item WHERE Item_ID = $id");
            while($row = mysqli_fetch_array($result)){
              //GLOBAL $code;
              $code = $row[1];
            }  
            return $code;
            mysqli_close($conn);
           }
             $subt = 0;
            $result = mysqli_query($conn,"SELECT * FROM sub_invoice WHERE Invoice_Inv_ID = $invoice");
            while($row = mysqli_fetch_array($result)){
              $sub = 0;
              echo "<tr>";
              
             
              
              echo "<td style='font-size:10px;width:352px;margin-top:2px;text-align:left;padding-left:15px;'>".name($row[8])."</td>";
              echo "<td style='font-size:10px;width:47px;margin-top:2px;text-align:center;'>".$row[1]."</td>";
              if($company == 2){
              echo "<td style='font-size:10px;width:90px;margin-top:2px;text-align:right;'>".number_format($row[3],2)."</td>";
            }
              else{
                echo "<td style='font-size:10px;width:90px;margin-top:2px;text-align:right;'>".number_format($row[5],2)."</td>";
              }
        echo "<td style='font-size:10px;width:88px;margin-top:2px;text-align:right;'>".$row[6]."%</td>";
        if($company == 2){
              $sub = (($row[1]*$row[3])*(100-$row[6]))/100;
            }
              else{
              $sub = (($row[1]*$row[5])*(100-$row[6]))/100;
              }
              echo "<td style='font-size:10px;margin-top:-10px;width:120px;margin-top:2px;text-align:right;margin-bottom:5px;'>".number_format($sub,2)."</td>";
                           
              echo "</td>";
             $subt = $subt + $sub;

            }    
            mysqli_close($conn);
            ?>
          </tbody>
          
        </table></div>
        <div style="height:75px;width:700px;margin-left:-5px;">
          <div >
            <div style="width:700px;float:left;text-align:right;font-size:12px;">
            Invoice Total: <?php echo number_format($subt,2) ?></br>
           

          </div>
          <div style="clear:both;margin-top:25px;text-align:left;font-size:10px;">
<?php if($type != 2){ ?>
<!--outstanding-->
<div style="width:700px;">
  <div style='width:450px;float:left;text-align:left;padding-right:5px;padding-top:5px;margin-left:20px;'><u style="border-bottom: 1px dotted gray;text-decoration: none;"><b>Outstanding Report</b></u></div>
<div style="width:700px;font-size:12px;clear:both;margin-top:5px;height:15px;border-color:#c2c2a3;padding-top:5px;margin-left:20px;">
      <div style="width:140px;float:left;text-align:left;"><u style="border-bottom: 1px dotted gray;text-decoration: none;"><b>Date</b></u></div>
      <div style="width:60px;float:left;text-align:center;"><u style="border-bottom: 1px dotted gray;text-decoration: none;"><b>Invoice No.</b></u></div>
      <div style="width:90px;float:left;text-align:right;"><u style="border-bottom: 1px dotted gray;text-decoration: none;"><b>Invoice Amount</b></u></div>
      <div style="width:115px;float:left;text-align:right;padding-right:5px;"><u style="border-bottom: 1px dotted gray;text-decoration: none;"><b>Balance</b></u></div>
      <div style="width:60px;float:left;text-align:right;padding-right:5px;"><u style="border-bottom: 1px dotted gray;text-decoration: none;"></u></div>
      
    </div>
<div style="width:600px;margin-left:20px;">       
<?php 
            
            include 'connection.php';
            $outtotal = 0;
            $count = 0;
            $result = mysqli_query($conn,"SELECT * FROM invoice WHERE Customer_id = $cusid AND status = '0' AND invoice = 1 ORDER BY InvDate ASC ");
            while($row = mysqli_fetch_array($result)){
              GLOBAL $count;
              $count = $count +1;
            }

            $steps = 1;
      
      $che = 0;
      $chebal = 0; 
      $cnt = 0;
            while($steps<=$count){

            $result = mysqli_query($conn,"SELECT * FROM invoice WHERE Customer_id = $cusid AND status = '0' AND invoice = 1 ORDER BY InvDate ASC LIMIT $steps");
            while($row = mysqli_fetch_array($result)){
              GLOBAL $invoiceID,$dat,$userID,$CustomerID,$Balance;              
              $invoiceID = $row['Inv_ID'];
              $dat = $row['InvDate'];
              $userID = $row['User_User_ID'];
              $CustomerID = $row['Customer_id'];
               $Balance = $row['Balance'];
            }

            $result = mysqli_query($conn,"SELECT * FROM deliver WHERE Invoice_ID = $invoiceID ");
            while($row = mysqli_fetch_array($result)){
              GLOBAL $deldate,$empid;
              $deldate = $row['DelDate'];
              $empid = $row['Employee_ID'];
            }

           



            $result = mysqli_query($conn,"SELECT * FROM user WHERE User_ID = $userID ");
            while($row = mysqli_fetch_array($result)){
              GLOBAL $repname;
              $repname = $row['UserName'];
            }
            $result = mysqli_query($conn,"SELECT * FROM cus_profile WHERE Customer_Cus_ID = $CustomerID ");
            while($row = mysqli_fetch_array($result)){
              GLOBAL $cusname;
              $cusname = $row['Name'];
            }
            echo "<div style='clear:both;width:480px;font-size:12px;'>";
            echo"<div style='width:150px;float:left;text-align:left;margin-bottom:5px;'>".$dat."</div>";
            echo"<div style='width:40px;float:left;text-align:center;margin-bottom:5px;'>".sprintf("%04d", $invoiceID)."</div>";
            
            

             $today = date("Y-m-d");
              $date1=date_create($dat);
                $date2=date_create( $today);
                $diff=date_diff($date2,$date1);
                $dif =  $diff->format("%a");
            
            
            
              $steps = $steps + 1;
              $t = 0;

              $result = mysqli_query($conn,"SELECT * FROM sub_invoice WHERE Invoice_Inv_ID = $invoiceID ");
            while($row = mysqli_fetch_array($result)){
              GLOBAL $qty,$wp,$Discount,$t;
              $qty = $row[1];
              $wp = $row[5];
              $Discount = $row[6];
              $sub = (100-$Discount);
                $sub = $sub * $qty *$wp;
                $sub = $sub/100;
                $t = $t + $sub;
            }
      
      $result = mysqli_query($conn,"SELECT * FROM cheque WHERE Customer_id = $CustomerID AND status = 0 ");
            while($row = mysqli_fetch_array($result)){
              GLOBAL $che;
              $che = $che + $row[2];
            }

                $tot = $t;
                $t = $t - $Balance;
        
        if($chebal == 0 && $cnt == 0){
      $chebal = $che;  $cnt = $cnt + 1;}

                echo "<div style='width:100px;float:left;text-align:right;margin-bottom:5px;'>".number_format($tot,2)."</div>";
            
            echo"<div style='width:115px;float:left;text-align:right;padding-right:5px;margin-bottom:5px;'>".number_format($t,2)."</div>";
      
       if($t>=$chebal && $chebal != 0){
        echo"<div style='width:60px;float:left;text-align:right;padding-right:5px;margin-bottom:5px;'>*chq (Rs.".$chebal.")</div>";
        $chebal = 0;
      }
      else if($t < $chebal){
        echo"<div style='width:60px;float:left;text-align:right;padding-right:5px;margin-bottom:5px;'>*chq (Rs.".$t.")</div>";
        $chebal = $chebal - $t; 
        
      }

            
            
            $outtotal = $outtotal + $t;
            
            }
            echo"<div style='clear:both;'></div>";
            

           
            
      
            
      echo "<div style='width:clear:both;width:700px;font-size:15px;margin-top:20px;text-align:left;'><b>** 30 Days Credit Period Only **</b></div>";
            

           
            ?>
</div>

</div>
<!--outstanding end--> <?php } ?>
            <div style='float:left;width:270px;margin-left:15px;margin-top:25px;text-align: center;'>.................................</br> Pepared By </div><div style='float:left;width:140px;text-align:left;margin-top:25px;margin-left:5px;text-align: center;'>.................................</br> Representative  </div><div style='float:left;width:250px;text-align:right;margin-top:25px;text-align: center;'>.................................</br> Customer</div>
          </div>
          
            
            </div>

        </div>
                   
     
        </div>
    <div style='float:left;width:700px;margin-left:10px;font-size:7px;text-align:right;'>Designed and Maintained By Advanced Information Technology (Pvt) LTD. [Contact: 071-5902599]</div>
<div/>


    </div>
    <script>
//window.print();
</script>
<script>
//window.location.assign("NewInvoicePrimary.php");
</script>


<body/>