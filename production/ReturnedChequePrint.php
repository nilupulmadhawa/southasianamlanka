<?php 
session_start(); 
$id1 = $_SESSION['id']; 
$company = $_SESSION['company'];
?>
<html>
<head>
</headl>
<body>
	<div style="width:750px;margin-left:25px;text-align:center;"><b>RETURNED CHEQUE DETAILED REPORT</b></div>
	<div style="width:750px;margin-left:25px;">
	<table>
          <thead>
            <tr>
               <th style='text-align:left;font-size:12px;'>Cheque Date</th>
              <th>Customer</th>
              <th style='text-align:center;font-size:12px;'>Cheque Number</th>
              <th style='text-align:center;font-size:12px;'>Bank</th>
              <th style='text-align:right;font-size:12px;'>Amount</th>
              
            </tr>
          </thead>
          <tbody>
            <?php 
            function cusname($cusid){
            	include 'connection.php';
            	 $result = mysqli_query($conn,"SELECT * FROM cus_profile WHERE Cus_ID = $cusid ");
            while($row = mysqli_fetch_array($result)){
              GLOBAL $Cusname;
              $Cusname = "<b>".$row[1]."</b> (".$row[3].")";
            }
            return $Cusname;
            mysqli_close($conn);
            }
            include 'connection.php';
            $count = 0;
            $result = mysqli_query($conn,"SELECT * FROM cheque WHERE status = 2 AND CompanyID = $company ORDER BY Cheque_date DESC");
            while($row = mysqli_fetch_array($result)){
              echo "<tr>";
              echo "<td style='text-align:left;font-size:12px;'>".$row[4]."</td>";
              echo "<td style='margin-bottom:5px;font-size:12px;'>".cusname($row[6])."</td>";
              echo "<td style='text-align:center;font-size:12px;'>".$row[1]."</td>";
              echo "<td style='text-align:center;font-size:12px;'>".$row[3]."</td>";
              echo "<td style='text-align:right;font-size:12px;'>".number_format($row[2],2)."</td>";
              


              echo "</tr>";
            }

              

            

            mysqli_close($conn);
            ?>
          </tbody>
        </table>
    </div>
<script>
window.print();
</script>
</body>
</html>