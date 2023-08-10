<?php

require_once './../../util/initialize.php';

if (isset($_POST["purchase_order_request"])) {
    $purchase_order_id = $_POST["purchase_order_id"];
    $purchase_order = PurchaseOrder::find_by_id($purchase_order_id);
    $purchase_order->supplier_id = $purchase_order->supplier_id()->name;
    echo json_encode($purchase_order);
}

if (isset($_POST["reload_products"])) {
    $purchase_order_id = $_POST["purchase_order_id"];
    $grn_products = array();
    foreach (PurchaseOrderProduct::find_all_by_purchase_order_id($purchase_order_id) as $index => $po_product) {
        $grn_product = array();
        $grn_product["product_id"] = $po_product->product_id;
        $grn_product["qty"] = $po_product->qty;
        $grn_product["batch_id"] = (new Batch())->to_array();
        $grn_products[] = $grn_product;
    }
    $_SESSION["product_grn_products"] = $grn_products;
}

if (isset($_POST["grn_product_request"])) {
    header('Content-Type: application/json');
    $grn_products = array();
    if (isset($_SESSION["product_grn_products"])) {

        foreach ($_SESSION["product_grn_products"] as $index => $grn_product) {
            $temp_grn_product = array();

            $temp_grn_product["product_id"] = $grn_product["product_id"];
            $product = Product::find_by_id($grn_product["product_id"]);
            $temp_grn_product["product"] = $product->name;
            $temp_grn_product["qty"] = $grn_product["qty"];
            $batch_id = $grn_product["batch_id"];
            $batch;
            if ($batch_id["id"] == "") {
                $batch = new Batch();
                $batch->id = $batch_id['id'];
                $batch->code = $batch_id['code'];
                $batch->mfd = $batch_id['mfd'];
                $batch->exp = $batch_id['exp'];
                $batch->cost = $batch_id['cost'];
                $batch->retail_price = $batch_id['retail_price'];
                $batch->wholesale_price = $batch_id['wholesale_price'];
            } else {
                $batch = Batch::find_by_id($grn_product["batch_id"]["id"]);
            }
            $temp_grn_product["batch_id"] = $batch->to_array();
            $temp_grn_product["index"] = $index;


            $grn_products[] = $temp_grn_product;
        }
    }

    echo json_encode($grn_products);
}

if (isset($_POST["addGRNProduct"])) {
    $index = $_POST['index'];
    $product_id = $_POST['product_id'];
    $qty = $_POST['qty'];
    $batch_id = $_POST['batch_id'];
    $batch_code = $_POST['batch_code'];
    $mfd = $_POST['mfd'];
    $exp = $_POST['exp'];
    $cost = $_POST['cost'];
    $retail_price = $_POST['retail_price'];
    $wholesale_price = $_POST['wholesale_price'];

    $batch;
    if (empty($batch_id)) {
        $temp_batch = new Batch();
        $temp_batch->code = $batch_code;
        $temp_batch->mfd = $mfd;
        $temp_batch->exp = $exp;
        $temp_batch->cost = $cost;
        $temp_batch->retail_price = $retail_price;
        $temp_batch->wholesale_price = $wholesale_price;
        $batch = $temp_batch->to_array();
    } else {
        $temp_batch = Batch::find_by_id($batch_id);
        $batch = $temp_batch->to_array();
    }

    $grn_product = array();
    $grn_product["product_id"] = $product_id;
    $grn_product["qty"] = $qty;
    $grn_product["batch_id"] = $batch;
    $grn_products[] = $grn_product;


    if ($index !== "") {
        $_SESSION["product_grn_products"][$index] = $grn_product;
    } else {
        if (isset($_SESSION["product_grn_products"])) {
            $_SESSION["product_grn_products"][] = $grn_product;
        } else {
            $_SESSION["product_grn_products"] = array();
            $_SESSION["product_grn_products"][] = $grn_product;
        }
    }
}



if (isset($_POST["batch_request"])) {
    header('Content-Type: application/json');
    $batch_id = $_POST["batch_id"];
    echo json_encode(Batch::find_by_id($batch_id));
}

if (isset($_POST["batch_code_request"])) {
    header('Content-Type: application/json');
    $db_next_code = Batch::getAutoIncrement();
    $final_code;

    if (isset($_SESSION["product_grn_products"])) {
        $max_grn_product_code = --$db_next_code;
        foreach ($_SESSION["product_grn_products"] as $index => $grn_product) {
            $temp_batch_code = $grn_product["batch_id"]["code"];
            if (!empty($temp_batch_code) && ($temp_batch_code >= $max_grn_product_code)) {
                $max_grn_product_code = $temp_batch_code;
            }
        }

        if ($max_grn_product_code < $db_next_code) {
            $final_code = $db_next_code;
        } else {
            $final_code = ++$max_grn_product_code;
        }
    } else {
        $final_code = $db_next_code;
    }

    echo json_encode($final_code);
}

if (isset($_POST["remove_product"])) {
    $removeingIndex = $_POST["index"];
    unset($_SESSION["product_grn_products"][$removeingIndex]);
}

if (isset($_POST["product_request"])) {
    header('Content-Type: application/json');
    $index = $_POST["index"];

    $grn_product = $_SESSION["product_grn_products"][$index];

    $temp_grn_product = array();
    $temp_grn_product["product_id"] = $grn_product["product_id"];
    $temp_grn_product["product"] = Product::find_by_id($grn_product["product_id"])->name;
    $temp_grn_product["qty"] = $grn_product["qty"];
    $temp_grn_product["index"] = $index;

    if ($grn_product["batch_id"]["id"] == "") {
        $batch = new Batch();
        $batch->id = $grn_product["batch_id"]['id'];
        $batch->code = $grn_product["batch_id"]['code'];
        $batch->mfd = $grn_product["batch_id"]['mfd'];
        $batch->exp = $grn_product["batch_id"]['exp'];
        $batch->cost = $grn_product["batch_id"]['cost'];
        $batch->retail_price = $grn_product["batch_id"]['retail_price'];
        $batch->wholesale_price = $grn_product["batch_id"]['wholesale_price'];
    } else {
        $batch = Batch::find_by_id($grn_product["batch_id"]["id"]);
    }
    $temp_grn_product["batch_id"] = $batch->to_array();

    echo json_encode($temp_grn_product);
}

if (isset($_POST["product_errors"])) {
    header('Content-Type: application/json');
    $errors = array();

    foreach ($_SESSION["product_grn_products"] as $index => $grn_product) {
        if (empty($grn_product["batch_id"]["code"]) || empty($grn_product["batch_id"]["mfd"]) || empty($grn_product["batch_id"]["exp"]) || empty($grn_product["batch_id"]["cost"]) || empty($grn_product["batch_id"]["retail_price"]) || empty($grn_product["batch_id"]["wholesale_price"])) {
            $errors[] = $temp_grn_product["product"] = Product::find_by_id($grn_product["product_id"])->name;
        }
    }

    if (empty($errors)) {
        echo json_encode(FALSE);
    } else {
        echo json_encode($errors);
    }
}

if (isset($_POST["batches_request"])) {
    header('Content-Type: application/json');
    $product_id = $_POST["product_id"];
    $batches = array();
    foreach (GRNProduct::find_all_by_product_id($product_id) as $grn_product) {
        $batch = $grn_product->batch_id()->to_array();
        $batch["product"] = $grn_product->product_id()->name;
        $batches[] = $batch;
    }
    echo json_encode($batches);
}


//if (isset($_POST["save"])) {
//    $grn_id = $_POST["grn_id"];
//    $po_id = $_POST["po_id"];
//
//    echo $grn_id;
//    echo "</br>";
//    echo $po_id;
//}

if (isset($_POST["save"])) {
    $code = $_POST["grn_code"];
    $purchase_order_id = $_POST["purchase_order_id"];
    $supplier_id = $_POST["supplier_id"];
//    $date = date("Y-m-d");
    $date = date('Y-m-d H:i:s');
    $user_id = $_SESSION["user"]["id"];

    $grn = new GRN();
    $grn->code = $code;
    $grn->date_time = $date;
    $grn->user_id = $user_id;
    $grn->grn_type_id = 1;
    $grn->supplier_id = $supplier_id;
    if (!empty($purchase_order_id)) {
        $grn->purchase_order_id = $purchase_order_id;
    }

    global $database;
    $database->start_transaction();
    $aaa;
    try {
        $grn->save();
        $inserted_grn_id = GRN::last_insert_id();

        if (isset($_SESSION["product_grn_products"])) {
            foreach ($_SESSION["product_grn_products"] as $index => $ses_grn_product) {
                $temp_batch = $ses_grn_product["batch_id"];
                $final_batch_id = $temp_batch["id"];
                if (empty($temp_batch["id"])) {
                    $batch = new Batch();
                    $batch->code = $temp_batch['code'];
                    $batch->mfd = $temp_batch['mfd'];
                    $batch->exp = $temp_batch['exp'];
                    $batch->cost = $temp_batch['cost'];
                    $batch->retail_price = $temp_batch['retail_price'];
                    $batch->wholesale_price = $temp_batch['wholesale_price'];
                    $batch->save();
                    $final_batch_id = Batch::last_insert_id();
                }

                $grn_product = new GRNProduct();
                $grn_product->grn_id = $inserted_grn_id;
                $grn_product->product_id = $ses_grn_product["product_id"];
                $grn_product->batch_id = $final_batch_id;
                $grn_product->qty = $ses_grn_product["qty"];
                $grn_product->user_id = $user_id;
                $grn_product->save();
                $inserted_grn_product_id = GRNProduct::last_insert_id();

                $inventory = new Inventory();
                $inventory->qty = $ses_grn_product["qty"];
                $inventory->product_id = $ses_grn_product["product_id"];
                $inventory->batch_id = $final_batch_id;
                $inventory->inventory_type_id = 1;
                $inventory->save();
                $inserted_inventory_id = Inventory::last_insert_id();

                $inventory_grn_product = new InventoryGRNProduct();
                $inventory_grn_product->inventory_id = $inserted_inventory_id;
                $inventory_grn_product->grn_product_id = $inserted_grn_product_id;
                $inventory_grn_product->save();

                if (!empty($purchase_order_id)) {
                    $purchase_order = PurchaseOrder::find_by_id($purchase_order_id);
                    $purchase_order->purchase_order_status_id = 2;
                    $purchase_order->save();
                }
            }
        }
        unset($_SESSION["product_grn_products"]);

        $database->commit();
        Activity::log_action("GRN - saved:" . $grn->code);
        $_SESSION["message"] = "Successfully saved";
        Functions::redirect_to('./../product_grn.php');
    } catch (Exception $exc) {
        $database->rollback();
        $_SESSION["error"] = "Failed to save GRN";
//        $_SESSION["error"] = $exc;
        Functions::redirect_to('./../product_grn.php');
    }
}

function isOkToUpdate($grn_id) {
//    $validation = TRUE;
//    $grn_products = GRNProduct::find_all_by_grn_id($grn_id);
//    foreach ($grn_products as $index => $temp_grn_product) {
//        $grn_product_qty = $temp_grn_product->qty;
//        $inventorys = Inventory::find_all_by_grn_product_id($temp_grn_product->id);
//        foreach ($inventorys as $inventory) {
//            $deliverer_inventory = DelivererInventory::find_all_by_inventory_id($inventory->id);
//            if (($grn_product_qty != $inventory->qty) || !empty($deliverer_inventory)) {
//                $validation = FALSE;
//            }
//        }
//
////        $deliverer_inventory = DelivererInventory::find_all_by_inventory_id($inventory->id);
////        if (($grn_product_qty != $inventory->qty) || !empty($deliverer_inventory)) {
////            $validation = FALSE;
////        }
//    }
//    return $validation;


    $validation = TRUE;
    foreach (GRNProduct::find_all_by_grn_id($grn->id) as $temp_grn_product) {
        $inventorys = Inventory::find_all_by_grn_product_id($temp_grn_product->id);
        foreach ($inventorys as $inventory) {
            $deliverer_inventory = DelivererInventory::find_all_by_inventory_id($inventory->id);
            if (!empty($deliverer_inventory) && (count($deliverer_inventory) > 0)) {
                $validation = FALSE;
            }
        }
    }
    return $validation;
}

if (isset($_POST["update"])) {
    $grn_id = $_POST["grn_id"];
    $purchase_order_id = $_POST["purchase_order_id"];
    $supplier_id = $_POST["supplier_id"];
    $date = date('Y-m-d H:i:s');
    $user_id = $_SESSION["user"]["id"];

    $grn = GRN::find_by_id($grn_id);
    $grn->date_time = $date;
    $grn->user_id = $user_id;
    $grn->supplier_id = $supplier_id;
    if (!empty($purchase_order_id)) {
        $grn->purchase_order_id = $purchase_order_id;
    }

    if (isOkToUpdate($grn->id)) {
        global $database;
        $database->start_transaction();
        try {
            foreach (GRNProduct::find_all_by_grn_id($grn->id) as $index => $db_grn_product) {
//                foreach (InventoryGRNProduct::find_all_by_grn_product_id($db_grn_product->id) as $inventory_grn_product) {
//                    $inventory_grn_product->delete();
//                    $inventory_grn_product->inventory_id()->delete();
//                }
                $inventory_grn_product = InventoryGRNProduct::find_by_grn_product_id($db_grn_product->id);
                $inventory_grn_product->delete();
                $inventory_grn_product->inventory_id()->delete();

                $db_grn_product->delete();
            }

            $grn->save();
            $inserted_grn_id = $grn_id;

            if (isset($_SESSION["product_grn_products"])) {
                foreach ($_SESSION["product_grn_products"] as $index => $ses_grn_product) {
                    $temp_batch = $ses_grn_product["batch_id"];
                    $final_batch_id = $temp_batch["id"];
                    if (empty($temp_batch["id"])) {
                        $batch = new Batch();
                        $batch->code = $temp_batch['code'];
                        $batch->mfd = $temp_batch['mfd'];
                        $batch->exp = $temp_batch['exp'];
                        $batch->cost = $temp_batch['cost'];
                        $batch->retail_price = $temp_batch['retail_price'];
                        $batch->wholesale_price = $temp_batch['wholesale_price'];
                        $batch->save();
                        $final_batch_id = Batch::last_insert_id();
                    }

                    $grn_product = new GRNProduct();
                    $grn_product->grn_id = $inserted_grn_id;
                    $grn_product->product_id = $ses_grn_product["product_id"];
                    $grn_product->batch_id = $final_batch_id;
                    $grn_product->qty = $ses_grn_product["qty"];
                    $grn_product->user_id = $user_id;
                    $grn_product->save();
                    $inserted_grn_product_id = GRNProduct::last_insert_id();

                    $inventory = new Inventory();
                    $inventory->qty = $ses_grn_product["qty"];
                    $inventory->product_id = $ses_grn_product["product_id"];
                    $inventory->batch_id = $final_batch_id;
                    $inventory->inventory_type_id = 1;
                    $inventory->save();
                    $inserted_inventory_id = Inventory::last_insert_id();

                    $inventory_grn_product = new InventoryGRNProduct();
                    $inventory_grn_product->inventory_id = $inserted_inventory_id;
                    $inventory_grn_product->grn_product_id = $inserted_grn_product_id;
                    $inventory_grn_product->save();
                }
            }
            unset($_SESSION["product_grn_products"]);

            $database->commit();
            Activity::log_action("GRN - updated:" . $grn->code);
            $_SESSION["message"] = "Successfully updated";
            Functions::redirect_to('./../grn_management.php');
        } catch (Exception $exc) {
            $database->rollback();
            $_SESSION["error"] = "Failed to update GRN";
//            $_SESSION["error"] = $exc;
            Functions::redirect_to('./../grn_management.php');
        }
    } else {
        $_SESSION["error"] = "Can't update GRN, Invoices already added for products related to the GRN you tried to update.";
        Functions::redirect_to("./../grn_management.php");
    }
}

if (isset($_POST["session_count"])) {
    if (isset($_SESSION["product_grn_products"])) {
        echo json_encode(sizeof($_SESSION["product_grn_products"]));
    }
}

if (isset($_POST["check_product"])) {
    $checking_product_id = $_POST["id"];
    $availability;
    if (isset($_SESSION["product_grn_products"])) {
        foreach ($_SESSION["product_grn_products"] as $key => $value) {
            if ($value["product_id"] == $checking_product_id) {
                $availability = true;
            }
        }
    }
    echo json_encode($availability);
}
?>