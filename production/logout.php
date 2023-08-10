<?php
session_start();

// log process
// include 'functions/activity.php';
// activity($_SESSION['id'],"Logged Out");
// end of log process

unset($_SESSION['id']);
session_destroy();
header("location:../index.php");
?>
