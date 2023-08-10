<?php

require_once './../../util/initialize.php';

if (isset($_POST['save'])) {
    
    $target = new Target();
    $target->user_id = trim($_POST['cmbRep']);
    $target->target_month_id = trim($_POST['cmbMonth']);
    $target->amount = trim($_POST['txtAmount']);
//    $target->year = date("Y");
    $target->year = trim($_POST['txtYear']);
  
    $user = User::find_by_id($target->user_id);
    $username = $user->name;
    $user_id = $target->user_id;
    
    $month_name = TargetMonth::get_month_name_by_id($target->target_month_id);
    
    $target_month_id =$target->target_month_id;
    $existing_target = Target::find_by_sql("SELECT * FROM target WHERE user_id = $user_id AND target_month_id=$target_month_id");
    
    if(!empty($existing_target)){
        $_SESSION["error"] = "Faild To Save..! ".$month_name->name." target for user : ".$username."  has already added" ;
        Functions::redirect_to("./../target.php");
    }else{
        try {
            $target->save();
            Activity::log_action("Monthly Target - saved for: ".$username);
            $_SESSION["message"] = "Successfully saved.";
            Functions::redirect_to("./../target.php");
        } catch (Exception $exc) {
            $_SESSION["error"] = "Error..! Failed to save.";
            Functions::redirect_to("./../target.php");
        }
    }
    
}

if (isset($_POST['update'])) {
    
    
    $target = Target::find_by_id($_POST['txtId']);
    //$target->user_id = trim($_POST['cmbRep']);
    //$target->target_month_id = trim($_POST['cmbMonth']);
    $target->amount = trim($_POST['txtAmount']);
    $user = User::find_by_id($_POST['cmbRepp']);
    $username = $user->name;
    
    try {
//        echo "true";
        $target->save();
        Activity::log_action("Monthly Target - Updated for: ".$username);
        $_SESSION["message"] = "Successfully updated.";
        Functions::redirect_to("./../target.php");
    } catch (Exception $exc) {
//        echo "false";
        $_SESSION["error"] = "Error..! Failed to update.";
        Functions::redirect_to("./../target.php");
    }
}


if (isset($_POST['delete'])) {
    $target = Target::find_by_id($_POST["txtId"]);
    $user = User::find_by_id($target->user_id);
    $username = $user->name;
    try {
        $target->delete();
        Activity::log_action("Target has deleted for : ".$username);
        $_SESSION["message"] = "Successfully deleted.";
        Functions::redirect_to("./../target.php");
    } catch (Exception $exc) {
        $_SESSION["error"] = "Error..! Failed to deleted.";
        Functions::redirect_to("./../target.php");
    }
}
?>

