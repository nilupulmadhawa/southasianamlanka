<?php 
session_start();
include 'connection.php';
$ponumber = $_SESSION['ponumber'];
$company = $_SESSION['company'];
$invoicenumber = $_SESSION['invoicenumber'];
$sql2 = "UPDATE rep_po SET status = 1 WHERE ID = $ponumber ";
mysqli_query($conn,$sql2);
$sql2 = "UPDATE rep_po SET PID = $invoicenumber WHERE ID = $ponumber ";
mysqli_query($conn,$sql2);
//company details
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
$_SESSION['check'] = 2;
?>
<html>
	<head>
	</head>
	<body>

    <div style="width:700px;font-size:20px;text-align:center;margin-left:15px;margin-bottom:0px;"><?php echo $companyname; ?></div>
    <div style="width:700px;font-size:10px;text-align:center;margin-left:12px;margin-bottom:5px;"><?php echo "Address: ".$address.", Tel: ".$contact.", Fax:".$fax.", Email:".$email; ?></div>
  <div style="width:700px;text-align:center;font-size:15px;margin-left:40px;"><b>PURCHASE ORDER</b></div>
  <div style="width:700px;text-align:left;font-size:15px;margin-left:40px;margin-bottom:5px;">
  	Supplier Name: <br/>
  	Purchase Order Date: <br/>
  </div>
	<div style="width:700px;font-size:12px;margin-left:40px;">	
		<table style="width:700px;font-size:12px;">
    <thead>
      <tr>
        <th style="text-align:left;border-bottom:1px solid;">Product Name</th>
        <th style="text-align:right;border-bottom:1px solid;">Qty</th>
        
      </tr>
    </thead>
    <tbody>
      <?php 
           include 'connection.php';
           $ponumber = $_SESSION['ponumber'];
           //echo $ponumber."</br>";
           $result = mysqli_query($conn, "SELECT * FROM rep_po_sub WHERE poID = $ponumber");
           $rowcount=mysqli_num_rows($result);
           //echo $rowcount."</br>";

           $steps = 1;
           while($rowcount>=$steps){
            $result = mysqli_query($conn,"SELECT * FROM rep_po_sub WHERE poID = $ponumber LIMIT $steps");
            while($row = mysqli_fetch_array($result)){
              GLOBAL $itemID,$qty,$multiID,$poid;
              $itemID = $row[2];
              $qty = $row[3];
              $multiID = $row[4];
              $poid = $row[0];
            }
           
            $result = mysqli_query($conn,"SELECT * FROM item WHERE Item_ID = $itemID");
            while($row = mysqli_fetch_array($result)){
              GLOBAL $itemname,$itemcode;
              $itemname = $row[2];             
              $itemcode = $row[1];             
            }
           

            echo "<tr>";
            echo "<td style='text-align:left;'>".$itemcode." (".$itemname.")</td>";
            echo "<td style='text-align:right;'>".$qty."</td>";
        
            echo "</tr>";
            $steps = $steps + 1;
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
