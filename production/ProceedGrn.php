<?php 
session_start();
$id1 = $_SESSION['id'];
include 'connection.php';
$po = $_SESSION['POID'];
$poid = $_POST['poid'];

$sql2 = "UPDATE rep_po SET POID = '$poid' WHERE ID = $po ";
mysqli_query($conn,$sql2);

//proceed with the grn
$result = mysqli_query($conn,"SELECT * FROM rep_po WHERE ID = $po");
while($row = mysqli_fetch_array($result)){
//	GLOBAL $supname;
	$supname = $row[1];
}
$date = date("Y-m-d");
echo $supname."</br>";
$test = substr($supname,0,3);
//echo $test."</br>";

//supid
$result = mysqli_query($conn,"SELECT * FROM supplier WHERE Name = '$supname' ");
while($row = mysqli_fetch_array($result)){
//	GLOBAL $supid,$due;
	$supid = $row[0];
	$due = $row[7];
}
echo $supid;

//add to the table po
$count1 = 0;
$result = mysqli_query($conn,"SELECT * FROM po");
while($row = mysqli_fetch_array($result)){
	GLOBAL $count1;
	$count1 = $row[0];
}
$count1 = $count1 + 1;
$purchase = $test.".".$poid;
$wtoday = date('Y-m-d', strtotime($due.' day', strtotime($date)));
$result = "INSERT INTO po (ID, PurchaseDate, PoID, SupplierID, Type, DueDate, written, WrittenDate ) VALUES ($count1, '$date', '$purchase', $supid, 0, $due , 0, '$wtoday' )";
//mysqli_query($conn,$result);

if (mysqli_query($conn, $result)) {
    $_SESSION['success']='SUCCESS! YOU HAVE SUCCESSFULLY GENERATED A GRN!!';
    echo "New record created successfully";
} else {
    $_SESSION['success']="OOPS! THERE WAS AN ERROR.";
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}


//function for inventory-------------------------------------------------------------------------------------------------------------
function setinv($itid,$itqty){
	include 'connection.php';
	$result = mysqli_query($conn,"SELECT * FROM multiprice WHERE Item_ID = $itid ");
	while($row = mysqli_fetch_array($result)){
		//GLOBAL $q;
		$q = $row[2];
	}
	$q = $q + $itqty;
	$sql2 = "UPDATE multiprice SET Qty = $q WHERE Item_ID = $itid ";
	mysqli_query($conn,$sql2);
	mysqli_close($conn);
}
//function for inventory-------------------------------------------------------------------------------------------------------------

//insert into rep_po_sub
$result = mysqli_query($conn,"SELECT * FROM rep_po_sub WHERE poID = '$po' ");
$subcount = mysqli_num_rows($result);
echo $subcount.'<br/>';
$itemcount = 1;
while($itemcount <= $subcount){
	//check item details
	$result = mysqli_query($conn,"SELECT * FROM rep_po_sub WHERE poID = '$po' LIMIT $itemcount ");
	while($row = mysqli_fetch_array($result)){
		GLOBAL $name,$qty,$free,$dis;
		$name = $row[2];
		$qty = $row[3];
		$free = $row[4];
		$dis = $row[5];
	}
	//item id
	$result = mysqli_query($conn,"SELECT * FROM item WHERE Name = '$name'  ");
	while($row = mysqli_fetch_array($result)){
		//GLOBAL $itemid,$costprice;
		$itemid = $row[0];
		$costprice = $row[3];
		
	}
	$costprice = 0;
	$retprice = 0;
	$wholeprice = 0;
	$result = mysqli_query($conn,"SELECT * FROM multiprice WHERE Item_ID = $itemid  ");
	while($row = mysqli_fetch_array($result)){
		
		$retprice = $row[5];
		$wholeprice = $row[4];
		$costprice = $row[3];
		
	}
	//insert to sub_po
	$count2 = 0;
	$result = mysqli_query($conn,"SELECT * FROM sub_po");
	while($row = mysqli_fetch_array($result)){
		GLOBAL $count2;
		$count2 = $row[0];
	}
	$count2 = $count2 + 1;

	$result = "INSERT INTO sub_po (ID, Qty, FreeIssue, RetPrice, CostPrice, Wprice,  Discount, ItemID, PoID) VALUES ($count2, $qty, $free, $retprice, $costprice, $wholeprice, $dis, $itemid, '$purchase')";
//	mysqli_query($conn,$result);
    
    if (mysqli_query($conn, $result)) {
        echo "New record created successfully";
    } else {
        echo "Error: " . $sql . "<br>" . mysqli_error($conn);
    }
    
	$finalqty = $qty + $free;
	setinv($itemid,$finalqty);
	$itemcount = $itemcount + 1;
}
$sql2 = "UPDATE rep_po SET status = 11 WHERE ID = $po ";
	mysqli_query($conn,$sql2);
//purchase order commision
function itemprice($itemname){
	include 'connection.php';
	$result = mysqli_query($conn,"SELECT * FROM item WHERE Name = '$itemname' ");
	while($row = mysqli_fetch_array($result)){
	GLOBAL $cost;
	$cost = $row[3];
	}
	return $cost;
	mysqli_close($conn);
}

$ptotal = 0;
$result = mysqli_query($conn,"SELECT * FROM rep_po_sub WHERE poID = '$po'  ");
	while($row = mysqli_fetch_array($result)){
	GLOBAL $ptotal;
	$sub  = 0;
	$sub = $row[3]* itemprice($row[2]);
	$ptotal = $ptotal + $sub;	
	}
	$ordercom = 0;
$ordercom =  $ptotal * 0.1;
$ordercom = $ordercom / 100;
echo $ordercom."<br>";
//get the employee
//$result = mysqli_query($conn,"SELECT * FROM purchase_emp WHERE PoID = '$po' ");
//	while($row = mysqli_fetch_array($result)){
//	GLOBAL $emp;
//	$emp = $row[1];
//	}
//	$result = mysqli_query($conn,"SELECT * FROM user_profile WHERE 	Name = '$emp' ");
//	while($row = mysqli_fetch_array($result)){
//	GLOBAL $emp1;
//	$emp1 = $row[0];
//	}
$orderdate = date("Y-m-d");
//echo $emp."<br>";
//$result = mysqli_query($conn,"SELECT * FROM commision ");
//while($row = mysqli_fetch_array($result)){
 // GLOBAL $count4;
  //$count4 = $row[0];
//} 
//$count4 = $count4 + 1;
//$result1 = "INSERT INTO commision (ID, Emp_id, commision, type, commisionDate, InvoiceID) VALUES ($count4, $emp1,  $ordercom, 'Purchase Order', '$orderdate', $po )";
//mysqli_query($conn,$result1);
//submit data

//end of purchase order commision

//log start
date_default_timezone_set("Asia/Kolkata");
$time =   date("h:i:s");
$today = date("Y-m-d");

//$logcount = 0;
//$result = mysqli_query($conn,"SELECT * FROM log");
//while($row = mysqli_fetch_array($result)){
//	$logcount = $row[0];
//}
//	$logcount = $logcount + 1;
//$result = "INSERT INTO log (ID, Purpose, RefID, Date, time, User_id) 
//VALUES ($logcount, 'Purchse Order Porceeded to the GRN', '$purchase', '$today', '$time', $id1)";
//mysqli_query($conn,$result);
//log end



header('location:DetailedReportPO.php');
mysqli_close($conn);
?>