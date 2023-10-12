<?php
// include all model files
require_once './../../util/initialize.php';

// to fix the invoice balance
function fix_invoice_balance($invoice_number)
{
    $invoice = Invoice::find_by_id($invoice_number);

    $payment = 0;
    $invoice_payment = PaymentInvoice::find_all_by_invoice_id($invoice_number);
    foreach ($invoice_payment as $payment_data) {
        $payment = $payment + $payment_data->amount;
    }

    $return = 0;
    $invoice_return = ProductReturnInvoice::find_all_by_invoice_id($invoice_number);
    foreach ($invoice_return as $return_data) {
        $return = $return + $return_data->return_amount;
    }

    $from_settlement = 0;
    $invoice_from_settlement = OverPayment::find_all_by_from_invoice_id($invoice_number);
    foreach ($invoice_from_settlement as $invoice_settlement_data) {
        $from_settlement = $from_settlement + $invoice_settlement_data->amount;
    }

    $to_settlement = 0;
    $invoice_to_settlement = OverPayment::find_all_by_invoice_id($invoice_number);
    foreach ($invoice_to_settlement as $invoice_settlement_data) {
        $to_settlement = $to_settlement + $invoice_settlement_data->amount;
    }


    $write_off = 0;
    $invoice_write_off = WriteOff::find_all_by_invoice_id($invoice_number);
    foreach ($invoice_write_off as $invoice_writeoff_data) {
        $write_off = $write_off + $invoice_writeoff_data->amount;
    }

    $balance = $invoice->net_amount - $payment - $return + $from_settlement - $to_settlement - $write_off;

    if ($balance < 1 && $balance > -1) {
        $balance = 0;
    }

    if ($balance == 0) {
        $invoice->balance = 0;
        $invoice->invoice_status_id = 2;
    } else if ($balance < 0) {
        $invoice->balance = $balance;
        $invoice->invoice_status_id = 2;
    } else if ($balance > 0) {
        $invoice->balance = $balance;
        $invoice->invoice_status_id = 1;
    }

    $invoice->save();
}

// to fix the selling price
function update_latest_selling($product_id, $selling_retail)
{
    foreach (Batch::find_all_by_product_id($product_id) as $batch) {
        $batch_data = Batch::find_by_id($batch->id);
        $batch_data->retail_price = $selling_retail;
        $batch_data->save();
    }
}
