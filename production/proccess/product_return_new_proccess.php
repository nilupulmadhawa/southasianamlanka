<?php

require_once './../../util/initialize.php';


if(isset($_GET['save_return'])){

    $return_deliverer = $_SESSION["return_deliverer"];
    $return_date_time = $_SESSION["return_date_time"];
    $return_reason = $_SESSION["return_return_note"];
    $return_return_number = $_SESSION["return_return_number"];
    $return_approved_by = $_SESSION["return_approved_by"];

    $product_return = new ProductReturn();

    $product_return->date_time = $return_date_time;
    $product_return->note = $return_reason;
    $product_return->user_id = $_SESSION["user"]["id"];
    $product_return->deliverer_id = $return_deliverer;
    $product_return->return_number = $return_return_number;
    $product_return->approved_by = $return_return_number;
    $product_return->save();
    $product_return_id = ProductReturn::last_insert_id();

    try {

        foreach($_SESSION['product_return_item'] as $index => $data){

            $item_id = $data['product_id'];
            $batch_id = $data['batch_id'];
            $qty = $data['qty'];
            $return_reason = $data['return_reason'];
            $item_discount = $data['discount'];
            $invoice_discount = $data['invoice_discount'];

            $batch_data = Batch::find_by_id($batch_id);

            $ProductReturnBatch = new ProductReturnBatch();

            if($data['price']){
                $wholesale_price = $data['price'];
            }else{
                $wholesale_price = $batch_data->retail_price;
            }

            $ProductReturnBatch->product_return_id = $product_return_id;
            $ProductReturnBatch->batch_id = $batch_id;
            $ProductReturnBatch->return_reason_id = $return_reason;
            $ProductReturnBatch->qty = $qty;
            $ProductReturnBatch->unit_price = $wholesale_price;
            $ProductReturnBatch->discount = $item_discount;
            $ProductReturnBatch->additional_discount = $invoice_discount;


            try {
                $ProductReturnBatch->save();

                if ($return_reason == 1 || $return_reason == 2) {

                    $return_batch = Batch::find_by_id($batch_id);

                    $inventory = Inventory::find_by_batch_id($return_batch->id);

                    echo $inventory->qty."<br/>";
                    $inventory_id;
                    if ($inventory) {
                        $inventory_id = $inventory->id;
                        $stock_balance = $inventory->qty + $qty;
                        $inventory->qty = $inventory->qty + $qty;
                        $inventory->save();
                        echo $return_batch->code."<br/>";
                        echo $stock_balance."<br/>";
                    } else {
                        $inventory = new Inventory();
                        $inventory->qty = $qty;
                        $stock_balance = (int) $qty;
                        $inventory->product_id = $return_batch->product_id;
                        $inventory->batch_id = $return_batch->id;
                        $inventory->save();
                        $inventory_id = Inventory::last_insert_id();
                    }

                    $deliverer = Deliverer::find_by_id($return_deliverer);
                    $deliverer_inventory = DelivererInventory::find_by_deliverer_id_inventory_id($deliverer->id, $inventory_id);
                    if ($deliverer_inventory) {
                        $deliverer_inventory->qty = (int) $deliverer_inventory->qty + (int) $qty;
                        $deliverer_inventory->save();
                    } else {
                        $deliverer_inventory = new DelivererInventory();
                        $deliverer_inventory->deliverer_id = $deliverer->id;
                        $deliverer_inventory->inventory_id = $inventory_id;
                        $deliverer_inventory->qty = $qty;
                        $deliverer_inventory->save();
                    }

                    // stock movement update start
                    $stock_movement = new StockMovement();
                    $stock_movement->type = "return";
                    $stock_movement->ref_id = $product_return_id;
                    $stock_movement->user_ref = $_SESSION["user"]["id"];
                    $stock_movement->qty = $qty;
                    echo $qty;
                    $stock_movement->stock_balance = $stock_balance;
                    $stock_movement->item_id = $return_batch->product_id;
                    $stock_movement->inventory_id = $inventory_id;
                    $stock_movement->batch_id = $return_batch->id;
                    $stock_movement->customer_id = "0";
                    $stock_movement->save();
                    // stock movement update ends

                }

                Activity::log_action("Product Return " . $batch_data->product_id()->name . " Qty: ".$qty."- Returned ");

            } catch (Exception $exc) {
                throw new Exception($exc->getMessage());
            }

        }


        foreach($_SESSION['product_return_invoice'] as $index => $data){

            $invoice_id = $data['invoice_id'];
            // invoice_id_right
            $invoice_id_right = $data['invoice_id_right'];

            $amount = $data['amount'];
            $invoice_data = Invoice::find_by_id($invoice_id);

            $ProductReturnInvoice = new ProductReturnInvoice();

            $ProductReturnInvoice->product_return_id = $product_return_id;
            $ProductReturnInvoice->invoice_id = $invoice_id;
            $ProductReturnInvoice->right_off = $invoice_id_right;
            $ProductReturnInvoice->return_amount = $amount;

            try{
                $ProductReturnInvoice->save();

                $invoice_data = Invoice::find_by_id($invoice_id);
                $invoice_data->balance = $invoice_data->balance - $amount;

                if($invoice_data->balance - $amount == 0 || $invoice_data->balance - $amount < 0){
                    $invoice_data->invoice_status_id = 2;
                }

                $invoice_data->save();

                Activity::log_action("Invoice Return " . $invoice_data->id . " Amount: ".$amount."- Returned ");

            } catch (Exception $exc) {
                throw new Exception($exc->getMessage());
            }

        }

        $_SESSION["message"] = "Successfully saved.";

        unset($_SESSION["product_return_invoice"]);
        unset($_SESSION["product_return_item"]);
        unset($_SESSION["return_deliverer"]);
        unset($_SESSION["return_date_time"]);
        unset($_SESSION["return_return_note"]);

        Functions::redirect_to("./../product_return_management.php");
    } catch (Exception $exc) {
        $_SESSION["error"] = "Error..! Failed to save.";

        unset($_SESSION["product_return_invoice"]);
        unset($_SESSION["product_return_item"]);
        unset($_SESSION["return_deliverer"]);
        unset($_SESSION["return_date_time"]);
        unset($_SESSION["return_return_note"]);

        Functions::redirect_to("./../product_return_management.php");
    }


}

if (isset($_POST["invoice_request"])) {
    header('Content-Type: application/json');

    $filter_id = $_POST["filter_id"];
    $batches;
    $batches = Batch::find_all_by_product_id($filter_id);

    echo json_encode($batches);
}

if (isset($_POST["customer_request"])) {
    header('Content-Type: application/json');

    $filter_id = $_POST["filter_id"];
    $batches;
    $batches = Invoice::customer_id_pendings($filter_id);

    echo json_encode($batches);
}

if (isset($_POST["add_invoice_payment"])) {

    $invoice_payment = array();
    $invoice_payment["product_id"] = $_POST['product_id'];
    $invoice_payment["batch_id"] = $_POST['batch_id'];
    $invoice_payment["price"] = $_POST['price'];
    $invoice_payment["qty"] = $_POST['qty'];
    $invoice_payment["return_reason"] = $_POST['return_reason'];
    $invoice_payment["discount"] = $_POST['discount'];
    $invoice_payment["invoice_discount"] = $_POST['invoice_discount'];

    if (isset($_SESSION["product_return_item"])) {
        $_SESSION["product_return_item"][] = $invoice_payment;
    } else {
        $_SESSION["product_return_item"] = array();
        $_SESSION["product_return_item"][] = $invoice_payment;
    }

}

if (isset($_POST["add_invoice_payment_invoice"])) {
    $invoice_payment = array();
    $invoice_payment["invoice_id"] = $_POST['invoice_id'];
    $invoice_payment["invoice_id_right"] = $_POST['invoice_id_right'];
    $invoice_payment["amount"] = $_POST['amount'];
    $invoice_payment["linetotal"] = $_POST['linetotal'];

    if (isset($_SESSION["product_return_invoice"])) {
        $_SESSION["product_return_invoice"][] = $invoice_payment;
    } else {
        $_SESSION["product_return_invoice"] = array();
        $_SESSION["product_return_invoice"][] = $invoice_payment;
    }
}


if (isset($_POST["invoice_payments_request"])) {
    $result = array();
    if (isset($_SESSION["product_return"])) {
        header('Content-Type: application/json');


        $invoice_payments = array();
        $total = 0;
        foreach ($_SESSION["invoice_payments"] as $index => $data) {
            $result['customer_id'] = Customer::find_by_id($data['customer_id']);
            $result['batch_id'] = Batch::find_by_id($data['batch_id']);
            $result['qty'] = $data['qty'];
        }
    }

    print_r($result);

    echo json_encode($result);
}


if (isset($_POST["remove_reload"])) {
    header('Content-Type: application/json');
    $index = $_POST["index"];
    $product_return_batch = $_SESSION["product_return_item"][$index];
    unset($_SESSION["product_return_item"][$index]);
    echo json_encode($product_return_batch);
}

if (isset($_POST["remove_reload_invoice"])) {
    header('Content-Type: application/json');
    $index = $_POST["index"];
    $product_return_batch = $_SESSION["product_return_invoice"][$index];
    unset($_SESSION["product_return_invoice"][$index]);
    echo json_encode($product_return_batch);
}
