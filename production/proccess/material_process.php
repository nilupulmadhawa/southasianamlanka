<?php

require_once './../../util/initialize.php';

if (isset($_POST['save'])) {
    $material = new Material();
    $material->name = trim($_POST['name']);

    try {
        $material->save();
        Activity::log_action("Material - saved : ".$material->name);
        $_SESSION["message"] = "Successfully saved.";
        Functions::redirect_to("./../material.php");
    } catch (Exception $exc) {
        $_SESSION["error"] = "Error..! Failed to saveaa.";
        Functions::redirect_to("./../material.php");
    }
}

if (isset($_POST['update'])) {
    $material = Material::find_by_id($_POST['id']);
    $material->name = trim($_POST['name']);
    

    try {
        $material->save();
        Activity::log_action("Material - updated : ".$material->name);
        $_SESSION["message"] = "Successfully updated.";
        Functions::redirect_to("./../material.php");
//        Functions::redirect_to("./../product_management.php");
    } catch (Exception $exc) {
        $_SESSION["error"] = "Error..! Failed to update.";
        Functions::redirect_to("./../material.php");
//        Functions::redirect_to("./../product_management.php");
    }
}


if (isset($_POST['delete'])) {
    $material = Material::find_by_id($_POST["id"]);
    
    try {
        $material->delete();
        Activity::log_action("Material - deleted : ".$material->name);
        $_SESSION["message"] = "Successfully deleted.";
        Functions::redirect_to("../material.php");
    } catch (Exception $exc) {
        $_SESSION["error"] = "Error..! Failed to delete.";
        Functions::redirect_to("../material.php");
    }
}
?>
