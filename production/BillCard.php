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
        xmlhttp.open("GET","AutomatedPO.php?q="+str,true);
        xmlhttp.send();
    }
}
</script>
<script>

  $(function() {

    $( "#datepicker" ).datepicker({dateFormat: 'yy-mm-dd'});

  });

  </script>
<script>

  $(function() {

    $( "#datepicker1" ).datepicker({dateFormat: 'yy-mm-dd'});

  });

  </script>
</head>
<body>

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
	<div class="row">
		<form class="form-inline" role="form" method="post" action="BillCard.php">
		<div class="form-group">
		  <label class="sr-only" for="email">Product:</label>
		  <select class="form-control" name="product">
			<?php 
			include 'connection.php';
			$result = mysqli_query($conn,"SELECT * FROM item ORDER BY Name ASC");
			while($row = mysqli_fetch_array($result)){
				echo "<option value='".$row[0]."'>".$row[2]."</option>";
			}
			mysqli_close($conn);
			?>
		  </select>
		</div>	
		<div class="form-group">
		  <label class="sr-only" for="email">Product:</label>
		  <input type="text" class="form-control" id="datepicker" name="start" placeholder="From">
		</div>
		<div class="form-group">
		  <label class="sr-only" for="email">Product:</label>
		  <input type="text" class="form-control" id="datepicker1" name="end" placeholder="To">
		</div>	
		<button type="submit" class="btn btn-default">View</button>
	  </form>
	  </div>
	  <div class="row">
		<table class="table table-striped">
		<thead>
		  <tr>
			<th style='text-align:left;'>Date</th>
			<th style='text-align:left;'>GRN ID</th>
			<th style='text-align:left;'>INVOICE ID</th>
			<th style='text-align:left;'>RETURN ID</th>
			<th style='text-align:center;'>GRN Qty</th>
			<th style='text-align:center;'>INVOICE Qty</th>
			<th style='text-align:center;'>RETURN Qty</th>
		  </tr>
		</thead>
		<tbody>
		<?php 
		include 'connection.php';
			if(isset($_POST['product'])){

			$product = $_POST['product'];
			$start = $_POST['start'];
			$end = $_POST['end'];
			
			$result = mysqli_query($conn,"SELECT * FROM item WHERE Item_ID = $product");
				while($row = mysqli_fetch_array($result)){
					echo "<p style='font-size:25px; background-color:black; color:white;margin-top:5px;padding-left:5px;'>".$row[1]." (".$row[2].")</p>";
				}
			$result = mysqli_query($conn,"SELECT * FROM inventory WHERE Item_Item_ID = $product");
				while($row = mysqli_fetch_array($result)){
					
					}
			
			$today = $end;
			$invdate = $start;
			$date1=date_create($invdate);
			$date2=date_create( $today);
			$diff=date_diff($date2,$date1);
			$dif =  $diff->format("%a");
			$i = 0;
			while($i<=$dif){
			$date = strtotime("-$i day", strtotime($today));
			//echo date("Y-m-d", $date)."</br>";
			$dat = date("Y-m-d", $date);
			
			
			
			$rowcount = 0;
			$result = mysqli_query($conn,"SELECT * FROM po WHERE PurchaseDate = '$dat' ");
			$rowcount=mysqli_num_rows($result);
			$postep = 1;
			while($postep <= $rowcount ){
				
				$result = mysqli_query($conn,"SELECT * FROM po WHERE PurchaseDate = '$dat' LIMIT $postep");
				while($row = mysqli_fetch_array($result)){
					GLOBAL $id;
					$id = $row[2];
				}
				$result = mysqli_query($conn,"SELECT * FROM sub_po WHERE PoID = '$id' AND ItemID = $product ");
				while($row = mysqli_fetch_array($result)){
					echo "<tr>";
					echo "<td>".$dat."</td>";
					
					echo "<td style='text-align:center;'>".$id."</td>"; 
					echo "<td style='text-align:center;'></td>"; 
					echo "<td style='text-align:right;'></td>"; 
					echo "<td style='text-align:center;'>".$row[1]."</td>";
					echo "<td style='text-align:right;'></td>";
					echo "<td style='text-align:right;'></td>";
					echo "</tr>";					
				}
				$postep = $postep +1;
			}
			
			$rowcount = 0;
			$result = mysqli_query($conn,"SELECT * FROM invoice WHERE InvDate = '$dat' AND Allocated = 1 ");
			$rowcount=mysqli_num_rows($result);
			$postep = 1;
			while($postep <= $rowcount ){
				
				$result = mysqli_query($conn,"SELECT * FROM invoice WHERE InvDate = '$dat' AND Allocated = 1 LIMIT $postep");
				while($row = mysqli_fetch_array($result)){
					GLOBAL $id;
					$id = $row[0];
				}
				$result = mysqli_query($conn,"SELECT * FROM sub_invoice WHERE Invoice_Inv_ID = $id AND Item_Item_ID = $product ");
				while($row = mysqli_fetch_array($result)){
					echo "<tr>";
					echo "<td>".$dat."</td>";
					echo "<td style='text-align:center;'></td>"; 
					 
					echo "<td style='text-align:center;'>".$id."</td>"; 
					echo "<td style='text-align:right;'></td>";
					echo "<td style='text-align:right;'></td>";
					echo "<td style='text-align:center;'>".$row[1]."</td>";
					echo "<td style='text-align:right;'></td>";
					echo "</tr>";					
				}
				$postep = $postep +1;
			}
			
			$rowcount = 0;
			$result = mysqli_query($conn,"SELECT * FROM return_invoice WHERE ReturnDate = '$dat' ");
			$rowcount=mysqli_num_rows($result);
			$postep = 1;
			while($postep <= $rowcount ){
				
				$result = mysqli_query($conn,"SELECT * FROM return_invoice WHERE ReturnDate = '$dat' LIMIT $postep");
				while($row = mysqli_fetch_array($result)){
					GLOBAL $id;
					$id = $row[0];
				}
				$result = mysqli_query($conn,"SELECT * FROM return_invoice WHERE ID = $id AND Item_ID = $product ");
				while($row = mysqli_fetch_array($result)){
					echo "<tr>";
					echo "<td>".$dat."</td>";
					echo "<td style='text-align:center;'></td>"; 
					echo "<td style='text-align:center;'></td>"; 
					echo "<td style='text-align:center;'>".$id."</td>"; 
					echo "<td style='text-align:right;'></td>";
					echo "<td style='text-align:right;'></td>";
					
					
					echo "<td style='text-align:center;'>".$row[2]."</td>";
					echo "</tr>";					
				}
				$postep = $postep +1;
			}
			
			$i = $i + 1;
			}
			
			}
		mysqli_close($conn);
		?>
		</tbody>
		</table>
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
