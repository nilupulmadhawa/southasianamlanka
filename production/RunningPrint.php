<?php session_start(); ?>

<head>
  <title>DHN Vetmedicare Admin Panel</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="Resource/css/bootstrap.min.css">
  <script src="Resource/jquery/jquery-1.11.3.min.js"></script>
  <script src="Resource/js/bootstrap.min.js"></script>
  <style>
    @media print
{
  #content { display:none;}
  #dvContents { display:block;}
}
    </style>
</head>
<body>
    <div id="dvContents">
    <div class="container-fluid text-center">
<div class="row text-center" style="font-size:50px;">
    RUNNING CHART
</div>
<div class="row text-center" style="font-size:12px;">
    <div class="col-sm-6 text-left" style="font-size:15px;">
        <p><b>Rep name: </b><?php
            include 'connection.php';
            $repDate = $_SESSION['repid']; 
            $result = mysqli_query($conn,"SELECT * FROM user_profile WHERE Prof_ID = $repDate ");
            while($row = mysqli_fetch_array($result)){
            echo $row['Name'];
            }
            ?></p>
         <p><b>Date: </b><?php
            $repID = $_SESSION['repdate'];
             echo $repID;
            ?></p>
         <p><b>Vehical Number: </b><?php
            include 'connection.php';
            $repDate = $_SESSION['repid']; 
            $result = mysqli_query($conn,"SELECT * FROM day_start WHERE Rep_id = $repDate ");
            while($row = mysqli_fetch_array($result)){
            echo $row[1];
            }
            ?></p>
    </div>
</div>
<div class="row">
    
    
            
       
            <table class="table table-striped">
          <thead>
            <tr>
              <th>Time</th>
              <th>Meter</th>
              <th>Place</th>
              <th>Order</th>
              <th>Cash</th>
              <th>Cheque</th>
              <th>Delivery</th>
              <th>Purchase</th>
            </tr>
          </thead>
          <tbody>
            <?php 
            include 'connection.php';
            $todaydate = date("Y-m-d");
            $torder = 0;
            $tcash = 0;
            $tcheque = 0;
            $tdelivery = 0;
            $tpurchase = 0;
            $count = 0;
             if(isset($_SESSION['check']) && $_SESSION['check'] = 1){
                $repID = $_SESSION['repdate'];    
                $repDate = $_SESSION['repid']; 
            $result = mysqli_query($conn,"SELECT * FROM running_chart WHERE meterdate = '$repID' && rep_id = $repDate ");
            while($row = mysqli_fetch_array($result)){
              echo "<tr>";
              echo "<td>".$row[4]."</td>";
              echo "<td>".$row[1]."</td>";
              echo "<td>".$row[2]."</td>";
              echo "<td>".$row[6]."</td>";
              echo "<td>".$row[7]."</td>";
              echo "<td>".$row[8]."</td>";
              echo "<td>".$row[9]."</td>";
              echo "<td>".$row[10]."</td>";              
              echo "</td>";
              $torder  = $torder + $row[6];
              $tcash  = $tcash + $row[7];
              $tcheque  = $tcheque + $row[8];
              $tdelivery  = $tdelivery + $row[9];
              $tpurchase  = $tpurchase + $row[10];

            }    }
            mysqli_close($conn);
            ?>
          </tbody>
          <tr><td></td><td></td><td><b>Total:</b><b></td><td><?php echo $torder; ?></td><td><?php echo $tcash; ?></td><td><?php echo $tcheque; ?></td><td><?php echo $tdelivery; ?></td><td><?php echo $tpurchase; ?></td></b></tr>
        </table>
            
     
        </div>
<div/>

<div class="row text-left" style="font-size:50px;">
    <div class="col-sm-6" style="font-size:20px;margin-top:50px;">
    Rep Signature:
</div>
<div class="col-sm-6" style="font-size:20px;margin-top:50px;">
    Recived By:
</div>
</div>
    </div>
    <script>
window.print();
</script>
<script>
     window.location.assign("RunningChardDetailed.php")

</script>
<body/>