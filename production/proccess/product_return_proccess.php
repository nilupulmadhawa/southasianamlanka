<?php

require_once './../../util/initialize.php';

if (isset($_POST['cusomer_invoice_request'])) {
    $customer_id = $_POST['customer_id'];
    echo json_encode(Invoice::find_all_by_customer_id($customer_id));
}



if (isset($_POST["batch_request"])) {
    $batch_id = $_POST["batch_id"];
    $batch = Batch::find_by_id($batch_id);
    $batch->product_id = $batch->product_id();
    echo json_encode($batch);
}

if (isset($_POST["total_request"])) {
    echo json_encode(getTotal());
}

function getTotal() {
    $total = 0;
    if (isset($_SESSION["product_return_batches"])) {
        foreach ($_SESSION["product_return_batches"] as $product_return_batch) {
            $sub_total = $product_return_batch["qty"] * $product_return_batch["unit_price"];
            $total += $sub_total;
        }
    }
    return number_format($total, 2);
}

if (isset($_POST["add_batch"])) {
    $product_return_batch = array();
    $product_return_batch["batch_id"] = $_POST["batch_id"];
    $product_return_batch["return_reason_id"] = $_POST["return_reason_id"];
    $product_return_batch["qty"] = $_POST["qty"];
    $product_return_batch["unit_price"] = $_POST["unit_price"];

    if (isset($_SESSION["product_return_batches"])) {
        $_SESSION["product_return_batches"][] = $product_return_batch;
    } else {
        $_SESSION["product_return_batches"] = array();
        $_SESSION["product_return_batches"][] = $product_return_batch;
    }
}

if (isset($_POST["return_batches_request"])) {
    header('Content-Type: application/json');

    $product_return_batches = array();
    if (isset($_SESSION["product_return_batches"])) {
        foreach ($_SESSION["product_return_batches"] as $index => $product_return_batch) {
            $batch = Batch::find_by_id($product_return_batch["batch_id"]);
            $product_return_batch["batch_id"] = $batch->to_array();
            $product_return_batch["batch_id"]["product_id"] = $batch->product_id();
            $product_return_batch["return_reason_id"] = ReturnReason::find_by_id($product_return_batch["return_reason_id"])->name;
            $product_return_batch["index"] = $index;
            $lineTot = $product_return_batch["unit_price"] * $product_return_batch["qty"];
            $product_return_batch["line_total"] = number_format($lineTot, 2);
            $product_return_batches[] = $product_return_batch;
        }
    }

    echo json_encode($product_return_batches);
}

if (isset($_POST["remove_row"])) {
    $removeingIndex = $_POST["index"];
    unset($_SESSION["product_return_batches"][$removeingIndex]);
}

if (isset($_POST["remove_reload"])) {
    header('Content-Type: application/json');
    $index = $_POST["index"];
    $product_return_batch = $_SESSION["product_return_batches"][$index];
    unset($_SESSION["product_return_batches"][$index]);
    echo json_encode($product_return_batch);
}

if (isset($_POST["session_count"])) {
    if (isset($_SESSION["product_return_batches"])) {
        echo json_encode(sizeof($_SESSION["product_return_batches"]));
    }
}


if (isset($_POST["save"])) {
    $product_return = array();
    $product_return["deliverer_id"] = $_POST["deliverer_id"];
    $product_return["customer_id"] = $_POST["customer_id"];
    $product_return["invoice_id"] = $_POST["invoice_id"];
    $product_return["note"] = $_POST["note"];
    $product_return["return_invoice"] = $_POST["return_invoice"];

    global $database;
    $database->start_transaction();
    try {
        save_returns($product_return,$_SESSION["product_return_batches"]);

        $database->commit();
        unset($_SESSION["product_return_batches"]);
        $_SESSION["message"] = "Successfully saved";
        Functions::redirect_to('./../product_return_management.php');
//        echo json_encode(TRUE);
    } catch (Exception $exc) {
        $database->rollback();
        $_SESSION["error"] = "Error! Failed to save return";
        Functions::redirect_to('./../product_return_management.php');
//        echo json_encode(FALSE);
    }
}

function save_returns($product_return,$product_return_batches) {
    $deliverer_id = $product_return["deliverer_id"];
    $customer_id = $product_return["customer_id"];
    $invoice_id = $product_return["invoice_id"];
    $note = $product_return["note"];
    $return_invoice = $product_return["return_invoice"];
    $now = date('Y-m-d H:i:s');

    $product_return = new ProductReturn();
    $product_return->note = $note;
    $product_return->deliverer_id = $deliverer_id;
    $product_return->customer_id = $customer_id;
    $product_return->invoice_id = $invoice_id;
    $product_return->date_time = $now;
    $product_return->user_id = $_SESSION["user"]["id"];
    try {
        $product_return->save();
        $product_return_id = ProductReturn::last_insert_id();

        $total = 0;
        foreach ($product_return_batches as $product_return_batch) {
            $return_reason_id = $product_return_batch["return_reason_id"];
            $return_qty = $product_return_batch["qty"];
            $return_unit_price = $product_return_batch["unit_price"];
            $return_batch_id = $product_return_batch["batch_id"];

            $product_return_batch = new ProductReturnBatch();
            $product_return_batch->product_return_id = $product_return_id;
            $product_return_batch->batch_id = $return_batch_id;
            $product_return_batch->return_reason_id = $return_reason_id;
            $product_return_batch->qty = $return_qty;
            $product_return_batch->unit_price = $return_unit_price;
            $product_return_batch->save();

            if ($return_reason_id == 1 || $return_reason_id == 2) {
                $return_batch = Batch::find_by_id($return_batch_id);

                $inventory = Inventory::find_by_batch_id($return_batch->id);
                $inventory_id;
                if ($inventory) {
                    $inventory_id = $inventory->id;
                    $inventory->qty = (int) $inventory->qty + (int) $return_qty;
                    $inventory->save();
                } else {
                    $inventory = new Inventory();
                    $inventory->qty = $return_qty;
                    $inventory->product_id = $return_batch->product_id;
                    $inventory->batch_id = $return_batch->id;
                    $inventory->save();
                    $inventory_id = Inventory::last_insert_id();
                }

                $deliverer = Deliverer::find_by_id($deliverer_id);
                $deliverer_inventory = DelivererInventory::find_by_deliverer_id_inventory_id($deliverer->id, $inventory_id);
                if ($deliverer_inventory) {
                    $deliverer_inventory->qty = (int) $deliverer_inventory->qty + (int) $return_qty;
                    $deliverer_inventory->save();
                } else {
                    $deliverer_inventory = new DelivererInventory();
                    $deliverer_inventory->deliverer_id = $deliverer->id;
                    $deliverer_inventory->inventory_id = $inventory_id;
                    $deliverer_inventory->qty = $return_qty;
                    $deliverer_inventory->save();
                }
            }
        }
        Activity::log_action("Product Return (ID:" . $product_return_id . ")- saved ");
    } catch (Exception $exc) {
        throw new Exception($exc->getMessage());
    }
}



if(isset($_POST['delete_return'])){
  $return_id = $_POST['product_return_id'];
  //get the product return invoice
  $invoice_data = ProductReturnInvoice::find_all_by_product_return_id($return_id);
  foreach($invoice_data as $data){
    $row_data = ProductReturnInvoice::find_by_id($data->id);
    //recalculate the invoice
    $recalculate = Invoice::get_recalculated_invoice_by_id($data->invoice_id);
    $invoice_data = Invoice::find_by_id($data->invoice_id);
    $invoice_data->invoice_status_id = $invoice_data->invoice_status_id;
    $invoice_data->balance = $invoice_data->balance;
    $invoice_data->save();
  //end of recalculate the invoice
    $row_data->delete();
  }

  //get the product return batch
  $invoice_data = ProductReturnBatch::find_all_by_product_return_id($return_id);
  foreach($invoice_data as $data){
    $row_data = ProductReturnBatch::find_by_id($data->id);
    $row_data->delete();
  }

  //get the prodct return data
  $row_data = ProductReturn::find_by_id($return_id);
  $row_data->delete();

  Activity::log_action("Product Return Detelete");
  $_SESSION["message"] = "Successfully Deleted.";
  Functions::redirect_to("./../product_return_management.php");

}
