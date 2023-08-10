<?php

require_once './../../util/initialize.php';

if (isset($_POST['save'])) {

    $inventory = new Inventory();
    // $inventory->id=  trim($_POST['id']);
    $inventory->qty = trim($_POST['qty']);
    $inventory->product_id = trim($_POST['product_id']);
    //$inventory->product_id = 1;
    try {

        $inventory->save();
        Activity::log_action("Inventory - saved");
        $_SESSION["message"] = "Successfully saved.";
        Functions::redirect_to("../inventory_management.php");
    } catch (Exception $exc) {
        $_SESSION["error"] = "Error..! Failed to save.";
        Functions::redirect_to("../inventory_management.php");
    }
}

if (isset($_POST['update'])) {
    $inventory = Inventory::find_by_id($_POST['id']);
    $inventory->qty = trim($_POST['qty']);
    $inventory->product_id = trim($_POST['product_id']);

    try {
        $inventory->save();
        Activity::log_action("Inventory - updated:" . $inventory->id);
        $_SESSION["message"] = "Successfully updated.";
        Functions::redirect_to("../inventory_management.php");
    } catch (Exception $exc) {
        $_SESSION["error"] = "Error..! Failed to update.";
        Functions::redirect_to("../inventory_management.php");
    }
}


if (isset($_POST['delete'])) {
    $inventory = Inventory::find_by_id($_POST["id"]);

    try {
        $inventory->delete();
        Activity::log_action("Inventory - deleted:" . $inventory->id);
        $_SESSION["message"] = "Successfully deleted.";
        Functions::redirect_to("../inventory_management.php");
    } catch (Exception $exc) {
        $_SESSION["error"] = "Error..! Failed to delete.";
        Functions::redirect_to("../inventory_management.php");
    }
}
?>