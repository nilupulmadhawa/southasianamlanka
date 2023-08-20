<?php

require_once './../../util/initialize.php';
require_once 'system_doctor.php';

if (isset($_POST["from_invoice"])) {
    $from_invoice = $_POST['from_invoice'];
    $invoice_id = $_POST['invoice_id'];
    $amount = $_POST['amount'];
    // from invoice
    $from_invoice_data = Invoice::find_by_id($from_invoice);
    // settle invoice data
    $settle_invoice_data = Invoice::find_by_id($invoice_id);

    $from_invoice_data->balance = $from_invoice_data->balance + $amount;

    $settle_invoice_data->balance = $settle_invoice_data->balance - $amount;

    $overpayment = new OverPayment();
    $overpayment->invoice_id = $invoice_id;
    $overpayment->amount = $amount;
    $overpayment->from_invoice  = $from_invoice;

    try {

        $overpayment->save();
        $from_invoice_data->save();
        $settle_invoice_data->save();

        // doctor check
        fix_invoice_balance($from_invoice);
        fix_invoice_balance($invoice_id);

        $database->commit();
        Activity::log_action("Invoice Settlement Done");
        $_SESSION["message"] = "Settlement Successfull.";
        Functions::redirect_to("./../over_payments_settlement.php");
    } catch (Exception $exc) {
        $database->rollback();
        $_SESSION["error"] = "Error..! Failed to Settle." . $exc;
        Functions::redirect_to("./../over_payments_settlement.php");
    }
}

if (isset($_POST['delete'])) {
    try {
        $invoice_id = $_POST['invoice_id'];
        $invoice = Invoice::find_by_id($invoice_id);
        $invoice->balance = 0.00;
        $invoice->save();
        $database->commit();
        Activity::log_action("Invoice $invoice_id balance 0");
        $_SESSION["message"] = "Over Payments Delete Successfull.";
        Functions::redirect_to("./../over_payments.php");
    } catch (Exception $exc) {
        $database->rollback();
        $_SESSION["error"] = "Error..! Failed to Settle." . $exc;
        Functions::redirect_to("./../over_payments_settlement.php");
    }
}
