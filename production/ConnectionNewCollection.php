<?php
session_start();
include 'class/image_upload.php';
include 'connection.php';

try{
	$image_upload = new ImageUpload();
	$image_upload->max_width = 400;
	$imageName = $image_upload->upload_image($_FILES["files_to_upload"],"chequeImage/");
} catch (Exception $exc){
	echo "error";
	$imageName = "NULL";
}

$id1 = $_SESSION['id'];
$cusname = $_SESSION['cusname'];
$company = 0;

$invoice = $_POST['invoice'];
$invdate = $_POST['invdate'];
$type = $_POST['type'];
$ammount = $_POST['ammount'];
$collector = 0;

if(isset($_POST['cnumber'])){
	$cnumber = $_POST['cnumber'];
}
if(isset($_POST['cdate'])){
	$cdate = $_POST['cdate'];
}
if(isset($_POST['bank'])){
	$bank = $_POST['bank'];
}

$result = mysqli_query($conn,"SELECT * FROM cus_profile WHERE Name = '$cusname' ");
while($row = mysqli_fetch_array($result)){
	// GLOBAL $cusid;
	$cusid = $row[11];

}
echo $type."<br/>";
//cash collection
if($type == 1){
	echo "one is ok";
	$t = 0;
	$result = mysqli_query($conn,"SELECT * FROM sub_invoice WHERE Invoice_Inv_ID = $invoice ");
	while($row = mysqli_fetch_array($result)){
		// GLOBAL $qty,$wp,$Discount,$t;
		$qty = $row[1];
		$wp = $row[5];
		$retail = $row[3];
		$Discount = $row[6];
		$sub = (100-$Discount);
		if($company == 2){
			$sub = $sub * $qty *$retail;
		}
		else{
			$sub = $sub * $qty *$wp;
		}

		$sub = $sub/100;
		$t = $t + $sub;
	}

	$result = mysqli_query($conn,"SELECT * FROM invoice WHERE Inv_ID = $invoice ");
	while($row = mysqli_fetch_array($result)){
		// GLOBAL $balance;
		$balance = $row[6];
	}
	$invbal = 0;
	$invbal = $t - $balance;
	echo $invbal."<br/>";
	echo $invoice."<br/>";
	if($invbal > $ammount){
		$newbal = 0;
		$newbal = $balance + $ammount;
		$sql2 = "UPDATE invoice SET Balance = $newbal WHERE Inv_ID = $invoice ";
		mysqli_query($conn,$sql2);
	}
	if($invbal == $ammount){
		$sql2 = "UPDATE invoice SET status = 1 WHERE Inv_ID = $invoice ";
		mysqli_query($conn,$sql2);
	}
	//collection table
	$collectioncount = 0;
	$result = mysqli_query($conn,"SELECT * FROM collection ORDER BY ID ASC");
	while($row = mysqli_fetch_array($result)){
		// GLOBAL $collectioncount;
		$collectioncount = $row[0];
	}
	$collectioncount = $collectioncount + 1;

	$result1 = "INSERT INTO collection (ID, Customer_ID, Employee_ID, Collection_date, Invoice_id, Type, CompanyID, Collector) VALUES ($collectioncount, $cusid, $id1, '$invdate', $invoice, $type, $company, 0)";
	mysqli_query($conn,$result1);
	//cash table
	$cashcount = 0;
	$result = mysqli_query($conn,"SELECT * FROM cash ORDER BY ID ASC");
	while($row = mysqli_fetch_array($result)){
		// GLOBAL $cashcount;
		$cashcount = $row[0];
	}
	$cashcount = $cashcount + 1;

	$result1 = "INSERT INTO cash (ID, Ammount, Collection_ID, CashDate, CompanyID, Collector) VALUES ($cashcount, $ammount, $collectioncount, '$invdate', $company, 0)";
	mysqli_query($conn,$result1);
}


//end of cash section

//cheque collection
else if($type == 2){
	echo "type 2 is ok";
	$t = 0;
	$result = mysqli_query($conn,"SELECT * FROM sub_invoice WHERE Invoice_Inv_ID = $invoice ");
	while($row = mysqli_fetch_array($result)){
		// GLOBAL $qty,$wp,$Discount,$t;
		$qty = $row[1];
		$wp = $row[5];
		$retail = $row[3];
		$Discount = $row[6];
		$sub = (100-$Discount);
		if($company == 2){
			$sub = $sub * $qty *$retail;
		}
		else{
			$sub = $sub * $qty *$wp;
		}

		$sub = $sub/100;
		$t = $t + $sub;
	}

	$result = mysqli_query($conn,"SELECT * FROM invoice WHERE Inv_ID = $invoice ");
	while($row = mysqli_fetch_array($result)){
		// GLOBAL $balance;
		$balance = $row[6];
	}
	$invbal = 0;
	$invbal = $t - $balance;
	echo $invbal."<br/>";
	echo $invoice."<br/>";
	if($invbal > $ammount){
		$newbal = 0;
		$newbal = $balance + $ammount;
		// $sql2 = "UPDATE invoice SET Balance = $newbal WHERE Inv_ID = $invoice ";
		// mysqli_query($conn,$sql2);
	}
	if($invbal == $ammount){
		$sql2 = "UPDATE invoice SET status = 1 WHERE Inv_ID = $invoice ";
		mysqli_query($conn,$sql2);
	}
	//collection table
	$collectioncount = 0;
	$result = mysqli_query($conn,"SELECT * FROM collection ORDER BY ID ASC");
	while($row = mysqli_fetch_array($result)){
		GLOBAL $collectioncount;
		$collectioncount = $row[0];
	}
	$collectioncount = $collectioncount + 1;

	$result1 = "INSERT INTO collection (ID, Customer_ID, Employee_ID, Collection_date, Invoice_id, Type, CompanyID, Collector) VALUES ($collectioncount, $cusid, $id1, '$invdate', $invoice, $type, $company, 0)";
	mysqli_query($conn,$result1);
	//cash table
	$chequecount = 0;
	$result = mysqli_query($conn,"SELECT * FROM cheque ORDER BY ID ASC");
	while($row = mysqli_fetch_array($result)){
		// GLOBAL $chequecount;
		$chequecount = $row[0];
	}
	$chequecount = $chequecount + 1;

	$result1 = "INSERT INTO cheque (ID, CNumber, Ammount, Bank, Cheque_date, Collection_ID, Customer_id, Collected_date, status, InvoiceID, CompanyID, Collector, Image) VALUES ($chequecount, '$cnumber', $ammount, '$bank', '$cdate', $collectioncount, $cusid, '$invdate', 0, $invoice, $company, 0, '$imageName')";
	mysqli_query($conn,$result1);
}

//tokn collection
if($type == 3){




	$sql2 = "UPDATE invoice SET status = 1 WHERE Inv_ID = $invoice ";
	mysqli_query($conn,$sql2);

	//collection table
	$collectioncount = 0;
	$result = mysqli_query($conn,"SELECT * FROM collection ");
	while($row = mysqli_fetch_array($result)){
		GLOBAL $collectioncount;
		$collectioncount = $row[0];
	}
	$collectioncount = $collectioncount + 1;

	$result1 = "INSERT INTO collection (ID, Customer_ID, Employee_ID, Collection_date, Invoice_id, Type, CompanyID, Collector) VALUES ($collectioncount, $cusid, $id1, '$invdate', $invoice, $type, $company, $collector)";
	mysqli_query($conn,$result1);
	//cash table
	$cashcount = 0;
	$result = mysqli_query($conn,"SELECT * FROM token ");
	while($row = mysqli_fetch_array($result)){
		// GLOBAL $cashcount;
		$cashcount = $row[0];
	}
	$cashcount = $cashcount + 1;

	$result1 = "INSERT INTO token (ID, token, Invoice_ID, CompanyID, tokenDate, CollectionID, Collector) VALUES ($cashcount, $ammount, $invoice, $company, '$invdate', $collectioncount, $id1)";
	mysqli_query($conn,$result1);
}

mysqli_close($conn);
header('location:NewCollection.php');

// log process
include 'functions/activity.php';
activity($_SESSION['id'],"Made A Cash Collection");
// end of log process

?>
