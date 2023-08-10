<?php
session_start(); 
$start = $_GET['id'];
include 'connection.php';
$result = mysqli_query($conn,"SELECT * FROM rep_po WHERE ID = $start");
while($row = mysqli_fetch_array($result)){
    $cusname = $row[1];
    $date = $row[2];
    //$cusname = $row[1];
}
$result = mysqli_query($conn,"SELECT * FROM supplier WHERE Name = '$cusname' ");
while($row = mysqli_fetch_array($result)){
    $address = $row[2];
    $contact = $row[3];
    //$cusname = $row[1];
}
mysqli_close($conn);
?>
<html>
<head>
  <?php include 'title.php'; ?>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <link rel="stylesheet" href="Resource/css/bootstrap.min.css">
  <script src="Resource/jquery/jquery-1.11.3.min.js"></script>
  <script src="Resource/js/bootstrap.min.js"></script>
  <style>
@font-face {
    font-family: myFirstFont;
    src: url(Resource/LUCON.TTF);
}

body {
    font-family: myFirstFont;
}
    </style>
</head>
<body>
<!--header-->
    <div style="width:700px;">
	
<div style='width:320px;margin-left:20px;float:left;'>
	<div style="width:300px;border:1px solid;border-radius:10px;font-size:20px;padding-left:5px;text-align:center;padding-top:10px;"><b>PURCHASE ORDER</b></div>
	<div style='width:110px;float:left;'>P.O. Number </div><?php echo ":<b>".$start."</b><br/>"; ?>
	<div style='width:110px;float:left;'>Date</div><?php echo ":<b>".$date."</b><br/>"; ?>
	
	
	</div>	
	</div>
    <div style="width:700px;clear:both;">
	<div style='width:330px;margin-left:20px;float:left;'>
	
	<br/>
        <div style="font-size:12px;"><b>VENDOR</b></div>
	<div style="font-size:12px;"><?php echo $cusname; ?></div>
	<div style="font-size:10px;"><?php echo $address; ?></div>
	<div style="font-size:10px;"><?php echo $contact; ?></div>
	
	</div>
<div style='width:320px;margin-left:20px;float:left;height:100px;margin-top:15px;'>
	
    <div style="font-size:12px;"><b>TRANSPORT TO</b></div>
	
	<div style="font-size:12px;">The Manager</div>
	<div style="font-size:10px;">SIGMA Pharmaceuticals (Pvt) Ltd,</div>
	<div style="font-size:10px;">Tel: +94 123 456 789</div>
	
	
	</div>	
	</div>
<!--customer-->
	
	<!--table header-->
	<div style="width:700px;height:40px;padding-top:5px;margin-left:20px;border:1px solid;clear:both;">
	
	<div style="font-size:12px;margin-left:20px;width:550px;float:left;text-align:left;">Description </div>
        <div style="font-size:12px;margin-left:20px;width:90px;float:left;text-align:right;">Qty</div>
<!--	<div style="font-size:12px;margin-left:20px;width:50px;float:left;text-align:center;">Unit Price</div>-->
	<!--<div style="font-size:12px;margin-left:20px;width:70px;float:left;text-align:right;">Unit Price</div>-->
<!--	<div style="font-size:12px;margin-left:20px;width:100px;float:left;text-align:right;">Sub Total</div>-->
	<!--<div style="font-size:12px;margin-left:20px;width:80px;float:left;text-align:right;">Remarks</div>-->
	</div>

	<?php
	
	function itemname($itemid){
		include 'connection.php';
		$result = mysqli_query($conn,"SELECT * FROM item WHERE Item_ID = $itemid");
		while($row = mysqli_fetch_array($result)){
			GLOBAL $itemname;
			$itemname = $row[1];
						
		}
		return $itemname;
		mysqli_close($conn);
	}
	include 'connection.php';
	$result = mysqli_query($conn,"SELECT * FROM rep_po_sub WHERE poID = $start ");
    while($row = mysqli_fetch_array($result)){
        if($row[3] > 0){
        ?>
    <div style="width:700px;height:20px;padding-top:5px;margin-left:20px;clear:both;">
    <div style="font-size:12px;margin-left:20px;width:550px;float:left;text-align:left;"> <?php echo $row[2]; ?> </div>
        <div style="font-size:12px;margin-left:20px;width:90px;float:left;text-align:right;"> <?php echo $row[3]; ?> </div>
    </div>
    <?php 
        }
    }
	mysqli_close($conn);
	?>





<script>
window.print();
</script>
	
<body/>
</html>