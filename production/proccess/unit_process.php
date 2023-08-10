<?php

require_once './../../util/initialize.php';

if (isset($_POST['save'])) {
    if (Functions::check_privilege_redirect("Category", "ins", "./../index.php")) {
        $unit = new Unit();
        $unit->name = trim($_POST['name']);

        try {
            $unit->save();
            Activity::log_action("Unit saved - " . $unit->name);
            $_SESSION["message"] = "Successfully saved.";
            Functions::redirect_to("./../unit_management.php");
        } catch (Exception $exc) {
            $_SESSION["error"] = "Error..! Failed to save.";
            Functions::redirect_to("./../unit_management.php");
        }
    }
}

if (isset($_POST['update'])) {
    if (Functions::check_privilege_redirect("Category", "upd", "./../index.php")) {
        $unit = Unit::find_by_id($_POST['id']);
        $unit->name = trim($_POST['name']);

        try {
            $unit->save();
            Activity::log_action("Unit updated - " . $unit->name);
            $_SESSION["message"] = "Successfully updated.";
            Functions::redirect_to("./../unit_management.php");
        } catch (Exception $exc) {
            $_SESSION["error"] = "Error..! Failed to update.";
            Functions::redirect_to("./../unit_management.php");
        }
    }
}


if (isset($_POST['delete'])) {
    if (Functions::check_privilege_redirect("Category", "del", "./../index.php")) {
        $unit = Unit::find_by_id($_POST["id"]);
        
        try {
            $unit->delete();
            Activity::log_action("Unit deleted - " . $unit->name);
            $_SESSION["message"] = "Successfully deleted.";
            Functions::redirect_to("./../unit_management.php");
        } catch (Exception $exc) {            
                $_SESSION["error"] = "Error..! Failed to deleted.";
                Functions::redirect_to("./../unit_management.php");            
        }
    }
}
?>

