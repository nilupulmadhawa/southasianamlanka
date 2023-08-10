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
    <link rel="stylesheet" href="//code.jquery.com/ui/1.11.4/themes/smoothness/jquery-ui.css">
  <script src="//code.jquery.com/jquery-1.10.2.js"></script>
  <script src="//code.jquery.com/ui/1.11.4/jquery-ui.js"></script>
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
      <!--product ajax-->
<script>
function showUser(str) {
    if (str == "") {
        document.getElementById("txtHint").innerHTML = "";
        return;
    } else {
        if (window.XMLHttpRequest) {
            // code for IE7+, Firefox, Chrome, Opera, Safari
            xmlhttp = new XMLHttpRequest();
        } else {
            // code for IE6, IE5
            xmlhttp = new ActiveXObject("Microsoft.XMLHTTP");
        }
        xmlhttp.onreadystatechange = function() {
            if (xmlhttp.readyState == 4 && xmlhttp.status == 200) {
                document.getElementById("txtHint").innerHTML = xmlhttp.responseText;
            }
        }
        xmlhttp.open("GET","withzero.php?q="+str,true);
        xmlhttp.send();
    }
}
</script>

      
    

    
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
      
       
    
      <div id="txtHint"></div>
       <div class="col-sm-12">
        
          <!--table--><div style="height:600px;overflow:auto;">
          <table class="table table-striped">
            <thead>
              <tr>
                <th>Item Code</th>
                <th>Item Name</th>
              
                <th style='text-align:center;'>Qty</th>
<!--                <th style='text-align:right;'>Sub Total(Cost Price)</th>-->
                
              </tr>
            </thead>
            <tbody>
              <?php 
              //function to get the quantity
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
			echo "<tr style='background-color:purple;color:white;'><td style='text-align:left;'>---</td><td style='font-size:15px;color:white;'><b>".$catname."</b></td><td style='text-align:center;'>---</td><td style='text-align:center;'>---</td></tr>";
              $result = mysqli_query($conn,"SELECT * FROM item WHERE CompanyID = $company AND Category_Cat_ID = $catid ORDER BY Name ASC");
                while($row = mysqli_fetch_array($result)){
                  $qty = 0;
                  $cost = 0;
					$qty = qty($row[0]);
          $totalc = totalcost($row[0]);
					GLOBAL $totalcost,$totalwhole;
					$totalcost = $totalcost + ($qty*$row[4]);
					$totalwhole = $totalwhole + ($qty*$row[5]);
					if($row[6] == $qty){
                  echo "<tr>";
                  echo "<td style='color:brown;'>".$row[1]."</td>";
                  echo "<td style='color:brown;'>".$row[2]."</td>";
                  
                  
                  echo "<td style='color:brown;text-align:center;'>".$qty ."</td>";
//                  echo "<td style='color:orange;text-align:right;'>". number_format($totalc,2)."</td>";
                  echo "</tr>";
                  $catsutot = $catsutot + $totalc;
					}
					else if($row[6] > $qty){
                  echo "<tr>";
                  echo "<td style='color:red;'>".$row[1]."</td>";
                  echo "<td style='color:red;'>".$row[2]."</td>";
                  
                  
                  echo "<td style='color:red;text-align:center;'>".$qty ."</td>";
//                  echo "<td style='color:orange;text-align:right;'>".number_format($totalc,2)."</td>";
                  echo "</tr>";
                  $catsutot = $catsutot + $totalc;
					}
					
					
                }
           
				$steps = $steps + 1;
			}
			
                mysqli_close($conn);
              ?>
            </tbody>
          </table>
          <!--end of table-->


       </div>
	   
     </div>

    </div>
    <div class="col-sm-2 sidenav">
      <?php include 'RightNavBar.php'; ?>
      </div>
    </div>
  </div>
</div>

<footer class="container-fluid text-center">
  <?php include 'footer.php'; ?>
</footer>

</body>
</html>
