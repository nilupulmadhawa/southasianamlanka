<?php

require_once './../../util/initialize.php';

if (isset($_POST["invoice_request"])) {
    header('Content-Type: application/json');
    $filter_id = $_POST["filter_id"];

    $invoices;
    if ($filter_id == "all") {
        $invoices = Invoice::find_all();
    } else if ($filter_id == "retail") {
        $invoices = Invoice::find_all_by_invoice_type_id(2);
    } else {
        $invoices = Invoice::find_all_by_customer_id($filter_id);
    }

    foreach ($invoices as $index => $invoice) {
        if ($invoice->customer_id) {
            $invoices[$index]->customer_id = " (" . $invoice->customer_id()->name . ")";
        } else {
            $invoices[$index]->customer_id = " (Retail)";
        }
    }

    echo json_encode($invoices);
}

if (isset($_POST["invoice_inventories_request"])) {
    header('Content-Type: application/json');

    $invoice_id = $_POST["invoice_id"];
    $invoice_inventories = array();
    foreach (InvoiceInventory::find_all_by_invoice_id($invoice_id) as $index => $invoice_inventory) {
        $inventory = $invoice_inventory->inventory_id();
        $batch = Batch::find_by_inventory_id($inventory->id);
        $invoice_inventory->batch_id = $batch;
        $invoice_inventory->product_id = $inventory->product_id()->name;

        $qty = 0;
        foreach (InvoiceReturn::find_all_by_invoice_id($invoice_inventory->invoice_id) as $invoice_return) {
            foreach (InvoiceReturnInventory::find_all_by_invoice_return_id($invoice_return->id) as $invoice_return_inventory) {
                if ($invoice_return_inventory->inventory_id == $inventory->id) {
                    $qty += $invoice_return_inventory->qty;
                }
            }
        }
        $invoice_inventory->avl_qty = ($invoice_inventory->qty) - $qty;

        $invoice_inventories[] = $invoice_inventory;
    }

    echo json_encode($invoice_inventories);
}

if (isset($_POST["batch_request"])) {
    $batch_id = $_POST["batch_id"];
    echo json_encode(Batch::find_by_id($batch_id));
}

if (isset($_POST["invoice_inventory_request"])) {
    header('Content-Type: application/json');
    $invoice_id = $_POST["invoice_id"];
    $inventory_id = $_POST["inventory_id"];


    $invoice_inventory = InvoiceInventory::find_by_invoice_id_inventory_id($invoice_id, $inventory_id);

    $qty = 0;
    foreach (InvoiceReturn::find_all_by_invoice_id($invoice_inventory->invoice_id) as $invoice_return) {
        foreach (InvoiceReturnInventory::find_all_by_invoice_return_id($invoice_return->id) as $invoice_return_inventory) {
            if ($invoice_return_inventory->inventory_id == $invoice_inventory->inventory_id) {
                $qty += $invoice_return_inventory->qty;
            }
        }
    }
    $invoice_inventory->avl_qty = ($invoice_inventory->qty) - $qty;

    echo json_encode($invoice_inventory);
}

if (isset($_POST["return_reasons_request"])) {
    header('Content-Type: application/json');
    echo json_encode(ReturnReason::find_all());
}

//if (isset($_POST["save"])) {
//    $invoice_id = $_POST["invoice_id"];
//    $note = $_POST["note"];
//    $tbl_data = $_POST["tblData"];
//    $deliverer_id = $_POST["deliverer_id"];
//
//    $invoice_return = new InvoiceReturn();
//    $invoice_return->invoice_id = $invoice_id;
//    $invoice_return->note = $note;
//    $invoice_return->user_id = $_SESSION["user"]["id"];
//    $invoice_return->date_time = date('Y-m-d H:i:s');
//    $invoice_return->deliverer_id = $deliverer_id;
//
//    $message = "";
//
//    global $database;
//    $database->start_transaction();
//    try {
//        $invoice_return->save();
//        $invoice_return_id = InvoiceReturn::last_insert_id();
//
//        foreach ($tbl_data as $value) {
//            $inventory_id = $value["inventory_id"];
//            $return_reason_id = $value["return_reason_id"];
//            $qty = $value["qty"];
//
//            $invoice_return_inventory = new InvoiceReturnInventory();
//            $invoice_return_inventory->invoice_return_id = $invoice_return_id;
//            $invoice_return_inventory->inventory_id = $inventory_id;
//            $invoice_return_inventory->qty = $qty;
//            $invoice_return_inventory->return_reason_id = $return_reason_id;
//            $invoice_return_inventory->save();
//
//            if ($return_reason_id == 1 || $return_reason_id == 2) {
//                $inventory = Inventory::find_by_id($inventory_id);
//                $inventory->qty = ($inventory->qty) + ($qty);
//                $inventory->save();
//
//                if($deliverer_id) {
//                    $deliverer_inventory = DelivererInventory::find_by_deliverer_id_inventory_id($deliverer_id, $inventory_id);
//                    if ($deliverer_inventory->id) {
//                        $deliverer_inventory->qty = ($deliverer_inventory->qty) + $qty;
//                    } else {
//                        $deliverer_inventory = new DelivererInventory();
//                        $deliverer_inventory->inventory_id = $inventory_id;
//                        $deliverer_inventory->qty = $qty;
//                        $deliverer_inventory->deliverer_id = $deliverer_id;
//                    }
//                    $deliverer_inventory->save();
//                }
//            }
//
//            $total;
//            $invoice_inventory = InvoiceInventory::find_by_invoice_id_inventory_id($invoice_id, $inventory_id);
//            $total = (($invoice_inventory->price) - ($invoice_inventory->unit_discount)) * $qty;
//
//            $invoice = Invoice::find_by_id($invoice_id);
//            if ($invoice->customer_id) {
//                $customer = $invoice->customer_id();
//                $customer->balance = ($customer->balance) + $total;
//                $customer->save();
//            }
//        }
//
//        $database->commit();
//        $invoice = Invoice::find_by_id($invoice_id);
//        Activity::log_action("Invoice Return (Invoice:" . $invoice->code . ")- saved ");
//        $_SESSION["message"] = "Successfuly saved.";
//    } catch (Exception $exc) {
//        $database->rollback();
////        $message = "error";
//        $_SESSION["error"] = "Error..! Failed to save return";
//        $_SESSION["error"] = $exc;
//    }
//
//    header('Content-Type: application/json');
//    echo json_encode(true);
//}



function save_returns($invoice_id,$note,$tbl_data,$deliverer_id){

    $invoice_return = new InvoiceReturn();
    $invoice_return->invoice_id = $invoice_id;
    $invoice_return->note = $note;
    $invoice_return->user_id = $_SESSION["user"]["id"];
    $invoice_return->date_time = date('Y-m-d H:i:s');
    $invoice_return->deliverer_id = $deliverer_id;

    try {
        $invoice_return->save();
        $invoice_return_id = InvoiceReturn::last_insert_id();

        foreach ($tbl_data as $value) {
            $inventory_id = $value["inventory_id"];
            $return_reason_id = $value["return_reason_id"];
            $qty = $value["qty"];

            $invoice_return_inventory = new InvoiceReturnInventory();
            $invoice_return_inventory->invoice_return_id = $invoice_return_id;
            $invoice_return_inventory->inventory_id = $inventory_id;
            $invoice_return_inventory->qty = $qty;
            $invoice_return_inventory->return_reason_id = $return_reason_id;
            $invoice_return_inventory->save();

            if ($return_reason_id == 1 || $return_reason_id == 2) {
                $inventory = Inventory::find_by_id($inventory_id);
                $inventory->qty = ($inventory->qty) + ($qty);
                $inventory->save();

                if($deliverer_id) {
                    $deliverer_inventory = DelivererInventory::find_by_deliverer_id_inventory_id($deliverer_id, $inventory_id);
                    if ($deliverer_inventory->id) {
                        $deliverer_inventory->qty = ($deliverer_inventory->qty) + $qty;
                    } else {
                        $deliverer_inventory = new DelivererInventory();
                        $deliverer_inventory->inventory_id = $inventory_id;
                        $deliverer_inventory->qty = $qty;
                        $deliverer_inventory->deliverer_id = $deliverer_id;
                    }
                    $deliverer_inventory->save();
                }
            }

            $total;
            $invoice_inventory = InvoiceInventory::find_by_invoice_id_inventory_id($invoice_id, $inventory_id);
            $total = (($invoice_inventory->price) - ($invoice_inventory->unit_discount)) * $qty;

            $invoice = Invoice::find_by_id($invoice_id);
            if ($invoice->customer_id) {
                $customer = $invoice->customer_id();
                $customer->balance = ($customer->balance) + $total;
                $customer->save();
            }
        }
    } catch (Exception $exc) {
        throw new Exception($exc->getMessage());
    }
}

if (isset($_POST["save"])) {
    $invoice_id = $_POST["invoice_id"];
    $note = $_POST["note"];
    $tbl_data = $_POST["tblData"];
    $deliverer_id = $_POST["deliverer_id"];
        
//    global $database;
//    $database->start_transaction();
//    try {
//        save_returns($invoice_id,$note,$tbl_data,$deliverer_id);
//        $database->commit();
//        $invoice = Invoice::find_by_id($invoice_id);
//        Activity::log_action("Invoice Return (Invoice:" . $invoice->code . ")- saved ");
//        echo "ok";
//    } catch (Exception $exc) {
//        $database->rollback();
//        echo "NOT ok";
//    }
    
    $array=array();
    $array["invoice_id"]=$invoice_id;
    $array["note"]=$note;
    $array["tblData"]=$tbl_data;
    $array["deliverer_id"]=$deliverer_id;
    
    $_SESSION["invoice_return"]=$array;
    
    echo json_encode(true);

}

?>

