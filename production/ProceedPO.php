<?php
session_start();
include 'connection.php';
$name = $_GET['name'];
include 'functions/POquantity.php';
include 'functions/addpodatabase.php';
$invdate = date("Y-m-d");

$reppoid = 0;
	$result = mysqli_query($conn,"SELECT * FROM rep_po ");
	while($row = mysqli_fetch_array($result)){
		GLOBAL $reppoid;
		$reppoid = $row[0];
	}
	$reppoid = $reppoid + 1;

$result = "INSERT INTO rep_po (ID, CustomerName, date) VALUES ($reppoid, '$name', '$invdate' )";
//mysqli_query($conn,$result);

if (mysqli_query($conn, $result)) {
    echo "New record created successfully";
    $_SESSION['success']='SUCCESS! YOU HAVE SUCCESSFULLY PLACED A PURCHASE ORDER. <b style="color:black;">PLEASE SELECT THE PURCHASE <b style="color:red;">ORDER ID</b> FOR FURTHER CUSTOMIZATION.</b>';
} else {
    $_SESSION['success']="OOPS! THERE WAS AN ERROR.";
    echo "Error: " . $sql . "<br>" . mysqli_error($conn);
}


$result = mysqli_query($conn,"SELECT * FROM supplier WHERE Name='$name' ");
            while($row = mysqli_fetch_array($result)){
              GLOBAL $supid;
              $supid = $row[0];
            }


            $result = mysqli_query($conn,"SELECT * FROM item WHERE Supplier_ID='$supid' ");
            while($row = mysqli_fetch_array($result)){



                $itemname = $row[2];
               $qty =  quantity($row[0],$row[6]);
               add($reppoid,$itemname,$qty);




            }
 mysqli_close($conn);
 header('location:PurchaseOrderDetailed.php');

 // log process
 include 'functions/activity.php';
 activity($_SESSION['id'],"Purchase Order generated");
 // end of log process
?>
