<?php

require_once './../../util/initialize.php';

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

if (isset($_POST["batches_request"])) {
    header('Content-Type: application/json');
    $product_id = $_POST["product_id"];
    $batches = array();

    foreach (Batch::find_all_by_product_id($product_id) as $batch) {
        $batch->product_id = $batch->product_id();
        $batches[] = $batch;
    }

    echo json_encode($batches);
}

if (isset($_POST["save"])) {
    $production_id = $_POST["production_id"];
    $qty = $_POST["number"];

    $batch_id = $_POST["batch_id"];
    $b_product_id = $_POST["product_id"];
    $b_code = $_POST["b_code"];
//    $b_mfd = $_POST["b_mfd"];
//    $b_exp = $_POST["b_exp"];
    $b_cost = $_POST["b_cost"];
    $b_retail_price = $_POST["b_retail_price"];
    $b_wholesale_price = $_POST["b_wholesale_price"];

    $batch = new Batch();
    $batch->code = $b_code;
    $batch->product_id = $b_product_id;
    $batch->mfd = $b_mfd;
    $batch->exp = $b_exp;
    $batch->cost = $b_cost;
    $batch->retail_price = $b_retail_price;
    $batch->wholesale_price = $b_wholesale_price;

    global $database;
    $database->start_transaction();
    try {
        $production = Production::find_by_id($production_id);
        $production->production_status_id = 2;
        $production->save();

        if (!$batch_id || $batch_id == 0) {
            $batch->save();
            $batch_id = Batch::last_insert_id();
        }

        $production_product = new ProductionProduct();
        $production_product->production_id = $production_id;
//        $production_product->product_id = $b_product_id;
        $production_product->batch_id = $batch_id;
        $production_product->qty = $qty;
        $production_product->save();
        $production_product_id = ProductionProduct::last_insert_id();

        $inventory = Inventory::find_by_batch_id($batch_id);
        if ($inventory) {
            $inventory->qty = (int) $inventory->qty + (int) $ses_grn_product["qty"];
            $inventory->save();
        } else {
            $inventory = new Inventory();
            $inventory->qty = $ses_grn_product["qty"];
            $inventory->product_id = $temp_batch["product_id"];
            $inventory->batch_id = $final_batch_id;
            $inventory->save();
        }

        $database->commit();

        Activity::log_action("Production GRN - saved : " . $production_product_id);
        $_SESSION["message"] = "Successfully saved.";
        Functions::redirect_to("./../production_management.php");
    } catch (Exception $exc) {
        $database->rollback();
        $_SESSION["error"] = "Error..! Failed to save Production GRN.";
        $_SESSION["error"] = $exc;
        Functions::redirect_to("./../production_management.php");
    }
}

function isOkToUpdate($grn_id) {
    $validation = TRUE;
    if (GRN::find_if_invoices_added_by_id($grn_id) || GRN::find_if_deliver_inventories_added_by_id($grn_id) || GRN::find_if_invoice_return_inventories_added_by_id($grn_id)) {
        $validation = FALSE;
    }

    return $validation;
}


//if (isset($_POST["update"])) {
//    $grn_id = $_POST["grn_id"];
//    $purchase_order_id = $_POST["purchase_order_id"];
//    $supplier_id = $_POST["supplier_id"];
////    $date = $_POST["date_time"];
//    $user_id = $_SESSION["user"]["id"];
//
//    $grn = GRN::find_by_id($grn_id);
//    $grn->date_time = $date;
//    $grn->user_id = $user_id;
//    $grn->supplier_id = $supplier_id;
//    if (!empty($purchase_order_id)) {
//        $grn->purchase_order_id = $purchase_order_id;
//    }
//
//    if (isOkToUpdate($grn->id)) {
//        global $database;
//        $database->start_transaction();
//        try {
//            foreach (GRNProduct::find_all_by_grn_id($grn->id) as $index => $db_grn_product) {
//                $inventory = Inventory::find_by_batch_id($db_grn_product->batch_id);
//                if ($inventory) {
//                    $inventory->qty = ((int) $inventory->qty) - ((int) $db_grn_product->qty);
//                    $inventory->save();
//                }
//                $db_grn_product->delete();
//            }
//
//            $grn->save();
//            $inserted_grn_id = $grn_id;
//
//            if (isset($_SESSION["product_grn_products"])) {
//                foreach ($_SESSION["product_grn_products"] as $index => $ses_grn_product) {
//                    $temp_batch = $ses_grn_product["batch_id"];
//                    $final_batch_id = $temp_batch["id"];
//                    if (empty($temp_batch["id"])) {
//                        $batch = new Batch();
//                        $batch->product_id = $temp_batch["product_id"];
//                        $batch->code = $temp_batch['code'];
////                        $batch->mfd = $temp_batch['mfd'];
////                        $batch->exp = $temp_batch['exp'];
//                        $batch->cost = $temp_batch['cost'];
//                        $batch->retail_price = $temp_batch['retail_price'];
//                        $batch->wholesale_price = $temp_batch['wholesale_price'];
//                        $batch->save();
//                        $final_batch_id = Batch::last_insert_id();
//                    }
//
//                    $grn_product = new GRNProduct();
//                    $grn_product->grn_id = $inserted_grn_id;
////                    $grn_product->product_id = $ses_grn_product["product_id"];
//                    $grn_product->batch_id = $final_batch_id;
//                    $grn_product->qty = $ses_grn_product["qty"];
//                    $grn_product->user_id = $user_id;
//                    $grn_product->save();
//                    $inserted_grn_product_id = GRNProduct::last_insert_id();
//
//                    $inventory = Inventory::find_by_batch_id($value);
//                    if ($inventory) {
//                        $inventory->qty = (int) $inventory->qty + (int) $ses_grn_product["qty"];
//                        $inventory->save();
//                    } else {
//                        $inventory = new Inventory();
//                        $inventory->qty = $ses_grn_product["qty"];
//                        $inventory->product_id = $temp_batch["product_id"];
//                        $inventory->batch_id = $final_batch_id;
//                        $inventory->save();
//                    }
//                }
//            }
//            unset($_SESSION["product_grn_products"]);
//
//            $database->commit();
//            Activity::log_action("GRN - updated:" . $grn->code);
//            $_SESSION["message"] = "Successfully updated";
//            Functions::redirect_to('./../grn_management.php');
//        } catch (Exception $exc) {
//            $database->rollback();
//            $_SESSION["error"] = "Failed to update GRN";
////            $_SESSION["error"] = $exc;
//            Functions::redirect_to('./../grn_management.php');
//        }
//    } else {
//        $_SESSION["error"] = "Can't change GRN, Products already added to deliverer inventories.";
//        Functions::redirect_to("./../grn_management.php");
//    }
//}
//
//if (isset($_POST["delete"])) {
//    $grn_id = $_POST["grn_id"];
//    $grn = GRN::find_by_id($grn_id);
//
//    if (isOkToUpdate($grn->id)) {
//        global $database;
//        $database->start_transaction();
//        try {
//            foreach (GRNProduct::find_all_by_grn_id($grn->id) as $index => $db_grn_product) {                
//                $inventory = Inventory::find_by_batch_id($db_grn_product->batch_id);
//                if ($inventory) {
//                    $inventory->qty = ((int) $inventory->qty) - ((int) $db_grn_product->qty);
//                    $inventory->save();
//                }
//                $db_grn_product->delete();
//            }
//
//            $grn->delete();
//            unset($_SESSION["product_grn_products"]);
//
//            $database->commit();
//            Activity::log_action("GRN - deleted:" . $grn->code);
//            $_SESSION["message"] = "Successfully deleted";
//            Functions::redirect_to('./../grn_management.php');
//        } catch (Exception $exc) {
//            $database->rollback();
//            $_SESSION["error"] = "Failed to delete GRN";
////            $_SESSION["error"] = $exc;
//            Functions::redirect_to('./../grn_management.php');
//        }
//    } else {
//        $_SESSION["error"] = "Can't delete GRN, Products already added to deliverer inventories.";
//        Functions::redirect_to("./../grn_management.php");
//    }
//}