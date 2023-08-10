<?php

require_once './../../util/initialize.php';

if (isset($_POST['save'])) {
    if (Functions::check_privilege_redirect("Category", "ins", "./../index.php")) {
        $brand = new Brand();
        $brand->name = trim($_POST['name']);

        try {
            $brand->save();
            Activity::log_action("Brand saved - " . $brand->name);
            $_SESSION["message"] = "Successfully saved.";
            Functions::redirect_to("./../brand_management.php");
        } catch (Exception $exc) {
            $_SESSION["error"] = "Error..! Failed to save.";
            Functions::redirect_to("./../brand_management.php");
        }
    }
}

if (isset($_POST['update'])) {
    if (Functions::check_privilege_redirect("Category", "upd", "./../index.php")) {
        $brand = Brand::find_by_id($_POST['id']);
        $brand->name = trim($_POST['name']);

        try {
            $brand->save();
            Activity::log_action("Brand updated - " . $brand->name);
            $_SESSION["message"] = "Successfully updated.";
            Functions::redirect_to("./../brand_management.php");
        } catch (Exception $exc) {
            $_SESSION["error"] = "Error..! Failed to update.";
            Functions::redirect_to("./../brand_management.php");
        }
    }
}


if (isset($_POST['delete'])) {
    if (Functions::check_privilege_redirect("Category", "del", "./../index.php")) {
        $brand = Brand::find_by_id($_POST["id"]);
        try {
            $brand->delete();
            Activity::log_action("Brand deleted - " . $brand->name);
            $_SESSION["message"] = "Successfully deleted.";
            Functions::redirect_to("./../brand_management.php");
        } catch (Exception $exc) {            
                $_SESSION["error"] = "Error..! Failed to deleted.";
                Functions::redirect_to("./../brand_management.php");            
        }
    }
}
?>

