<?php session_start(); ?>
<div class="row" style="font-size:20px;text-align:center;padding-right:20px;border:1px solid;"><a href="LroutePrint.php" target="_blank">Print</a></div>
<!--start of the tabele--><div style="height:450px;overflow:auto;">
<table class="table table-striped" width="100%" style="font-size:15px;">
  <thead>
    <tr>
      <th class="tablecol1">Customer Name</th>
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

    $route = $_REQUEST["q"];
    $_SESSION['route'] = $route;


    // echo $route."</br>";



    //echo $invdate."</br>";
    $count = 0;
    $result1 = mysqli_query($conn,"SELECT * FROM cus_profile WHERE Cus_ID = '$route' ");
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

    $bal1 = 0;
    $bal2 = 0;
    $bal3 = 0;
    $bal4 = 0;
    $bal5 = 0;

    while($steps <= $count){
      $result1 = mysqli_query($conn,"SELECT * FROM cus_profile WHERE Cus_ID = '$route' LIMIT $steps");
      while($row=mysqli_fetch_array($result1)) {
        GLOBAL $name,$cusid,$contact;
        $name = $row[1];
        $cusid = $row[0];
        $contact = $row[7];
      }

      $che = 0;
      //echo $name."</br>";
      //get the cheque amount


      $result2 = mysqli_query($conn,"SELECT * FROM invoice WHERE Customer_id = $cusid AND Allocated = 1 ORDER BY InvDate ASC ");
      $rowcount=mysqli_num_rows($result2);

      $ncount = 0;
      if($rowcount != 0){
        $s = 1;
        while($s <= $rowcount){
          $result1 = mysqli_query($conn,"SELECT * FROM invoice WHERE Customer_id = $cusid AND Allocated = 1 ORDER BY InvDate ASC LIMIT $s ");
          while($row=mysqli_fetch_array($result1)) {
            // GLOBAL $inid,$bal,$dat;
            $inid = $row[0];
            $bal = $row[6];
            $dat = $row[1];
            $BillID = $row['BillID'];
          }
          $to = date("Y-m-d");
          $date1=date_create($dat);
          $date2=date_create( $to);
          $diff=date_diff($date2,$date1);
          $dif =  $diff->format("%a");

          $total = sum($inid);
          $ncount = $ncount + 1;

          echo "<tr>";

          if($ncount == 1){
            echo "<td>".$name."</td>";
            echo "<td>".$contact."</td>";
          }
          else {
            echo "<td> </td>";
            echo "<td> </td>";
          }

          echo "<td class='text-center'>".$dat."</td>";

          $in = sprintf("%04d", $inid);
          echo "<td class='text-center'>".$BillID."</td>";
          echo "<td class='text-right'>". number_format($total,2)."</td>";




          $che1 = " ";

          $balance = $total - $bal;


          if($dif < 30){
            echo "<td class='text-right' style='color:#66CC00;'>".number_format($balance,2)." ".$che1."</td>";
            $bal1 = $bal1 + $balance;
          }
          else if($dif < 45 && $dif >= 30){
            echo "<td class='text-right' style='color:#669900;'>".number_format($balance,2)." ".$che1."</td>";
            $bal2 = $bal2 + $balance;
          }
          else if($dif < 55 && $dif >= 45){
            echo "<td class='text-right' style='color:#FFCC00;'>".number_format($balance,2)." ".$che1."</td>";
            $bal3 = $bal3 + $balance;
          }
          else if($dif < 60 && $dif >= 55){
            echo "<td class='text-right' style='color:#FF9900;'>".number_format($balance,2)." ".$che1."</td>";
            $bal4 = $bal4 + $balance;
          }
          else if($dif >= 60 ){
            echo "<td class='text-right' style='color:#FF0000;'>".number_format($balance,2)." ".$che1."</td>";
            $bal5 = $bal5 + $balance;
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
<div class="row">
  <div class="col-sm-2" style="color:#66CC00;font-size:20px;text-align:right;"><?php echo  number_format($bal1,2); ?></div>
  <div class="col-sm-2" style="color:#669900;font-size:20px;text-align:right;"><?php echo  number_format($bal2,2); ?></div>
  <div class="col-sm-2" style="color:#FFCC00;font-size:20px;text-align:right;"><?php echo  number_format($bal3,2); ?></div>
  <div class="col-sm-2" style="color:#FF9900;font-size:20px;text-align:right;"><?php echo  number_format($bal4,2); ?></div>
  <div class="col-sm-2" style="color:#FF0000;font-size:20px;text-align:right;"><?php echo  number_format($bal5,2); ?></div>
  <div class="col-sm-12" style="color:black;font-size:20px;text-align:center;">TOTAL OUTSTANDING: <?php echo  number_format($bal1 + $bal2 + $bal3 + $bal4 + $bal5 ,2); ?></div>
</div>
