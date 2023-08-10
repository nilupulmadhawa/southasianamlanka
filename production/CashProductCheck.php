<!DOCTYPE html>
<html>
<head>
    <script src="Resource/jquery.min.js"></script>
    <link rel="stylesheet" href="Resource/css/bootstrap.min.css">
    <link rel="stylesheet" href="Resource/css/bootstrap-theme.min.css">
    <script src="Resource/js/bootstrap.min.js"></script>
    <script src="typeahead.min.js"></script>
</head>
<body>

<?php
$q = intval($_GET['q']);

include'connection.php';


$sql="SELECT * FROM invoice WHERE Inv_ID = '".$q."'";
$result = mysqli_query($conn,$sql);
while($row = mysqli_fetch_array($result)) {
    GLOBAL $cusID;
    $cusID = $row['Customer_id'];    
}
$result = mysqli_query($conn,"SELECT * FROM cus_profile");
while($row = mysqli_fetch_array($result)){
    GLOBAL $name;
    $name = $row['Name'];
}

echo $name;
mysqli_close($conn);
?>
</body>
</html>