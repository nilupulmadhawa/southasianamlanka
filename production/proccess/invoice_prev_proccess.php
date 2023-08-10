<?php

require_once './../../util/initialize.php';
require_once 'system_doctor.php';


if(isset($_GET['approve'])){

    $invoice_id = $_GET['approve'];

    $invoice = Invoice::find_by_id($invoice_id);
    $invoice->discount_approval = 1;
    $invoice->save();
    Functions::redirect_to("./../invoice_management.php");
}

if(isset($_REQUEST['print'])){

    $invoice_id = $_REQUEST['print'];

    $invoice = Invoice::find_by_id($invoice_id);
    $invoice->is_printed = 1;
    $invoice->save();

}

if (isset($_POST["finalize"])) {
    global $database;
    $database->start_transaction();
    try {
        save_invoice($_SESSION["invoice"]);

        $database->commit();
        unset($_SESSION["invoice"]);
        $_SESSION["message"] = "Successfully saved";
//        Functions::redirect_to('./../invoice_return_management.php');
        echo json_encode(TRUE);
    } catch (Exception $exc) {
        $database->rollback();
        $_SESSION["error"] = "Error! Failed to save Invoice";
        $_SESSION["error"] = $exc;
//        Functions::redirect_to('./../invoice_return_management.php');
        echo json_encode(FALSE);
    }
}

function save_invoice($sess_invoice) {
    $user_id = $_SESSION["user"]["id"];
    $date_time = $sess_invoice["date_time"];
    $cash = $sess_invoice["cash"];
    $balance = $sess_invoice["balance"];
    $GpsLocation = $_SESSION['geolocation'];

    $invoice = new Invoice();
    $invoice->code = $sess_invoice["code"];
    // $invoice->date_time = $date_time;
    $invoice->date_time = date('Y-m-d H:i:s');
    $invoice->gross_amount = $sess_invoice["gross_amount"];
    $invoice->net_amount = $sess_invoice["net_amount"];
    $invoice->balance = $balance;
    $invoice->user_id = $_SESSION["user"]["id"];
    $invoice->invoice_condition_id = 1;
    $invoice->deliverer_id = $sess_invoice["deliverer_id"];
    $invoice->invoice_method = $sess_invoice["invType1"];
    $invoice->GpsLocation = $GpsLocation;

    $invoice->invoice_type_id = 1;
    $invType = $sess_invoice["invType"];
    if ($invType == "invType1") {
        $invoice->customer_id = $sess_invoice["order_customer_id"];
        $invoice->customer_order_id = $sess_invoice["order_id"];
    } else if ($invType == "invType2") {
        $invoice->customer_id = $sess_invoice["customer_id"];
    } else if ($invType == "invType3") {
        $invoice->invoice_type_id = 2;
    }

    if ($balance > 0) {
        $invoice->invoice_status_id = 1;
    } else {
        $invoice->invoice_status_id = 2;
    }

    try {
        $invoice->save();
        $inserted_invoice_id = Invoice::last_insert_id();
        save_invoice_inventories($sess_invoice["invoice_inventories"], $inserted_invoice_id, $sess_invoice["order_customer_id"]);

        if ($cash > 0) {
            $payment_cash = new Payment();
            $payment_cash->code = Payment::getNextCode();
            $payment_cash->amount = $cash;
            $payment_cash->date_time = $date_time;
            $payment_cash->invoice_id = $inserted_invoice_id;
            $payment_cash->payment_method_id = 1;
            $payment_cash->payment_status_id = 2;
            $payment_cash->payment_type_id = 2;
            $payment_cash->user_id = $user_id;
            $payment_cash->save();

            $inserted_payment_id = Payment::last_insert_id();
            $payment_invoice = new PaymentInvoice();
            $payment_invoice->payment_id = $inserted_payment_id;
            $payment_invoice->invoice_id = $inserted_invoice_id;
            $payment_invoice->amount = $cash;
            $payment_invoice->save();
        }
        Activity::log_action("Invoice (Invoice:" . $invoice->code . ")- saved ");
    } catch (Exception $exc) {
        throw new Exception($exc->getMessage());
    }
}

function save_invoice_inventories($sess_invoice_inventories, $invoice_id, $customer_id) {
    try {
        foreach ($sess_invoice_inventories as $key => $sess_invoice_inventory) {

            $deliverer_inventory = Inventory::find_by_id($sess_invoice_inventory["inventory_id"]);
            $stock_item_id = $deliverer_inventory->product_id;
            $new_di_qty = (int) $deliverer_inventory->qty - (int) $sess_invoice_inventory["qty"] - (int) $sess_invoice_inventory["freeissue"];
            if ($new_di_qty < 0) {
                $deliverer_inventory->qty = 0;
                $new_di_qty == 0;
            } else {
                $deliverer_inventory->qty = $new_di_qty;
            }

            $inventory = $deliverer_inventory;
            // $new_qty = (int) $inventory->qty - (int) $sess_invoice_inventory["qty"];
            // if ($new_qty < 0) {
            //     $inventory->qty = 0;
            // } else {
            //     $inventory->qty = $new_qty;
            // }

            $invoice_inventory = new InvoiceInventory();
            $invoice_inventory->invoice_id = $invoice_id;
            $invoice_inventory->inventory_id = $inventory->id;
            $invoice_inventory->qty = $sess_invoice_inventory["qty"];
            $invoice_inventory->freeissue = $sess_invoice_inventory["freeissue"];
            $invoice_inventory->price = $sess_invoice_inventory["price"];
            $invoice_inventory->unit_discount = ($sess_invoice_inventory["unit_discount"]) ? $sess_invoice_inventory["unit_discount"] : 0;
            $invoice_inventory->gross_amount = ($invoice_inventory->qty) * ($invoice_inventory->price);
            $invoice_inventory->net_amount = ($invoice_inventory->qty) * (($invoice_inventory->price) - ($invoice_inventory->unit_discount));



            // stock movement update start
            $stock_movement = new StockMovement();
            $stock_movement->type = "invoice";
            $stock_movement->ref_id = $invoice_id;
            $stock_movement->user_ref = $_SESSION["user"]["id"];
            $stock_movement->qty = $sess_invoice_inventory["qty"] + $sess_invoice_inventory["freeissue"];
            $stock_movement->stock_balance = $new_di_qty;
            $stock_movement->item_id = $stock_item_id;
            $stock_movement->inventory_id = $inventory->id;
            $stock_movement->batch_id = $inventory->batch_id;
            $stock_movement->customer_id = $customer_id;
            $stock_movement->save();
            // stock movement update ends

            $invoice_inventory->save();
            $deliverer_inventory->save();
            // $inventory->save();
        }
    } catch (Exception $exc) {
        throw new Exception($exc->getMessage());
    }
}
