<?php session_start(); $invoice =  $_GET['id'];$userid = $_SESSION['id']; $company = $_SESSION['company'];?>

<head>
  <title>Dinu Distributers Admin Panel</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="Resource/css/bootstrap.min.css">
  <script src="Resource/jquery/jquery-1.11.3.min.js"></script>
  <script src="Resource/js/bootstrap.min.js"></script>
  <style>
@font-face {
    font-family: myFirstFont;
    src: url(Resource/LUCON.TTF);
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
              GLOBAL $company,$address,$contact,$fax,$email;
              $companyname = $row[1];
              $address = $row[2];
              $contact = $row[3];
              $fax = $row[4];
              $email = $row[5];

            }
    mysqli_close($conn);
    ?>
    <div style="width:700px;font-size:20px;text-align:left;margin-left:15px;margin-bottom:-20px;">INVOICE</div>
    <div style="width:700px;font-size:28px;text-align:center;margin-left:15px;margin-bottom:-5px;"><?php echo $companyname; ?></div>
    <div style="width:700px;font-size:12px;text-align:center;margin-left:12px;"><?php echo "Address: ".$address.", Tel: ".$contact.", Fax:".$fax.", Email:".$email; ?></div>
  <!--description of invoice-->
  <?php 
  include 'connection.php';
  $result = mysqli_query($conn,"SELECT * FROM invoice WHERE Inv_ID = $invoice ");
            while($row = mysqli_fetch_array($result)){
              GLOBAL $invdate,$cusid;
              $invdate = $row[1];
              $cusid = $row[4];
            }
  $result = mysqli_query($conn,"SELECT * FROM cus_profile WHERE Cus_ID = $cusid ");
            while($row = mysqli_fetch_array($result)){
              GLOBAL $cusname,$address,$contact;
              $cusname = $row[1];
              $address = $row[3];
              $contact = $row[7];
            }
			$result = mysqli_query($conn,"SELECT * FROM deliver WHERE Invoice_ID = $invoice ");
            while($row = mysqli_fetch_array($result)){
              GLOBAL $repid;
              $repid = $row[1];
              
            }
			$result = mysqli_query($conn,"SELECT * FROM user_profile WHERE Prof_ID = $repid ");
            while($row = mysqli_fetch_array($result)){
              GLOBAL $repname,$repcode;
              $repname = $row[1];
              $repcode = $row[10];
            }

  mysqli_close($conn);
   ?>

  <div style="width:700px;font-size:12px;margin-top:5px;border:1px solid;margin-left:10px;border-color:#c2c2a3;">
    <div style="width:170px;float:left;text-align:left;margin-left:5px;">
      Invoice Number </br>
      Invoice Date <br/>
	  Contact Number<br/>
	  Representative<br/>
      <br/>
      <br/>
    </div>
    <div style="width:175px;float:left;text-align:left;">
      : <?php $count = sprintf("%04d", $invoice); echo $count; ?></br>
      : <?php echo $invdate; ?><br/>
       : <?php echo $contact; ?><br/>
        :<?php echo $repname." (".$repcode.")"; ?>
       
    </div>
    <div style="width:330px;float:left;text-align:left;">
      <u>Customer Name:</u> </br><?php echo $cusname; ?></br>
		<u>Address:</u> <br/><?php echo  $address; ?>
      
      
    </div>
   
    
    <div style="width:700px;font-size:12px;clear:both;border-top:0.5px solid;border-bottom:0.5px solid;height:32px;border-color:#c2c2a3;">
      <div style="width:47px;float:left;text-align:center;">Qty</div>
      <div style="width:67px;float:left;text-align:center;">Code</div>
      <div style="width:245px;float:left;text-align:left;margin-left:-5px; padding-left:5px;">Product</div>
      <div style="width:68px;float:left;text-align:center;">Free Issue</div>
      <div style="width:80px;float:left;text-align:right;">Unit Price</div>
      <div style="width:68px;float:left;text-align:right;">Discount</div>
      <div style="width:120px;float:left;text-align:right;padding-right:5px;">Amount (Rs.) </div>
    </div>
    
  </div>
  <!--end of invoice description-->
</div>

<div class="row" style="padding-left:15px;padding-right:25px;">
    
    
            
       
            <div style="height:655px;border:1px solid;border-color:gray;width:700px;margin-left:-5px;padding-top:5px;"><table>
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
              GLOBAL $name;
              $name = $row[2];
            }  
            return $name;
            mysqli_close($conn);
           }
		   function code($id){
            include 'connection.php';
            $result = mysqli_query($conn,"SELECT * FROM item WHERE Item_ID = $id");
            while($row = mysqli_fetch_array($result)){
              GLOBAL $code;
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
              echo "<td style='font-size:12px;width:43px;margin-top:2px;text-align:center;'>".$row[1]."</td>";
              echo "<td style='font-size:12px;width:67px;margin-top:2px;text-align:center;'>".code($row[8])."</td>";
              
              echo "<td style='font-size:12px;width:245px;margin-top:2px;text-align:left;padding-left:5px;'>".name($row[8])."</td>";
              echo "<td style='font-size:12px;width:48px;margin-top:2px;text-align:center;'>".  $row[2]."</td>";
              echo "<td style='font-size:12px;width:100px;margin-top:2px;text-align:right;'>".number_format($row[3],2)."</td>";
			  echo "<td style='font-size:12px;width:58px;margin-top:2px;text-align:center;'>".$row[6]."</td>";
              $sub = (($row[1]*$row[3])*(100-$row[6]))/100;
              echo "<td style='font-size:12px;margin-top:-10px;width:120px;margin-top:2px;text-align:right;margin-bottom:5px;'>".number_format($sub,2)."</td>";
                           
              echo "</td>";
             $subt = $subt + $sub;

            }    
            mysqli_close($conn);
            ?>
          </tbody>
          
        </table></div>
        <div style="height:75px;border:1px solid;border-color:gray;width:700px;margin-left:-5px;">
          <div >
            <div style="width:680px;float:left;text-align:right;font-size:15px;">
            Bill Total: <?php echo number_format($subt,2) ?></br>
          </div>
          <div style="clear:both;margin-top:25px;text-align:left;font-size:12px;">

            <div style='float:left;width:270px;margin-left:15px;margin-top:5px;'>Pepared By:................................. </div><div style='float:left;width:140px;text-align:left;margin-top:5px;margin-left:5px;'>Customer <br/>Signature: </div><div style='float:left;width:150px;text-align:right;margin-top:5px;'>Customer <br/>Seal: </div>
          </div>
          
            
            </div>

        </div>
                   
     
        </div>
		<div style='float:left;width:700px;margin-left:10px;font-size:10px;'>Designed and Maintained By Advanced Information Technology (Pvt) LTD. [Contact: 071-5902599]</div>
<div/>


    </div>
    <script>
window.print();
</script>



<body/>