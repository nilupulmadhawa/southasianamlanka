<?php
session_start();
include 'connection.php';

if(isset($_POST['clean'])){
  $refer = $_POST['clean'];
  $sql = "UPDATE tbl_ret_final SET RepID = NULL WHERE GroupID = '$refer' ";
  if(mysqli_query($conn, $sql)){
    echo "ok";
  }else{
    echo mysqli_error($conn);
  }
}

if(isset($_POST['RepName']) && isset($_POST['RefID'])){

  $repID = mysqli_real_escape_string($conn,$_POST['RepName']);
  $refer = mysqli_real_escape_string($conn,$_POST['RefID']);

  echo $repID."<br/>";
  echo $refer."<br/>";

  $_SESSION['RepAllocation']  = $repID;

  $sql = "UPDATE tbl_ret_final SET RepID = $repID WHERE GroupID = '$refer' ";
  if(mysqli_query($conn, $sql)){
    echo "ok";
  }else{
    echo mysqli_error($conn);
  }

}else if(isset($_POST['RepName']) && !isset($_POST['RefID'])){
    $repID = mysqli_real_escape_string($conn,$_POST['RepName']);
    $_SESSION['RepAllocation']  = $repID;
    echo "second is ok";

}

header('location:RepAllocation.php');
