<?php 
session_start();
$q = $_REQUEST["q"];
if($q == 1){
$_SESSION['zero'] = "1";
//echo "one";
}
else if($q == 2){
$_SESSION['zero'] = "2";
//echo "two";
}
?>