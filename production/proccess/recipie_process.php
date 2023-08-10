<?php

require_once './../../util/initialize.php';

if (isset($_POST['save'])) {
    $recipie = new Recipie();
    $recipie->name = trim($_POST['name']);
    $recipie->description = trim($_POST['description']);
    

    try {
        $recipie->save();
        Activity::log_action("Recipie - saved : ".$recipie->name);
        $_SESSION["message"] = "Successfully saved.";
        Functions::redirect_to("./../recipie.php");
    } catch (Exception $exc) {
        $_SESSION["error"] = "Error..! Failed to save.";
        Functions::redirect_to("./../recipie.php");
    }
}

if (isset($_POST['update'])) {
    $recipie = Recipie::find_by_id($_POST['id']);
    $recipie->name = trim($_POST['name']);
    $recipie->description = trim($_POST['description']);
    

    try {
        $recipie->save();
        Activity::log_action("Recipie - updated : ".$recipie->name);
        $_SESSION["message"] = "Successfully updated.";
        Functions::redirect_to("./../recipie.php");
//        Functions::redirect_to("./../product_management.php");
    } catch (Exception $exc) {
        $_SESSION["error"] = "Error..! Failed to update.";
        Functions::redirect_to("./../recipie.php");
//        Functions::redirect_to("./../product_management.php");
    }
}


if (isset($_POST['delete'])) {
    $recipie = Recipie::find_by_id($_POST["id"]);
    
    try {
        $recipie->delete();
        Activity::log_action("Recipie - deleted : ".$recipie->name);
        $_SESSION["message"] = "Successfully deleted.";
        Functions::redirect_to("./../recipie.php");
//        Functions::redirect_to("./../product_management.php");
    } catch (Exception $exc) {
        $_SESSION["error"] = "Error..! Failed to delete.";
        Functions::redirect_to("./../recipie.php");
//        Functions::redirect_to("./../product_management.php");
    }
}
?>