<?php 
session_start();
$q = $_REQUEST["q"];
include 'connection.php';

mysqli_close($conn);
?>
		<label for="email">Price Details:</label>
		<select class="form-control" name="multi">
			<?php 
			include 'connection.php';
			$result = mysqli_query($conn,"SELECT * FROM multiprice WHERE Item_ID = $q");
			while($row = mysqli_fetch_array($result)){
				echo "<option value='".$row[0]."'> Wholesale Price:(".$row[4].") Retail Price (".$row[5].") Quantity:(".$row[2].")</option>";
			}
			mysqli_close($conn);
			?>
		</select>

