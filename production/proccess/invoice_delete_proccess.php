<?php

require_once './../../util/initialize.php';

if (isset($_GET["id"])) {
    $id = Functions::custom_crypt($_GET["id"], 'd');
    if ($invoice = Invoice::find_by_id($id)) {
        $errors = array();
        if (ProductReturn::find_all_by_invoice_id($id)) {
            $errors[] = "Product returns were added to this invoice.";
        }

        if (empty($errors)) {
            delete($invoice);
        } else {
            $_SESSION["error"] = "Could not delete Invoice <br/>" . join("<br/>", $errors);
            Functions::redirect_to("../invoice_management.php");
        }
    } else {
        $_SESSION["error"] = "Entry not available...";
        Functions::redirect_to("../invoice_management.php");
    }
} else {
    $_SESSION["error"] = "Entry not available...";
    Functions::redirect_to("../invoice_management.php");
}

function delete($invoice) {
    global $database;
    $database->start_transaction();

    try {
//        $invoice->delete();
        delete_payments($invoice);
        update_inventories($invoice);
        $invoice->delete();

        $database->commit();
        Activity::log_action("Invoice - deleted:" . $invoice->code);
        $_SESSION["message"] = "Successfully deleted";
        Functions::redirect_to('../invoice_management.php');
    } catch (Exception $exc) {
        $database->rollback();
        $_SESSION["error"] = "Failed to delete Invoice";
        $_SESSION["error"] = $exc->getMessage();
        Functions::redirect_to('../invoice_management.php');
    }
}

function delete_payments($invoice) {
    try {
        foreach (PaymentInvoice::find_all_by_invoice_id($invoice->id) as $payment_invoice) {
            $payment_invoice->delete();

            $payment = $payment_invoice->payment_id();

            foreach (PaymentCheque::find_all_by_payment_id($payment->id) as $payment_cheque) {
                $payment_cheque->delete();

                $cheque = $payment_cheque->cheque_id();
                $cheques = PaymentCheque::find_all_by_cheque_id($cheque->id);
                if (count($cheques) == 0) {
                    $cheque->delete();
                }
            }

            foreach (CustomerPayment::find_all_by_payment_id($payment->id) as $customer_payment) {
                $customer_payment->delete();
            }

            $payment->delete();
        }
    } catch (Exception $exc) {
        throw new Exception($exc->getMessage());
    }
}

function update_inventories($invoice) {
    try {
        foreach (InvoiceInventory::find_all_by_invoice_id($invoice->id) as $invoice_inventory) {
            $inventory = $invoice_inventory->inventory_id();
            $batch = $inventory->batch_id();

            $inventory_id;
            if ($inventory) {
                $inventory_id = $inventory->id;
                $inventory->qty = (int) $inventory->qty + (int) $invoice_inventory->qty;
                $inventory->save();
            } else {
                $inventory = new Inventory();
                $inventory->qty = $invoice_inventory->qty;
                $inventory->product_id = $batch->product_id;
                $inventory->batch_id = $batch->id;
                $inventory->save();
                $inventory_id = Inventory::last_insert_id();
            }

            if (isset($invoice->deliverer_id) && !empty($invoice->deliverer_id)) {
                $deliverer_inventory = DelivererInventory::find_by_deliverer_id_inventory_id($invoice->deliverer_id, $inventory_id);
                if ($deliverer_inventory) {
                    $deliverer_inventory->qty = (int) $deliverer_inventory->qty + (int) $invoice_inventory->qty;
                    $deliverer_inventory->save();
                } else {
                    $deliverer_inventory = new DelivererInventory();
                    $deliverer_inventory->deliverer_id = $invoice->deliverer_id;
                    $deliverer_inventory->inventory_id = $inventory->id;
                    $deliverer_inventory->qty = $invoice_inventory->qty;
                    $deliverer_inventory->save();
                }
            }

            $invoice_inventory->delete();
        }
    } catch (Exception $exc) {
        throw new Exception($exc->getMessage());
    }
}

function update_deliverer_inventories($invoice) {
    try {

        $inventory = $invoice->inventory_id();
        if (isset($inventory->deliverer_id) && !empty($inventory->deliverer_id)) {
            $deliverer = $inventory->deliverer_id();

            $deliverer_inventory = DelivererInventory::find_by_deliverer_id_inventory_id($deliverer->id, $inventory_id);
            if ($deliverer_inventory) {
                $deliverer_inventory->qty = (int) $deliverer_inventory->qty + (int) $invoice_inventory->qty;
                $deliverer_inventory->save();
            } else {
                $deliverer_inventory = new DelivererInventory();
                $deliverer_inventory->deliverer_id = $deliverer->id;
                $deliverer_inventory->inventory_id = $inventory->id;
                $deliverer_inventory->qty = $invoice_inventory->qty;
                $deliverer_inventory->save();
            }
        }
    } catch (Exception $exc) {
        throw new Exception($exc->getMessage());
    }
}
