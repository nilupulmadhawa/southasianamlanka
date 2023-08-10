<?php 
$dat = "2016-01-01";
$num = 5;
$date ="+".$num." days";
$NewDate=Date($dat, strtotime($date));
echo $NewDate."</br>";


date_default_timezone_set("Asia/Kolkata");
echo  date("h:i:s");

?>

<form class="form-inline" role="form" method="post" action="test.php">
		<div class="form-group">
		  <select name="item" autofocus="on">
		  <?php 
			include 'connection.php';
			$result = mysqli_query($conn,"SELECT * FROM item ORDER BY Name");
            while($row = mysqli_fetch_array($result)){
				echo "<option value='".$row[0]."'>".$row[2]."</option>";
			}
			mysqli_close($conn);
		  ?>
		  </select>
		
		
		<button type="submit" class="btn btn-primary">SET</button>
	  </form>
	  <br/>
	  <br/>
<?php 
include 'connection.php';
if(isset($_POST['item'])){
	$item = $_POST['item'];
	$result = mysqli_query($conn,"SELECT * FROM item WHERE Item_ID = $item");
            while($row = mysqli_fetch_array($result)){
				echo "Item ID:".$row[0]."<br/>";
				echo "Retail:".$row[3]."<br/>";
				echo "Cost:".$row[4]."<br/>";
				echo "Wp:".$row[5]."<br/>";
			}
			echo ".................................................................<br/>";
			$result = mysqli_query($conn,"SELECT * FROM multiprice WHERE Item_ID = $item");
            while($row = mysqli_fetch_array($result)){
				echo "Multi ID:".$row[0]."<br/>";
				echo "Retail:".$row[5]."<br/>";
				echo "Cost:".$row[3]."<br/>";
				echo "Wp:".$row[4]."<br/>";
				echo ".................................................................<br/>";
			}
}
mysqli_close($conn);
?>
<br/>
<form class="form-inline" role="form" method="post" action="test.php">
		<div class="form-group">
		  <select name="item" autofocus="on">
		  <?php 
			include 'connection.php';
			$result = mysqli_query($conn,"SELECT * FROM cus_profile ORDER BY Name");
            while($row = mysqli_fetch_array($result)){
				echo "<option value='".$row[0]."'>".$row[1]."</option>";
			}
			mysqli_close($conn);
		  ?>
		  </select>
		
		
		<button type="submit" class="btn btn-primary">SET</button>
	  </form>
	  <br/>
	  <br/>
<?php 
include 'connection.php';
if(isset($_POST['item'])){
	$item = $_POST['item'];
	$result = mysqli_query($conn,"SELECT * FROM cus_profile WHERE Cus_ID = $item");
            while($row = mysqli_fetch_array($result)){
				echo "Company:".$row[12]."<br/>";
				
			}
}
mysqli_close($conn);
?>