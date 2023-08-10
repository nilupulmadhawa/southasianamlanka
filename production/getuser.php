<!DOCTYPE html>
<html>
<head>
    <script src="resource/jquery.min.js"></script>
    <link rel="stylesheet" href="resource/css/bootstrap.min.css">
    <link rel="stylesheet" href="resource/css/bootstrap-theme.min.css">
    <script src="resource/js/bootstrap.min.js"></script>
    <script src="typeahead.min.js"></script>
</head>
<body>

<?php
$q = intval($_GET['q']);

include'connection.php';


$sql="SELECT * FROM tbl_product WHERE id = '".$q."'";
$result = mysqli_query($conn,$sql);

echo "<table class='table table-condensed' style='font-size:12px;'>
<tr>
<th>Product Name</th>
<th>Price</th>
<th>Cost Price</th>
<th>Reorder Level</th>
<th>M.R.Level</th>
</tr>";
while($row = mysqli_fetch_array($result)) {
    echo "<tr>";
    echo "<td>" . $row[1] . "</td>";
    echo "<td>Rs." . $row[2] . "</td>";
    echo "<td>Rs." . $row[3] . "</td>";
    echo "<td>" . $row[5] . "</td>";
    echo "<td>" . $row[6] . "</td>";
    echo "</tr>";
}
echo "</table>";
mysqli_close($conn);
?>
</body>
</html>