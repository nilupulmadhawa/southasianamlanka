<?php

require_once './../../util/initialize.php';

if (!empty($_GET['filter_id'])) {
  $invoice_id = $_GET["filter_id"];
  //    echo '<b>'.$invoice_id.'</b><br/>';
  //    header('Content-Type: application/json');//Payment No,Invoice No,Date/Time,Pay. Method,Pay. Status,Amount
  $payment_invoice = PaymentInvoice::find_by_sql("SELECT * FROM payment_invoice WHERE invoice_id =$invoice_id ");
  $invoice_details = Invoice::find_by_id($invoice_id);

  $customer_name = "";
  if ($invoice_details->customer_id) {
    $customer_name = Customer::find_by_id($invoice_details->customer_id)->name;
  } else {
    $customer_name = "Retail Customer";
  }
  $output = '<h4 id="title" style="color:#737373;">Invoices Details</h4>';

  $output .= '<div class="col-sm-6"><table id="tbl" class="table table-striped dt-responsive nowrap">

  <tr style="background-color:whitesmoke;">
  <th>Customer</th>
  <td>' . $customer_name . '</td>
  </tr>
  <tr>
  <th>Invoice Date</th>
  <td>' . $invoice_details->date_time . '</td>
  </tr>
  <tr>
  <th>Invoice Status</th>
  <td>' . InvoiceStatus::find_by_id($invoice_details->invoice_status_id)->name . '</td>
  </tr>
  </table>
  </div>';
  $output .= '<div class="col-sm-6">
  <table id="tbl" class="table table-striped dt-responsive nowrap">
  <tr>
  <th>Gross Amount</th>
  <td>' . $invoice_details->gross_amount . '</td>
  </tr>
  <tr>
  <th>Net Amount</th>
  <td>' . $invoice_details->net_amount . '</td>
  </tr>
  <tr>
  <th>Balance</th>
  <td>' . $invoice_details->balance . '</td>
  </tr>
  </table>
  </div>


  </tbody>
  </table></div>';

  $output .= '<br/><h4 id="title" style="color:#737373;">Payment Details</h4><br/>';
  $output .= '<table id="tbl" class="table table-striped dt-responsive nowrap">
  <thead>
  <tr style="background-color:gray;color:white;">
  <th>Payment No</th>
  <th>Invoice No</th>
  <th>Date/Time</th>
  <th>Pay. Method</th>
  <th>Bank Name</th>
  <th>Branch</th>
  <th>Banking Date</th>
  <th>Pay. Status</th>
  <th>Amount</th>
  </tr>
  </thead>
  <tbody >';
  $amount_total = 0.00;
  $amount_balance = 0.00;
  foreach ($payment_invoice as $payinv) {

    $payment_methood = PaymentMethod::find_by_id(Payment::find_by_id($payinv->payment_id)->payment_method_id);
    $payment_status = PaymentStatus::find_by_id(Payment::find_by_id($payinv->payment_id)->payment_status_id);
    $payment_method_id = Payment::find_by_id($payinv->payment_id)->payment_status_id;
    $payment_bank_id = Cheque::find_by_id(PaymentCheque::find_by_id(Payment::find_by_id($payinv->payment_id)->id)->cheque_id);
    // $payment_branch = Cheque::find_by_id(Cheque::find_by_id(PaymentCheque::find_by_id(Payment::find_by_id($payinv->payment_id)->id)->cheque_id)->branch_id);
    // $banking_date = Cheque::find_by_id(PaymentCheque::find_by_id(Payment::find_by_id($payinv->payment_id)->id)->cheque_id);

    if ($payment_method_id == 2) {
      $amount_total += Payment::find_by_id($payinv->payment_id)->amount;
    }
    if ($payment_method_id == 1) {
      $amount_balance += Payment::find_by_id($payinv->payment_id)->amount;
    }
    //
    $payment_code = Payment::find_by_id($payinv->payment_id)->code;
    $output .= '<tr style="background-color:whitesmoke;">'
      . '<td>  <a href="payment_prev.php?payment_id=' . Payment::find_by_id($payinv->payment_id)->code . '" target="_blank">' . sprintf('%05d', $payment_code) . '</a></td>
    <td>' . Invoice::find_by_id($payinv->invoice_id)->code . '</td>
    <td>' . Payment::find_by_id($payinv->payment_id)->date_time . '</td>
    <td>' . $payment_methood->name . '</td>
    <td>' . Bank::find_by_id($payment_bank_id->bank_id)->name . '</td>
    <td>' . $payment_bank_id->branch . '</td>
    <td>' . $payment_bank_id->date . '</td>
    <td>' . $payment_status->name . '</td>
    <td>' . Payment::find_by_id($payinv->payment_id)->amount . '</td>

    </tr>';
  }
  $output .= '<tr style="background-color:gray;color:white;" >'
    . '<td>' . "" . '</td>
  <td>' . "" . '</td>
  <td>' . "" . '</td>
  <td>' . "" . '</td>
  <td>' . "Total Pending Amount(LKR)" . '</td>
  <td>' . "Total Paid Amount(LKR)" . '</td>
  </tr><tr style="border-bottom:1px solid gray;">'
    . '<td>' . "" . '</td>'
    . '<td>' . "" . '</td>'
    . '<td>' . "" . '</td>'
    . '<td>' . "" . '</td>'
    . '<td>' . number_format($amount_balance, 2) . '</td>'
    . '<td>' . number_format($amount_total, 2) . '</td>'
    . '</tr>';
  $output .= '</tbody></table><br/>';


  echo $output;
} else {
  echo "There is no payment history for this invoice";
}