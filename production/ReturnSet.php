<?php
session_start();
$invo = $_GET['invo'];
include 'connection.php';
if(isset($_SESSION['issue']) && $_SESSION['issue'] == "set"){
	$set = $_SESSION['issue'];
}

$count = 0;
$result = mysqli_query($conn,"SELECT * FROM return_invoice WHERE status = 0");
while($row = mysqli_fetch_array($result)){
	$count = $count + 1;
}
$steps = 1;
$ReturnTotal = 0;
while($steps <= $count){
	$result = mysqli_query($conn,"SELECT * FROM return_invoice WHERE status = 0 LIMIT $steps");
	while($row = mysqli_fetch_array($result)){
		GLOBAL $item,$type;
		$item = $row[1];
		$type = $row[8];
		$qty = $row[2];
		$multi = $row[9];
	}

	if($type == 3 || $type == 4){


		$result = mysqli_query($conn,"SELECT * FROM multiprice WHERE ID = $multi");
		while($row = mysqli_fetch_array($result)){
			//GLOBAL $multiCount;
			$multiCount = $row[2];
			$wp = $row[4];
		}
		$multiCount = $multiCount + $qty;
		$sql2 = "UPDATE multiprice SET Qty = $multiCount WHERE ID = $multi ";
		mysqli_query($conn,$sql2);
		$ReturnTotal = $ReturnTotal + $wp;
	}

	else if(isset($set) && $set == 'set'){


		$result = mysqli_query($conn,"SELECT * FROM multiprice WHERE ID = $multi");
		while($row = mysqli_fetch_array($result)){
			//GLOBAL $multiCount;
			$multiCount = $row[2];
			$wp = $row[4];
		}
		$multiCount = $multiCount - $qty;
		$sql2 = "UPDATE multiprice SET Qty = $multiCount WHERE ID = $multi ";
		mysqli_query($conn,$sql2);
		$ReturnTotal = $ReturnTotal + $wp;
	}

	else{

		$result = mysqli_query($conn,"SELECT * FROM multiprice WHERE ID = $multi");
		while($row = mysqli_fetch_array($result)){
			//GLOBAL $multiCount;
			$multiCount = $row[2];
			$wp = $row[4];
		}


		$ReturnTotal = $ReturnTotal + $wp;
	}

	$steps = $steps + 1;
}
//get the balance of the invoice
$result = mysqli_query($conn,"SELECT * FROM invoice WHERE Inv_ID = $invo");
while($row = mysqli_fetch_array($result)){
	$bal = $row[6];
}
$balance = 0;
$balance = $bal + $ReturnTotal;
//update the invoice balance
$sql2 = "UPDATE invoice SET Balance = $balance WHERE Inv_ID = $invo ";
mysqli_query($conn,$sql2);

$sql2 = "UPDATE return_invoice SET status = 1 WHERE status = 0 ";
mysqli_query($conn,$sql2);
mysqli_close($conn);
unset($_SESSION['cus']);

if(isset($_SESSION['issue']) && $_SESSION['issue'] == "set"){
	header('location:itemreturn.php');
}

else{
	unset($_SESSION['issue']);
	unset($_SESSION['reID']);
	header('location:Return.php');

}

?>
