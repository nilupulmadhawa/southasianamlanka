<?php
session_start();
include 'connection.php';
$company = $_SESSION['company'];
$itemgroup = $_SESSION['itemgroup'];
//echo $itemgroup."<br/>";
$q = $_REQUEST["q"]; 
//echo $q."<br/>";
$itemid = $_SESSION['itemID'];
//echo $itemid."<br/>";	
?>
<div class="form-group">
				<label for="email">Multiple Prices:</label>
			  <select class="form-control" name="multi">
			<?php 
			include 'connection.php';
			$result = mysqli_query($conn,"SELECT * FROM multiprice WHERE Item_ID = $itemid");
			while($row = mysqli_fetch_array($result)){
				echo "<option value='".$row[0]."'> Wholesale Price:(".$row[4].") Retail Price (".$row[5].") Quantity:(".$row[2].")</option>";
			}
			mysqli_close($conn);
			?>
		</select>
			</div>
<div class="col-sm-12" style="margin-left:-15px;margin-bottom:5px;">
<label>Free Issue Category</label>
 <select class="form-control" name="freesec" >
            <?php
			include 'connection.php';
			$count = 1;
			$result = mysqli_query($conn,"SELECT * FROM freeissue WHERE Item_ID = $itemid ");
            while($row = mysqli_fetch_array($result)){
              echo "<option value = '".$row[0]."'>"."Qty:".$row[2]." Free Issue:".$row[3]."</option>";
              
			  }
              mysql_close($conn);
             ?>
          </select>
		  
</div>

<div class="col-sm-12" style="margin-left:-15px;">
<label>Free Issue Item</label>
 <select class="form-control" name="freeissue" >
            <?php
			include 'connection.php';
			$count = 1;
			$result = mysqli_query($conn, "SELECT * FROM item WHERE CompanyID = $company AND grouping = $itemgroup ");
            while($row = mysqli_fetch_array($result)){
              echo "<option value = '".$row[0]."'>".$row[1]." (".$row[2].")"."</option>";
              
			  }
              mysql_close($conn);
             ?>
          </select>
		  
</div>