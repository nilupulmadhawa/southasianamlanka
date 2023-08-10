<?php
session_start();
$itemname = $_GET['name'];
$_SESSION['cusname'] = $itemname;
header('location:NewCollection.php')
 ?>