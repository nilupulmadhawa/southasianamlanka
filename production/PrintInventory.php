<?php 
session_start(); 
$id1 = $_SESSION['id']; 
$company = $_SESSION['company'];
$zero = 0;
$zero = $_SESSION['zero'];
?>
<html>
<head>

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
<body style="font-size:12px;">
<div style="width:700px;text-align:center;font-size:20px;margin-bottom:5px;"><b>TOTAL STOCK REPORT</b></div>
<div style="width:700px;text-align:left;font-size:12px;margin-bottom:10px;"><b>STOCK REPORT DATE: <?php echo date("Y-m-d"); ?></b></div>
<table class="table table-striped" style="font-size:12px;">
            <thead>
              <tr>
                <th>Item Code</th>
                <th>Description</th>
                <th style='text-align:center;'>Qty</th>
                <th style='text-align:right;'>Sub Total(Cost Price)</th>
                
              </tr>
            </thead>
            <tbody>
              <?php 
              function qty($id){
                include 'connection.php';
                $qty = 0;
              $result = mysqli_query($conn,"SELECT * FROM multiprice WHERE Item_ID = $id ");
                while($row = mysqli_fetch_array($result)){
                  GLOBAL $qty;
                  $qty = $qty + $row[2];
                }
                return $qty;
                mysqli_close($conn);
              }
              // function to get the total cost
              function totalcost($id){
                include 'connection.php';
                $cost = 0;
              $result = mysqli_query($conn,"SELECT * FROM multiprice WHERE Item_ID = $id ");
                while($row = mysqli_fetch_array($result)){
                  GLOBAL $cost;
                  $cost = $cost + ($row[2] * $row[3]);
                }
                return $cost;
                mysqli_close($conn);
              }
              include 'connection.php';
			  $result = mysqli_query($conn,"SELECT * FROM category WHERE CompanyID = $company");
			$rowcount=mysqli_num_rows($result);
			$steps = 1;
			$totalcost = 0;
			$totalwhole = 0;
			while($rowcount>=$steps){
			$result = mysqli_query($conn,"SELECT * FROM category WHERE CompanyID = $company ORDER BY Category ASC LIMIT $steps");
			while($row = mysqli_fetch_array($result)){
				GLOBAL $catid,$catname;
				$catid = $row[0];
				$catname = $row[1];
			}
      $catsutot = 0;
			echo "<tr style='color:black;'><td style='text-align:left;'>-------</td><td style='font-size:15px;color:black;text-align:center;margin-top:20px;'><b><u>".$catname."</u></b></td><td style='text-align:center;'>---------------</td><td style='text-align:center;'>---------------</td></tr>";
              $result = mysqli_query($conn,"SELECT * FROM item WHERE CompanyID = $company AND Category_Cat_ID = $catid ORDER BY Name ASC");
                while($row = mysqli_fetch_array($result)){
                  $qty = 0;
                  $cost = 0;
					$qty = qty($row[0]);
          $totalc = totalcost($row[0]);
          if($zero == 0 || $zero == 1){
					if($qty >= 0){
					$totalcost = $totalcost + ($qty*$row[4]);
					$totalwhole = $totalwhole + ($qty*$row[5]);
					if($row[6] == $qty){
                  echo "<tr>";
                  echo "<td style='color:black;'>".$row[1]."</td>";
                  echo "<td style='color:black;'>".$row[2]."</td>"; 
                  
                  echo "<td style='color:black;text-align:center;'>".$qty ."</td>";
                  echo "<td style='color:black;text-align:right;'>". number_format($totalc,2)."</td>";
                  echo "</tr>";
                  $catsutot = $catsutot + $totalc;
					}
					else if($row[6] > $qty){
                  echo "<tr>";
                  echo "<td style='color:black;'>".$row[1]."</td>";
                  echo "<td style='color:black;'>".$row[2]."</td>"; 
                  
                  echo "<td style='color:black;text-align:center;'>".$qty ."</td>";
                  echo "<td style='color:black;text-align:right;'>".number_format($totalc,2)."</td>";
                  echo "</tr>";
                  $catsutot = $catsutot + $totalc;
					}
					else{
                  echo "<tr>";
                  echo "<td>".$row[1]."</td>";
                  echo "<td>".$row[2]."</td>";
                  
                  echo "<td style='text-align:center;'>".$qty ."</td>";
                  echo "<td style='text-align:right;'>".number_format($totalc,2)."</td>";
                  echo "</tr>";
                  $catsutot = $catsutot + $totalc;
					}
				}
      }
       else if($zero == 2){
          if($qty > 0){
          $totalcost = $totalcost + ($qty*$row[4]);
          $totalwhole = $totalwhole + ($qty*$row[5]);
          if($row[6] == $qty){
                  echo "<tr>";
                  echo "<td style='color:black;'>".$row[1]."</td>";
                  echo "<td style='color:black;'>".$row[2]."</td>"; 
                  
                  echo "<td style='color:black;text-align:center;'>".$qty ."</td>";
                  echo "<td style='color:black;text-align:right;'>". number_format($totalc,2)."</td>";
                  echo "</tr>";
                  $catsutot = $catsutot + $totalc;
          }
          else if($row[6] > $qty){
                  echo "<tr>";
                  echo "<td style='color:black;'>".$row[1]."</td>";
                  echo "<td style='color:black;'>".$row[2]."</td>"; 
                  
                  echo "<td style='color:black;text-align:center;'>".$qty ."</td>";
                  echo "<td style='color:black;text-align:right;'>".number_format($totalc,2)."</td>";
                  echo "</tr>";
                  $catsutot = $catsutot + $totalc;
          }
          else{
                  echo "<tr>";
                  echo "<td>".$row[1]."</td>";
                  echo "<td>".$row[2]."</td>";
                  
                  echo "<td style='text-align:center;'>".$qty ."</td>";
                  echo "<td style='text-align:right;'>".number_format($totalc,2)."</td>";
                  echo "</tr>";
                  $catsutot = $catsutot + $totalc;
          }
        }
      }
					
                }
                 echo "<tr style='background-color:gray;color:white;'>";
                  echo "<td></td>";
                  echo "<td></td>";
                  
                  
                  echo "<td style='text-align:center;'>CATEGORY SUB TOTAL (COST PRICE)</td>";
                  echo "<td style='text-align:right;'>".number_format($catsutot,2)."</td>";
                  echo "</tr>";
				$steps = $steps + 1;
			}
			 echo "<tr style='font-size:15px;'>";
                  echo "<td></td>";
                  echo "<td style='text-align:left;'>COST TOTAL</td>";
                  
                  echo "<td style='text-align:right;'>".number_format($totalcost,2)."</td>";
                  echo "</tr>";
			 echo "<tr style='font-size:15px;'>";
                  echo "<td></td>";
                  echo "<td style='text-align:left;'>WHOLESALE TOTAL</td>";
                  
                  echo "<td style='text-align:right;'>".number_format($totalwhole,2)."</td>";
                  echo "</tr>";
                mysqli_close($conn);
              ?>
            </tbody>
          </table>
<script>
//window.print();
</script>
</body>
</html>