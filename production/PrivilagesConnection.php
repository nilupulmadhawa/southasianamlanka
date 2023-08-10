<?php
session_start();
include 'connection.php';
if(isset($_POST['userID'])){
    $userID = $_POST['userID'];

    $sql = "DELETE FROM tbl_role WHERE user_id=$userID";
    if (mysqli_query($conn, $sql)) {
        echo "Record deleted successfully";
    } else {
        echo "Error deleting record: " . mysqli_error($conn);
    }


    $step = 1;
    $count = 47;
    while($step <= $count){
        if(isset($_POST[$step])){
            $module = $_POST[$step];
           $sql = "INSERT INTO  tbl_role (user_id, module_id) VALUES ($userID,$step)";
            if (mysqli_query($conn, $sql)) {
                echo "New record created successfully";
            } else {
                echo "Error: " . $sql . "<br>" . mysqli_error($conn);
            }
        }
    $step = $step + 1;
    }
}
mysqli_close($conn);
header('location:Privilages.php');

// log process
include 'functions/activity.php';
activity($_SESSION['id'],"Priviliage Changed");
// end of log process
