<?php
include 'connection.php';
$q = $_REQUEST["q"];
//get the company details
$result = mysqli_query($conn,"SELECT * FROM company WHERE ID = $q ");
while($row = mysqli_fetch_array($result)){
	GLOBAL $name,$address,$contact,$fax,$email;
	$name = $row[1];
	$address = $row[2];
	$contact = $row[3];
	$fax = $row[4];
	$email = $row[5];
	$refName = $row[6];
}
mysqli_close($conn);
?>
<form class="form-horizontal" role="form" method="post" action="updatecompany.php">
	<div class="form-group">
		<label class="control-label col-sm-2" for="email">Ref Name:</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" id="email" name="refname" value="<?php echo $refName; ?>">
		</div>
	</div>
	<div class="form-group">
		<label class="control-label col-sm-2" for="email">Branch Name:</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" id="email" name="name" value="<?php echo $name; ?>">
		</div>
	</div>
	<div class="form-group">
		<label class="control-label col-sm-2" for="pwd">Address:</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" id="pwd" name="address" value="<?php echo $address; ?>">
		</div>
	</div>
	<div class="form-group">
		<label class="control-label col-sm-2" for="pwd">Contact:</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" id="pwd" name="contact" value="<?php echo $contact; ?>">
		</div>
	</div>
	<div class="form-group">
		<label class="control-label col-sm-2" for="pwd">Fax:</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" id="pwd" name="fax" value="<?php echo $fax; ?>">
		</div>
	</div>
	<div class="form-group">
		<label class="control-label col-sm-2" for="pwd">Email:</label>
		<div class="col-sm-10">
			<input type="text" class="form-control" id="pwd" name="email" value="<?php echo $email; ?>">
		</div>
	</div>
	<input type="hidden" class="form-control" id="pwd" name="id" value="<?php echo $q; ?>">
	<div class="form-group">
		<div class="col-sm-offset-2 col-sm-10">
			<button type="submit" class="btn btn-default">Update</button>
		</div>
	</div>
</form>
