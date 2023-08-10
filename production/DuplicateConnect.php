<?php 
$invoice =  $_GET['id'];
$_SESSION['invoice'] = $invoice;
header('location:InvoicePrint.php');
?>