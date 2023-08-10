<?php
include 'connection.php';
$q = $_REQUEST["q"];
$result = mysqli_query($conn,"SELECT * FROM item WHERE Item_ID = $q ");
	while($row = mysqli_fetch_array($result)){
		GLOBAL $name;
		$name = $row[2];
	}
	echo "<b>".$name."</b><br/>";
mysqli_close($conn);
?>
<form method='post' action='OldPrice.php'>
<!--start of the tabele--><div style="height:300px;overflow:auto;">
        <table class="table table-striped text-center" width="100%" style="font-size:12px;">
        <thead>
        <tr>


       <th style='text-align:right;'>Cost </th>
       <th style='text-align:right;'>Wholesale </th>
       <th style='text-align:right;'>Retail </th>
       <th style='text-align:right;'>Bact Number </th>
       <th style='text-align:right;'></th>


        </tr>
      </thead>
         <tbody>
            <?php
			function itemname($itemid){
				include 'connection.php';
				if($itemid != ""){
				$result = mysqli_query($conn,"SELECT * FROM item WHERE Item_ID = $itemid");
              while($row=mysqli_fetch_array($result)) {
				  GLOBAL $itemname;
				  $itemname = $row[2];
			  }
				return $itemname;}
				mysqli_close($conn);
			}
			function itemcode($itemid){
				include 'connection.php';
				if($itemid != ""){
				$result = mysqli_query($conn,"SELECT * FROM item WHERE Item_ID = $itemid");
              while($row=mysqli_fetch_array($result)) {
				  GLOBAL $itemcode;
				  $itemcode = $row[1];
			  }
				return $itemcode;}
				mysqli_close($conn);
			}
			include 'connection.php';
			$result = mysqli_query($conn,"SELECT * FROM multiprice WHERE Item_ID = $q");
              while($row=mysqli_fetch_array($result)) {

                echo "<tr>";

                echo "<td style='text-align:right;'><input type='hidden' name='UpdatemulID' value='".$row[0]."' ><input type='text' name='cost' class='form-control' value='".$row[3]."' ></td>";
                echo "<td style='text-align:right;'><input type='text' name='whole' class='form-control' value='".$row[4]."' ></td>";
                echo "<td style='text-align:right;'><input type='text' name='ret' class='form-control' value='".$row[5]."' ></td>";
                echo "<td style='text-align:right;'><input type='text' name='bat' class='form-control' value='".$row[8]."' ></td>";
				echo "<td style='text-align:right;'><button type='submit' class='btn btn-primary'>UPDATE</button></td>";

                echo "</tr>";

              }
			  mysqli_close($conn);
             ?>
          </tbody>
        </table>
      <!--end of the tabele--></div>
			</form>
