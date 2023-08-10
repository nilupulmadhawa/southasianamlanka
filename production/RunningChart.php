<?php
session_start();
$repdate = $_POST['repdate'];
$rep = $_POST['rep'];
$_SESSION['check'] = 1;    
$_SESSION['repdate'] = $repdate;    
$_SESSION['repid'] = $rep; 
header('location:RunningChardDetailed.php');
?>