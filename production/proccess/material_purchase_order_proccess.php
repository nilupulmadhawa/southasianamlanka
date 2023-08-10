<?php

require_once './../../util/initialize.php';

if (isset($_POST["po_material_request"])) {
    $po_materials = array();
    if (isset($_SESSION["po_materials"])) {
        header('Content-Type: application/json');
//        $_SESSION["po_materials"] = array_values($_SESSION["po_materials"]);


        foreach ($_SESSION["po_materials"] as $index => $po_material) {
            $material = Material::find_by_id($po_material["material_id"]);
            $po_material["material_id"] = $material->name;
            $po_material["index"] = $index;

            $po_materials[] = $po_material;
        }
    }
    echo json_encode($po_materials);
}

if (isset($_POST["addMaterial"])) {
    $po_material = array();
    $po_material["material_id"] = $_POST['material_id'];
    $po_material["volume"] = $_POST['volume'];

    if (isset($_SESSION["po_materials"])) {
        $_SESSION["po_materials"][] = $po_material;
    } else {
        $_SESSION["po_materials"] = array();
        $_SESSION["po_materials"][] = $po_material;
    }
}

if (isset($_POST["remove"])) {
    $removeingIndex = $_POST["index"];
    unset($_SESSION["po_materials"][$removeingIndex]);
}

if (isset($_POST["check_material"])) {
    $checking_material_id = $_POST["id"];
    $availability;
    if (isset($_SESSION["po_materials"])) {
        foreach ($_SESSION["po_materials"] as $key => $value) {
            if ($value["material_id"] == $checking_material_id) {
                $availability = true;
            }
        }
    }
    echo json_encode($availability);
}

if (isset($_POST["clearPOMaterial"])) {
    if (isset($_SESSION["po_materials"])) {
        unset($_SESSION["po_materials"]);
    }
}

if (isset($_POST["save"])) {
    $supplier_id = $_POST["supplier_id"];
    $code = $_POST["code"];
    $date = date('Y-m-d H:i:s');
    $user_id = $_SESSION["user"]["id"];

    $purchase_order = new PurchaseOrder();
    $purchase_order->code = $code;
    $purchase_order->date = $date;
    $purchase_order->supplier_id = $supplier_id;
    $purchase_order->purchase_order_type_id = 2;
    $purchase_order->user_id = $user_id;
    $purchase_order->purchase_order_status_id = 1;

    global $database;
    $database->start_transaction();
    try {
        $purchase_order->save();
        $inserted_po_id = PurchaseOrder::last_insert_id();
        if (isset($_SESSION["po_materials"])) {
            foreach ($_SESSION["po_materials"] as $index => $po_material) {

                $purchase_order_material = new PurchaseOrderMaterial();
                echo $purchase_order_material->to_array();
                $purchase_order_material->purchase_order_id = $inserted_po_id;
                $purchase_order_material->material_id = $po_material["material_id"];
                $purchase_order_material->volume = $po_material["volume"];
                $purchase_order_material->save();
            }
        }
        unset($_SESSION["po_materials"]);

        $database->commit();
        Activity::log_action("Material Purchase order - saved:" . $inserted_po_id);
        $_SESSION["message"] = "Successfully saved. ";
        Functions::redirect_to('../material_purchase_order.php');
    } catch (Exception $exc) {
        $database->rollback();
        $_SESSION["error"] = "Failed to save Purchase Order";
        Functions::redirect_to('../material_purchase_order.php');
    }
}

if (isset($_POST["update"])) {
    $id = $_POST["id"];
    $purchase_order = PurchaseOrder::find_by_id($id);
    $purchase_order->purchase_order_type_id = 1;
    $purchase_order->supplier_id = $_POST["supplier_id"];
//    $purchase_order->code = $_POST["code"];
//    $purchase_order->date = date("Y-m-d");
    $purchase_order->user_id = $_SESSION["user"]["id"];

    global $database;
    $database->start_transaction();
    try {
        $current_purchase_order_products = PurchaseOrderMaterial::find_all_by_purchase_order_id($id);
        foreach ($current_purchase_order_material as $value) {
            $value->delete();
        }

        $purchase_order->save();

        if (isset($_SESSION["po_materials"])) {
            foreach ($_SESSION["po_materials"] as $index => $po_material) {
                $purchase_order_material = new PurchaseOrderProduct();
                $purchase_order_material->purchase_order_id = $id;
                $purchase_order_material->material_id = $po_material["material_id"];
                $purchase_order_material->volume = $po_material["volume"];
                $purchase_order_material->save();
            }
        }
        unset($_SESSION["po_materials"]);

        $database->commit();
        Activity::log_action("Material Purchase order - updated:" . $purchase_order->id);
        $_SESSION["message"] = "Successfully updated";
        Functions::redirect_to('../material_purchase_order.php');
    } catch (Exception $exc) {
        $database->rollback();
        $_SESSION["error"] = "Failed to update Purchase Order";
        Functions::redirect_to('../material_purchase_order.php');
    }
}

if (isset($_POST["delete"])) {
    $id = $_POST["id"];
    $purchase_order = PurchaseOrder::find_by_id($id);

    global $database;
    $database->start_transaction();
    try {
        $current_purchase_order_material = PurchaseOrderMaterial::find_all_by_purchase_order_id($purchase_order->id);
        foreach ($current_purchase_order_material as $value) {
            $value->delete();
        }

        $purchase_order->delete();
        unset($_SESSION["po_materials"]);

        $database->commit();
        Activity::log_action("Material Purchase order - deleted:" . $purchase_order->id);
        $_SESSION["message"] = "Successfully deleted";
        Functions::redirect_to('../material_purchase_order.php');
    } catch (Exception $exc) {
        $database->rollback();
        $_SESSION["error"] = "Failed to delete Purchase Order";
        Functions::redirect_to('../material_purchase_order.php');
    }
}
?>