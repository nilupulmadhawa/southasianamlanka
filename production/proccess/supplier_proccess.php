<?php

require_once './../../util/initialize.php';

if (isset($_POST['save'])) {
    $supplier = new Supplier();
    $supplier->name = trim($_POST['name']);
    $supplier->address = trim($_POST['address']);
    $supplier->email = trim($_POST['email']);
    $supplier->contact_no = trim($_POST['contact_no']);

    try {
        $supplier->save();
        Activity::log_action("Supplier - saved : ".$supplier->name);
        $_SESSION["message"] = "Successfully saved.";
        Functions::redirect_to("./../supplier.php");
    } catch (Exception $exc) {
        $_SESSION["error"] = "Error..! Failed to save.";
        Functions::redirect_to("./../supplier.php");
    }
}

if (isset($_POST['update'])) {
    $supplier = Supplier::find_by_id($_POST['id']);
    $supplier->name = trim($_POST['name']);
    $supplier->address = trim($_POST['address']);
    $supplier->email = trim($_POST['email']);
    $supplier->contact_no = trim($_POST['contact_no']);
    
    try {
        $supplier->save();
        Activity::log_action("Supplier - updated : ".$supplier->name);
        $_SESSION["message"] = "Successfully updated.";
        Functions::redirect_to("./../supplier.php");
    } catch (Exception $exc) {
        $_SESSION["error"] = "Error..! Failed to update.";
        Functions::redirect_to("./../supplier.php");
    }
}


if (isset($_POST['delete'])) {
    $supplier = Supplier::find_by_id($_POST["id"]);
    
    try {
        $supplier->delete();
        Activity::log_action("Supplier - deleted : ".$supplier->name);
        $_SESSION["message"] = "Successfully deleted.";
        Functions::redirect_to("./../supplier.php");
    } catch (Exception $exc) {
        $_SESSION["error"] = "Error..! Failed to deleted.";
        Functions::redirect_to("./../supplier.php");
    }
}
?>

