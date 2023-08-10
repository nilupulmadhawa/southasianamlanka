<?php 
session_start();
$q = $_REQUEST["q"];
if($q == "ACTIVE"){
$_SESSION['active'] = $q;
echo $q;
}
else if($q == "DEACTIVE"){
	unset($_SESSION['active']);
	echo $q;
}


?>