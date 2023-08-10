<?php 
session_start();

$com = $_POST['com'];
//echo $com;
$_SESSION['company'] = $com;
$_SESSION['error'] = 1;

header('location:switch.php');
?>