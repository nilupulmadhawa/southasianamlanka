<?php 
session_start(); 
$id1 = $_SESSION['id']; 
$company = $_SESSION['company'];
?>
<html>
<head>
</headl>
<body>
	<div style="width:750px;margin-left:25px;text-align:center;"><b>OUTSTANDING OVER 60DAYS (DETAILED REPORT)</b></div>
	<div style="width:750px;margin-left:25px;">
	 <table class="table table-striped" width="100%" style="font-size:12px;">
          <thead>
            <tr>
              <th style='text-align:left;'>GRN ID</th>
              <th style='text-align:left;'>GRN Date</th>
              
              <th style='text-align:left;'>Supplier</th>
              <th style='text-align:right;'>Amount</th>

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
            echo "<tr><td>".$poid."</td>";
            echo "<td>".$dat."</td>";
            
            echo "<td style='text-align:left;'>".$supname."</td>";
            
              
              $potot = 0;
            echo "<td style='text-align:right;'>". number_format(totalpo($idid),2)."</td>";
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
    </div>
<script>
//window.print();
</script>
</body>
</html>