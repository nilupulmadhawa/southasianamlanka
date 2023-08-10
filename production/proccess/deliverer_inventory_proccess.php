<?php

require_once './../../util/initialize.php';

if (isset($_POST["available_qty"]) && isset($_POST["inventory_id"])) {
    header('Content-Type: application/json');
    $inventory_id = $_POST["inventory_id"];
    $current_inventory = Inventory::find_by_id($inventory_id)->qty;
    
    $deliverer_inventory_qty = 0;
    $deliverer_inventorys = DelivererInventory::find_all_by_inventory_id($inventory_id);
    if ($deliverer_inventorys) {
        foreach ($deliverer_inventorys as $db_deliverer_inventory) {
            $deliverer_inventory_qty += $db_deliverer_inventory->qty;
        }
    }

    $session_qty = 0;
    if (isset($_SESSION["deliverer_inventorys"])) {
        foreach ($_SESSION["deliverer_inventorys"] as $index => $ses_deliverer_inventory) {
            if ($ses_deliverer_inventory["inventory_id"] == $inventory_id) {
                $session_qty += $ses_deliverer_inventory["qty"];
            }
        }
    }
    
//    $available_qty=$current_inventory - $deliverer_inventory_qty;
    $available_qty=$current_inventory - $session_qty;
    echo json_encode($available_qty);
}

if (isset($_POST["inventory_request"])) {
    header('Content-Type: application/json');
    $deliverer_inventorys = array();
    
    if (isset($_SESSION["deliverer_inventorys"])) {
        foreach ($_SESSION["deliverer_inventorys"] as $index => $deliverer_inventory) {
            $inventory = Inventory::find_by_id($deliverer_inventory["inventory_id"]);
            $batch = $inventory->batch_id();
            
            $deliverer_inventory["inventory_id"] = $inventory->product_id()->name;
            $deliverer_inventory["batch_id"] = $batch->code;
            $deliverer_inventory["index"] = $index;

            $deliverer_inventorys[] = $deliverer_inventory;
        }
    }
    echo json_encode($deliverer_inventorys);
}

if (isset($_POST["add_inventory"])) {
    $deliverer_inventory = array();
    $deliverer_inventory["inventory_id"] = $_POST['inventory_id'];
    $deliverer_inventory["qty"] = $_POST['qty'];

    if (isset($_SESSION["deliverer_inventorys"])) {
        $update = false;
        foreach ($_SESSION["deliverer_inventorys"] as $index => $value) {
            if ($value["inventory_id"] == $deliverer_inventory["inventory_id"]) {
                $update = true;
                $value["qty"] = $value["qty"] + $deliverer_inventory["qty"];
                $_SESSION["deliverer_inventorys"][$index] = $value;
            }
        }

        if (!$update) {
            $_SESSION["deliverer_inventorys"][] = $deliverer_inventory;
        }
    } else {
        $_SESSION["deliverer_inventorys"] = array();
        $_SESSION["deliverer_inventorys"][] = $deliverer_inventory;
    }
}

if (isset($_POST["reload_deliverer_inventory"])) {
    $deliverer_id = $_POST['deliverer_id'];
    $db_deliverer_inventorys = DelivererInventory::find_all_by_deliverer_id($deliverer_id);
    $deliverer_inventorys = array();
    foreach ($db_deliverer_inventorys as $deliverer_inventory) {
        $deliverer_inventorys[] = $deliverer_inventory->to_array();
    }
    $_SESSION["deliverer_inventorys"] = $deliverer_inventorys;
}

if (isset($_POST["remove"])) {
    $removeingIndex = $_POST["index"];
    unset($_SESSION["deliverer_inventorys"][$removeingIndex]);
}

if (isset($_POST["check_inventory"])) {
    $checking_product_id = $_POST["id"];
    $availability;
    if (isset($_SESSION["deliverer_inventorys"])) {
        foreach ($_SESSION["deliverer_inventorys"] as $key => $value) {
            if ($value["inventory_id"] == $checking_product_id) {
                $availability = true;
            }
        }
    }
    echo json_encode($availability);
}

if (isset($_POST["session_count"])) {
    if (isset($_SESSION["deliverer_inventorys"])) {
        echo json_encode(sizeof($_SESSION["deliverer_inventorys"]));
    }
}

if (isset($_POST["clearPOProducts"])) {
    if (isset($_SESSION["deliverer_inventorys"])) {
        unset($_SESSION["deliverer_inventorys"]);
    }
}

if (isset($_POST["save"])) {
    $deliverer_id = $_POST["deliverer_id"];

    global $database;
    $database->start_transaction();
    try {
        foreach (DelivererInventory::find_all_by_deliverer_id($deliverer_id) as $db_deliverer_inventory) {
            $db_deliverer_inventory->delete();
        }

        if (isset($_SESSION["deliverer_inventorys"])) {
            foreach ($_SESSION["deliverer_inventorys"] as $index => $ses_deliverer_inventory) {
                $deliverer_inventory = new DelivererInventory();
                $deliverer_inventory->deliverer_id = $deliverer_id;
                $deliverer_inventory->inventory_id = $ses_deliverer_inventory["inventory_id"];
                $deliverer_inventory->qty = $ses_deliverer_inventory["qty"];
                $deliverer_inventory->save();

//                $deliverer_inventory = DelivererInventory::find_by_deliverer_id_inventory_id($deliverer_id, $ses_deliverer_inventory["inventory_id"]);
//                if ($deliverer_inventory) {
//                    $deliverer_inventory->qty = ((int) $deliverer_inventory->qty) + ((int) $ses_deliverer_inventory["qty"]);
//                    $deliverer_inventory->save();
//                } else {
//                    $deliverer_inventory = new DelivererInventory();
//                    $deliverer_inventory->deliverer_id = $deliverer_id;
//                    $deliverer_inventory->inventory_id = $ses_deliverer_inventory["inventory_id"];
//                    $deliverer_inventory->qty = $ses_deliverer_inventory["qty"];
//                    $deliverer_inventory->save();
//                }
            }
        }
        unset($_SESSION["deliverer_inventorys"]);

        $database->commit();
        Activity::log_action("Deliverer Inventory - saved, deliverer : " . Deliverer::find_by_id($deliverer_id)->number);
        $_SESSION["message"] = "Successfully saved";
        Functions::redirect_to('../deliverer_inventory_management.php');
    } catch (Exception $exc) {
        $database->rollback();
        $_SESSION["error"] = "Failed to save Deliverer Inventory";
        Functions::redirect_to('../deliverer_inventory_management.php');
    }
}

if (isset($_POST["delete"])) {
    $deliverer_id = $_POST["deliverer_id"];

    global $database;
    $database->start_transaction();
    try {
        foreach (DelivererInventory::find_all_by_deliverer_id($deliverer_id) as $db_deliverer_inventory) {
            $db_deliverer_inventory->delete();
        }
        unset($_SESSION["deliverer_inventorys"]);

        $database->commit();
        Activity::log_action("Deliverer Inventorys - deleted , deliverer : " . Deliverer::find_by_id($deliverer_id)->number);
        $_SESSION["message"] = "Successfully saved";
        Functions::redirect_to('../deliverer_inventory_management.php');
    } catch (Exception $exc) {
        $database->rollback();
        $_SESSION["error"] = "Failed to save Deliverer Inventory";
        Functions::redirect_to('../deliverer_inventory_management.php');
    }
}

//if (isset($_POST["update"])) {
//    $id = $_POST["id"];
//    $purchase_order = PurchaseOrder::find_by_id($id);
////    $purchase_order->purchase_order_type_id = 1;
////    $purchase_order->purchase_order_status_id = 1;
//    $purchase_order->supplier_id = $_POST["supplier_id"];
////    $purchase_order->code = $_POST["code"];
////    $purchase_order->date = date("Y-m-d");
//    $purchase_order->user_id = $_SESSION["user"]["id"];
//
//    try {
//        $current_purchase_order_products = PurchaseOrderProduct::find_all_by_purchase_order_id($id);
//        foreach ($current_purchase_order_products as $value) {
//            $value->delete();
//        }
//
//        $purchase_order->save();
//
//        try {
//            if (isset($_SESSION["deliverer_inventorys"])) {
//                foreach ($_SESSION["deliverer_inventorys"] as $index => $po_product) {
//                    $purchase_order_product = new PurchaseOrderProduct();
//                    $purchase_order_product->purchase_order_id = $id;
//                    $purchase_order_product->product_id = $po_product["product_id"];
//                    $purchase_order_product->qty = $po_product["qty"];
//                    $purchase_order_product->save();
//                }
//            }
//            unset($_SESSION["deliverer_inventorys"]);
//            Activity::log_action("Product Purchase Order - updated : " . $purchase_order->code);
//            $_SESSION["message"] = "Successfully updated";
//            Functions::redirect_to('./../product_purchase_order.php');
//        } catch (Exception $exc) {
//            $_SESSION["error"] = "Failed to update Purchase Order";
//            Functions::redirect_to('./../product_purchase_order.php');
//        }
//    } catch (Exception $exc) {
//        $_SESSION["error"] = "Failed to save Purchase Order";
//        Functions::redirect_to('./../product_purchase_order.php');
//    }
//}
//
//if (isset($_POST["delete"])) {
//    $id = $_POST["id"];
//    $purchase_order = PurchaseOrder::find_by_id($id);
//
//    try {
//        $current_purchase_order_products = PurchaseOrderProduct::find_all_by_purchase_order_id($purchase_order->id);
//        foreach ($current_purchase_order_products as $value) {
//            $value->delete();
//        }
//
//        try {
//            $purchase_order->delete();
//            Activity::log_action("Product Purchase Order - deleted : " . $purchase_order->code);
//            unset($_SESSION["deliverer_inventorys"]);
//            $_SESSION["message"] = "Successfully deleted";
//            Functions::redirect_to('./../product_purchase_order.php');
//        } catch (Exception $exc) {
//            $_SESSION["error"] = "Failed to delet Purchase Order";
//            Functions::redirect_to('./../product_purchase_order.php');
//        }
//    } catch (Exception $exc) {
//        $_SESSION["error"] = "Failed to delete Purchase Order";
//        Functions::redirect_to('./../product_purchase_order.php');
//    }
//}